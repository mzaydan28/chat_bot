-- Tabel untuk menyimpan feedback/kritik dan saran
DROP TABLE IF EXISTS `feedback`;
CREATE TABLE `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `komentar` text NOT NULL,
  `rating` int(1) NOT NULL,
  `status` varchar(20) DEFAULT 'pending',
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabel untuk menyimpan pertanyaan yang tidak terjawab
DROP TABLE IF EXISTS `unanswered_questions`;
CREATE TABLE `unanswered_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `pertanyaan` text NOT NULL,
  `user_ip` varchar(45) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'pending',
  `jawaban_admin` text DEFAULT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX `status` (`status`),
  INDEX `created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabel untuk menyimpan riwayat chat
DROP TABLE IF EXISTS `chat_history`;
CREATE TABLE `chat_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `session_id` varchar(100) NOT NULL,
  `user_question` text NOT NULL,
  `bot_answer` text,
  `matched_keyword` varchar(255) DEFAULT NULL,
  `is_answered` tinyint(1) DEFAULT 1,
  `user_ip` varchar(45) DEFAULT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  INDEX `session_id` (`session_id`),
  INDEX `is_answered` (`is_answered`),
  INDEX `created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
