<?php

namespace App\Models;

use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TypeArticle extends Model
{
    use HasFactory;

    protected $fillable = ["nom"];
    
    public function articles()
    {
        
        return $this->hasMany(Article::class);
    }

    public function proprietes()
    {
        return $this->HasMany(ProprieteArticle::class);
    }

}
