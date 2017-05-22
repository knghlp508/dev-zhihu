<?php

namespace App\Http\Controllers;

use App\Repositories\TopicsRepository;
use Illuminate\Http\Request;

/**
 * Class TopicsController
 * @package App\Http\Controllers
 */
class TopicsController extends Controller
{
  /**
   * @var TopicsRepository
   */
  protected $topic;

  /**
   * TopicsController constructor.
   * @param $topic
   */
  public function __construct(TopicsRepository $topic)
  {
    $this->topic = $topic;
  }

  /**
   * @param Request $request
   * @return mixed
   */
  public function index(Request $request)
  {
    return $this->topic->getTopicsForTagging($request);
  }
}
