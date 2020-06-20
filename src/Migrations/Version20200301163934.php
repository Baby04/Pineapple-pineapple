<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200301163934 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE booking CHANGE datebooked datebooked DATETIME DEFAULT NULL, CHANGE deliverydate deliverydate DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE cart CHANGE user_id user_id INT DEFAULT NULL, CHANGE comodity_id comodity_id INT DEFAULT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7F5DD4993 FOREIGN KEY (comodity_id) REFERENCES product (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BA388B7A76ED395 ON cart (user_id)');
        $this->addSql('CREATE INDEX IDX_BA388B7F5DD4993 ON cart (comodity_id)');
        $this->addSql('ALTER TABLE comment CHANGE created_at created_at DATETIME DEFAULT NULL, CHANGE rating rating INT DEFAULT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_9474526C4584665A ON comment (product_id)');
        $this->addSql('CREATE INDEX IDX_9474526CF675F31B ON comment (author_id)');
        $this->addSql('ALTER TABLE `order` CHANGE orderdate orderdate DATETIME NOT NULL, CHANGE phonenumber phonenumber VARCHAR(20) DEFAULT NULL, CHANGE add_delivery_instruction add_delivery_instruction VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE order_detail CHANGE date_paid date_paid DATETIME NOT NULL');
        $this->addSql('ALTER TABLE product CHANGE plantation_id plantation_id INT DEFAULT NULL, CHANGE cover_image cover_image VARCHAR(255) DEFAULT NULL, CHANGE cart_id cart_id INT DEFAULT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD19E5826C FOREIGN KEY (plantation_id) REFERENCES plantation (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD1AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD19E5826C ON product (plantation_id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD1AD5CDBF ON product (cart_id)');
        $this->addSql('ALTER TABLE user CHANGE reset_token reset_token VARCHAR(60) DEFAULT NULL, CHANGE roles roles JSON DEFAULT NULL, ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE booking CHANGE datebooked datebooked DATETIME DEFAULT \'NULL\', CHANGE deliverydate deliverydate DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE cart MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B7A76ED395');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B7F5DD4993');
        $this->addSql('DROP INDEX UNIQ_BA388B7A76ED395 ON cart');
        $this->addSql('DROP INDEX IDX_BA388B7F5DD4993 ON cart');
        $this->addSql('ALTER TABLE cart DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE cart CHANGE user_id user_id INT DEFAULT NULL, CHANGE comodity_id comodity_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comment MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C4584665A');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CF675F31B');
        $this->addSql('DROP INDEX IDX_9474526C4584665A ON comment');
        $this->addSql('DROP INDEX IDX_9474526CF675F31B ON comment');
        $this->addSql('ALTER TABLE comment DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE comment CHANGE created_at created_at DATETIME DEFAULT \'NULL\', CHANGE rating rating INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` CHANGE orderdate orderdate DATETIME NOT NULL, CHANGE phonenumber phonenumber VARCHAR(20) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE add_delivery_instruction add_delivery_instruction VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE order_detail CHANGE date_paid date_paid DATETIME NOT NULL');
        $this->addSql('ALTER TABLE product MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD19E5826C');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD1AD5CDBF');
        $this->addSql('DROP INDEX IDX_D34A04AD19E5826C ON product');
        $this->addSql('DROP INDEX IDX_D34A04AD1AD5CDBF ON product');
        $this->addSql('ALTER TABLE product DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE product CHANGE plantation_id plantation_id INT DEFAULT NULL, CHANGE cart_id cart_id INT DEFAULT NULL, CHANGE cover_image cover_image VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE user MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE user DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE user CHANGE reset_token reset_token VARCHAR(60) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE roles roles LONGTEXT DEFAULT NULL COLLATE utf8mb4_bin');
    }
}
