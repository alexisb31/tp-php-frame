<!DOCTYPE html>
<html lang="fr">
<title>Document</title>
<style>

body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
    color: #333;
}

div {
    text-align: center;
    margin: 20px;
}

a {
    text-decoration: none;
    color: #007BFF;
    transition: color 0.3s;
}

a:hover {
    color: #0056b3;
}


.product-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    padding: 20px;
    max-width: 1200px;
    margin: auto;
}

.product-card {
    background-color: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s, box-shadow 0.3s;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.product-card a {
    display: block;
    padding: 10px;
    font-weight: bold;
    font-size: 18px;
    color: #333;
    text-align: center;
}

.product-card a:hover {
    color: #007BFF;
}

.product-card p {
    margin: 10px;
    font-size: 16px;
    color: #666;
}


.product-card .price {
    font-weight: bold;
    font-size: 20px;
    color: #28a745;
    margin: 10px;
    text-align: center;
}


div a {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007BFF;
    color: #fff;
    border-radius: 4px;
    font-weight: bold;
    transition: background-color 0.3s;
}

div a:hover {
    background-color: #0056b3;
}

</style>

<body>
    <div>
        <a href="/products/create">Ajouter un produit</a>
    </div>
    <div class="product-container">
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <h2><a href="<?= $product->getUrl() ?>"><?= $product->name ?></a></h2>
                <p><?= $product->description ?></p>
                <p class="price"><?= $product->price ?>€</p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>