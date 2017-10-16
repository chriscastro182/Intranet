
-- -----------------------------------------------------
-- Table `intranet`.`Post`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `intranet`.`Post` (
  `idPost` INT NOT NULL,
  `tituloPost` VARCHAR(45) NOT NULL,
  `contenidoPost` VARCHAR(45) NOT NULL,
  `fechaPost` DATETIME NOT NULL,
  `imagenPost` VARCHAR(45) NULL,
  PRIMARY KEY (`idPost`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `intranet`.`Comentario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `intranet`.`Comentario` (
  `idComentario` INT NOT NULL,
  `comentario` VARCHAR(45) NOT NULL,
  `fechaComentario` DATETIME NOT NULL,
  `Usuario_idUsuario` INT NOT NULL,
  `Post_idPost` INT NOT NULL,
  PRIMARY KEY (`idComentario`, `Usuario_idUsuario`, `Post_idPost`),
  INDEX `fk_Comentario_Usuario1_idx` (`Usuario_idUsuario` ASC),
  INDEX `fk_Comentario_Post1_idx` (`Post_idPost` ASC),
  CONSTRAINT `fk_Comentario_Usuario1`
    FOREIGN KEY (`Usuario_idUsuario`)
    REFERENCES `intranet`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Comentario_Post1`
    FOREIGN KEY (`Post_idPost`)
    REFERENCES `intranet`.`Post` (`idPost`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
