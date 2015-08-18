<?php

namespace App\Repositories;

use App\Comment;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class CommentRepository implements CommentRepositoryInterface
{
    public function all()
    {
        return Comment::all();
    }

    public function OneById($id)
    {
        return Comment::with('user')->findOrFail($id);
    }

    public function create($data) {}

    public function addCommentToRequest($data, $rid)
    {
        $comment = new Comment;
        $comment->text = $data->text;
        $comment->user_id = Auth::user()->id;
        $comment->review_request_id = $rid;
        $comment->save();

        return $comment;
    }

    public function update($id, $data)
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