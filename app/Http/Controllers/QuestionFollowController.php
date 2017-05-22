<?php

namespace App\Http\Controllers;

use App\Repositories\QuestionRepository;
use Illuminate\Http\Request;

/**
 * Class QuestionFollowController
 * @package App\Http\Controllers
 */
class QuestionFollowController extends Controller
{

  /**
   * @var QuestionRepository
   */
  protected $question;

  /**
   * QuestionFollowController constructor.
   * @param QuestionRepository $question
   */
  public function __construct(QuestionRepository $question)
  {
    $this->question = $question;
  }

  /**
   * @param $question
   * @return \Illuminate\Http\JsonResponse
   */
  public function followCount($question)
  {
    return response()->json(['count' => $this->question->followCount($question)]);
  }

  public function follower(Request $request)
  {
    $followed = user('api')->followed($request->get('question'));
    return response()->json(['followed' => !!$followed]);
  }

  public function followThisQuestion(Request $request)
  {
    $question = $this->question->byId($request->get('question'));
    $followed = user('api')->followThis($question->id);
    if (count($followed['detached']) > 0) {
      $question->decrement('follows_count');
      return response()->json(['followed' => false]);
    }

    $question->increment('follows_count');
    return response()->json(['followed' => true]);
  }

}
