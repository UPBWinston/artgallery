<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230513141744 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sale_event (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sale_event_entry (id INT AUTO_INCREMENT NOT NULL, sale_event_id INT NOT NULL, art_id INT NOT NULL, INDEX IDX_1B76FD316F830421 (sale_event_id), INDEX IDX_1B76FD318C25E51A (art_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sale_events (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sale_event_entry ADD CONSTRAINT FK_1B76FD316F830421 FOREIGN KEY (sale_event_id) REFERENCES sale_event (id)');
        $this->addSql('ALTER TABLE sale_event_entry ADD CONSTRAINT FK_1B76FD318C25E51A FOREIGN KEY (art_id) REFERENCES art (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sale_event_entry DROP FOREIGN KEY FK_1B76FD316F830421');
        $this->addSql('ALTER TABLE sale_event_entry DROP FOREIGN KEY FK_1B76FD318C25E51A');
        $this->addSql('DROP TABLE sale_event');
        $this->addSql('DROP TABLE sale_event_entry');
        $this->addSql('DROP TABLE sale_events');
    }
}
