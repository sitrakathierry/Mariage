<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230211130054 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE albums ADD id_mariage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE albums ADD CONSTRAINT FK_F4E2474FA41801EC FOREIGN KEY (id_mariage_id) REFERENCES mariage (id)');
        $this->addSql('CREATE INDEX IDX_F4E2474FA41801EC ON albums (id_mariage_id)');
        $this->addSql('ALTER TABLE categories ADD id_type_offre INT NOT NULL, ADD id_prix INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE albums DROP FOREIGN KEY FK_F4E2474FA41801EC');
        $this->addSql('DROP INDEX IDX_F4E2474FA41801EC ON albums');
        $this->addSql('ALTER TABLE albums DROP id_mariage_id');
        $this->addSql('ALTER TABLE categories DROP id_type_offre, DROP id_prix');
    }
}
