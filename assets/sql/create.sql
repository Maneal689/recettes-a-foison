CREATE TABLE `USERS` (
  `id_user` int(11) PRIMARY KEY AUTO_INCREMENT,
  `login` VARCHAR(64) COLLATE utf8mb4_unicode_ci UNIQUE NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` text COLLATE utf8mb4_unicode_ci DEFAULT NULL CHECK (`sex` like 'homme' or `sex` like 'femme' or `sex` like ''),
  `mail` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth` date DEFAULT NULL
);

CREATE TABLE `FAVORITES` (
  `id_user` int(11) NOT NULL REFERENCES USERS(`id_user`),
  `recipe` text COLLATE utf8mb4_unicode_ci NOT NULL
);