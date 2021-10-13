<?php

use Illuminate\Support\Str;

define("PAGEEDITFORM","edit");
define("PAGELISTE","liste");
define("PAGEUSERFORM","userform");


function fullName()
{
    return auth()->user()->nom ." ".auth()->user()->prenom;
}


function getRolesName()
{
    $rolesName = "";
    $i = 0;
    foreach(auth()->user()->roles as $role)
    {
        $rolesName .= $role->nomRole;

        if($i< sizeof(auth()->user()->roles)-1){
            $rolesName .= ",";
        }
    }
    $i++;

    return $rolesName;
}

function setMenuClasse($route, $classe)
{
    $routeActuelle = request()->route()->getName();

    if(contains($routeActuelle,$route))
    {
        return $classe;
    }
    return "";
}

function setMenuActive($route)
{
    $routeActuelle = request()->route()->getName();

    if($routeActuelle === $route)
    {
        return "active";
    }
    return "";
}

function contains($container, $contenu)
{
    return Str::contains($container, $contenu);
}