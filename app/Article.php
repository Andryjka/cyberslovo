<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Article extends Model
{
    protected $fillable = ['title', 'slug', 'description_short', 'description', 'image', 'image_show', 'meta_title', 'meta_description', 'meta_keywords', 'published', 'created_by', 'modified_by', 'source', 'rss_content'];

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y H:i');
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y H:i');
    }

    
    public function setSlugAttribute()
    {
        $this->attributes['slug'] = Str::slug(mb_substr($this->title,0,100));
    }
    
    // Polymorhic relations
    public function categories()
    {
        return $this->morphToMany('App\Category', 'categoryable');
    }

    public function getCategoryArticles()
    {
        return $this->belongsTo('App\Category')->withDefault();
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    public function author()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function getTagsList()
    {
        return $this->tags->pluck('id');
    }
}
