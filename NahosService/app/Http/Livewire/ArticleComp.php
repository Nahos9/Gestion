<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Article;
use App\Models\ArticlePropriete;
use App\Models\ProprieteArticle;
use App\Models\TypeArticle;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class ArticleComp extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $search = "";

    public $filtreEtat = "", $filtreType = "";

    public $addArticle = [];

    public $proprieteArticles = [];

    public $images;

    public $imageEdit;

    public $editArticle = [];

    public $inputFile = 0;
    public $hasChange;

    public $valueEditOld = [];

    // protected function rules()
    // {
    //     return [
    //         'editArticle.nom' => ["required", Rule::unique("articles", "nom")->ignore($this->editArticle["id"])],
    //         'editArticle.noSerie' => ["required", Rule::unique("articles", "noSerie")->ignore($this->editArticle["id"])],
    //         'editArticle.type_article_id' => "required|exists:App\Models\TypeArticle,id",
    //         'editArticle.article_proprietes.*.valeur' => "required",
    //     ];
    // }
    // cette founction permet de savoir si une  valeur d'une propriété de notre article à changer et afficher le boutton de modification
    public function showEditBouttun()
    {
        $this->hasChange = false;

        foreach ($this->valueEditOld["article_proprietes"] as $key => $valueOld) {
            if ($this->editArticle["article_proprietes"][$key]["valeur"] !== $valueOld["valeur"]) {
                $this->hasChange = true;
            }
        }
        if (
            $this->valueEditOld["nom"] !== $this->editArticle["nom"] ||
            $this->valueEditOld["noSerie"] !== $this->editArticle["noSerie"] ||
            $this->imageEdit !== null
        ) {
            $this->hasChange = true;
        }
    }


    protected function rules()
    {
        return [
            'editArticle.nom' => ["required", Rule::unique("articles", "nom")->ignore($this->editArticle["id"])],
            'editArticle.noSerie' => ["required", Rule::unique("articles", "noSerie")->ignore($this->editArticle["id"])],
            'editArticle.type_article_id' => "required|exists:App\Models\TypeArticle,id",
            'editArticle.article_proprietes.*.valeur' => "required",
        ];
    }
    public function render()
    {
        Carbon::setLocale("fr");
        $articleQuery = Article::query();

        if ($this->search != "") {
            $articleQuery->where("nom", "LIKE", "%" . $this->search . "%")
                ->orWhere("noSerie", "LIKE", "%" . $this->search . "%");
        }

        if ($this->filtreType != "") {
            $articleQuery->where("type_article_id", $this->filtreType);
        }
        if ($this->filtreEtat != "") {
            $articleQuery->where("estDisponible", $this->filtreEtat);
        }
        if ($this->editArticle !== []) {
            $this->showEditBouttun();
        }
        return view('livewire.articles.index', [
            "articles" => $articleQuery->latest()->where("nom", "LIKE", "%" . $this->search . "%")
                ->paginate(5),
            "typearticles" => TypeArticle::orderBy("nom", "ASC")->get()
        ])
            ->extends('layouts.master')
            ->section('contenu');
    }

    public function comfirmDeleteArticle(Article $article)
    {
        $this->dispatchBrowserEvent("showConfirmMessage", [
            "message" => [
                "title" => "Continuer!!",
                "text" => "Vous levez vous supprimer cet article",
                "type" => "warning",
                "data" => [
                    "article_id" => $article
                ]
            ]
        ]);
    }

    public function updated($proprety)
    {
        if ($proprety == "addArticle.type") {
            $this->proprieteArticles = TypeArticle::find($this->addArticle["type"])->proprietes;
        }
    }
    //suppression de l'article
    public function deleteArticle(Article $article)
    {
        $article->delete();

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Article supprimé avec success!!"]);
    }

    //formulaire d'ajout d'un article

    public function showAddForm()
    {
        $this->resetValidation();
        $this->addArticle = [];
        $this->proprieteArticles = [];
        $this->images = null;
        $this->inputFile++;
        $this->dispatchBrowserEvent("showModal");
    }

    public function closeModal()
    {
        $this->addArticle = [];
        $this->resetErrorBag();
        $this->dispatchBrowserEvent("closeModal", []);
    }

    //ajouter un article
    public function ajouterArticle()
    {

        // dump($this->addArticle);

        //reglès de validation des entrés satatiques de notre article
        $validateAttr = [
            "addArticle.nom" => "string|min:3|required|unique:articles,nom",
            "addArticle.noSerie" => "string|max:50|min:3|required|unique:articles,noSerie",
            "addArticle.type" => "required",
            "images" => "image|max:10240"
        ];

        $customErrMessage = [];
        $proIds = [];
        // reglès des validations des entrées dynamiques de notre article (le propritées du au type d'article choisi)
        foreach ($this->proprieteArticles as $propriete) {

            $Namefield = "addArticle.prop." . $propriete->nomPropriete;
            $proIds[$propriete->nomPropriete] = $propriete->id;

            if ($propriete->estObligatoire == 1) {
                $validateAttr[$Namefield] = "required";
                $customErrMessage["$Namefield.required"] = "Le champ  <<" . $propriete->nomPropriete . ">> est obligatoire";
            } else {
                $validateAttr[$Namefield] = "nullable";
            }
        }


        $data =  $this->validate($validateAttr, $customErrMessage);

        $imagePath = "img/photo.png";

        if ($this->images != "") {

            $path = $this->images->store('upload', 'public');
            $imagePath = "storage/" . $path;
            $image = Image::make(public_path($imagePath))->fit(200, 200);
            $image->save();
        }
        $article =  Article::create([
            "nom" => $data["addArticle"]["nom"],
            "noSerie" => $data["addArticle"]["noSerie"],
            "type_article_id" => $data["addArticle"]["type"],
            "imageUrl" => $imagePath
        ]);

        foreach ($data["addArticle"]["prop"] ?: [] as $key => $propriete) {
            ArticlePropriete::create([
                "article_id" => $article->id,
                "propriete_article_id" => $proIds[$key],
                "valeur" => $propriete
            ]);
        }
        $this->closeModal();
        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Article ajouté avec succès!!"]);
    }

    //modification d'un article (formaulaire de modifiaction)

    public function editArticle($articleId)
    {
        $this->editArticle = Article::with("type", "article_proprietes.propriete")->find($articleId)->toArray();
        $this->valueEditOld = $this->editArticle;
        $this->dispatchBrowserEvent("showEditModal", []);
    }
    // fonction de modification d'un article

    public function updateArticle()
    {
        $this->validate();

        $article = Article::find($this->editArticle["id"]);
        $article->fill($this->editArticle);

        if ($this->imageEdit != "") {
            $path = $this->imageEdit->store('upload', 'public');
            $imagePath = "storage/" . $path;
            $image = Image::make(public_path($imagePath))->fit(200, 200);
            $image->save();
            Storage::disk("local")->delete(str_replace("storage/", "public/upload", $article->imageUrl));
            $article->imageUrl = $imagePath;
        }
        $article->save();
        collect($this->editArticle["article_proprietes"])->each(function ($item) {
            ArticlePropriete::where([
                "article_id" => $item["article_id"],
                "propriete_article_id" => $item["propriete_article_id"],
            ])->update(["valeur" => $item["valeur"]]);
        });

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Article mis à jour avec succès!!"]);
        $this->closeEditModal();
    }

    public function closeEditModal()
    {

        $this->dispatchBrowserEvent("closeEditModal");
    }

    protected function cleanupOldUploads()
    {
        $storage = Storage::disk("local");

        foreach ($storage->allFiles("livewire-tmp") as $pathFileName) {
            if (!$storage->exists($pathFileName)) continue;

            $fiveSecondDelete = now()->subSeconds(5)->timestamp;
            if ($fiveSecondDelete > $storage->lastModified($pathFileName)) {
                $storage->delete($pathFileName);
            }
        }
    }
}