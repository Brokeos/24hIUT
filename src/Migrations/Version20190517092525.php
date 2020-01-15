<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190517092525 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE account CHANGE username username VARCHAR(128) NOT NULL, CHANGE email email VARCHAR(128) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7D3656A4F85E0677 ON account (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7D3656A4E7927C74 ON account (email)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_7D3656A4F85E0677 ON account');
        $this->addSql('DROP INDEX UNIQ_7D3656A4E7927C74 ON account');
        $this->addSql('ALTER TABLE account CHANGE username username VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE email email VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
