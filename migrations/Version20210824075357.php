<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210824075357 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE photo ADD dossier_id INT DEFAULT NULL, ADD description VARCHAR(255) DEFAULT NULL, DROP chemin');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418611C0C56 FOREIGN KEY (dossier_id) REFERENCES dossier_photos (id)');
        $this->addSql('CREATE INDEX IDX_14B78418611C0C56 ON photo (dossier_id)');
      
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B78418611C0C56');
        $this->addSql('DROP INDEX IDX_14B78418611C0C56 ON photo');
        $this->addSql('ALTER TABLE photo ADD chemin VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP dossier_id, DROP description');
    }
}
