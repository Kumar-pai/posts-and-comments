<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Posts;

class Comments extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = [
        'messages'
    ];

    public function posts()
    {
        return $this->belongsTo(Posts::class, 'posts_id', 'id');
    }
}
