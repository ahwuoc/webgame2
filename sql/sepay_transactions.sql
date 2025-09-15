-- Table to store SePay transactions
CREATE TABLE IF NOT EXISTS `sepay_transactions` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `sepay_id` VARCHAR(64) NOT NULL,
  `gateway` VARCHAR(64) NOT NULL,
  `transaction_date` VARCHAR(64) NOT NULL,
  `account_number` VARCHAR(64) NOT NULL,
  `content` TEXT NOT NULL,
  `transfer_type` VARCHAR(16) NOT NULL,
  `transfer_amount` BIGINT NOT NULL DEFAULT 0,
  `accumulated` BIGINT NOT NULL DEFAULT 0,
  `reference_code` VARCHAR(128) DEFAULT '',
  `description` VARCHAR(255) DEFAULT '',
  `account_id` INT UNSIGNED NOT NULL DEFAULT 0,
  `username` VARCHAR(64) NOT NULL DEFAULT 'UNKNOWN',
  `status` ENUM('pending','completed','failed') NOT NULL DEFAULT 'pending',
  `created_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_sepay_id` (`sepay_id`),
  KEY `idx_account_id` (`account_id`),
  KEY `idx_created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
