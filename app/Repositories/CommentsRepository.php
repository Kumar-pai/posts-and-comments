<?php

namespace App\Repositories;

use App\Models\Comments;
use Illuminate\Database\Eloquent\Model;

class CommentsRepository extends Comments
{
    public function __construct()
    {
        parent::__construct();
    }

    public function resolveRouteBinding($value, $field = null): Model
    {
        $request = request();
        $posts = $request->route('posts');

        return $this->where([
            ['id', $value],
            ['posts_id', $posts->id]
        ])->firstOrFail();
    }
}
