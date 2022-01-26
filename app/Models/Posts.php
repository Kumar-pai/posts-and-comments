<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Comments;

class Posts extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'title',
        'content',
    ];

    public function hasMany($related, $foreignKey = null, $localKey = null)
    {
        return $this->hasMany(Comments::class, 'posts_id', 'id');
    }
}
