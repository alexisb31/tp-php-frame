<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Product;
use Core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::get();

        $categories = Category::get();

        return $this->render('home', compact('products', 'categories'));
    }
}  