<?php

namespace App\Repositories;

use App\Tag;
use App\Repositories\Interfaces\TagRepositoryInterface;

class TagRepository implements TagRepositoryInterface
{
    public function all()
    {
        return Tag::all();
    }

    public function create($data)
    {
        $tag = new Tag;
        $tag->title = $data->title;
        $tag->save();

        return $tag;
    }

    public function OneById($id) {}

    public function searchByKeyWord($keyword)
    {
        return Tag::where('title', 'like', '%'.$keyword.'%')->get();
    }
}