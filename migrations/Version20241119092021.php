<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241119092021 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pokemon ADD type1_id INT NOT NULL, DROP type1');
        $this->addSql('ALTER TABLE pokemon ADD CONSTRAINT FK_62DC90F3BFAFA3E1 FOREIGN KEY (type1_id) REFERENCES type (id)');
        $this->addSql('CREATE INDEX IDX_62DC90F3BFAFA3E1 ON pokemon (type1_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pokemon DROP FOREIGN KEY FK_62DC90F3BFAFA3E1');
        $this->addSql('DROP INDEX IDX_62DC90F3BFAFA3E1 ON pokemon');
        $this->addSql('ALTER TABLE pokemon ADD type1 INT DEFAULT NULL, DROP type1_id');
    }
}
