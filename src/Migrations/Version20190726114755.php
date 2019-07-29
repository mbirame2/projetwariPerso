<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190726114755 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE partenaire (id INT AUTO_INCREMENT NOT NULL, raison_social LONGTEXT NOT NULL, ninea INT NOT NULL, adresse VARCHAR(255) NOT NULL, numero_compte BIGINT NOT NULL, solde BIGINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE versement (id INT AUTO_INCREMENT NOT NULL, partenaire_id INT NOT NULL, montant BIGINT NOT NULL, date_versement DATETIME NOT NULL, INDEX IDX_716E936798DE13AC (partenaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom_complet VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, proprietaire VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE versement ADD CONSTRAINT FK_716E936798DE13AC FOREIGN KEY (partenaire_id) REFERENCES partenaire (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE versement DROP FOREIGN KEY FK_716E936798DE13AC');
        $this->addSql('DROP TABLE partenaire');
        $this->addSql('DROP TABLE versement');
        $this->addSql('DROP TABLE user');
    }
}
