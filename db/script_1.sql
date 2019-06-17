
CREATE TABLE `tbl_usuario`(  
  `id_usuario` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(150) NOT NULL,
  `email` VARCHAR(250) NOT NULL,
  `senha` VARCHAR(64) NOT NULL,
  `ativo` CHAR(1) NOT NULL,
  `dt_cadastro` DATETIME NOT NULL,
  `hash` VARCHAR(255) NULL,
  `dt_hash_exp` DATETIME NULL,
  `cadastro_completo` CHAR(1) NOT NULL,
  `dt_nascimento` DATETIME NULL,
  `celular` CHAR(15) NULL,
  `sexo` CHAR(1) NULL,
  `super_usuario` CHAR(100) NULL,
  `code_cookie_hash` VARCHAR(150) NULL,
  PRIMARY KEY (`id_usuario`),
  CONSTRAINT Uk_Email UNIQUE (email),
  CONSTRAINT Uk_Super_usuario UNIQUE (super_usuario),
  CONSTRAINT Uk_Code_Cookie UNIQUE (code_cookie_hash)
);

CREATE TABLE IF NOT EXISTS `tbl_ci_sessions` (
        `id` VARCHAR(128) NOT NULL,
        `ip_address` VARCHAR(45) NOT NULL,
        `timestamp` INT(10) UNSIGNED DEFAULT 0 NOT NULL,
        `data` BLOB NOT NULL,
        KEY `ci_sessions_timestamp` (`timestamp`)
);

ALTER TABLE tbl_ci_sessions ADD PRIMARY KEY (id);

CREATE TABLE `miste872_matilab`.`tbl_tipo_usuario`(  
  `id_tipo_usuario` INT(11) NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(255) NOT NULL,
  `status` CHAR(1) NOT NULL,
  PRIMARY KEY (`id_tipo_usuario`)
);

CREATE TABLE `miste872_matilab`.`tbl_menu`(  
  `id_menu` INT(11) NOT NULL AUTO_INCREMENT,
  `menu` VARCHAR(255) NOT NULL,
  `url` VARCHAR(255) NOT NULL,
  `ordem` INT(10) NOT NULL,
  `status` CHAR(1) NOT NULL,
  PRIMARY KEY (`id_menu`)
);

CREATE TABLE `miste872_matilab`.`tbl_submenu`(  
  `id_submenu` INT(11) NOT NULL AUTO_INCREMENT,
  `id_menu` INT(11) NOT NULL,
  `submenu` VARCHAR(255) NOT NULL,
  `url` VARCHAR(255) NOT NULL,
  `ordem` INT(1) NOT NULL,
  `status` CHAR(1) NOT NULL,
  PRIMARY KEY (`id_submenu`),
  CONSTRAINT `fk_menu_submenu` FOREIGN KEY (`id_menu`) REFERENCES `miste872_matilab`.`tbl_menu`(`id_menu`)
);


ALTER TABLE `miste872_matilab`.`tbl_usuario`   
  ADD COLUMN `id_tipo_usuario` INT(11) NOT NULL AFTER `ver_cad_usuario`,
  ADD CONSTRAINT `fk_tipo_usuario` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `miste872_matilab`.`tbl_tipo_usuario`(`id_tipo_usuario`);

INSERT INTO tbl_tipo_usuario VALUES (NULL, 'Admin', 'a');

CREATE TABLE `miste872_matilab`.`tbl_menu_usuario`(  
  `id_menu_usuario` INT(11) NOT NULL AUTO_INCREMENT,
  `id_tipo_menu` INT(11) NOT NULL,
  `id_menu` INT(11) NOT NULL,
  PRIMARY KEY (`id_menu_usuario`),
  CONSTRAINT `fk_menu_usuario` FOREIGN KEY (`id_menu`) REFERENCES `miste872_matilab`.`tbl_menu`(`id_menu`),
  CONSTRAINT `fk_tipo_usuario_menu` FOREIGN KEY (`id_tipo_menu`) REFERENCES `miste872_matilab`.`tbl_tipo_usuario`(`id_tipo_usuario`)
);

ALTER TABLE `miste872_matilab`.`tbl_menu`
  ADD COLUMN `icone` VARCHAR(100) NULL AFTER `status`;

INSERT INTO tbl_menu VALUES (NULL, 'Home', 'Welcome', 1, 'a', 'ti-home');
INSERT INTO tbl_menu VALUES (NULL, 'Logout', 'logout', 99, 'a', 'ti-close');
INSERT INTO tbl_menu_usuario VALUES (NULL, 1, 1);
INSERT INTO tbl_menu_usuario VALUES (NULL, 1, 2);

CREATE TABLE `miste872_matilab`.`tbl_titulo`(  
  `id_titulo` INT(11)  NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`id_titulo`)
);

INSERT INTO tbl_titulo VALUES (NULL, 'Principal');
INSERT INTO tbl_titulo VALUES (NULL, 'Cadastro');
INSERT INTO tbl_titulo VALUES (NULL, 'Configuração');

CREATE TABLE `miste872_matilab`.`tbl_menu_titulo`(  
  `id_menu_titulo` INT(11) NOT NULL AUTO_INCREMENT,
  `id_menu` INT(11) NOT NULL,
  `id_titulo` INT(11) NOT NULL,
  PRIMARY KEY (`id_menu_titulo`),
  CONSTRAINT `fk_menu` FOREIGN KEY (`id_menu`) REFERENCES `miste872_matilab`.`tbl_menu`(`id_menu`),
  CONSTRAINT `fk_titulo` FOREIGN KEY (`id_titulo`) REFERENCES `miste872_matilab`.`tbl_titulo`(`id_titulo`)
);

INSERT INTO tbl_menu_titulo VALUES (NULL, 1, 1);
INSERT INTO tbl_menu_titulo VALUES (NULL, 2, 3);

INSERT INTO tbl_menu VALUES (NULL, 'Menu', 'Dashboard/Menu', 1, 'a', 'ti-layout-grid4-alt');
INSERT INTO tbl_menu_titulo VALUES (NULL, 3, 2);
INSERT INTO tbl_menu_usuario VALUES (NULL, 1, 3);