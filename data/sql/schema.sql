CREATE TABLE anhang (id INTEGER PRIMARY KEY AUTOINCREMENT, path VARCHAR(255) NOT NULL UNIQUE, name VARCHAR(255), anlage_id INTEGER NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL);
CREATE TABLE anlage (id INTEGER PRIMARY KEY AUTOINCREMENT, longname VARCHAR(255), kuerzel VARCHAR(255) NOT NULL, zeit INTEGER, ziel VARCHAR(1000), methode VARCHAR(1000), material VARCHAR(1000), kurzinhalt VARCHAR(1000), kofferinfo VARCHAR(10000), rolle_tm VARCHAR(1000), stunde_id INTEGER, lnr INTEGER NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL);
CREATE TABLE bild (id INTEGER PRIMARY KEY AUTOINCREMENT, lnr INTEGER NOT NULL, name VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL, caption VARCHAR(1000), anlage_id INTEGER NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL);
CREATE TABLE section (id INTEGER PRIMARY KEY AUTOINCREMENT, lnr INTEGER NOT NULL, anlage_id INTEGER, inhalt VARCHAR(100000), tip VARCHAR(1000), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL);
CREATE TABLE stunde (id INTEGER PRIMARY KEY AUTOINCREMENT, lnr INTEGER NOT NULL, name VARCHAR(255) NOT NULL, zim_id INTEGER NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL);
CREATE TABLE zim (id INTEGER PRIMARY KEY AUTOINCREMENT, name VARCHAR(255) NOT NULL, ptkuerzel VARCHAR(255) NOT NULL, ptjahr VARCHAR(255) NOT NULL, user_id INTEGER, ziele VARCHAR(10000), zielgruppe VARCHAR(255), roterfaden VARCHAR(10000), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL);
CREATE TABLE sf_guard_group (id INTEGER PRIMARY KEY AUTOINCREMENT, name VARCHAR(255) UNIQUE, description VARCHAR(1000), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL);
CREATE TABLE sf_guard_group_permission (group_id INTEGER, permission_id INTEGER, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(group_id, permission_id));
CREATE TABLE sf_guard_permission (id INTEGER PRIMARY KEY AUTOINCREMENT, name VARCHAR(255) UNIQUE, description VARCHAR(1000), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL);
CREATE TABLE sf_guard_remember_key (id INTEGER PRIMARY KEY AUTOINCREMENT, user_id INTEGER, remember_key VARCHAR(32), ip_address VARCHAR(50), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL);
CREATE TABLE sf_guard_user (id INTEGER PRIMARY KEY AUTOINCREMENT, username VARCHAR(128) NOT NULL UNIQUE, algorithm VARCHAR(128) DEFAULT 'sha1' NOT NULL, salt VARCHAR(128), password VARCHAR(128), is_active INTEGER DEFAULT '1', is_super_admin INTEGER DEFAULT '0', last_login DATETIME, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL);
CREATE TABLE sf_guard_user_group (user_id INTEGER, group_id INTEGER, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, group_id));
CREATE TABLE sf_guard_user_permission (user_id INTEGER, permission_id INTEGER, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, permission_id));
CREATE UNIQUE INDEX anlage_lnr_idx ON bild (anlage_id, lnr);
CREATE UNIQUE INDEX section_lnr_idx ON section (anlage_id, lnr);
CREATE UNIQUE INDEX zim_lnr_idx ON stunde (zim_id, lnr);
CREATE INDEX is_active_idx_idx ON sf_guard_user (is_active);
