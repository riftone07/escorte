<?php

if (!function_exists('formaterDate')) {
    function formaterDate($date)
    {
        if (empty($date)) {
            return '';
        }
        return \Carbon\Carbon::parse($date)->format('d/m/Y');
    }
}

if (!function_exists('formaterDateTime')) {
    function formaterDateTime($date)
    {
        if (empty($date)) {
            return '';
        }
        return \Carbon\Carbon::parse($date)->format('d/m/Y H:i');
    }
}

if (!function_exists('formaterTime')) {
    function formaterTime($time)
    {
        if (empty($time)) {
            return '';
        }
        return \Carbon\Carbon::parse($time)->format('H:i');
    }
}

//formater Montant
if (!function_exists('formaterMontant')) {
    function formaterMontant($montant)
    {
        if (empty($montant)) {
            return '';
        }
        return \NumberFormatter::create('fr', \NumberFormatter::CURRENCY)->format($montant);
    }
}

if (!function_exists('getOneUser')) {
    function getOneUser($user)
    {
        foreach ($user->roles as $role) {
            return $role->name;
        }

        return null;
    }
}

