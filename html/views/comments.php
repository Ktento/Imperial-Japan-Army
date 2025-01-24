<?php foreach ($comments as $comment):
    $name = htmlspecialchars($comment['name'] ?? "取得できませんでした", ENT_QUOTES, 'UTF-8');
    $content = htmlspecialchars($comment['topic_comment'] ?? "取得できませんでした", ENT_QUOTES, 'UTF-8');
    $created_at = htmlspecialchars(formatJapaneseDate($comment['created_at']) ?? "取得できませんでした", ENT_QUOTES, 'UTF-8');
    $category = htmlspecialchars($comment['category'] ?? "取得できませんでした", ENT_QUOTES, 'UTF-8');
?>
    <div class="bg-gray-100 py-5 px-6 mb-1 flex relative">
        <div class="absolute top-0 bottom-0 left-3/4 w-0.5 border-l border-dotted border-gray-400 my-4"></div>
        <div class="w-3/4 flex justify-between items-start pr-4">
            <div>
                <p class="text-xs text-gray-600">
                    <span class="">
                        <strong>
                            <a href="#" class="text-black-600"><?= $name ?></a>
                        </strong>

                        <?= $created_at ?>
                    </span>
                </p>
                <p class="mt-2 text-gray-800"><?= $content ?></p>
            </div>
            <div class="flex space-x-2">
                <a class="p-1 text-xs border border-gray-300 hover:bg-gray-200" href="topics-res-upd.php?topic_id=<?= $topic_id ?>">編集</a>
                <a class="p-1 text-xs border border-red-300 text-red-600 hover:bg-red-200" href="topics-res-del.php?topic_id=<?= $topic_id ?>">削除</a>
            </div>
        </div>
        <div class="w-1/4 text-left text-xs text-gray-600 space-y-1 pl-6">
            <p>種類: <?= $category ?></p>
            <p>名前: <?= $name ?></p>
            <p>登録日時: <?= $created_at ?></p>
        </div>
    </div>
<?php endforeach; ?>