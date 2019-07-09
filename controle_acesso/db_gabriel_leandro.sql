create database db_gabriel_leandro;

use db_gabriel_leandro;

CREATE TABLE IF NOT EXISTS tb_perfil (
  id_perfil int(11) NOT NULL AUTO_INCREMENT,
  descricao varchar(255) DEFAULT NULL,
  ativo smallint(6) DEFAULT NULL,
  PRIMARY KEY (id_perfil)
);

INSERT INTO tb_perfil (id_perfil, descricao, ativo) VALUES
	(1, 'Admin', 1),
	(2, 'Basico', 1);

CREATE TABLE IF NOT EXISTS tb_senha (
  id_senha int(11) NOT NULL AUTO_INCREMENT,
  dt_inclusao datetime DEFAULT NULL,
  dt_expiracao datetime DEFAULT NULL,
  id_usuario int(11) DEFAULT NULL,
  ds_senha_cripto varchar(255) DEFAULT NULL,
  PRIMARY KEY (id_senha),
  KEY fK_tb_usuario (id_usuario),
  CONSTRAINT fK_tb_usuario FOREIGN KEY (id_usuario) REFERENCES tb_usuario (id_usuario)
);


INSERT INTO tb_senha (id_senha, dt_inclusao, dt_expiracao, id_usuario, ds_senha_cripto) VALUES
	(1, '2019-06-17 16:00:02', '2019-08-17 17:32:48', 1, 'e10adc3949ba59abbe56e057f20f883e'),
	(9, '2019-06-18 18:04:14', '2019-08-17 18:04:14', 14, 'e10adc3949ba59abbe56e057f20f883e');

CREATE TABLE IF NOT EXISTS tb_usuario (
  id_usuario int(11) NOT NULL AUTO_INCREMENT,
  nm_usuario varchar(255) NOT NULL,
  ds_usuario varchar(255) NOT NULL,
  dt_inclusao datetime NOT NULL,
  fl_ativo smallint(6) NOT NULL DEFAULT 1,
  id_perfil int(11) NOT NULL,
  PRIMARY KEY (id_usuario),
  UNIQUE KEY un_ds_usuario (ds_usuario),
  KEY fk_tb_perfil (id_perfil),
  CONSTRAINT fk_tb_perfil FOREIGN KEY (id_perfil) REFERENCES tb_perfil (id_perfil)
);

INSERT INTO tb_usuario (id_usuario, nm_usuario, ds_usuario, dt_inclusao, fl_ativo, id_perfil) VALUES
	(1, 'Gabriel Leandro', 'admin', '2019-06-17 16:16:27', 1, 1),
	(14, 'Usuario Basico', 'basico', '2019-06-18 18:04:14', 1, 2);