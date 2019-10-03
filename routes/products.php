<?php


/*
|--------------------------------------------------------------------------
| Products Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of routes concerning correspondant
| controller. Each defined route point to Data method, on corresponding
| route. 
| Check documentation for more details.
|
*/


/**
 * Set route prefix
 */
$routePrefix = "/products";


/**
 * Set class prefix
 */
$classPrefix = "\Resty\Controllers\Products";


/**
 * Set routes rules
 */
$router
    ->post    ("$routePrefix/create",            ["$classPrefix\Create",    "Data"])
    ->any     ("$routePrefix/read",              ["$classPrefix\ReadAll",   "Data"])
    ->any     ("$routePrefix/read/{id}",         ["$classPrefix\ReadOne",   "Data"])
    ->post    ("$routePrefix/update/{id}",       ["$classPrefix\Update",    "Data"])
    ->post    ("$routePrefix/delete/{id}",       ["$classPrefix\Delete",    "Data"])
    ->any     ("$routePrefix/search/{max}?",     ["$classPrefix\Search",    "Data"])
;

