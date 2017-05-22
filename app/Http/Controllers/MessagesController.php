<?php

namespace App\Http\Controllers;

use App\Repositories\MessageRepository;
use Illuminate\Http\Request;

/**
 * Class MessagesController
 * @package App\Http\Controllers
 */
class MessagesController extends Controller
{

  /**
   * @var MessageRepository
   */
  protected $message;

  /**
   * MessagesController constructor.
   * @param $message
   */
  public function __construct(MessageRepository $message)
  {
    $this->message = $message;
  }

  /**
   * @return \Illuminate\Http\JsonResponse
   */
  public function store()
  {
    $message = $this->message->create([
      'to_user_id' => request('user'),
      'from_user_id' => user('api')->id,
      'body' => request('body'),
      'dialog_id' => user('api')->id < request('user') ? user('api')->id . request('user') : request('user') . user('api')->id
    ]);
    return $message ? response()->json(['status' => true]) : response()->json(['status' => false]);
  }

}
