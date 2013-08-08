CREATE TABLE anhang (id BIGINT AUTO_INCREMENT, path VARCHAR(255) NOT NULL UNIQUE, name VARCHAR(255), anlage_id BIGINT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX anlage_id_idx (anlage_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE anlage (id BIGINT AUTO_INCREMENT, longname VARCHAR(255), kuerzel VARCHAR(255) NOT NULL, zeit BIGINT, ziel TEXT, methode TEXT, material TEXT, kurzinhalt TEXT, kofferinfo TEXT, rolle_tm TEXT, stunde_id BIGINT, lnr BIGINT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX stunde_id_idx (stunde_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE bild (id BIGINT AUTO_INCREMENT, name VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL, caption TEXT, section_id BIGINT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX section_id_idx (section_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE section (id BIGINT AUTO_INCREMENT, lnr BIGINT NOT NULL, anlage_id BIGINT, inhalt TEXT, tip TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX section_lnr_idx (anlage_id, lnr), INDEX anlage_id_idx (anlage_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE stunde (id BIGINT AUTO_INCREMENT, lnr BIGINT NOT NULL, name VARCHAR(255) NOT NULL, zim_id BIGINT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX zim_lnr_idx (zim_id, lnr), INDEX zim_id_idx (zim_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE zim (id BIGINT AUTO_INCREMENT, name VARCHAR(255) NOT NULL, ptkuerzel VARCHAR(255) NOT NULL, ptjahr VARCHAR(255) NOT NULL, user_id INT, ziele TEXT, zielgruppe VARCHAR(255), roterfaden TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_group (id INT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_group_permission (group_id INT, permission_id INT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(group_id, permission_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_permission (id INT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_remember_key (id INT AUTO_INCREMENT, user_id INT, remember_key VARCHAR(32), ip_address VARCHAR(50), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id, ip_address)) ENGINE = INNODB;
CREATE TABLE sf_guard_user (id INT AUTO_INCREMENT, username VARCHAR(128) NOT NULL UNIQUE, algorithm VARCHAR(128) DEFAULT 'sha1' NOT NULL, salt VARCHAR(128), password VARCHAR(128), is_active TINYINT(1) DEFAULT '1', is_super_admin TINYINT(1) DEFAULT '0', last_login DATETIME, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX is_active_idx_idx (is_active), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user_group (user_id INT, group_id INT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, group_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user_permission (user_id INT, permission_id INT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, permission_id)) ENGINE = INNODB;
ALTER TABLE anhang ADD CONSTRAINT anhang_anlage_id_anlage_id FOREIGN KEY (anlage_id) REFERENCES anlage(id) ON DELETE CASCADE;
ALTER TABLE anlage ADD CONSTRAINT anlage_stunde_id_stunde_id FOREIGN KEY (stunde_id) REFERENCES stunde(id);
ALTER TABLE bild ADD CONSTRAINT bild_section_id_section_id FOREIGN KEY (section_id) REFERENCES section(id) ON DELETE CASCADE;
ALTER TABLE section ADD CONSTRAINT section_anlage_id_anlage_id FOREIGN KEY (anlage_id) REFERENCES anlage(id) ON DELETE CASCADE;
ALTER TABLE stunde ADD CONSTRAINT stunde_zim_id_zim_id FOREIGN KEY (zim_id) REFERENCES zim(id) ON DELETE CASCADE;
ALTER TABLE zim ADD CONSTRAINT zim_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id);
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sf_guard_group_permission_permission_id_sf_guard_permission_id FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sf_guard_group_permission_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_remember_key ADD CONSTRAINT sf_guard_remember_key_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sf_guard_user_group_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sf_guard_user_group_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT sf_guard_user_permission_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT sf_guard_user_permission_permission_id_sf_guard_permission_id FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
