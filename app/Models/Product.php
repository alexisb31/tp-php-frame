<?php

namespace App\Models;

use Core\Model;

class Product extends Model
{
    public function getSlug()
    {
        return slugify($this->name);
    }

    public function getCategory()
    {
        return Category::find($this->category_id);

    }    


    public function getUrl()
    {
        return '/products/' . $this->getSlug() . '-' . $this->id;
    }
}