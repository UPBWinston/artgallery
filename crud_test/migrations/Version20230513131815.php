<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230513131815 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE art ADD artist_id INT NOT NULL');
        $this->addSql('ALTER TABLE art ADD CONSTRAINT FK_FC35D654B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id)');
        $this->addSql('CREATE INDEX IDX_FC35D654B7970CF8 ON art (artist_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE art DROP FOREIGN KEY FK_FC35D654B7970CF8');
        $this->addSql('DROP INDEX IDX_FC35D654B7970CF8 ON art');
        $this->addSql('ALTER TABLE art DROP artist_id');
    }
}
