<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241119101021 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__question AS SELECT id, prompt, answer, options, id_user, total_count, right_count FROM question');
        $this->addSql('DROP TABLE question');
        $this->addSql('CREATE TABLE question (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, prompt VARCHAR(255) NOT NULL, answer VARCHAR(255) NOT NULL, option1 VARCHAR(255) NOT NULL, id_user INTEGER NOT NULL, total_count INTEGER NOT NULL, right_count INTEGER NOT NULL, option2 VARCHAR(255) DEFAULT NULL, option3 VARCHAR(255) DEFAULT NULL, option4 VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO question (id, prompt, answer, option1, id_user, total_count, right_count) SELECT id, prompt, answer, options, id_user, total_count, right_count FROM __temp__question');
        $this->addSql('DROP TABLE __temp__question');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__question AS SELECT id, prompt, answer, option1, id_user, total_count, right_count FROM question');
        $this->addSql('DROP TABLE question');
        $this->addSql('CREATE TABLE question (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, prompt VARCHAR(255) NOT NULL, answer VARCHAR(255) NOT NULL, options VARCHAR(255) NOT NULL, id_user INTEGER NOT NULL, total_count INTEGER NOT NULL, right_count INTEGER NOT NULL)');
        $this->addSql('INSERT INTO question (id, prompt, answer, options, id_user, total_count, right_count) SELECT id, prompt, answer, option1, id_user, total_count, right_count FROM __temp__question');
        $this->addSql('DROP TABLE __temp__question');
    }
}
