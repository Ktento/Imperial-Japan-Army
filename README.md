# Imperial-Japan-Army

# 開発者向け情報

###　 クエリパラメータの命名規則
$topic_id -> &ti
$media_id ->&mi
&topic_comment_id ->&tci
&media_comment_id ->&mci
$title -> &t
$category -> &c
$target -> &a
$content ->&con

### `docker compose` を使う場合

#### 依存関係を構築し、プログラムを実行する

データベースの host 名をコンテナの名前(mysql_db)にする

config/config.php を以下のように設定してください

```php
<?php
return [
    'dsn' => 'mysql:host=mysql_db;dbname=artifact;charset=utf8mb4',
    'user' => 'user01',
    'password' => 'user01',
];
?>
```

以下のコマンドを実行した後、 http://localhost:8080 にアクセスすると、開発中のプログラムを確認する事ができます。

```bash
$ docker compose up -d
```

http://localhost:8081 にアクセスすると、phpmyadmin にアクセスすることができます。
