<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190524125249 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE coffee (id INT AUTO_INCREMENT NOT NULL, coffee_type VARCHAR(255) NOT NULL, quantity INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coffee_country (coffee_id INT NOT NULL, country_id INT NOT NULL, INDEX IDX_14A9B56078CD6D6E (coffee_id), INDEX IDX_14A9B560F92F3E70 (country_id), PRIMARY KEY(coffee_id, country_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE coffee_country ADD CONSTRAINT FK_14A9B56078CD6D6E FOREIGN KEY (coffee_id) REFERENCES coffee (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE coffee_country ADD CONSTRAINT FK_14A9B560F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE coffee_country DROP FOREIGN KEY FK_14A9B56078CD6D6E');
        $this->addSql('DROP TABLE coffee');
        $this->addSql('DROP TABLE coffee_country');
    }
}
