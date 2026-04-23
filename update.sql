-- 1. Event Documents
CREATE TABLE `event_documents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `mime_type` varchar(255) DEFAULT NULL,
  `file_size` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_documents_event_id_foreign` (`event_id`),
  CONSTRAINT `event_documents_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Awareness Days
CREATE TABLE `awareness_days` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `celebration_date` date NOT NULL,
  `body` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Podcasts
CREATE TABLE `podcasts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `youtube_url` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `display_order` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4a. Post Views (Blog articles)
CREATE TABLE `post_views` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `post_views_post_id_foreign` (`post_id`),
  KEY `post_views_user_id_foreign` (`user_id`),
  CONSTRAINT `post_views_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `post_views_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4b. Post Likes
CREATE TABLE `post_likes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `post_likes_post_id_user_id_unique` (`post_id`,`user_id`),
  KEY `post_likes_user_id_foreign` (`user_id`),
  CONSTRAINT `post_likes_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `post_likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4c. Post Bookmarks
CREATE TABLE `post_bookmarks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `post_bookmarks_post_id_user_id_unique` (`post_id`,`user_id`),
  KEY `post_bookmarks_user_id_foreign` (`user_id`),
  CONSTRAINT `post_bookmarks_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `post_bookmarks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4d. Post Comments
CREATE TABLE `post_comments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `parent_id` bigint(20) unsigned DEFAULT NULL,
  `body` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `post_comments_post_id_foreign` (`post_id`),
  KEY `post_comments_user_id_foreign` (`user_id`),
  KEY `post_comments_parent_id_foreign` (`parent_id`),
  CONSTRAINT `post_comments_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `post_comments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `post_comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `post_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4e. Post Comment Likes
CREATE TABLE `post_comment_likes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_comment_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `post_comment_likes_post_comment_id_user_id_unique` (`post_comment_id`,`user_id`),
  KEY `post_comment_likes_user_id_foreign` (`user_id`),
  CONSTRAINT `post_comment_likes_post_comment_id_foreign` FOREIGN KEY (`post_comment_id`) REFERENCES `post_comments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `post_comment_likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5a. Forum Posts
CREATE TABLE `forum_posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `views_count` bigint(20) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `forum_posts_slug_unique` (`slug`),
  KEY `forum_posts_user_id_foreign` (`user_id`),
  CONSTRAINT `forum_posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5b. Forum Post Likes
CREATE TABLE `forum_post_likes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `forum_post_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `forum_post_likes_forum_post_id_user_id_unique` (`forum_post_id`,`user_id`),
  KEY `forum_post_likes_user_id_foreign` (`user_id`),
  CONSTRAINT `forum_post_likes_forum_post_id_foreign` FOREIGN KEY (`forum_post_id`) REFERENCES `forum_posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `forum_post_likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5c. Forum Post Bookmarks
CREATE TABLE `forum_post_bookmarks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `forum_post_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `forum_post_bookmarks_forum_post_id_user_id_unique` (`forum_post_id`,`user_id`),
  KEY `forum_post_bookmarks_user_id_foreign` (`user_id`),
  CONSTRAINT `forum_post_bookmarks_forum_post_id_foreign` FOREIGN KEY (`forum_post_id`) REFERENCES `forum_posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `forum_post_bookmarks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5d. Forum Comments
CREATE TABLE `forum_comments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `forum_post_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `parent_id` bigint(20) unsigned DEFAULT NULL,
  `body` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `forum_comments_forum_post_id_foreign` (`forum_post_id`),
  KEY `forum_comments_user_id_foreign` (`user_id`),
  KEY `forum_comments_parent_id_foreign` (`parent_id`),
  CONSTRAINT `forum_comments_forum_post_id_foreign` FOREIGN KEY (`forum_post_id`) REFERENCES `forum_posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `forum_comments_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `forum_comments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `forum_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5e. Forum Comment Likes
CREATE TABLE `forum_comment_likes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `forum_comment_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `forum_comment_likes_forum_comment_id_user_id_unique` (`forum_comment_id`,`user_id`),
  KEY `forum_comment_likes_user_id_foreign` (`user_id`),
  CONSTRAINT `forum_comment_likes_forum_comment_id_foreign` FOREIGN KEY (`forum_comment_id`) REFERENCES `forum_comments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `forum_comment_likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Finally, mark all 5 migrations as run in Laravel's migrations table
INSERT INTO `migrations` (`migration`, `batch`) VALUES
  ('2026_04_22_000001_create_event_documents_table', 99),
  ('2026_04_22_000002_create_awareness_days_table', 99),
  ('2026_04_22_000003_create_podcasts_table', 99),
  ('2026_04_22_000004_create_post_engagement_tables', 99),
  ('2026_04_22_000005_create_forum_tables', 99);