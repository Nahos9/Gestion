<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Article;
use App\Models\ProprieteArticle;
use App\Models\TypeArticle;
use Livewire\Component;
use Livewire\WithPagination;

class ArticleComp extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = "";

    public $filtreEtat = "", $filtreType="";

    public $addArticle = [];

    public $proprieteArticles = null;
    
    public function render()
    {
        Carbon::setLocale("fr");
        $articleQuery = Article::query();

        if($this->search != "")
        {
            $articleQuery->where("nom","LIKE","%".$this->search."%")
                          ->orWhere("noSerie","LIKE","%".$this->search."%");
        }

        if($this->filtreType != "")
        {
            $articleQuery->where("type_article_id",$this->filtreType);
        }
        if($this->filtreEtat != "")
        {
            $articleQuery->where("estDisponible",$this->filtreEtat);
        }
        return view('livewire.articles.index',[
            "articles"=>$articleQuery->latest()->where("nom","LIKE","%".$this->search."%")
                                            ->paginate(5),
            "typearticles"=>TypeArticle::orderBy("nom","ASC")->get()
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

    public function updated($proprety)
    {
        if($proprety == "addArticle.type")
        {
            $this->proprieteArticles = TypeArticle::find($this->addArticle["type"])->proprietes;
        }
    }
    //suppression de l'article
    public function deleteArticle(Article $article)
    {
        $article->delete();

        $this->dispatchBrowserEvent("showSuccessMessage",["message"=>"Article supprimé avec success!!"]);
    }

    //formulaire d'ajout d'un article

    public function showAddForm()
    {
        $this->dispatchBrowserEvent("showModal");
    }

    public function closeModal()
    {
      
        $this->dispatchBrowserEvent("closeModal", []);
       
    }

    //ajouter un article
    public function ajouterArticle()
    {
        dump($this->addArticle);
    }
}
