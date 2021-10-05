<?php


function fullName()
{
    return auth()->user()->nom ." ".auth()->user()->prenom;
}