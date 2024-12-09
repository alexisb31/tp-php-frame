<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Product;
use Core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::query()
            ->where('price', '>', 0)
            ->orderBy('price', 'desc')
            ->orderby('name')
            ->get();

        $categories = Category::get();

        return $this->render('home', compact('products', 'categories'));
    }
}  