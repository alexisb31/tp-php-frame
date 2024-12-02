<?php

namespace App\Controllers;

use App\Models\Category;
use Core\Controller;

class CategoryController extends Controller
{
    public static function show($slug, $id) 
    {
        $category = Category::find($id);

        dump($category);
    }
}