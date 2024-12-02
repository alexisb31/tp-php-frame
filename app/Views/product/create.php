<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="/products/store" method="POST">
        <div>
            <div>
                <label>Nom</label>
            </div>
            <input type="text" name="name" value="<?=($old['name'] ?? '') ?>">
            <?php if (isset($errors['name'])): ?>
                <div><?= $errors['name'] ?></div>
            <?php endif; ?>
        </div>
        <div>
            <div>
                <label>Description</label>
            </div>
            <textarea name="description"><?=($old['description'] ?? '') ?></textarea>
            <?php if (isset($errors['description'])): ?>
                <div><?= $errors['description'] ?></div>
            <?php endif; ?>
        </div>
        <div>
            <div>
                <label>Prix</label>
            </div>
            <input type="text" name="price" value="<?=($old['price'] ?? '') ?>">
            <?php if (isset($errors['price'])): ?>
                <div><?= $errors['price'] ?></div>
            <?php endif; ?>
        </div>
        <div>
            <div>
                <label>Catégorie</label>
            </div>
            <select name="category_id">
                <option value="">-- Choisir --</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category->id ?>" <?= ($old['category_id'] ?? '') == $category->id ? 'selected' : '' ?>><?= $category->name ?></option>
                <?php endforeach; ?>
            </select>
            <?php if (isset($errors['category_id'])): ?>
                <div><?= $errors['category_id'] ?></div>
            <?php endif; ?>
        </div>
        <div>
            <button type="submit">Créer</button>
        </div>
    </form>
</body>
</html>