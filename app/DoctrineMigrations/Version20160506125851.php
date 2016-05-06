<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160506125851 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE bonus_card (id INT AUTO_INCREMENT NOT NULL, series SMALLINT NOT NULL, number INT NOT NULL, issue_date DATETIME NOT NULL, exp_date DATETIME NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bonus_card_history (id INT AUTO_INCREMENT NOT NULL, bonus_card_id INT DEFAULT NULL, product_name VARCHAR(255) NOT NULL, product_price NUMERIC(10, 2) NOT NULL, date DATETIME NOT NULL, INDEX IDX_AFFA5FC6BB577228 (bonus_card_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bonus_card_history ADD CONSTRAINT FK_AFFA5FC6BB577228 FOREIGN KEY (bonus_card_id) REFERENCES bonus_card (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bonus_card_history DROP FOREIGN KEY FK_AFFA5FC6BB577228');
        $this->addSql('DROP TABLE bonus_card');
        $this->addSql('DROP TABLE bonus_card_history');
    }
}
