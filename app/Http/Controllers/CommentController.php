<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    private $comment;

    public function __construct(Comment $comment)
    {
         $this->comment = $comment;
    }

    public function store(Request $request,$post_id)
    {
        $request->validate(
            [
             'comment_body' . $post_id => 'required|max:150' 
            ], //バリデーションルール 'field_name' => 'rule1|rule2|...',
            [
             'comment_body' . $post_id . '.required' => 'You cannot submit an empty comment.',
             'comment_body' . $post_id . '.max' => 'The comment must not have more than 150 characters.'
            ] //エラーメッセージ  'field_name.rule' => 'Error message',
         );

        $this->comment->body = $request->input('comment_body' . $post_id);//inputは特定の投稿に対するコメントの本文を取得するために使用される
        $this->comment->user_id = Auth::user()->id;
        $this->comment->post_id = $post_id;
        $this->comment->save();

        return redirect()->back();
    }


    public function destroy($id)
   {
    $this->comment->destroy($id);

    return redirect()->back();
   }

}
