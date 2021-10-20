<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TypeArticleComp extends Component
{
    public function render()
    {
        // use WithPagination;
    
        // protected $paginationTheme = 'bootstrap';

        return view('livewire.type-article-comp')
                ->extends('layouts.master')
                ->section('contenu');
    }
}
