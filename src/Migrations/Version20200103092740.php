<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200103092740 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product ADD description LONGTEXT DEFAULT NULL, ADD cover_image VARCHAR(255) DEFAULT NULL, CHANGE plantation_id plantation_id INT  NULL');
        $this->addSql('ALTER TABLE `order` CHANGE orderdate orderdate DATETIME NOT NULL');
        $this->addSql('ALTER TABLE order_detail CHANGE date_paid date_paid DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `order` CHANGE orderdate orderdate DATETIME NOT NULL');
        $this->addSql('ALTER TABLE order_detail CHANGE date_paid date_paid DATETIME NOT NULL');
        $this->addSql('ALTER TABLE product DROP description, DROP cover_image, CHANGE plantation_id plantation_id INT DEFAULT NULL');
    }
}