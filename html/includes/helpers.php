<?php
function sanitizeInput($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

function getPaginationInfo($totalItems, $itemsPerPage, $currentPage) {
    $totalPages = (int)ceil($totalItems / $itemsPerPage);
    $offset = ($currentPage - 1) * $itemsPerPage;

    return [
        'totalPages' => $totalPages,
        'offset' => $offset,
    ];
}

function formatJapaneseDate($datetime) {
    $weekdays = ['日', '月', '火', '水', '木', '金', '土'];
    $date = new DateTime($datetime);

    return $date->format('Y年n月j日') . '(' . $weekdays[$date->format('w')] . ')' . $date->format(' H:i');
}
?>

