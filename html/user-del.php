<!DOCTYPE html>
<html>
<head>
    <title>ユーザー登録</title>
    <style>
        .greeting {
            margin-bottom: 20px;
            font-size: 16px;
        }
        div {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="greeting">
        こんにちは<span id="registeredName"></span>さん
    </div>

    <form method="post" action="for.php">
        <div>
            <label>ログインID：</label>
        </div>

        <div>
            <label>ユーザー氏名：<span class="required"></span></label>
            <input type="text" name="user_name" onchange="updateGreeting(this.value)">
        </div>

        <div>
            <label>パスワード：<span class="required"></span></label>
            <input type="password" name="password">
        </div>

        <div>
            <label>レベル：<span class="required"></span></label>
            <input type="radio" name="level" value="admin" id="admin">
            <label for="admin">管理者</label>
            <input type="radio" name="level" value="general" id="general">
            <label for="general">一般</label>
        </div>

        <button type="submit">削除</button>
    </form>

    <script>
        function updateGreeting(name) {
            document.getElementById('registeredName').textContent = name;
        }
    </script>
</body>
</html>