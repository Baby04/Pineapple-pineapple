<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200107104400 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product CHANGE cover_image cover_image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` ADD prod_id INT NOT NULL, CHANGE orderdate orderdate DATETIME NOT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993981C83F75 FOREIGN KEY (prod_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_F52993981C83F75 ON `order` (prod_id)');
        $this->addSql('ALTER TABLE order_detail CHANGE date_paid date_paid DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993981C83F75');
        $this->addSql('DROP INDEX IDX_F52993981C83F75 ON `order`');
        $this->addSql('ALTER TABLE `order` DROP prod_id, CHANGE orderdate orderdate DATETIME NOT NULL');
        $this->addSql('ALTER TABLE order_detail CHANGE date_paid date_paid DATETIME NOT NULL');
        $this->addSql('ALTER TABLE product CHANGE plantation_id plantation_id INT DEFAULT NULL, CHANGE cover_image cover_image VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
    }
}