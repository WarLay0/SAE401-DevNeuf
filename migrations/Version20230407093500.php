<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230407093500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE partie_utilisateur (id INT NOT NULL, utilisateur_id INT NOT NULL, INDEX IDX_87F5E0FBBF396750 (id), INDEX IDX_87F5E0FBFB88E14F (utilisateur_id), PRIMARY KEY(id, utilisateur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE partie_utilisateur ADD CONSTRAINT FK_87F5E0FBBF396750 FOREIGN KEY (id) REFERENCES partie (id)');
        $this->addSql('ALTER TABLE partie_utilisateur ADD CONSTRAINT FK_87F5E0FBFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (utilisateur_id)');
        $this->addSql('ALTER TABLE mot ADD mot_en VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE mot_partie ADD partie_id INT DEFAULT NULL, ADD mot_id INT DEFAULT NULL, ADD mp_trouve VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE mot_partie ADD CONSTRAINT FK_D971169E075F7A4 FOREIGN KEY (partie_id) REFERENCES partie (id)');
        $this->addSql('ALTER TABLE mot_partie ADD CONSTRAINT FK_D97116963977652 FOREIGN KEY (mot_id) REFERENCES mot (id)');
        $this->addSql('CREATE INDEX IDX_D971169E075F7A4 ON mot_partie (partie_id)');
        $this->addSql('CREATE INDEX IDX_D97116963977652 ON mot_partie (mot_id)');
        $this->addSql('ALTER TABLE partie DROP partie_joueur1, DROP partie_joueur2');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE partie_utilisateur DROP FOREIGN KEY FK_87F5E0FBBF396750');
        $this->addSql('ALTER TABLE partie_utilisateur DROP FOREIGN KEY FK_87F5E0FBFB88E14F');
        $this->addSql('DROP TABLE partie_utilisateur');
        $this->addSql('ALTER TABLE partie ADD partie_joueur1 VARCHAR(255) NOT NULL, ADD partie_joueur2 VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE mot_partie DROP FOREIGN KEY FK_D971169E075F7A4');
        $this->addSql('ALTER TABLE mot_partie DROP FOREIGN KEY FK_D97116963977652');
        $this->addSql('DROP INDEX IDX_D971169E075F7A4 ON mot_partie');
        $this->addSql('DROP INDEX IDX_D97116963977652 ON mot_partie');
        $this->addSql('ALTER TABLE mot_partie DROP partie_id, DROP mot_id, DROP mp_trouve');
        $this->addSql('ALTER TABLE mot DROP mot_en');
    }
}
