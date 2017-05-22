<?php
namespace App;


/**
 * Class Setting
 * @package App
 */
class Setting
{

  /**
   * @var User
   */
  protected $user;

  /**
   * @var array
   */
  protected $allowed = ['city', 'bio'];

  /**
   * Setting constructor.
   * @param User $user
   */
  public function __construct(User $user)
  {
    $this->user = $user;
  }

  /**
   * @param array $attributes
   */
  public function merge(array $attributes)
  {
    $settings = array_merge($this->user->settings, array_only($attributes, $this->allowed));
    $this->user->update(['settings' => $settings]);
  }

}