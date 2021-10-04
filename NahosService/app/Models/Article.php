<?php

namespace App\Models;

use App\Models\TypeArticle;
use App\Models\ProprieteArticle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    public function typeArticle()
    {
        return $this->belongsTo(TypeArticle::class);
    }

    public function proprieteArticles()
    {
        return $this->belongsToMany(ProprieteArticle::class);
    }
    
    public function locations()
    {
        return $this->belongsToMany(Location::class);
    }
}
