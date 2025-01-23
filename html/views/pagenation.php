<div class="flex space-x-1">
    <span><?= $total_comments ?> 件の記事 • ページ <?= $page ?> / <?= $total_pages ?></span>
    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <a href="?id=<?= $topic_id ?>&page=<?= $i ?>" 
            class="px-1 py-1 border <?= $i === $page ? 'bg-gray-300' : 'hover:bg-gray-100' ?>">
            <?= $i ?>
        </a>
    <?php endfor; ?>
</div>