CREATE database IF NOT EXISTS smbaudit;
USE smbaudit;

CREATE TABLE IF NOT EXISTS `audit` (
        `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `when` TIMESTAMP DEFAULT NOW() COMMENT 'Time the operation occurred',
        `share` VARCHAR(255) COMMENT 'Share/service name',
        `ip` VARCHAR(255) COMMENT 'IP address of connecting user',
        `user` VARCHAR(255) COMMENT 'Remote username',
        `op` VARCHAR(255) COMMENT 'Type of operation performed',
        `result` VARCHAR(255) COMMENT 'Operation reulst',
        `arg` VARCHAR(255) COMMENT 'Argument for operation'
) ENGINE = MYISAM DEFAULT CHARSET=UTF8;

CREATE TABLE IF NOT EXISTS last_update (
	lastupdate TIMESTAMP
) ENGINE = MYISAM DEFAULT CHARSET=UTF8;

use mysql;
GRANT ALL ON smbaudit.* TO 'smbd'@'localhost';
REPLACE INTO user (host, user, password)     VALUES (         'localhost',         'smbd',         password('smbpass')     );

flush privileges;
