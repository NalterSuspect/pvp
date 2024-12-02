<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241202075827 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pokemon (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type1_id INTEGER NOT NULL, type2_id INTEGER DEFAULT NULL, name VARCHAR(50) DEFAULT NULL, sprite VARCHAR(255) DEFAULT NULL, price INTEGER DEFAULT NULL, evolution_tier INTEGER DEFAULT NULL, gen INTEGER DEFAULT NULL, CONSTRAINT FK_62DC90F3BFAFA3E1 FOREIGN KEY (type1_id) REFERENCES type (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_62DC90F3AD1A0C0F FOREIGN KEY (type2_id) REFERENCES type (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_62DC90F3BFAFA3E1 ON pokemon (type1_id)');
        $this->addSql('CREATE INDEX IDX_62DC90F3AD1A0C0F ON pokemon (type2_id)');
        $this->addSql('CREATE TABLE question (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, prompt VARCHAR(255) NOT NULL, answer VARCHAR(255) NOT NULL, option1 VARCHAR(255) NOT NULL, option2 VARCHAR(255) DEFAULT NULL, option3 VARCHAR(255) DEFAULT NULL, option4 VARCHAR(255) DEFAULT NULL, id_user INTEGER NOT NULL, total_count INTEGER NOT NULL, right_count INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE type (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(30) NOT NULL, sprite VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, money INTEGER NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
        $this->addSql('CREATE TABLE winrate (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_user INTEGER NOT NULL, type_question VARCHAR(255) NOT NULL, correct_answer INTEGER NOT NULL, total_answers INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE pokemon');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE winrate');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
