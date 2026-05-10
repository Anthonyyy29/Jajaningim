-- ============================================================
--  JajaninGim — Setup Database Lengkap
--  Cara pakai:
--    phpMyAdmin → tab SQL → paste semua → klik Go
--  atau terminal:
--    mysql -u root -p < database.sql
-- ============================================================

CREATE DATABASE IF NOT EXISTS jajaningim_db
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE jajaningim_db;


-- ------------------------------------------------------------
--  Tabel: akun
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS akun (
  id_akun       INT                    NOT NULL AUTO_INCREMENT,
  username_akun VARCHAR(20)            NOT NULL,
  password      VARCHAR(255)           NOT NULL,
  email         VARCHAR(50)            NOT NULL,
  created_at    TIMESTAMP              NOT NULL DEFAULT CURRENT_TIMESTAMP,
  role          ENUM('user','admin')   NOT NULL DEFAULT 'user',
  PRIMARY KEY (id_akun),
  UNIQUE KEY uq_username (username_akun),
  UNIQUE KEY uq_email    (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- ------------------------------------------------------------
--  Tabel: refresh_tokens
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS refresh_tokens (
  id          INT           NOT NULL AUTO_INCREMENT,
  user_id     INT           NOT NULL,
  token       VARCHAR(255)  NOT NULL,
  device_info VARCHAR(255)  DEFAULT NULL,
  ip_address  VARCHAR(50)   DEFAULT NULL,
  expired_at  TIMESTAMP     NOT NULL,
  created_at  TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  FOREIGN KEY (user_id) REFERENCES akun(id_akun) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- ------------------------------------------------------------
--  Tabel: guest_session_id
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS guest_session_id (
  id            INT           NOT NULL AUTO_INCREMENT,
  session_token VARCHAR(255)  NOT NULL,
  email         TEXT          DEFAULT NULL,
  created_at    TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  expired_at    TIMESTAMP     NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY uq_session_token (session_token)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- ------------------------------------------------------------
--  Tabel: games
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS games (
  id_game     INT           NOT NULL AUTO_INCREMENT,
  nama_game   VARCHAR(255)  NOT NULL,
  gambar_game VARCHAR(255)  NOT NULL,
  PRIMARY KEY (id_game)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO games (nama_game, gambar_game) VALUES
  ('Mobile Legends', 'mlbb.png'),
  ('Free Fire',      'freefire.png'),
  ('Call of Duty Mobile', 'codm.png'),
  ('PUBG Mobile',    'pubg.png'),
  ('Genshin Impact', 'genshin.png');


-- ------------------------------------------------------------
--  Tabel: game_items
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS game_items (
  id_item    INT                                   NOT NULL AUTO_INCREMENT,
  id_games   INT                                   NOT NULL,
  label_item VARCHAR(30)                           NOT NULL,
  price      INT                                   NOT NULL,
  type       ENUM('subscription','non_subscription') NOT NULL DEFAULT 'non_subscription',
  PRIMARY KEY (id_item),
  FOREIGN KEY (id_games) REFERENCES games(id_game) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO game_items (id_games, label_item, price, type) VALUES
  -- Mobile Legends (id_game = 1)
  (1, '11 Diamond',    2000,   'non_subscription'),
  (1, '22 Diamond',    4000,   'non_subscription'),
  (1, '56 Diamond',    9000,   'non_subscription'),
  (1, '112 Diamond',   18000,  'non_subscription'),
  (1, '257 Diamond',   40000,  'non_subscription'),
  (1, '706 Diamond',   99000,  'non_subscription'),
  (1, 'Twilight Pass', 149000, 'subscription'),
  -- Free Fire (id_game = 2)
  (2, '100 Diamond',   9000,   'non_subscription'),
  (2, '310 Diamond',   27000,  'non_subscription'),
  (2, '520 Diamond',   45000,  'non_subscription'),
  (2, '1060 Diamond',  90000,  'non_subscription'),
  (2, 'Weekly Pass',   19000,  'subscription'),
  -- Call of Duty Mobile (id_game = 3)
  (3, '80 CP',         13000,  'non_subscription'),
  (3, '400 CP',        65000,  'non_subscription'),
  (3, '800 CP',        130000, 'non_subscription'),
  (3, 'Battle Pass',   149000, 'subscription'),
  -- PUBG Mobile (id_game = 4)
  (4, '60 UC',         14000,  'non_subscription'),
  (4, '325 UC',        75000,  'non_subscription'),
  (4, '660 UC',        149000, 'non_subscription'),
  -- Genshin Impact (id_game = 5)
  (5, '60 Primogem',   14000,  'non_subscription'),
  (5, '330 Primogem',  75000,  'non_subscription'),
  (5, '980 Primogem',  149000, 'non_subscription'),
  (5, 'Blessing',      149000, 'subscription');


-- ------------------------------------------------------------
--  Tabel: payment_method
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS payment_method (
  id_payment     INT                      NOT NULL AUTO_INCREMENT,
  metode_payment VARCHAR(255)             NOT NULL,
  logo           TEXT                     DEFAULT NULL,
  is_active      ENUM('true','false')     NOT NULL DEFAULT 'true',
  PRIMARY KEY (id_payment)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO payment_method (metode_payment, logo, is_active) VALUES
  ('QRIS',      'qris.png',      'true'),
  ('GoPay',     'gopay.png',     'true'),
  ('ShopeePay', 'shopeepay.png', 'true'),
  ('DANA',      'dana.png',      'true'),
  ('OVO',       'ovo.png',       'true');


-- ------------------------------------------------------------
--  Tabel: transaksi
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS transaksi (
  id_transaksi     INT                              NOT NULL AUTO_INCREMENT,
  id_item          INT                              NOT NULL,
  id_akun          INT                              DEFAULT NULL,
  guest_session_id INT                              DEFAULT NULL,
  id_payment       INT                              NOT NULL,
  game_user_id     VARCHAR(255)                     DEFAULT NULL,
  game_zone_id     VARCHAR(255)                     DEFAULT NULL,
  status_transaksi ENUM('pending','success','failed') NOT NULL DEFAULT 'pending',
  status_payment   ENUM('unpaid','paid')            NOT NULL DEFAULT 'unpaid',
  date_transaksi   DATETIME                         NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id_transaksi),
  FOREIGN KEY (id_item)          REFERENCES game_items(id_item)         ON DELETE CASCADE,
  FOREIGN KEY (id_akun)          REFERENCES akun(id_akun)               ON DELETE SET NULL,
  FOREIGN KEY (guest_session_id) REFERENCES guest_session_id(id)        ON DELETE SET NULL,
  FOREIGN KEY (id_payment)       REFERENCES payment_method(id_payment)  ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- ============================================================
--  SETUP AKUN ADMIN:
--  1. Buka website → /?url=register → daftar akun
--  2. Jalankan query berikut (ganti 'username_kamu'):
--
--     UPDATE akun SET role = 'admin' WHERE username_akun = 'username_kamu';
--
-- ============================================================
