
<?php foreach ($tags as $tag): ?>
    <span class="px-3 py-1 border text-xs"><?= htmlspecialchars($tag, ENT_QUOTES, 'UTF-8') ?></span>
<?php endforeach; ?>