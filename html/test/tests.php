<?php
if (isset($_GET["d"])) {
    $topic_id = "2567";
    $title = "DHCPリレーエージェントについて";
    $category = "ネットワーク";
    $target = "CCNA受験";

    $comments = [
        [
            'name' => '山田 太郎',
            'category' => '一般',
            'comment' => 'このトピックは非常に有益です。',
            'created_at' => '2025-01-16 23:18:05',
            'tags' =>  [
                'tag_name' => 'ネットワーク',
                'tag_name' => 'CCNA',
                'tag_name' => 'DHCP',
                'リレーエージェント',
            ],
        ],
        [
            'name' => '佐藤 花子',
            'category' => 'フィードバック',
            'comment' => 'もう少し詳細な説明が欲しいです。',
            'created_at' => '2025-01-15 14:32:00',
        ],
        [
            'name' => '田中 一郎',
            'category' => '質問',
            'comment' => '具体的な使用例を教えていただけますか？',
            'created_at' => '2025-01-15 10:05:00',
        ],
        [
            'name' => '鈴木 次郎',
            'category' => '感想',
            'comment' => '大変参考になりました！ありがとうございます。',
            'created_at' => '2025-01-15 09:45:00',
        ],
    ];

    // タグのテストデータを作成
    $tags = [
        'ネットワーク',
        'CCNA',
        'DHCP',
        'リレーエージェント',
    ];

    $totalComments = count($comments);
    $total_comments = count($comments);
    $total_pages = (int)ceil($total_comments / $items_per_page);

}
?>