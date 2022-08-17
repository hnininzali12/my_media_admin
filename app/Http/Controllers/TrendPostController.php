<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\ActionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrendPostController extends Controller
{
    //direct trend post page
     public function index() {
        $post = ActionLog::select('action_logs.*','posts.*',DB::raw('COUNT(action_logs.post_id) as post_count'))
                           ->leftJoin('posts','posts.post_id','action_logs.post_id')
                           ->groupBy('action_logs.post_id')
                           ->orderBy('post_count','desc')
                           ->get();
        return view('admin.trend_post.index',compact('post'));
    }

    //direct details trend post
    public function detailsTrendPost($id){
        $post =Post::where('post_id',$id)->first();
        return view('admin.trend_post.details',compact('post'));
    }
}
