<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
    <a href="/products/create">Ajouter un produit</a>
    </div>
    <?php foreach($products as $product): ?>
        <h2><a href="<?= $product->getUrl() ?>"><?= $product->name ?></a></h2>
        <p><?= $product->description ?></p>
    <?php endforeach; ?>
</body>
</html>