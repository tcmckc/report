<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231027130412 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gcp (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, share INTEGER DEFAULT NULL, pricingmodel VARCHAR(255) DEFAULT NULL, datacenter INTEGER DEFAULT NULL)');
        
        $this->addSql('CREATE TABLE share (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, aws INTEGER NOT NULL, azure INTEGER NOT NULL, gcp INTEGER NOT NULL)');
        $this->addSql("INSERT INTO share (aws, azure, gcp) VALUES (32, 22, 11)");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE gcp');
        $this->addSql('DROP TABLE share');
    }
}
