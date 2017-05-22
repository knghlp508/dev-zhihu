<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnswerRequest;
use App\Repositories\AnswerRepository;
use Illuminate\Http\Request;

/**
 * Class AnswersController
 * @package App\Http\Controllers
 */
class AnswersController extends Controller
{

  /**
   * @var AnswerRepository
   */
  protected $answer;

  /**
   * AnswersController constructor.
   * @param $answer
   */
  public function __construct(AnswerRepository $answer)
  {
    $this->answer = $answer;
  }

  /**
   * @param \App\Http\Requests\StoreAnswerRequest $request
   * @param $question
   * @return \Illuminate\Http\RedirectResponse
   */
  public function store(StoreAnswerRequest $request, $question)
  {
    $this->answer->create([
      'question_id' => $question,
      'user_id' => user()->id,
      'body' => $request->get('body')
    ]);
    return back();
  }
}
