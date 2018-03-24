<?php
/**
 * Created by PhpStorm.
 * User: Parth
 * Date: 2018-03-07
 * Time: 12:36 PM
 */

namespace App\Filters;


use App\User;
use Illuminate\Http\Request;

class ThreadFilters extends Filters
{

    protected $filters = ['by','popular'];


    /**
     * @param $builder
     * @param $username
     * @return mixed
     */
    public function by($username)
    {
        $user = User::where('name', $username)->firstOrFail();
        return $this->builder->where('user_id', $user->id);
    }




    protected function popular(){

        $this->builder->getQuery()->orders=[];
        return $this->builder->orderBy('replies_count','desc');
    }
}