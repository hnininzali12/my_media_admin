<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Reaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReactionController extends Controller
{
    //set reaction
    public function reaction(Request $request){
      $data =[
        'user_id'=>$request->user_id,
        'post_id'=>$request->post_id,
       ];
       Reaction::create($data);
       $reaction = Reaction::where('post_id',$request->post_id)->get();
       return response()->json([
        'post'=>$reaction,
       ]);
    }

    //delete reaction
    public function deleteReaction(Request $request){
       Reaction::where('reaction_id',$request->reaction_id)
                 ->delete();
       $reaction = Reaction::where('post_id',$request->post_id)->get();
       return response()->json([
        'post'=>$reaction,
       ]);
    }

    //get reaction
    public function reactionCount(Request $request){
        $reaction=Reaction::where('post_id',$request->post_id)
                    ->get();
        return response()->json([
            'post'=>$reaction,
        ]);
    }

    //create comment
    public function comment(Request $request){
        $data=[
             'user_id'=>$request->user_id,
             'post_id'=>$request->post_id,
             'comment'=>$request->comment,
             'created_at'=>Carbon::now(),
        ];
        Reaction::create($data);
           $comment = Reaction::select('users.name','reactions.*')
                            ->join('users','reactions.user_id','users.id')
                            ->where('post_id',$request->post_id)
                            ->orderBy('created_at','desc')
                            ->get();
        return response()->json([
            'comment'=>$comment,
        ]);
    }

    //get comment
     public function getComment(Request $request){
        $comment = Reaction::select('users.name','reactions.*')
                            ->join('users','reactions.user_id','users.id')
                            ->where('post_id',$request->post_id)
                            ->orderBy('created_at','desc')
                            ->get();
        return response()->json([
            'comment'=>$comment,
        ]);
    }

    //delete comment
    public function deleteComment(Request $request){
        Reaction::where('reaction_id',$request->reaction_id)->delete();
       $data = Reaction::select('users.name','reactions.*')
                            ->join('users','reactions.user_id','users.id')
                            ->where('post_id',$request->post_id)
                            ->orderBy('created_at','desc')
                            ->get();
        return response()->json([
          'comment'=>$data,
        ]);
    }

    //update comment
    public function updateComment(Request $request){
         $data=[
             'post_id'=>$request->post_id,
             'comment'=>$request->comment,
             'created_at'=>Carbon::now(),
        ];
        Reaction::where('reaction_id',$request->reaction_id)->update($data);
           $comment = Reaction::select('users.name','reactions.*')
                            ->join('users','reactions.user_id','users.id')
                            ->where('post_id',$request->post_id)
                            ->orderBy('created_at','desc')
                            ->get();
        return response()->json([
            'comment'=>$comment,
        ]);
    }
}
