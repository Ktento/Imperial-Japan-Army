-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- ホスト: db:3306
-- 生成日時: 2025 年 1 月 29 日 14:14
-- サーバのバージョン： 8.0.41
-- PHP のバージョン: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `artifact`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `media`
--

CREATE TABLE `media` (
  `media_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `media_title` varchar(255) DEFAULT NULL,
  `media_category_id` int DEFAULT NULL,
  `media_target_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- テーブルのデータのダンプ `media`
--

INSERT INTO `media` (`media_id`, `user_id`, `media_title`, `media_category_id`, `media_target_id`, `created_at`) VALUES
(1, 123, 'Media A', 1, 1, '2025-01-16 03:36:42'),
(2, 456, 'Media B', 2, 2, '2025-01-16 03:36:42'),
(5, 123, 'test', 1, 1, '2025-01-20 05:09:51'),
(6, 123, 'test', 2, NULL, '2025-01-20 05:25:12'),
(7, 123, 'test', 2, NULL, '2025-01-20 05:25:20'),
(8, 123, 'test', 2, NULL, '2025-01-20 05:25:43'),
(9, NULL, '678yh8i', NULL, NULL, '2025-01-23 03:49:52'),
(10, NULL, 'ijerufhiewuhf', NULL, NULL, '2025-01-23 03:50:34'),
(11, NULL, 'hiufiuwfi', NULL, NULL, '2025-01-23 04:08:20'),
(1113, NULL, '1112 ***', NULL, NULL, '2025-01-23 04:08:46'),
(1114, NULL, 'guygayud', NULL, NULL, '2025-01-23 04:18:14'),
(1115, NULL, 'AAAAAAAAA', NULL, NULL, '2025-01-23 04:18:22');

-- --------------------------------------------------------

--
-- テーブルの構造 `media_category`
--

CREATE TABLE `media_category` (
  `media_category_id` int NOT NULL,
  `media_id` int DEFAULT NULL,
  `media_category_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- テーブルのデータのダンプ `media_category`
--

INSERT INTO `media_category` (`media_category_id`, `media_id`, `media_category_name`, `created_at`) VALUES
(1, 1, 'Category A', '2025-01-16 03:36:42'),
(2, 2, 'Category B', '2025-01-16 03:36:42'),
(4, 10, '本', '2025-01-23 03:50:34'),
(5, 11, '本', '2025-01-23 04:08:20'),
(6, 1113, '本', '2025-01-23 04:08:46'),
(7, 1114, '本', '2025-01-23 04:18:14'),
(8, 1115, '本', '2025-01-23 04:18:22');

-- --------------------------------------------------------

--
-- テーブルの構造 `media_comment`
--

CREATE TABLE `media_comment` (
  `media_comment_id` int NOT NULL,
  `media_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `comment_category` varchar(255) DEFAULT NULL,
  `media_comment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- テーブルのデータのダンプ `media_comment`
--

INSERT INTO `media_comment` (`media_comment_id`, `media_id`, `user_id`, `comment_category`, `media_comment`, `created_at`) VALUES
(1, 1114, 88888, 'おーいお茶', 'hello there', '2025-01-24 01:14:45');

-- --------------------------------------------------------

--
-- テーブルの構造 `media_tags`
--

CREATE TABLE `media_tags` (
  `media_tag_id` int NOT NULL,
  `media_id` int DEFAULT NULL,
  `tag_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- テーブルのデータのダンプ `media_tags`
--

INSERT INTO `media_tags` (`media_tag_id`, `media_id`, `tag_id`, `created_at`) VALUES
(1, 1, 1, '2025-01-16 03:37:52'),
(2, 2, 2, '2025-01-16 03:37:52');

-- --------------------------------------------------------

--
-- テーブルの構造 `media_target`
--

CREATE TABLE `media_target` (
  `media_target_id` int NOT NULL,
  `media_id` int DEFAULT NULL,
  `media_target_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- テーブルのデータのダンプ `media_target`
--

INSERT INTO `media_target` (`media_target_id`, `media_id`, `media_target_name`, `created_at`) VALUES
(1, 1, 'Target A', '2025-01-16 03:37:52'),
(2, 2, 'Target B', '2025-01-16 03:37:52'),
(4, 10, '学生', '2025-01-23 03:50:34'),
(5, 11, '学生', '2025-01-23 04:08:20'),
(6, 1113, '学生', '2025-01-23 04:08:46'),
(7, 1114, '学生', '2025-01-23 04:18:14'),
(8, 1115, '学生', '2025-01-23 04:18:22');

-- --------------------------------------------------------

--
-- テーブルの構造 `tags`
--

CREATE TABLE `tags` (
  `tag_id` int NOT NULL COMMENT 'AUTO_INCREMENT',
  `tag_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- テーブルのデータのダンプ `tags`
--

INSERT INTO `tags` (`tag_id`, `tag_name`, `created_at`) VALUES
(1, 'アニメ', '2025-01-16 03:37:52'),
(2, '漫画', '2025-01-16 03:37:52'),
(3, '音楽', '2025-01-23 05:52:22'),
(11, '', '2025-01-29 14:07:10'),
(12, '', '2025-01-29 14:07:40');

-- --------------------------------------------------------

--
-- テーブルの構造 `topics`
--

CREATE TABLE `topics` (
  `topic_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `topic_title` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- テーブルのデータのダンプ `topics`
--

INSERT INTO `topics` (`topic_id`, `user_id`, `topic_title`, `created_at`) VALUES
(1, 123, 'Topic A', '2025-01-16 03:37:52'),
(2, 456, 'Topic B', '2025-01-16 03:37:52'),
(5, 123, 'a', '2025-01-20 01:30:55'),
(6, 123, 'as', '2025-01-20 02:32:16'),
(7, 123, 'ZXC', '2025-01-23 02:07:06'),
(8, 123, 'ZXC', '2025-01-23 02:11:50'),
(9, 123, 'DHCPリレーエージェントについて', '2025-01-23 02:13:20'),
(10, 199, '伊藤がトピ登録', '2025-01-23 02:59:19'),
(11111, 123, '大日本帝国陸軍~欲しがりません勝つまでは~', '2025-01-24 00:36:42'),
(11112, 123, 'アイス', '2025-01-29 14:07:10'),
(11113, 123, 'アイス', '2025-01-29 14:07:40');

-- --------------------------------------------------------

--
-- テーブルの構造 `topic_category`
--

CREATE TABLE `topic_category` (
  `topic_category_id` int NOT NULL,
  `topic_id` int DEFAULT NULL,
  `topic_category_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- テーブルのデータのダンプ `topic_category`
--

INSERT INTO `topic_category` (`topic_category_id`, `topic_id`, `topic_category_name`, `created_at`) VALUES
(1, 1, 'Category X', '2025-01-16 03:37:52'),
(2, 2, 'Category Y', '2025-01-16 03:37:52'),
(4, 6, 'お知らせ', '2025-01-20 02:32:16'),
(5, 7, 'お知らせ', '2025-01-23 02:07:06'),
(6, 8, 'お知らせ', '2025-01-23 02:11:50'),
(7, 9, 'お知らせ', '2025-01-23 02:13:20'),
(8, 10, 'お知らせ', '2025-01-23 02:59:19'),
(14, 11111, 'お知らせ', '2025-01-24 00:36:42'),
(15, 11112, 'お知らせ', '2025-01-29 14:07:10'),
(16, 11113, 'お知らせ', '2025-01-29 14:07:40');

-- --------------------------------------------------------

--
-- テーブルの構造 `topic_comment`
--

CREATE TABLE `topic_comment` (
  `topic_comment_id` int NOT NULL,
  `topic_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `comment_category` varchar(255) DEFAULT NULL,
  `topic_comment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- テーブルのデータのダンプ `topic_comment`
--

INSERT INTO `topic_comment` (`topic_comment_id`, `topic_id`, `user_id`, `comment_category`, `topic_comment`, `created_at`) VALUES
(1, 10, 123, 'カテゴリー', 'komento', '2025-01-23 04:13:18'),
(2, 9, 88888, 'oip', 'iefiuwnniufnqwiu\r\n', '2025-01-23 04:13:39');

-- --------------------------------------------------------

--
-- テーブルの構造 `topic_tags`
--

CREATE TABLE `topic_tags` (
  `topic_tag_id` int NOT NULL,
  `topic_id` int DEFAULT NULL,
  `tag_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- テーブルのデータのダンプ `topic_tags`
--

INSERT INTO `topic_tags` (`topic_tag_id`, `topic_id`, `tag_id`, `created_at`) VALUES
(1, 1, 1, '2025-01-16 03:37:52'),
(5, 11112, 11, '2025-01-29 14:07:10'),
(6, 11113, 11, '2025-01-29 14:07:40');

-- --------------------------------------------------------

--
-- テーブルの構造 `topic_target`
--

CREATE TABLE `topic_target` (
  `topic_target_id` int NOT NULL,
  `topic_id` int DEFAULT NULL,
  `topic_target_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- テーブルのデータのダンプ `topic_target`
--

INSERT INTO `topic_target` (`topic_target_id`, `topic_id`, `topic_target_name`, `created_at`) VALUES
(1, 1, 'Audience X', '2025-01-16 03:37:52'),
(2, 2, 'Audience Y', '2025-01-16 03:37:52'),
(4, 6, '学生', '2025-01-20 02:32:16'),
(5, 7, '学生', '2025-01-23 02:07:06'),
(6, 8, '学生', '2025-01-23 02:11:50'),
(7, 9, '学生', '2025-01-23 02:13:20'),
(8, 10, '学生', '2025-01-23 02:59:19'),
(14, 11111, '教員', '2025-01-24 00:36:42'),
(15, 11112, '学生', '2025-01-29 14:07:10'),
(16, 11113, '学生', '2025-01-29 14:07:40');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `user_icon` longblob,
  `favtag` varchar(255) DEFAULT NULL,
  `user_level` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password`, `user_icon`, `favtag`, `user_level`, `created_at`) VALUES
(123, 'Ado', 'ado123', NULL, NULL, '管理者', '2025-01-16 03:36:13'),
(199, 'Uru', '123', NULL, NULL, '管理者', '2025-01-23 02:58:22'),
(456, '橋本環奈', 'kanna456', NULL, NULL, '一般', '2025-01-16 03:36:13'),
(88888, 'kkk', 'kkk', NULL, 'Tag3', '管理者', '2025-01-23 03:16:26');

-- --------------------------------------------------------

--
-- ビュー用の代替構造 `view_media_comments`
-- (実際のビューを参照するには下にあります)
--
CREATE TABLE `view_media_comments` (
`category` varchar(255)
,`id` int
,`target` varchar(255)
,`title` varchar(255)
,`total_count` bigint
);

-- --------------------------------------------------------

--
-- ビュー用の代替構造 `view_topic_comments`
-- (実際のビューを参照するには下にあります)
--
CREATE TABLE `view_topic_comments` (
`category` varchar(255)
,`id` int
,`target` varchar(255)
,`title` varchar(255)
,`total_count` bigint
);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`media_id`),
  ADD KEY `user_id` (`user_id`);

--
-- テーブルのインデックス `media_category`
--
ALTER TABLE `media_category`
  ADD PRIMARY KEY (`media_category_id`),
  ADD KEY `media_category_ibfk_1` (`media_id`);

--
-- テーブルのインデックス `media_comment`
--
ALTER TABLE `media_comment`
  ADD PRIMARY KEY (`media_comment_id`),
  ADD KEY `media_id` (`media_id`),
  ADD KEY `user_id` (`user_id`);

--
-- テーブルのインデックス `media_tags`
--
ALTER TABLE `media_tags`
  ADD PRIMARY KEY (`media_tag_id`),
  ADD KEY `media_tags_ibfk_1` (`media_id`),
  ADD KEY `media_tags_ibfk_2` (`tag_id`);

--
-- テーブルのインデックス `media_target`
--
ALTER TABLE `media_target`
  ADD PRIMARY KEY (`media_target_id`),
  ADD KEY `media_target_ibfk_1` (`media_id`);

--
-- テーブルのインデックス `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_id`);

--
-- テーブルのインデックス `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`topic_id`),
  ADD KEY `user_id` (`user_id`);

--
-- テーブルのインデックス `topic_category`
--
ALTER TABLE `topic_category`
  ADD PRIMARY KEY (`topic_category_id`),
  ADD KEY `topic_category_ibfk_1` (`topic_id`);

--
-- テーブルのインデックス `topic_comment`
--
ALTER TABLE `topic_comment`
  ADD PRIMARY KEY (`topic_comment_id`),
  ADD KEY `topic_id` (`topic_id`),
  ADD KEY `user_id` (`user_id`);

--
-- テーブルのインデックス `topic_tags`
--
ALTER TABLE `topic_tags`
  ADD PRIMARY KEY (`topic_tag_id`),
  ADD KEY `topic_tags_ibfk_1` (`topic_id`),
  ADD KEY `topic_tags_ibfk_2` (`tag_id`);

--
-- テーブルのインデックス `topic_target`
--
ALTER TABLE `topic_target`
  ADD PRIMARY KEY (`topic_target_id`),
  ADD KEY `topic_target_ibfk_1` (`topic_id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `media`
--
ALTER TABLE `media`
  MODIFY `media_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1116;

--
-- テーブルの AUTO_INCREMENT `media_category`
--
ALTER TABLE `media_category`
  MODIFY `media_category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- テーブルの AUTO_INCREMENT `media_comment`
--
ALTER TABLE `media_comment`
  MODIFY `media_comment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- テーブルの AUTO_INCREMENT `media_tags`
--
ALTER TABLE `media_tags`
  MODIFY `media_tag_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- テーブルの AUTO_INCREMENT `media_target`
--
ALTER TABLE `media_target`
  MODIFY `media_target_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- テーブルの AUTO_INCREMENT `tags`
--
ALTER TABLE `tags`
  MODIFY `tag_id` int NOT NULL AUTO_INCREMENT COMMENT 'AUTO_INCREMENT', AUTO_INCREMENT=13;

--
-- テーブルの AUTO_INCREMENT `topics`
--
ALTER TABLE `topics`
  MODIFY `topic_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11114;

--
-- テーブルの AUTO_INCREMENT `topic_category`
--
ALTER TABLE `topic_category`
  MODIFY `topic_category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- テーブルの AUTO_INCREMENT `topic_comment`
--
ALTER TABLE `topic_comment`
  MODIFY `topic_comment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- テーブルの AUTO_INCREMENT `topic_tags`
--
ALTER TABLE `topic_tags`
  MODIFY `topic_tag_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- テーブルの AUTO_INCREMENT `topic_target`
--
ALTER TABLE `topic_target`
  MODIFY `topic_target_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131416;

-- --------------------------------------------------------

--
-- ビュー用の構造 `view_media_comments`
--
DROP TABLE IF EXISTS `view_media_comments`;

CREATE ALGORITHM=UNDEFINED DEFINER=`user01`@`%` SQL SECURITY DEFINER VIEW `view_media_comments`  AS SELECT `t`.`media_id` AS `id`, `t`.`media_title` AS `title`, `c`.`media_category_name` AS `category`, `ta`.`media_target_name` AS `target`, count(`tc`.`media_comment_id`) AS `total_count` FROM (((`media` `t` join `media_category` `c` on((`t`.`media_id` = `c`.`media_id`))) join `media_target` `ta` on((`t`.`media_id` = `ta`.`media_id`))) left join `media_comment` `tc` on((`t`.`media_id` = `tc`.`media_id`))) GROUP BY `t`.`media_id`, `c`.`media_category_name`, `ta`.`media_target_name` ORDER BY `t`.`created_at` DESC ;

-- --------------------------------------------------------

--
-- ビュー用の構造 `view_topic_comments`
--
DROP TABLE IF EXISTS `view_topic_comments`;

CREATE ALGORITHM=UNDEFINED DEFINER=`user01`@`%` SQL SECURITY DEFINER VIEW `view_topic_comments`  AS SELECT `t`.`topic_id` AS `id`, `t`.`topic_title` AS `title`, `c`.`topic_category_name` AS `category`, `ta`.`topic_target_name` AS `target`, count(`tc`.`topic_comment_id`) AS `total_count` FROM (((`topics` `t` join `topic_category` `c` on((`t`.`topic_id` = `c`.`topic_id`))) join `topic_target` `ta` on((`t`.`topic_id` = `ta`.`topic_id`))) left join `topic_comment` `tc` on((`t`.`topic_id` = `tc`.`topic_id`))) GROUP BY `t`.`topic_id`, `c`.`topic_category_name`, `ta`.`topic_target_name` ORDER BY `t`.`created_at` DESC ;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- テーブルの制約 `media_category`
--
ALTER TABLE `media_category`
  ADD CONSTRAINT `media_category_ibfk_1` FOREIGN KEY (`media_id`) REFERENCES `media` (`media_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- テーブルの制約 `media_comment`
--
ALTER TABLE `media_comment`
  ADD CONSTRAINT `media_comment_ibfk_1` FOREIGN KEY (`media_id`) REFERENCES `media` (`media_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `media_comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- テーブルの制約 `media_tags`
--
ALTER TABLE `media_tags`
  ADD CONSTRAINT `media_tags_ibfk_1` FOREIGN KEY (`media_id`) REFERENCES `media` (`media_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `media_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`tag_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- テーブルの制約 `media_target`
--
ALTER TABLE `media_target`
  ADD CONSTRAINT `media_target_ibfk_1` FOREIGN KEY (`media_id`) REFERENCES `media` (`media_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- テーブルの制約 `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- テーブルの制約 `topic_category`
--
ALTER TABLE `topic_category`
  ADD CONSTRAINT `topic_category_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`topic_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- テーブルの制約 `topic_comment`
--
ALTER TABLE `topic_comment`
  ADD CONSTRAINT `topic_comment_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`topic_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `topic_comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- テーブルの制約 `topic_tags`
--
ALTER TABLE `topic_tags`
  ADD CONSTRAINT `topic_tags_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`topic_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `topic_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`tag_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- テーブルの制約 `topic_target`
--
ALTER TABLE `topic_target`
  ADD CONSTRAINT `topic_target_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`topic_id`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
