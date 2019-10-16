CREATE database IF NOT EXISTS smbaudit;
USE smbaudit;

CREATE TABLE IF NOT EXISTS `audit` (
        `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `when` TIMESTAMP DEFAULT NOW() COMMENT 'Time the operation occurred',
        `share` VARCHAR(255) COMMENT 'Share/service name',
        `ip` VARCHAR(255) COMMENT 'IP address of connecting user',
        `user` VARCHAR(255) COMMENT 'Remote username',
        `op` VARCHAR(255) COMMENT 'Type of operation performed',
        `result` VARCHAR(255) COMMENT 'Operation reulst',
        `arg` VARCHAR(255) COMMENT 'Argument for operation',
	KEY `audit_when_IDX` (`when`) USING BTREE,
  	KEY `audit_share_IDX` (`share`) USING BTREE,
  	KEY `audit_user_IDX` (`user`) USING BTREE
) ENGINE = MYISAM DEFAULT CHARSET=UTF8;

CREATE TABLE IF NOT EXISTS last_update (
	lastupdate TIMESTAMP
) ENGINE = MYISAM DEFAULT CHARSET=UTF8;
