<?php

namespace App\Http\Controllers;
use App\Friend;
use App\Post;
use Illuminate\Http\Request;

class NewsFeedController extends Controller
{
    //
    public function index(){
        $friends = Friend::friendships();
        $user_id[] = auth()->user()->id;
        $user_ids = array_merge($user_id,$friends->pluck('user_id')->toArray());
        $user_ids = array_merge($user_id,$friends->pluck('friend_id')->toArray());
        $user_ids = array_unique($user_ids);

//        dd($user_ids);


        $posts = Post::with(['user','likes','comments.user'])->whereIn('user_id',$user_ids)->orderBy('created_at','desc')->get();

//        dd($posts->toArray());
        return view('news-feed',compact('posts'));
    }


}
