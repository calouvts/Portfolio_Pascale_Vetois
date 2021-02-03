<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210203212058 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE realisation (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, realisationphoto VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, projectlink VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE realisation_competence (realisation_id INT NOT NULL, competence_id INT NOT NULL, INDEX IDX_27EF2245B685E551 (realisation_id), INDEX IDX_27EF224515761DAB (competence_id), PRIMARY KEY(realisation_id, competence_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE realisation_competence ADD CONSTRAINT FK_27EF2245B685E551 FOREIGN KEY (realisation_id) REFERENCES realisation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE realisation_competence ADD CONSTRAINT FK_27EF224515761DAB FOREIGN KEY (competence_id) REFERENCES competence (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE realisation_competence DROP FOREIGN KEY FK_27EF2245B685E551');
        $this->addSql('DROP TABLE realisation');
        $this->addSql('DROP TABLE realisation_competence');
    }
}
