<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Today extends Model
{
    protected $fillable = ['title', 'today', 'description', 'image', 'color', 'source', 'created_at', 'updated_at', 'published', 'description_feed', 'photo_published', 'card_icon', 'sort'];
}
