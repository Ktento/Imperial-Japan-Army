<div class="flex justify-between items-center space-x-4 mb-2">
    <a href="<?= $filename ?>-ins.php" class="inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700 transition duration-300"><?= $name ?>新規登録</a>
    <p>登録されている<?= $name ?>(最新<?= $count ?>件)</p>
</div>
<table class="min-w-full table-auto bg-white border border-gray-200 rounded-lg shadow-md mb-2">
    <thead>
        <tr>
            <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">種類</th>
            <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">対象</th>
            <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">タイトル</th>
            <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">コメント件数</th>
            <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">編集</th>
            <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">削除</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($rows as $row):
            $id = htmlspecialchars($row['id'] ?? "0", ENT_QUOTES, 'UTF-8');
            $title = htmlspecialchars($row['title'] ?? "取得できませんでした", ENT_QUOTES, 'UTF-8');
            $category = htmlspecialchars($row['category'] ?? "取得できませんでした", ENT_QUOTES, 'UTF-8');
            $target = htmlspecialchars($row['target'] ?? "取得できませんでした", ENT_QUOTES, 'UTF-8');
            $comment_count = htmlspecialchars($row['total_count'] ?? "取得できませんでした", ENT_QUOTES, 'UTF-8');

            $array_tags = $filename == "topics"  ? fetchTopicTags($id) : fetchMediaTags($id);
            $tags = htmlspecialchars(implode(',', $array_tags), ENT_QUOTES, 'UTF-8');

            $initial = $filename == "topics" ? "t" : "m";
            $detail_url = "{$filename}-dtl.php?{$initial}i={$id}&t={$title}&c={$category}&a={$target}";
            $upd_url = "{$filename}-upd.php?{$initial}i={$id}&t={$title}&c={$category}&a={$target}&g={$tags}";
            $del_url = "{$filename}-del.php?{$initial}i={$id}&t={$title}&c={$category}&a={$target}&g={$tags}";
        ?>
            <tr class="bg-gray-50">
                <td class="py-2 px-4 border-b text-sm text-gray-600"><?= $category ?></td>
                <td class="py-2 px-4 border-b text-sm text-gray-600"><?= $target ?></td>
                <td class='py-2 px-4 border-b text-sm text-gray-800'>
                    <a href='<?= $detail_url ?>'>
                        <?= $title ?>
                    </a>
                    <div class='flex flex-wrap gap-1'>
                        <?php foreach ($array_tags as $tag): ?>
                            <span class='px-1 border text-xs'><?= htmlspecialchars($tag, ENT_QUOTES, 'UTF-8') ?></span>
                        <?php endforeach; ?>
                    </div>
                </td>
                <td class="py-2 px-4 border-b text-sm text-gray-600"><?= $comment_count ?></td>
                <td class='py-2 px-4 border-b text-sm text-gray-600'><a href='<?= $upd_url ?>'>編集</a></td>
                <td class='py-2 px-4 border-b text-sm text-gray-600'><a href='<?= $del_url ?>'>削除</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>