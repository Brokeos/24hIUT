<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190524142952 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE coffee ADD account_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE coffee ADD CONSTRAINT FK_538529B39B6B5FBA FOREIGN KEY (account_id) REFERENCES account (id)');
        $this->addSql('CREATE INDEX IDX_538529B39B6B5FBA ON coffee (account_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE coffee DROP FOREIGN KEY FK_538529B39B6B5FBA');
        $this->addSql('DROP INDEX IDX_538529B39B6B5FBA ON coffee');
        $this->addSql('ALTER TABLE coffee DROP account_id');
    }
}
