<?php

namespace App\Http\Livewire;

use App\Models\TypeArticle;
use Livewire\Component;

use Livewire\WithPagination;

class TypeArticleComp extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
       
        $data = ["typearticles"=>TypeArticle::latest()->paginate(5)];
        return view('livewire.typearticles.index',$data)
                ->extends('layouts.master')
                ->section('contenu');
    }
}
