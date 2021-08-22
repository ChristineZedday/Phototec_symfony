<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210822164613 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, lieu_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, chemin VARCHAR(255) NOT NULL, date DATE DEFAULT NULL, INDEX IDX_14B784186AB213CC (lieu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo_sujet (photo_id INT NOT NULL, sujet_id INT NOT NULL, INDEX IDX_94425E2A7E9E4C8C (photo_id), INDEX IDX_94425E2A7C4D497E (sujet_id), PRIMARY KEY(photo_id, sujet_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B784186AB213CC FOREIGN KEY (lieu_id) REFERENCES lieu (id)');
        $this->addSql('ALTER TABLE photo_sujet ADD CONSTRAINT FK_94425E2A7E9E4C8C FOREIGN KEY (photo_id) REFERENCES photo (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE photo_sujet ADD CONSTRAINT FK_94425E2A7C4D497E FOREIGN KEY (sujet_id) REFERENCES sujet (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE photo_sujet DROP FOREIGN KEY FK_94425E2A7E9E4C8C');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE photo_sujet');
    }
}
