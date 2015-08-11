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
        $tag = new Tag();
        $tag->title = $data;
        $tag->save();
        return $tag;
    }

    public function OneById($id) {}
}