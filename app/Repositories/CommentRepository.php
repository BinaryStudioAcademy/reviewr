<?php

namespace App\Repositories;

use App\Comment;
use App\Repositories\Contracts\CommentRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class CommentRepository implements CommentRepositoryInterface
{
    public function all()
    {
        return Comment::all();
    }

    public function find($id)
    {
        return Comment::with('user')->findOrFail($id);
    }

    public function create(array $attributes) {}

    public function addCommentToRequest($data, $rid)
    {
        $comment = Comment::create([
            'text' => $data->text,
            'user_id' => Auth::user()->id,
            'review_request_id' => $rid
        ]);


        $last_comment_id = $comment->id;
        $last_comment = $comment->with('user')->find($last_comment_id);

        // Push last comment with user to all subscribers
        $data = [
            'topic_id' => 'request/' . $rid . '/comments',
            'data'     => $last_comment
        ];
        \App\Socket\Pusher::sendDataToServer($data);

        return $last_comment;
    }

    public function update(array $data, $id)
    {
        $comment = Comment::findOrFail($id);

        if ($comment->user_id == Auth::user()->id) {
            $comment->text = $data->text;
            $comment->save();

            return $comment;

        } else {
            return ['error' => ['message' => 'You can not edit not yours comment']];
        }
    }

    public function delete($id)
    {
        $comment = Comment::findOrFail($id);
        if ($comment->user_id == Auth::user()->id) {
            $removed = $comment; // store removed item for returning
            $comment->delete();
            return ['status' => 'Ok', 'message' => 'Comment removed', $removed];
        } else {
            return ['error' => ['message' => 'You can not remove not yours comment']];
        }
    }

    public function findByField($fieldName, $fieldValue, $columns=['*'])
    {
        return Comment::with('user')->where($fieldName, $fieldValue)->orderBy('created_at', 'ASC')->get($columns);
    }
}