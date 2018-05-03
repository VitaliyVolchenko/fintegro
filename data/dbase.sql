CREATE TABLE `yii2basic`.`items` (
  `id` INT NOT NULL,
  `id_ref` INT NOT NULL,
  `title` VARCHAR(45) NULL)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;

INSERT INTO `yii2basic`.`items` (`id`, `id_ref`, `title`) VALUES ('0', '0', 'root');
INSERT INTO `yii2basic`.`items` (`id`, `id_ref`, `title`) VALUES ('1', '0', 'Main Item 1');
INSERT INTO `yii2basic`.`items` (`id`, `id_ref`, `title`) VALUES ('2', '0', 'Main Item 2');
INSERT INTO `yii2basic`.`items` (`id`, `id_ref`, `title`) VALUES ('3', '0', 'Main Item 3');
INSERT INTO `yii2basic`.`items` (`id`, `id_ref`, `title`) VALUES ('4', '0', 'Main Item 4');
INSERT INTO `yii2basic`.`items` (`id`, `id_ref`, `title`) VALUES ('5', '1', 'Sub Item 1');
INSERT INTO `yii2basic`.`items` (`id`, `id_ref`, `title`) VALUES ('6', '1', 'Sub Item 2');
INSERT INTO `yii2basic`.`items` (`id`, `id_ref`, `title`) VALUES ('7', '1', 'Sub Item 3');
INSERT INTO `yii2basic`.`items` (`id`, `id_ref`, `title`) VALUES ('8', '2', 'Sub Item 1');
INSERT INTO `yii2basic`.`items` (`id`, `id_ref`, `title`) VALUES ('9', '2', 'Sub Item 2');
INSERT INTO `yii2basic`.`items` (`id`, `id_ref`, `title`) VALUES ('10', '3', 'Sub Item 1');
INSERT INTO `yii2basic`.`items` (`id`, `id_ref`, `title`) VALUES ('11', '10', 'Sub Item 1');
INSERT INTO `yii2basic`.`items` (`id`, `id_ref`, `title`) VALUES ('12', '11', 'Sub Item 1');

