<?php

namespace App\Http\Livewire;

use App\Models\Article;
use Carbon\Carbon;
use Livewire\Component;

class ArticleComp extends Component
{
    public function render()
    {
        Carbon::setLocale("fr");
        return view('livewire.articles.index',[
            "articles"=>Article::latest()->paginate(5)
        ])
               ->extends('layouts.master')
               ->section('contenu');
    }
}
