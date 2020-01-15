<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190524131419 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commande ADD importateur_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D69B35AE8 FOREIGN KEY (importateur_id_id) REFERENCES account (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D69B35AE8 ON commande (importateur_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D69B35AE8');
        $this->addSql('DROP INDEX IDX_6EEAA67D69B35AE8 ON commande');
        $this->addSql('ALTER TABLE commande DROP importateur_id_id');
    }
}
