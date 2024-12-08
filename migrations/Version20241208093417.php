<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241208093417 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pokemon CHANGE name name VARCHAR(50) DEFAULT NULL, CHANGE sprite sprite VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE question CHANGE option2 option2 VARCHAR(255) DEFAULT NULL, CHANGE option3 option3 VARCHAR(255) DEFAULT NULL, CHANGE option4 option4 VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE type CHANGE sprite sprite VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE pokemon CHANGE name name VARCHAR(50) DEFAULT \'NULL\', CHANGE sprite sprite VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE question CHANGE option2 option2 VARCHAR(255) DEFAULT \'NULL\', CHANGE option3 option3 VARCHAR(255) DEFAULT \'NULL\', CHANGE option4 option4 VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE type CHANGE sprite sprite VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`');
    }
}
