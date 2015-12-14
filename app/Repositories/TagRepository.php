<?php

namespace App\Repositories;

use App\Tag;
use App\Repositories\Contracts\TagRepositoryInterface;

class TagRepository implements TagRepositoryInterface
{
    public function all()
    {
        return Tag::orderBy('title')->get();
    }

    public function create(array $data)
    {
        $tags = Tag::all();

        foreach($tags as $temp) {
            if ($data == $temp->title) return $temp;
        }

        $tag = new Tag();
        $tag->title = $data['title'];
        $tag->save();
        return $tag;
    }

    public function find($id) {}

    public function update(array $data, $id) {}

    public function delete($id)
    {
        return Tag::findOrFail($id)->delete();
    }

    public function searchByKeyWord($keyword)
    {
        return Tag::where('title', 'like', '%'.$keyword.'%')->get();
    }

    public function getPopular()
    {
        $tags = $this->all();
        $tags_sorted = $tags->sortByDesc('requests_count');
        return $tags_sorted->values()->all();
    }
}