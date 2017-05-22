<?php
namespace App\Repositories;


use Illuminate\Http\Request;
use App\Topic;

/**
 * Class TopicsRepository
 * @package App\Repositories
 */
class TopicsRepository
{

  /**
   * @param Request $request
   * @return mixed
   */
  public function getTopicsForTagging(Request $request)
  {
    return Topic::select(['id', 'name'])
      ->where('name', 'like', '%' . $request->query('q') . '%')
      ->get();
  }

}