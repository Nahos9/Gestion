<?php

namespace App\Models;

use App\Models\TypeArticle;
use App\Models\ProprieteArticle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    public function type()
    {
        return $this->belongsTo(TypeArticle::class ,"type_article_id", "id");
    }

    public function proprieteArticles()
    {
        return $this->belongsToMany(ProprieteArticle::class);
    }
    
    public function locations()
    {
        return $this->belongsToMany(Location::class,"article_location","article_id","location_id");
    }
}
