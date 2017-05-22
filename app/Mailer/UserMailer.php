<?php
namespace App\Mailer;

use App\User;
use Auth;

/**
 * 用户邮件相关
 * Class UserMailer
 * @package App\Mailer
 */
class UserMailer extends Mailer
{

  /**
   * 发送关注邮件
   * @param string $email
   */
  public function followNotifyEmail($email)
  {
    $data = ['url' => 'http://dev-zhihu.com', 'name' => Auth::guard('api')->user()->name];

    $this->sendTo('zhihu_new_user_follow', $email, $data);
  }

  /**
   * 发送重置密码邮件
   * @param string $email
   * @param string $token
   */
  public function passwordReset($email, $token)
  {
    $data = ['url' => url('password/reset', $token)];

    $this->sendTo('zhihu_pwd_reset', $email, $data);
  }

  /**
   * 发送注册激活邮件
   * @param User $user
   */
  public function welcome(User $user)
  {
    $data = ['url' => route('email.verify', ['token' => $user->confirmation_token]), 'name' => $user->name];

    $this->sendTo('ming_zhihu_register', $user->email, $data);
  }

}
