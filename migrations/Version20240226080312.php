<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240226080312 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles JSON NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE commander DROP FOREIGN KEY commander_ibfk_1');
        $this->addSql('ALTER TABLE commander DROP FOREIGN KEY commander_ibfk_2');
        $this->addSql('ALTER TABLE commander DROP FOREIGN KEY commander_ibfk_3');
        $this->addSql('ALTER TABLE commander DROP FOREIGN KEY commander_ibfk_1');
        $this->addSql('ALTER TABLE commander DROP FOREIGN KEY commander_ibfk_2');
        $this->addSql('ALTER TABLE commander CHANGE Date_achat date_achat DATE NOT NULL, CHANGE Nbr_exemplaires nbr_exemplaires BIGINT NOT NULL');
        $this->addSql('ALTER TABLE commander ADD CONSTRAINT FK_42D318BA7A5143FB FOREIGN KEY (Id_Livre) REFERENCES livres (Id_Livre)');
        $this->addSql('ALTER TABLE commander ADD CONSTRAINT FK_42D318BAE3E87F1D FOREIGN KEY (Id_fournisseur) REFERENCES fournisseurs (Id_fournisseur)');
        $this->addSql('DROP INDEX id_livre ON commander');
        $this->addSql('CREATE INDEX IDX_42D318BA7A5143FB ON commander (Id_Livre)');
        $this->addSql('DROP INDEX id_fournisseur ON commander');
        $this->addSql('CREATE INDEX IDX_42D318BAE3E87F1D ON commander (Id_fournisseur)');
        $this->addSql('DROP INDEX idutilisateur ON commander');
        $this->addSql('CREATE INDEX IDX_42D318BA5D419CCB ON commander (idUtilisateur)');
        $this->addSql('ALTER TABLE commander ADD CONSTRAINT commander_ibfk_3 FOREIGN KEY (idUtilisateur) REFERENCES utilisateur (idUtilisateur)');
        $this->addSql('ALTER TABLE commander ADD CONSTRAINT commander_ibfk_1 FOREIGN KEY (Id_Livre) REFERENCES livres (Id_Livre) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commander ADD CONSTRAINT commander_ibfk_2 FOREIGN KEY (Id_fournisseur) REFERENCES fournisseurs (Id_fournisseur) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('DROP INDEX index_Code_fournisseur ON fournisseurs');
        $this->addSql('DROP INDEX index_Raison_sociale ON fournisseurs');
        $this->addSql('ALTER TABLE fournisseurs CHANGE Code_fournisseur code_fournisseur VARCHAR(50) NOT NULL, CHANGE Raison_sociale raison_sociale VARCHAR(50) NOT NULL, CHANGE Rue_fournisseur rue_fournisseur VARCHAR(100) DEFAULT NULL, CHANGE Code_postal code_postal VARCHAR(50) DEFAULT NULL, CHANGE Localite localite VARCHAR(100) DEFAULT NULL, CHANGE Pays pays VARCHAR(100) DEFAULT NULL, CHANGE Tel_fournisseur tel_fournisseur VARCHAR(50) DEFAULT NULL, CHANGE Url_fournisseur url_fournisseur VARCHAR(100) DEFAULT NULL, CHANGE Email_fournisseur email_fournisseur VARCHAR(50) DEFAULT NULL, CHANGE Fax_fournisseur fax_fournisseur VARCHAR(50) DEFAULT NULL');
        $this->addSql('DROP INDEX Index_Editeur ON livres');
        $this->addSql('DROP INDEX Index_Titre_livre ON livres');
        $this->addSql('DROP INDEX Index_Theme_livre ON livres');
        $this->addSql('DROP INDEX Index_Nom_auteur ON livres');
        $this->addSql('DROP INDEX Index_ISBN ON livres');
        $this->addSql('ALTER TABLE livres CHANGE Nbr_pages_livre nbr_pages_livre BIGINT NOT NULL, CHANGE Annee_edition annee_edition BIGINT NOT NULL');
        $this->addSql('DROP INDEX prenom ON utilisateur');
        $this->addSql('DROP INDEX age ON utilisateur');
        $this->addSql('DROP INDEX email ON utilisateur');
        $this->addSql('DROP INDEX nom ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur CHANGE age age BIGINT DEFAULT NULL, CHANGE Date date VARCHAR(20) NOT NULL, CHANGE Statut statut VARCHAR(50) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE commander DROP FOREIGN KEY FK_42D318BA7A5143FB');
        $this->addSql('ALTER TABLE commander DROP FOREIGN KEY FK_42D318BAE3E87F1D');
        $this->addSql('ALTER TABLE commander DROP FOREIGN KEY FK_42D318BA7A5143FB');
        $this->addSql('ALTER TABLE commander DROP FOREIGN KEY FK_42D318BAE3E87F1D');
        $this->addSql('ALTER TABLE commander DROP FOREIGN KEY FK_42D318BA5D419CCB');
        $this->addSql('ALTER TABLE commander CHANGE date_achat Date_achat DATE DEFAULT \'CURRENT_TIMESTAMP\' NOT NULL, CHANGE nbr_exemplaires Nbr_exemplaires INT NOT NULL');
        $this->addSql('ALTER TABLE commander ADD CONSTRAINT commander_ibfk_1 FOREIGN KEY (Id_Livre) REFERENCES livres (Id_Livre) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commander ADD CONSTRAINT commander_ibfk_2 FOREIGN KEY (Id_fournisseur) REFERENCES fournisseurs (Id_fournisseur) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('DROP INDEX idx_42d318bae3e87f1d ON commander');
        $this->addSql('CREATE INDEX Id_fournisseur ON commander (Id_fournisseur)');
        $this->addSql('DROP INDEX idx_42d318ba5d419ccb ON commander');
        $this->addSql('CREATE INDEX idUtilisateur ON commander (idUtilisateur)');
        $this->addSql('DROP INDEX idx_42d318ba7a5143fb ON commander');
        $this->addSql('CREATE INDEX Id_Livre ON commander (Id_Livre)');
        $this->addSql('ALTER TABLE commander ADD CONSTRAINT FK_42D318BA7A5143FB FOREIGN KEY (Id_Livre) REFERENCES livres (Id_Livre)');
        $this->addSql('ALTER TABLE commander ADD CONSTRAINT FK_42D318BAE3E87F1D FOREIGN KEY (Id_fournisseur) REFERENCES fournisseurs (Id_fournisseur)');
        $this->addSql('ALTER TABLE commander ADD CONSTRAINT FK_42D318BA5D419CCB FOREIGN KEY (idUtilisateur) REFERENCES utilisateur (idUtilisateur)');
        $this->addSql('ALTER TABLE fournisseurs CHANGE code_fournisseur Code_fournisseur VARCHAR(50) NOT NULL COMMENT \'Le code du fournisseur\', CHANGE raison_sociale Raison_sociale VARCHAR(50) NOT NULL COMMENT \'Nom de la compagnie du fournisseur\', CHANGE rue_fournisseur Rue_fournisseur VARCHAR(100) DEFAULT NULL COMMENT \'Rue du fournisseur\', CHANGE code_postal Code_postal VARCHAR(50) DEFAULT NULL COMMENT \'Code postal du fournisseur\', CHANGE localite Localite VARCHAR(100) DEFAULT NULL COMMENT \'Localité du fournisseur\', CHANGE pays Pays VARCHAR(100) DEFAULT NULL COMMENT \'Pays du fournisseur\', CHANGE tel_fournisseur Tel_fournisseur VARCHAR(50) DEFAULT NULL COMMENT \'téléphone du fournisseur\', CHANGE url_fournisseur Url_fournisseur VARCHAR(100) DEFAULT NULL COMMENT \'Adresse du site Web du fournisseur\', CHANGE email_fournisseur Email_fournisseur VARCHAR(50) DEFAULT NULL COMMENT \'Email du fournisseur\', CHANGE fax_fournisseur Fax_fournisseur VARCHAR(50) DEFAULT NULL COMMENT \'Fax du fournisseur\'');
        $this->addSql('CREATE INDEX index_Code_fournisseur ON fournisseurs (Code_fournisseur(10))');
        $this->addSql('CREATE INDEX index_Raison_sociale ON fournisseurs (Raison_sociale(10))');
        $this->addSql('ALTER TABLE livres CHANGE nbr_pages_livre Nbr_pages_livre INT NOT NULL, CHANGE annee_edition Annee_edition INT NOT NULL');
        $this->addSql('CREATE INDEX Index_Editeur ON livres (Editeur(10))');
        $this->addSql('CREATE INDEX Index_Titre_livre ON livres (Titre_livre(10))');
        $this->addSql('CREATE INDEX Index_Theme_livre ON livres (Theme_livre(10))');
        $this->addSql('CREATE INDEX Index_Nom_auteur ON livres (Nom_auteur(10))');
        $this->addSql('CREATE INDEX Index_ISBN ON livres (ISBN(10))');
        $this->addSql('ALTER TABLE utilisateur CHANGE age age INT DEFAULT NULL, CHANGE date Date DATE DEFAULT \'CURRENT_TIMESTAMP\' NOT NULL, CHANGE statut Statut VARCHAR(50) DEFAULT \'Utilisateur\'');
        $this->addSql('CREATE INDEX prenom ON utilisateur (prenom(10))');
        $this->addSql('CREATE INDEX age ON utilisateur (age)');
        $this->addSql('CREATE INDEX email ON utilisateur (email)');
        $this->addSql('CREATE INDEX nom ON utilisateur (nom(10))');
    }
}
