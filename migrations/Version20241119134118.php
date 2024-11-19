<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241119134118 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pokemon DROP INDEX UNIQ_62DC90F3BFAFA3E1, ADD INDEX IDX_62DC90F3BFAFA3E1 (type1_id)');
        $this->addSql('ALTER TABLE pokemon DROP INDEX UNIQ_62DC90F3AD1A0C0F, ADD INDEX IDX_62DC90F3AD1A0C0F (type2_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pokemon DROP INDEX IDX_62DC90F3BFAFA3E1, ADD UNIQUE INDEX UNIQ_62DC90F3BFAFA3E1 (type1_id)');
        $this->addSql('ALTER TABLE pokemon DROP INDEX IDX_62DC90F3AD1A0C0F, ADD UNIQUE INDEX UNIQ_62DC90F3AD1A0C0F (type2_id)');
    }
}
