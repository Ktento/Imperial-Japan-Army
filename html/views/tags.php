

<?php foreach ($tags as $tag): ?>
    <a href="top.php?tags=<?= $tag ?>" class="px-3 py-1 border text-xs hover:text-blue-500"><?= htmlspecialchars($tag, ENT_QUOTES, 'UTF-8') ?></a>
<?php endforeach; ?>