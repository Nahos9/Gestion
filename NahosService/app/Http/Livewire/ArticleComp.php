<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;

class ArticleComp extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = "";
    
    public function render()
    {
        Carbon::setLocale("fr");
        $articleQuery = Article::query();
        if($this->search != "")
        {
            $articleQuery->where("nom","LIKE","%".$this->search."%")
                          ->orWhere("noSerie","LIKE","%".$this->search."%");
        }
        return view('livewire.articles.index',[
            "articles"=>$articleQuery->latest()->where("nom","LIKE","%".$this->search."%")
                                            ->paginate(5)
        ])
               ->extends('layouts.master')
               ->section('contenu');
    }

    public function comfirmDeleteArticle(Article $article)
    {
        $this->dispatchBrowserEvent("showConfirmMessage",[
            "message"=>[
                "title"=>"Continuer!!",
                "text"=>"Vous levez vous supprimer cet article",
                "type"=>"warning",
                "data"=>[
                    "article_id"=>$article
                ]
            ]
            ]);
    }
    //suppression de l'article
    public function deleteArticle(Article $article)
    {
        $article->delete();

        $this->dispatchBrowserEvent("showSuccessMessage",["message"=>"Article supprimé avec success!!"]);
    }
}
