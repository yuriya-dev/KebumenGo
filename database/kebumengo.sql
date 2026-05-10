-- DATABASE: kebumengo

CREATE DATABASE IF NOT EXISTS kebumengo
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE kebumengo;

CREATE TABLE users (
  id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name        VARCHAR(100) NOT NULL,
  email       VARCHAR(150) NOT NULL UNIQUE,
  password    VARCHAR(255) NOT NULL,
  role        ENUM('admin') DEFAULT 'admin',
  created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE categories (
  id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name        VARCHAR(80) NOT NULL,
  slug        VARCHAR(100) NOT NULL UNIQUE,
  icon_img    VARCHAR(255) DEFAULT NULL,
  sort_order  TINYINT UNSIGNED DEFAULT 0,
  created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE destinations (
  id              INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  category_id     INT UNSIGNED NOT NULL,
  name            VARCHAR(150) NOT NULL,
  slug            VARCHAR(160) NOT NULL UNIQUE,
  description     TEXT NOT NULL,
  main_photo      VARCHAR(255) NOT NULL,
  ticket_price    INT UNSIGNED DEFAULT 0,
  est_food        INT UNSIGNED DEFAULT 0,
  est_parking     INT UNSIGNED DEFAULT 0,
  open_time       TIME DEFAULT '07:00:00',
  close_time      TIME DEFAULT '17:00:00',
  operational_day VARCHAR(100) DEFAULT 'Senin - Minggu',
  maps_embed      TEXT DEFAULT NULL,
  facilities      JSON DEFAULT NULL,
  status          ENUM('active','inactive') DEFAULT 'active',
  created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE RESTRICT
);

CREATE TABLE destination_photos (
  id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  dest_id     INT UNSIGNED NOT NULL,
  photo_url   VARCHAR(255) NOT NULL,
  sort_order  TINYINT UNSIGNED DEFAULT 0,
  created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (dest_id) REFERENCES destinations(id) ON DELETE CASCADE
);

CREATE TABLE reviews (
  id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  dest_id     INT UNSIGNED NOT NULL,
  name        VARCHAR(100) NOT NULL,
  rating      TINYINT UNSIGNED NOT NULL CHECK (rating BETWEEN 1 AND 5),
  comment     TEXT NOT NULL,
  status      ENUM('pending','approved','rejected') DEFAULT 'pending',
  created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (dest_id) REFERENCES destinations(id) ON DELETE CASCADE
);

CREATE INDEX idx_destinations_category ON destinations(category_id);
CREATE INDEX idx_destinations_status   ON destinations(status);
CREATE INDEX idx_destinations_prices   ON destinations(ticket_price, est_food, est_parking);
CREATE INDEX idx_reviews_dest_status   ON reviews(dest_id, status);

INSERT INTO categories (name, slug, icon_img, sort_order) VALUES
('Pantai', 'pantai', 'public/images/placeholders/category-placeholder.svg', 1),
('Goa', 'goa', 'public/images/placeholders/category-placeholder.svg', 2),
('Sejarah', 'sejarah', 'public/images/placeholders/category-placeholder.svg', 3),
('Kuliner', 'kuliner', 'public/images/placeholders/category-placeholder.svg', 4);

INSERT INTO destinations (category_id, name, slug, description, main_photo, ticket_price, est_food, est_parking, open_time, close_time, operational_day, maps_embed, facilities, status) VALUES
(1, 'Pantai Logending', 'pantai-logending', 'Pantai dengan panorama samudra luas dan area parkir yang nyaman.', 'public/images/placeholders/destination-placeholder.svg', 25000, 20000, 10000, '07:00:00', '18:00:00', 'Senin - Minggu', 'https://www.google.com/maps?q=pantai+logending&output=embed', '["Toilet","Mushola","Parkir","Warung"]', 'active'),
(1, 'Pantai Karang Bolong', 'pantai-karang-bolong', 'Pantai dengan karang ikonik dan spot foto yang instagrammable.', 'public/images/placeholders/destination-placeholder.svg', 25000, 15000, 10000, '07:00:00', '18:00:00', 'Senin - Minggu', 'https://www.google.com/maps?q=pantai+karang+bolong&output=embed', '["Toilet","Parkir","Warung"]', 'active'),
(2, 'Goa Jatijajar', 'goa-jatijajar', 'Goa kapur dengan sejarah dan jalur wisata yang aman.', 'public/images/placeholders/destination-placeholder.svg', 30000, 15000, 8000, '08:00:00', '17:00:00', 'Senin - Minggu', 'https://www.google.com/maps?q=goa+jatijajar&output=embed', '["Toilet","Mushola","Parkir","Pemandu"]', 'active'),
(3, 'Benteng Van der Wijck', 'benteng-van-der-wijck', 'Bangunan heritage dengan arsitektur unik dan area taman.', 'public/images/placeholders/destination-placeholder.svg', 20000, 15000, 8000, '08:00:00', '17:00:00', 'Senin - Minggu', 'https://www.google.com/maps?q=benteng+van+der+wijck&output=embed', '["Toilet","Parkir","Kantin"]', 'active'),
(4, 'Sate Ambal', 'sate-ambal', 'Kuliner khas Kebumen dengan bumbu tempe yang gurih.', 'public/images/placeholders/destination-placeholder.svg', 0, 35000, 5000, '10:00:00', '22:00:00', 'Senin - Minggu', 'https://www.google.com/maps?q=sate+ambal&output=embed', '["Parkir","Pembayaran Tunai"]', 'active');

INSERT INTO destination_photos (dest_id, photo_url, sort_order) VALUES
(1, 'public/images/placeholders/destination-placeholder.svg', 1),
(2, 'public/images/placeholders/destination-placeholder.svg', 1),
(3, 'public/images/placeholders/destination-placeholder.svg', 1),
(4, 'public/images/placeholders/destination-placeholder.svg', 1),
(5, 'public/images/placeholders/destination-placeholder.svg', 1);

INSERT INTO reviews (dest_id, name, rating, comment, status) VALUES
(1, 'Rina', 5, 'Pantainya bersih dan akses mudah.', 'approved'),
(1, 'Yoga', 4, 'View sunset bagus, parkir cukup.', 'approved'),
(3, 'Sari', 5, 'Goa nyaman dan pemandu ramah.', 'approved'),
(4, 'Adit', 4, 'Tempat sejarah yang unik.', 'approved'),
(5, 'Doni', 5, 'Sate ambal wajib dicoba.', 'approved');
