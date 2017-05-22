<?php

namespace App\Http\Controllers;

use App\Notifications\NewUserFollowNotification;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

/**
 * Class FollowersController
 * @package App\Http\Controllers
 */
class FollowersController extends Controller
{

  /**
   * @var UserRepository
   */
  protected $user;

  /**
   * FollowersController constructor.
   * @param $user
   */
  public function __construct(UserRepository $user)
  {
    $this->user = $user;
  }


  /**
   * @param int $id
   * @return \Illuminate\Http\JsonResponse
   */
  public function index($id)
  {
    $user = $this->user->byId($id);
    $followers = $user->followersUser()->pluck('follower_id')->toArray();
    return response()->json(['followed' => (in_array(user('api')->id, $followers)) ? true : false]);
  }

  /**
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function follow(Request $request)
  {
    $userToFollow = $this->user->byId($request->get('user'));

    $followed = user('api')->followThisUser($userToFollow->id);
    if (count($followed['attached']) > 0) {
      $userToFollow->notify(new NewUserFollowNotification());
      $userToFollow->increment('followers_count');
      return response()->json(['followed' => true]);
    }
    $userToFollow->decrement('followers_count');
    return response()->json(['followed' => false]);
  }
}
