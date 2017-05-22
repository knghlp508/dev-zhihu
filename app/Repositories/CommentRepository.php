<?php
namespace App\Repositories;


use App\Comment;
use App\Question;

/**
 * Class CommentRepository
 * @package App\Repositories
 */
class CommentRepository
{

  protected $question;

  /**
   * CommentRepository constructor.
   * @param $question
   */
  public function __construct(QuestionRepository $question)
  {
    $this->question = $question;
  }


  /**
   * @param array $attributes
   * @return static
   */
  public function create(array $attributes)
  {
    $comment = Comment::create($attributes);
    if ($comment && $attributes['commentable_type'] === 'App\Question') {
      $question = $this->question->byId($attributes['commentable_id']);
      $question->increment('comments_count');
    }
    return $comment;
  }

}