-- =============================
-- TABLE: akun
-- =============================
CREATE TABLE akun (
    id_akun     INT PRIMARY KEY AUTO_INCREMENT,
    username_akun VARCHAR(20) NOT NULL,
    password    VARCHAR(50) NOT NULL,
    email       VARCHAR(50) NOT NULL,
    created_at  TIMESTAMP DEFAULT NOW()
);

-- =============================
-- TABLE: refresh_tokens
-- =============================
CREATE TABLE refresh_tokens (
    id          INT PRIMARY KEY AUTO_INCREMENT,
    user_id     INT NOT NULL,
    token       VARCHAR(255) NOT NULL,
    device_info VARCHAR(255),
    ip_address  VARCHAR(50),
    expired_at  TIMESTAMP,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES akun(id_akun)
);

-- =============================
-- TABLE: guest_session_id
-- =============================
CREATE TABLE guest_session_id (
    id            INT PRIMARY KEY AUTO_INCREMENT,
    session_token VARCHAR(255) NOT NULL,
    email         TEXT,
    created_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    expired_at    TIMESTAMP
);

-- =============================
-- TABLE: games
-- =============================
CREATE TABLE games (
    id_game     INT PRIMARY KEY AUTO_INCREMENT,
    nama_game   VARCHAR(255) NOT NULL,
    gambar_game VARCHAR(255)
);

-- =============================
-- TABLE: game_items
-- =============================
CREATE TABLE game_items (
    id_item   INT PRIMARY KEY AUTO_INCREMENT,
    id_games  INT NOT NULL,
    label_item VARCHAR(30) NOT NULL,
    price     INT NOT NULL,
    type      ENUM('subscription', 'non_subsription') NOT NULL,
    FOREIGN KEY (id_games) REFERENCES games(id_game)
);

-- =============================
-- TABLE: payment_method
-- =============================
CREATE TABLE payment_method (
    id_payment      INT PRIMARY KEY AUTO_INCREMENT,
    metode_payment  VARCHAR(255) NOT NULL,
    logo            TEXT,
    is_active       ENUM('true', 'false') DEFAULT 'true'
);

-- =============================
-- TABLE: transaksi
-- =============================
CREATE TABLE transaksi (
    id_transaksi     INT PRIMARY KEY AUTO_INCREMENT,
    id_item          INT NOT NULL,
    id_akun          INT,
    guest_session_id INT,
    id_payment       INT NOT NULL,
    game_user_id     VARCHAR(255),
    game_zone_id     VARCHAR(255),
    status_transaksi ENUM('pending', 'success', 'failed') DEFAULT 'pending',
    status_payment   ENUM('unpaid', 'paid') DEFAULT 'unpaid',
    date_transaksi   DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_item)          REFERENCES game_items(id_item),
    FOREIGN KEY (id_akun)          REFERENCES akun(id_akun),
    FOREIGN KEY (guest_session_id) REFERENCES guest_session_id(id),
    FOREIGN KEY (id_payment)       REFERENCES payment_method(id_payment)
);