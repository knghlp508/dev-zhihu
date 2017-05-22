<?php
namespace App\Repositories;


use App\Answer;

/**
 * Class AnswerRepository
 * @package App\Repositories
 */
class AnswerRepository
{

  /**
   * @param array $attributes
   * @return static
   */
  public function create(array $attributes)
  {
    $answer = Answer::create($attributes);
    $answer->question()->increment('answers_count');
    $answer->user()->increment('answers_count');
    return $answer;
  }

  /**
   * @param $id
   * @return mixed
   */
  public function byId($id)
  {
    return Answer::find($id);
  }

  /**
   * @param $id
   * @return mixed
   */
  public function getAnswerCommentsById($id)
  {
    $answer = Answer::with('comments', 'comments.user')->where('id', $id)->first();
    return $answer->comments;
  }

}