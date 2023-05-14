<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230327215825 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE intensity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE hobby ADD intensity_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE hobby ADD CONSTRAINT FK_3964F33791A55F57 FOREIGN KEY (intensity_id) REFERENCES intensity (id)');
        $this->addSql('CREATE INDEX IDX_3964F33791A55F57 ON hobby (intensity_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hobby DROP FOREIGN KEY FK_3964F33791A55F57');
        $this->addSql('DROP TABLE intensity');
        $this->addSql('DROP INDEX IDX_3964F33791A55F57 ON hobby');
        $this->addSql('ALTER TABLE hobby DROP intensity_id');
    }
}
