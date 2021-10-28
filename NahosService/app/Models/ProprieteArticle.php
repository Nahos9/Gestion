<?php

namespace App\Models;

use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProprieteArticle extends Model
{
    use HasFactory;

    protected $fillable = ["nomPropriete","estObligatoire","type_article_id"];

    public function typeArticle()
    {
        return $this->belongsTo(TypeArticle::class);
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class,"article_propriete","propriete_article_id","article_id");
    }
}
