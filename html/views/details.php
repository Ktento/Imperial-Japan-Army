<div class="text-sm bg-gray-100 p-4 space-y-2 leading-3">
    <div class="flex items-center">
        <span class="font-medium text-gray-700 w-24">タイトル:</span>
        <span class="text-gray-900"><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></span>
    </div>
    <div class="flex items-center">
        <span class="font-medium text-gray-700 w-24">登録番号:</span>
        <span class="text-gray-900"><?= htmlspecialchars($topic_id, ENT_QUOTES, 'UTF-8') ?></span>
    </div>
    <div class="flex items-center">
        <span class="font-medium text-gray-700 w-24">種類:</span>
        <span class="text-gray-900"><?= htmlspecialchars($category, ENT_QUOTES, 'UTF-8') ?></span>
    </div>
    <div class="flex items-center">
        <span class="font-medium text-gray-700 w-24">対象:</span>
        <span class="text-gray-900"><?= htmlspecialchars($target, ENT_QUOTES, 'UTF-8') ?></span>
    </div>
</div>