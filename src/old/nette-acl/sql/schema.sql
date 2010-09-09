CREATE TABLE `users` (
  `id`         int            NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name`       varchar(255)   NOT NULL,
  `email`      varchar(255)   NOT NULL,
  `password`   char(40)       NOT NULL,
  `role`       varchar(255)   NOT NULL
) ENGINE = MyISAM DEFAULT CHARACTER SET = utf8;
