<?php

namespace App;

use App\Mailer\UserMailer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Mail;
use Naux\Mail\SendCloudTemplate;

/**
 * Class User
 * @package App
 */
class User extends Authenticatable
{
  use Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['name', 'email', 'password', 'avatar', 'confirmation_token', 'api_token', 'settings'];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  /**
   * @var array
   */
  protected $casts = [
    'settings' => 'json'
  ];

  /**
   * @return Setting
   */
  public function settings()
  {
    return new Setting($this);
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function answers()
  {
    return $this->hasMany(Answer::class);
  }

  /**
   * @return static
   */
  public function follows()
  {
    return $this->belongsToMany(Question::class, 'user_question')->withTimestamps();
  }

  /**
   * @param $question
   * @return mixed
   */
  public function followThis($question)
  {
    return $this->follows()->toggle($question);
  }

  /**
   * @param $question
   * @return mixed
   */
  public function followed($question)
  {
    return !!$this->follows()->where('question_id', $question)->count();
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function followers()
  {
    return $this->belongsToMany(self::class, 'followers', 'follower_id', 'followed_id')->withTimestamps();
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function followersUser()
  {
    return $this->belongsToMany(self::class, 'followers', 'followed_id', 'follower_id')->withTimestamps();
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function votes()
  {
    return $this->belongsToMany(Answer::class, 'votes')->withTimestamps();
  }

  /**
   * @param $answer
   * @return array
   */
  public function voteFor($answer)
  {
    return $this->votes()->toggle($answer);
  }

  /**
   * @param $answer
   * @return bool
   */
  public function hasVoteFor($answer)
  {
    return !!$this->votes()->where('answer_id', $answer)->count();
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function messages()
  {
    return $this->hasMany(Message::class, 'to_user_id');
  }

  /**
   * @param $user
   * @return array
   */
  public function followThisUser($user)
  {
    return $this->followers()->toggle($user);
  }

  /**
   * @param string $token
   */
  public function sendPasswordResetNotification($token)
  {
    (new UserMailer())->passwordReset($this->email, $token);
  }

  /**
   * @param Model $model
   * @return bool
   */
  public function owns(Model $model)
  {
    return $this->id == $model->user_id;
  }

}
