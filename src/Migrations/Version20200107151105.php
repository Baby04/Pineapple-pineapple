<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200107151105 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `order` CHANGE orderdate orderdate DATETIME NOT NULL, CHANGE phonenumber phonenumber VARCHAR(20) DEFAULT NULL, CHANGE add_delivery_instruction add_delivery_instruction VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE order_detail CHANGE date_paid date_paid DATETIME NOT NULL');
        $this->addSql('ALTER TABLE product CHANGE cover_image cover_image VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `order` CHANGE orderdate orderdate DATETIME NOT NULL, CHANGE phonenumber phonenumber VARCHAR(20) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE add_delivery_instruction add_delivery_instruction VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE order_detail CHANGE date_paid date_paid DATETIME NOT NULL');
        $this->addSql('ALTER TABLE product CHANGE cover_image cover_image VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
    }
}
