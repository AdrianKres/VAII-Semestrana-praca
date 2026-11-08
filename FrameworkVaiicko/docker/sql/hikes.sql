SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS `ratings`;
DROP TABLE IF EXISTS `hike_photos`;
DROP TABLE IF EXISTS `hikes`;
DROP TABLE IF EXISTS `mountains`;
DROP TABLE IF EXISTS `users`;
SET FOREIGN_KEY_CHECKS = 1;

-- 1. TABUĽKA POUŽÍVATEĽOV (users)
-- Praktický zmysel: Oddeľuje súkromný denník od verejnej nástenky. Každý vie, kto trasu reálne prešiel.
CREATE TABLE `users` (
                         `id` INT AUTO_INCREMENT PRIMARY KEY,
                         `name` VARCHAR(100) NOT NULL,
                         `email` VARCHAR(150) NOT NULL UNIQUE,
                         `password` VARCHAR(255) NOT NULL,
                         `role` VARCHAR(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
                                                                    (1, 'Adrián Kres', 'adrian@exploreslovakia.sk', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'),
                                                                    (2, 'Nikola K.', 'nika@exploreslovakia.sk', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user');

-- 2. TABUĽKA POHORÍ (mountains)
-- Praktický zmysel: Zabraňuje preklepom (nikto nezadá "Vysoke tatry" s malým t) a drží reálne geografické dáta.
CREATE TABLE `mountains` (
                             `id` INT AUTO_INCREMENT PRIMARY KEY,
                             `name` VARCHAR(100) NOT NULL UNIQUE,
                             `highest_peak` VARCHAR(100) NOT NULL,
                             `elevation` INT NOT NULL,
                             `description` TEXT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `mountains` (`id`, `name`, `highest_peak`, `elevation`, `description`) VALUES
                                                                                       (1, 'Vysoké Tatry', 'Gerlachovský štít', 2654, 'Najvyššie pohorie Slovenska s alpským charakterom, skalnými štítmi a ľadovcovými plesami.'),
                                                                                       (2, 'Západné Tatry', 'Bystrá', 2248, 'Výrazný hôľny a skalnatý hrebeň s exponovanými úsekmi v časti Roháče.'),
                                                                                       (3, 'Nízke Tatry', 'Ďumbier', 2043, 'Rozsiahle pohorie s dlhým hrebeňom, žulovými vrcholmi na severe a krasovými dolinami.'),
                                                                                       (4, 'Malá Fatra', 'Veľký Kriváň', 1709, 'Pohorie rozdelené Váhom s vápencovými tiesňavami (Diery), skalným Rozsutcom a lúčnym hrebeňom.'),
                                                                                       (5, 'Veľká Fatra', 'Ostredok', 1596, 'Hôľne pohorie s dlhými trávnatými hrebeňmi, krasovými dolinami a zachovalými lesmi.');

-- 3. TABUĽKA TÚR (hikes)
-- Praktický zmysel: Obsahuje len metriky, ktoré turista reálne rieši (dĺžka, výškové metre, obtiažnosť v teréne, GPX podklad a viditeľnosť).
CREATE TABLE `hikes` (
                         `id` INT AUTO_INCREMENT PRIMARY KEY,
                         `user_id` INT NOT NULL DEFAULT 1,
                         `mountain_id` INT NOT NULL DEFAULT 1,
                         `mountain` VARCHAR(100) NOT NULL,
                         `title` VARCHAR(255) NOT NULL,
                         `hike_date` DATE NOT NULL,
                         `distance` DECIMAL(5,2) NOT NULL,
                         `elevation` INT NOT NULL,
                         `difficulty` VARCHAR(50) NOT NULL DEFAULT 'Stredná',
                         `gpx_file` VARCHAR(255) NOT NULL DEFAULT 'trasa.gpx',
                         `status` VARCHAR(50) NOT NULL DEFAULT 'Absolvovaná',
                         `is_public` TINYINT(1) NOT NULL DEFAULT 1,
                         `description` TEXT NULL,
                         CONSTRAINT `fk_hikes_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
                         CONSTRAINT `fk_hikes_mountain` FOREIGN KEY (`mountain_id`) REFERENCES `mountains`(`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `hikes` (`id`, `user_id`, `mountain_id`, `mountain`, `title`, `hike_date`, `distance`, `elevation`, `difficulty`, `gpx_file`, `status`, `is_public`, `description`) VALUES
                                                                                                                                                                                    (1, 1, 1, 'Vysoké Tatry', 'Výstup na Kriváň (2 494 m)', '2026-09-12', 15.80, 1360, 'Ťažká', 'krivan_track.gpx', 'Absolvovaná', 1, 'Skvelé jesenné počasie, ráno mierny mráz v kosodrevine. Záver výstupu cez Daxnerov žľab náročný na orientáciu a prudké stúpanie po skale, ale kruhový výhľad z vrcholu stál za to.'),
                                                                                                                                                                                    (2, 1, 1, 'Vysoké Tatry', 'Prechod cez Bystrú lávku (2 300 m)', '2026-08-18', 14.20, 980, 'Ťažká', 'bystra_lavka.gpx', 'Absolvovaná', 1, 'Okruh zo Štrbského plesa cez Mlynickú dolinu okolo vodopádu Skok, prechod cez reťaze v sedle a zostup Furkotskou dolinou.'),
                                                                                                                                                                                    (3, 1, 1, 'Vysoké Tatry', 'Ľadový štít cez Koňarčinu (2 627 m)', '2026-10-03', 18.20, 1450, 'Extrémna', 'ladovy_stit.gpx', 'Plánovaná', 1, 'Vysokohorský hrebeňový výstup mimo značkovaných chodníkov. Nutná prilba a pevná obuv.'),
                                                                                                                                                                                    (4, 2, 2, 'Západné Tatry', 'Hrebeňovka: Baníkov a Tri kopy', '2026-07-25', 16.50, 1320, 'Extrémna', 'rohacky_hreben.gpx', 'Absolvovaná', 1, 'Exponovaný skalný hrebeň zabezpečený reťazami. Silný vietor na hrebeni, ale stabilné a suché skaly.');

-- 4. TABUĽKA FOTOGRAFIÍ Z TERÉNU (hike_photos)
-- Praktický zmysel: Slúži ako vizuálny report aktuálnych podmienok (sneh v žľabe, stav reťazí, viditeľnosť).
CREATE TABLE `hike_photos` (
                               `id` INT AUTO_INCREMENT PRIMARY KEY,
                               `hike_id` INT NOT NULL,
                               `caption` VARCHAR(255) NOT NULL,
                               `file_name` VARCHAR(255) NOT NULL DEFAULT 'IMG_TATRY.jpg',
                               `file_size` VARCHAR(50) NOT NULL DEFAULT '3.2 MB',
                               CONSTRAINT `fk_photos_hike` FOREIGN KEY (`hike_id`) REFERENCES `hikes`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `hike_photos` (`hike_id`, `caption`, `file_name`, `file_size`) VALUES
                                                                               (1, 'Ranný pohľad na Kriváň od Jamského plesa', 'IMG_2026_01.jpg', '3.4 MB'),
                                                                               (1, 'Stúpanie cez Malú Krivánsku priehybu', 'IMG_2026_02.jpg', '4.1 MB'),
                                                                               (1, 'Vrcholový dvojkríž (2 494 m n. m.)', 'IMG_2026_03.jpg', '2.9 MB'),
                                                                               (2, 'Vodopád Skok v Mlynickej doline', 'IMG_2026_11.jpg', '3.8 MB'),
                                                                               (2, 'Reťaze pod Bystrou lávkou', 'IMG_2026_12.jpg', '4.0 MB');

-- 5. TABUĽKA HODNOTENÍ A REPORTU PODMIENOK (ratings)
-- Praktický zmysel: Komunita si tu nepíše prázdne frázy, ale aktuálny stav chodníka (napr. ľad, popadané stromy) a bodové hodnotenie trasy.
CREATE TABLE `ratings` (
                           `id` INT AUTO_INCREMENT PRIMARY KEY,
                           `hike_id` INT NOT NULL,
                           `author_name` VARCHAR(100) NOT NULL DEFAULT 'Turista',
                           `stars` INT NOT NULL DEFAULT 5,
                           `comment` TEXT NULL,
                           `created_at` DATE NOT NULL,
                           CONSTRAINT `fk_ratings_hike` FOREIGN KEY (`hike_id`) REFERENCES `hikes`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `ratings` (`hike_id`, `author_name`, `stars`, `comment`, `created_at`) VALUES
                                                                                       (1, 'Nikola K.', 5, 'Pod sedlom už ráno namŕza skala, odporúčam pribaliť nesmeky. Výhľady perfektné.', '2026-09-14'),
                                                                                       (1, 'Marek T.', 5, 'Klasika, ktorá nesklame. Od Troch studničiek je stúpanie v lese dosť strmé.', '2026-09-15'),
                                                                                       (2, 'Adrián Kres', 5, 'Reťaze na Bystrej lávke sú v super stave, bez problémov prechodné z oboch strán.', '2026-08-19'),
                                                                                       (4, 'Adrián Kres', 5, 'Najkrajšia hrebeňovka na Slovensku, na Troch kopách treba dávať pozor na suť.', '2026-07-28');