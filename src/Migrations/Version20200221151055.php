<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200221151055 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, author_id INT NOT NULL, created_at DATETIME DEFAULT NULL, rating INT DEFAULT NULL, INDEX IDX_9474526C4584665A (product_id), INDEX IDX_9474526CF675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE product CHANGE plantation_id plantation_id INT DEFAULT NULL, CHANGE cover_image cover_image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` CHANGE orderdate orderdate DATETIME NOT NULL, CHANGE phonenumber phonenumber VARCHAR(20) DEFAULT NULL, CHANGE add_delivery_instruction add_delivery_instruction VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE reset_token reset_token VARCHAR(60) DEFAULT NULL, CHANGE roles roles JSON DEFAULT NULL');
        $this->addSql('ALTER TABLE booking CHANGE datebooked datebooked DATETIME DEFAULT NULL, CHANGE deliverydate deliverydate DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE order_detail CHANGE date_paid date_paid DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE comment');
        $this->addSql('ALTER TABLE booking CHANGE datebooked datebooked DATETIME DEFAULT \'NULL\', CHANGE deliverydate deliverydate DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE `order` CHANGE orderdate orderdate DATETIME NOT NULL, CHANGE phonenumber phonenumber VARCHAR(20) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE add_delivery_instruction add_delivery_instruction VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE order_detail CHANGE date_paid date_paid DATETIME NOT NULL');
        $this->addSql('ALTER TABLE product CHANGE plantation_id plantation_id INT DEFAULT NULL, CHANGE cover_image cover_image VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE user CHANGE reset_token reset_token VARCHAR(60) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE roles roles LONGTEXT DEFAULT NULL COLLATE utf8mb4_bin');
    }
}
