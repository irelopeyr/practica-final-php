<h1>Listado de publicaciones</h1>

<?php foreach ($posts as $post): ?>

    <h2><?= htmlspecialchars($post['title']) ?></h2>

    <p><?= htmlspecialchars($post['body']) ?></p>

    <p>
        Categoría:
        <?= htmlspecialchars($post['category']) ?>
    </p>

    <hr>

<?php endforeach; ?>