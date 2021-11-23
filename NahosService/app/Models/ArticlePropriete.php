<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticlePropriete extends Model
{
    public $table = "article_propriete";

    protected $fillable = [
        "article_id",
        "propriete_article_id",
        "valeur"
    ];

    use HasFactory;

    public function propriete()
    {
        return $this->hasOne(ProprieteArticle::class,'id','propriete_article_id');
    }
}
