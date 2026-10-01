-- ====================================================================
-- Advertisement Management & Administrator Approval Workflow Migration
-- Project: 24ads
-- Database: 24ads_db
-- ====================================================================

-- 1. Create Approval History & Audit Trail Table
CREATE TABLE IF NOT EXISTS `tbl_ad_approval_history` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `ad_id` INT NOT NULL,
  `admin_id` INT NULL,
  `action` VARCHAR(50) NOT NULL COMMENT 'APPROVED, REJECTED, RESUBMITTED, CLOSED',
  `comment` TEXT NULL,
  `created_at` DATETIME NOT NULL,
  INDEX `idx_ad_id` (`ad_id`),
  INDEX `idx_admin_id` (`admin_id`),
  INDEX `idx_action` (`action`),
  INDEX `idx_created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create compatibility view
CREATE OR REPLACE VIEW `ad_approval_history` AS 
SELECT * FROM `tbl_ad_approval_history`;

-- 2. Create Login Attempt Protection / Rate Limiting Table
CREATE TABLE IF NOT EXISTS `tbl_login_attempts` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `ip_address` VARCHAR(45) NOT NULL,
  `username` VARCHAR(100) NOT NULL,
  `attempt_time` INT NOT NULL,
  INDEX `idx_ip_user` (`ip_address`, `username`),
  INDEX `idx_attempt_time` (`attempt_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Ensure all approval workflow columns exist in tbl_ads
-- Note: tbl_ads already had ads_status, enabled_by, enabled_date, rejected_by, rejected_date, rejected_reason
ALTER TABLE `tbl_ads` 
  ADD COLUMN IF NOT EXISTS `approved_by` VARCHAR(200) NULL AFTER `rejected_reason`,
  ADD COLUMN IF NOT EXISTS `approved_at` DATETIME NULL AFTER `approved_by`,
  ADD COLUMN IF NOT EXISTS `approval_comment` TEXT NULL AFTER `approved_at`,
  ADD COLUMN IF NOT EXISTS `updated_at` DATETIME NULL AFTER `date_uploaded`;

-- 4. Add optimized performance indexes for filtering and searching
ALTER TABLE `tbl_ads`
  ADD INDEX IF NOT EXISTS `idx_ads_status` (`ads_status`),
  ADD INDEX IF NOT EXISTS `idx_business_id` (`business_id`),
  ADD INDEX IF NOT EXISTS `idx_date_uploaded` (`date_uploaded`),
  ADD INDEX IF NOT EXISTS `idx_status` (`status`);

-- 5. Seed default permissions for System Admin role if not already configured
UPDATE `tbl_roles` 
SET `permissions` = 'all,view_ads,review_ads,approve_ads,reject_ads,manage_users,view_audit_logs' 
WHERE `id` = 1 AND (`permissions` IS NULL OR `permissions` = '');

-- End of migration
