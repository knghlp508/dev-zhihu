<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Class UsersController
 * @package App\Http\Controllers
 */
class UsersController extends Controller
{

  /**
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function avatar()
  {
    return view('users.avatar');
  }

  /**
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function changeAvatar(Request $request)
  {
    $file = $request->file('img');
    $filename = 'avatars/' . md5(time() . user()->id) . '.' . $file->getClientOriginalExtension();

    //上传到项目目录
    $filename = md5(time() . user()->id) . '.' . $file->getClientOriginalExtension();
    $file->move(public_path('avatars'), $filename);
    user()->avatar = '/avatars/' . $filename;

    //上传到七牛
    /*$filename = 'avatars/' . md5(time() . user()->id) . '.' . $file->getClientOriginalExtension();
    Storage::disk('qiniu')->writeStream($filename, fopen($file->getRealPath(), 'r'));
    user()->avatar = 'http://' . config('filesystems.disks.qiniu.domain') . '/' . $filename;*/
    user()->save();

    return response()->json(['url' => user()->avatar]);
  }

}
