<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Comments;

class Posts extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'uuid',
        'title',
        'content',
    ];

    public function comments()
    {
        return $this->hasMany(Comments::class, 'posts_id', 'id');
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('uuid', $value)->firstOrFail();
    }
}
