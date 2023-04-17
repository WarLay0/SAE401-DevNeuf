<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230416134957 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mot (id INT AUTO_INCREMENT NOT NULL, mot VARCHAR(255) NOT NULL, mot_en VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mot_partie (id INT AUTO_INCREMENT NOT NULL, partie_id INT DEFAULT NULL, mot_id INT DEFAULT NULL, mp_emplacement VARCHAR(255) NOT NULL, mp_couleur_j1 VARCHAR(255) NOT NULL, mp_couleur_j2 VARCHAR(255) NOT NULL, mp_trouve VARCHAR(255) DEFAULT NULL, mp_jeton1 VARCHAR(255) DEFAULT NULL, mp_jeton2 VARCHAR(255) DEFAULT NULL, INDEX IDX_D971169E075F7A4 (partie_id), INDEX IDX_D97116963977652 (mot_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partie (id INT AUTO_INCREMENT NOT NULL, partie_etat VARCHAR(255) NOT NULL, partie_nbtour INT NOT NULL, partie_joueur_tour VARCHAR(255) NOT NULL, partie_victoire VARCHAR(255) NOT NULL, nom_partie VARCHAR(255) NOT NULL, partie_type TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partie_utilisateur (id INT NOT NULL, utilisateur_id INT NOT NULL, INDEX IDX_87F5E0FBBF396750 (id), INDEX IDX_87F5E0FBFB88E14F (utilisateur_id), PRIMARY KEY(id, utilisateur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AFB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stats (id INT AUTO_INCREMENT NOT NULL, parties_gagnees INT DEFAULT NULL, parties_perdues INT DEFAULT NULL, parties_jouees INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (utilisateur_id INT AUTO_INCREMENT NOT NULL, utilisateur_email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, utilisateur_created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', utilisateur_pseudo VARCHAR(255) NOT NULL, token_registration VARCHAR(255) DEFAULT NULL, token_registration_life_time DATETIME NOT NULL, is_verified TINYINT(1) NOT NULL, avatar VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1D1C63B3215724AA (utilisateur_email), PRIMARY KEY(utilisateur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vshistory (id INT AUTO_INCREMENT NOT NULL, nom_adversaire VARCHAR(255) NOT NULL, nb_vs INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mot_partie ADD CONSTRAINT FK_D971169E075F7A4 FOREIGN KEY (partie_id) REFERENCES partie (id)');
        $this->addSql('ALTER TABLE mot_partie ADD CONSTRAINT FK_D97116963977652 FOREIGN KEY (mot_id) REFERENCES mot (id)');
        $this->addSql('ALTER TABLE partie_utilisateur ADD CONSTRAINT FK_87F5E0FBBF396750 FOREIGN KEY (id) REFERENCES partie (id)');
        $this->addSql('ALTER TABLE partie_utilisateur ADD CONSTRAINT FK_87F5E0FBFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (utilisateur_id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (utilisateur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mot_partie DROP FOREIGN KEY FK_D971169E075F7A4');
        $this->addSql('ALTER TABLE mot_partie DROP FOREIGN KEY FK_D97116963977652');
        $this->addSql('ALTER TABLE partie_utilisateur DROP FOREIGN KEY FK_87F5E0FBBF396750');
        $this->addSql('ALTER TABLE partie_utilisateur DROP FOREIGN KEY FK_87F5E0FBFB88E14F');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AFB88E14F');
        $this->addSql('DROP TABLE mot');
        $this->addSql('DROP TABLE mot_partie');
        $this->addSql('DROP TABLE partie');
        $this->addSql('DROP TABLE partie_utilisateur');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE stats');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE vshistory');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
