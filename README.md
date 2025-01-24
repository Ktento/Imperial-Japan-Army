# Imperial-Japan-Army

# 開発者向け情報

###  `docker compose` を使う場合

#### 依存関係を構築し、プログラムを実行する

データベースの host名をコンテナの名前(mysql_db)にする

config/config.phpを以下のように設定してください


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

http://localhost:8081 にアクセスすると、phpmyadminにアクセスすることができます。