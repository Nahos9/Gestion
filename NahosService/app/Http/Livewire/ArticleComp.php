<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class ArticleComp extends Component
{
    public function render()
    {
        Carbon::setLocale("fr");
        return view('livewire.articles.index')
               ->extends('layouts.master')
               ->section('contenu');
    }
}
