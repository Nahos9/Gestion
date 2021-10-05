<?php


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