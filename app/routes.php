<?php

return [
        '/' => 'home.index',
        'products/{alphanum}-{num}' => 'product.show',
        'products/create' => 'product.create',
        'products/store' => 'product.store',
        'categories/{alphanum}-{num}' => 'category.show',
];
