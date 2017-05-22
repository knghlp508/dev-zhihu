<?php

if (!function_exists('user')) {
  /**
   * @param null $driver
   * @return mixed
   */
  function user($driver = null)
  {
    return $driver ? app('auth')->guard($driver)->user() : app('auth')->user();
  }
}