<?php
namespace App\Repositories;


use App\Question;
use App\Topic;
use App\User;

/**
 * Class QuestionRepository
 * @package App\Repositories
 */
class QuestionRepository
{

  /**
   * @return mixed
   */
  public function getQuestionsFeed()
  {
    return Question::published()->latest('updated_at')->with('user')->get();
  }

  /**
   * @param $id
   * @return mixed
   */
  public function byIdWithTopicsAndAnswer($id)
  {
    return Question::where('id', $id)->with('topics', 'answers')->first();
  }

  /**
   * @param array $attributes
   * @return static
   */
  public function create(array $attributes)
  {
    $question = Question::create($attributes);
    $user = User::find($question->user_id);
    $user->increment('questions_count');
    return $question;
  }

  /**
   * @param $id
   * @return mixed
   */
  public function byId($id)
  {
    return Question::find($id);
  }

  /**
   * @param array $topics
   * @return array
   */
  public function normalizeTopic(array $topics)
  {
    return collect($topics)->map(function ($topic) {
      if (is_numeric($topic)) {
        Topic::find($topic)->increment('questions_count');
        return (int)$topic;
      }
      $newTopic = Topic::create(['name' => $topic, 'questions_count' => 1]);
      return $newTopic->id;
    })->toArray();
  }

  /**
   * @param $question
   * @return int
   */
  public function followCount($question)
  {
    $question = Question::find($question);
    return (int)$question->follows_count;
  }

  /**
   * @param $id
   * @return mixed
   */
  public function getQuestionCommentsById($id)
  {
    $question = Question::with('comments', 'comments.user')->where('id', $id)->first();
    return $question->comments;
  }

}