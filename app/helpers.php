<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}

function category_nav_active($categoryId)
{
    return active_class(if_route('categories.show') && if_route_param('category', $categoryId));
}

function make_excerpt($string, $length = 200)
{
    $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($string)));

    return Str::limit($excerpt, $length);
}
