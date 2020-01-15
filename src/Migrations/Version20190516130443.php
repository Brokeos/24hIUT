<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190516130443 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE account (id INT AUTO_INCREMENT NOT NULL, role_id INT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, INDEX IDX_7D3656A4D60322AC (role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe (id INT AUTO_INCREMENT NOT NULL, inherited_id INT DEFAULT NULL, role VARCHAR(255) NOT NULL, display VARCHAR(255) NOT NULL, INDEX IDX_4B98C21436F9E0 (inherited_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE account ADD CONSTRAINT FK_7D3656A4D60322AC FOREIGN KEY (role_id) REFERENCES groupe (id)');
        $this->addSql('ALTER TABLE groupe ADD CONSTRAINT FK_4B98C21436F9E0 FOREIGN KEY (inherited_id) REFERENCES groupe (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE account DROP FOREIGN KEY FK_7D3656A4D60322AC');
        $this->addSql('ALTER TABLE groupe DROP FOREIGN KEY FK_4B98C21436F9E0');
        $this->addSql('DROP TABLE account');
        $this->addSql('DROP TABLE groupe');
    }
}
