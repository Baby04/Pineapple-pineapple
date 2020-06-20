-- Doctrine Migration File Generated on 2020-02-09 19:18:14

-- Version 20200209181428
CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, datebooked DATETIME DEFAULT NULL, deliverydate DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB;
ALTER TABLE `order` CHANGE orderdate orderdate DATETIME NOT NULL, CHANGE phonenumber phonenumber VARCHAR(20) DEFAULT NULL, CHANGE add_delivery_instruction add_delivery_instruction VARCHAR(255) DEFAULT NULL;
ALTER TABLE order_detail CHANGE date_paid date_paid DATETIME NOT NULL;
ALTER TABLE product CHANGE plantation_id plantation_id INT DEFAULT NULL, CHANGE cover_image cover_image VARCHAR(255) DEFAULT NULL;
INSERT INTO migration_versions (version, executed_at) VALUES ('20200209181428', CURRENT_TIMESTAMP);
