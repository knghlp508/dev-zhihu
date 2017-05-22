<?php
namespace App\Mailer;

use Mail;
use Naux\Mail\SendCloudTemplate;

/**
 * 发送邮件基类
 * Class Mailer
 * @package App\Mailer
 */
class Mailer
{

  /**
   * 发送邮件（使用SendCloud）
   * @param $template
   * @param $email
   * @param array $data
   */
  protected function sendTo($template, $email, array $data)
  {
    $content = new SendCloudTemplate($template, $data);

    Mail::raw($content, function ($message) use ($email) {
      $message->from('henshuaidezhouming@vip.qq.com', 'Ming-Zhihu');

      $message->to($email);
    });
  }

}