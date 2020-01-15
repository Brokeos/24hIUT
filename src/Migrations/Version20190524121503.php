<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190524121503 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, country_id INT DEFAULT NULL, exportateur_id INT DEFAULT NULL, coffee_type VARCHAR(255) NOT NULL, quantity INT NOT NULL, date_commande DATETIME NOT NULL, INDEX IDX_6EEAA67DF92F3E70 (country_id), INDEX IDX_6EEAA67DB4FCC262 (exportateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DB4FCC262 FOREIGN KEY (exportateur_id) REFERENCES account (id)');
        $this->addSql('ALTER TABLE account ADD address_id INT DEFAULT NULL, ADD phone_number INT NOT NULL');
        $this->addSql('ALTER TABLE account ADD CONSTRAINT FK_7D3656A4F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7D3656A4F5B7AF75 ON account (address_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE commande');
        $this->addSql('ALTER TABLE account DROP FOREIGN KEY FK_7D3656A4F5B7AF75');
        $this->addSql('DROP INDEX UNIQ_7D3656A4F5B7AF75 ON account');
        $this->addSql('ALTER TABLE account DROP address_id, DROP phone_number');
    }
}
