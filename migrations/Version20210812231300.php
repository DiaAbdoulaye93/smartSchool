<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210812231300 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE matiere_classe_annee_scolaire DROP FOREIGN KEY FK_28C195557DEA6356');
        $this->addSql('ALTER TABLE matiere_classe_annee_scolaire DROP FOREIGN KEY FK_28C195559331C741');
        $this->addSql('DROP INDEX IDX_28C195557DEA6356 ON matiere_classe_annee_scolaire');
        $this->addSql('DROP INDEX IDX_28C195559331C741 ON matiere_classe_annee_scolaire');
        $this->addSql('ALTER TABLE matiere_classe_annee_scolaire DROP anneescolaire_id, DROP annee_scolaire_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE matiere_classe_annee_scolaire ADD anneescolaire_id INT DEFAULT NULL, ADD annee_scolaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE matiere_classe_annee_scolaire ADD CONSTRAINT FK_28C195557DEA6356 FOREIGN KEY (anneescolaire_id) REFERENCES classe_annee_scolaire (id)');
        $this->addSql('ALTER TABLE matiere_classe_annee_scolaire ADD CONSTRAINT FK_28C195559331C741 FOREIGN KEY (annee_scolaire_id) REFERENCES classe_annee_scolaire (id)');
        $this->addSql('CREATE INDEX IDX_28C195557DEA6356 ON matiere_classe_annee_scolaire (anneescolaire_id)');
        $this->addSql('CREATE INDEX IDX_28C195559331C741 ON matiere_classe_annee_scolaire (annee_scolaire_id)');
    }
}
