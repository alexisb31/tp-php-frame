<?php
namespace App\Controllers;

use App\Models\Category;
use App\Models\Product;
use Core\Controller;

class ProductController  extends Controller
{
    public function show($slug, $id)
    {
        $product = Product::find($id);

        if ($product->getSlug() !== $slug) {
            $this->redirect($product->getUrl());
        }

        return $this->render('product.show', compact('product'));
    }

    public function create()
    {
        $categories = Category::get();
        return $this->render('product.create', compact('categories'));
    }

    public function store()
    {
        // Validation des données du formulaire
        // Nom : pas vide meme si espace, max 255 caractères 
        //Description : pas de contrainte 
        //Prix : pas vide, decimal, positif
        //Catégorie : pas vide, doit exister en base de données

        $errors = $this->validate([
            'name' => ['required','max:255'],
            'description' => 'nullable',
            'price' => 'required|decimal|min:0',
            'category_id' => 'required|exists:Category,id'
        ], 'post');

    }
}