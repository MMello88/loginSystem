
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

INSERT INTO tbl_tipo_usuario VALUES (NULL, 'Admin', 'a');

SET FOREIGN_KEY_CHECKS=0;

ALTER TABLE `miste872_matilab`.`tbl_usuario`   
  ADD COLUMN `id_tipo_usuario` INT(11) NOT NULL AFTER `ver_cad_usuario`,
  ADD CONSTRAINT `fk_tipo_usuario` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `miste872_matilab`.`tbl_tipo_usuario`(`id_tipo_usuario`);

SET FOREIGN_KEY_CHECKS=1;

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

CREATE TABLE `miste872_matilab`.`tbl_tabela`(  
  `id_tabela` INT(11) NOT NULL AUTO_INCREMENT,
  `tabela` VARCHAR(100) NOT NULL,
  `url` VARCHAR(100) NOT NULL,
  `label` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id_tabela`)
);

CREATE TABLE `miste872_matilab`.`tbl_coluna`(  
  `id_coluna` INT(11) NOT NULL AUTO_INCREMENT,
  `id_tabela` INT(11) NOT NULL,
  `coluna` VARCHAR(100) NOT NULL,
  `tipo` VARCHAR(100) NOT NULL,
  `lenght` VARCHAR(15),
  `default` VARCHAR(100),
  `primary` CHAR(1),
  `obrigatorio` CHAR(1) NOT NULL,
  `input_label` VARCHAR(100) NOT NULL,
  `input_visivel` CHAR(1) NOT NULL,
  `input_type` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id_coluna`),
  CONSTRAINT `fk_tabela` FOREIGN KEY (`id_tabela`) REFERENCES `miste872_matilab`.`tbl_tabela`(`id_tabela`)
);


CREATE TABLE `miste872_matilab`.`tbl_relacional`(  
  `id_relacional` INT(11) NOT NULL AUTO_INCREMENT,
  `id_tabela_pai` INT(11) NOT NULL,
  `id_coluna_pai` INT(11) NOT NULL,
  `id_tabela_rel` INT(11) NOT NULL,
  `id_coluna_rel` INT(11) NOT NULL,
  `pai_filha` CHAR(1) NOT NULL COMMENT '0 - não / 1 - sim',
  PRIMARY KEY (`id_relacional`),
  CONSTRAINT `fk_tabela_pai` FOREIGN KEY (`id_tabela_pai`) REFERENCES `miste872_matilab`.`tbl_tabela`(`id_tabela`),
  CONSTRAINT `fk_tabela_rel` FOREIGN KEY (`id_tabela_rel`) REFERENCES `miste872_matilab`.`tbl_tabela`(`id_tabela`),
  CONSTRAINT `fk_coluna_pai` FOREIGN KEY (`id_coluna_pai`) REFERENCES `miste872_matilab`.`tbl_coluna`(`id_coluna`),
  CONSTRAINT `fk_coluna_rel` FOREIGN KEY (`id_coluna_rel`) REFERENCES `miste872_matilab`.`tbl_coluna`(`id_coluna`)
);

ALTER TABLE `miste872_matilab`.`tbl_coluna`   
  ADD COLUMN `grid_visivel` CHAR(1) NOT NULL AFTER `input_type`,
  ADD COLUMN `input_ordem` INT(11) NOT NULL AFTER `grid_visivel`;


/*

-- td para realizar os cadastro
SELECT * FROM tbl_tabela;
SELECT * FROM tbl_coluna;
SELECT * FROM tbl_relacional;
SELECT * FROM tbl_relacional_coluna;
-- -----------------------------------------

-- td sobre as tabelas do menu
SELECT * FROM tbl_titulo;
SELECT * FROM tbl_menu;
SELECT * FROM tbl_submenu;
SELECT * FROM tbl_menu_titulo;
SELECT * FROM tbl_menu_usuario;
SELECT * FROM tbl_tipo_usuario;
-- -----------------------------------------

*/