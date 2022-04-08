<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210814163606 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE matiere_classe_annee_scolair (id INT AUTO_INCREMENT NOT NULL, matiere_id INT DEFAULT NULL, classe_anneescolaire_id INT DEFAULT NULL, enseignant_id INT DEFAULT NULL, coefficient INT DEFAULT NULL, INDEX IDX_CC47BB7BF46CD258 (matiere_id), INDEX IDX_CC47BB7BFDAC98E7 (classe_anneescolaire_id), INDEX IDX_CC47BB7BE455FCC0 (enseignant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE matiere_classe_annee_scolair ADD CONSTRAINT FK_CC47BB7BF46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id)');
        $this->addSql('ALTER TABLE matiere_classe_annee_scolair ADD CONSTRAINT FK_CC47BB7BFDAC98E7 FOREIGN KEY (classe_anneescolaire_id) REFERENCES classe_annee_scolaire (id)');
        $this->addSql('ALTER TABLE matiere_classe_annee_scolair ADD CONSTRAINT FK_CC47BB7BE455FCC0 FOREIGN KEY (enseignant_id) REFERENCES enseignant (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE matiere_classe_annee_scolair');
    }
}
