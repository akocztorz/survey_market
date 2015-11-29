<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151129230910 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE question_definition (id INT AUTO_INCREMENT NOT NULL, poll_definition_id INT DEFAULT NULL, question LONGTEXT NOT NULL, definition_type VARCHAR(255) NOT NULL, max_choices INT DEFAULT NULL, INDEX IDX_FE4B0502D491D6E (poll_definition_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offer (id INT AUTO_INCREMENT NOT NULL, poll_definition_id INT DEFAULT NULL, offer_name LONGTEXT NOT NULL, quantity INT NOT NULL, min_quantity INT NOT NULL, price NUMERIC(4, 2) NOT NULL, due_date DATETIME NOT NULL, sealed TINYINT(1) NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, INDEX IDX_29D6873E2D491D6E (poll_definition_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE option_definition (id INT AUTO_INCREMENT NOT NULL, question_definition_open_id INT DEFAULT NULL, question_definition_choice_id INT DEFAULT NULL, response LONGTEXT NOT NULL, free_text TINYINT(1) NOT NULL, response_type VARCHAR(255) NOT NULL, INDEX IDX_855937E8F60519C2 (question_definition_open_id), INDEX IDX_855937E8D4B8DA6B (question_definition_choice_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE poll (id INT AUTO_INCREMENT NOT NULL, poll_definition_id INT DEFAULT NULL, INDEX IDX_84BCFA452D491D6E (poll_definition_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE poll_definition (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE answer (id INT AUTO_INCREMENT NOT NULL, poll_id INT DEFAULT NULL, option_definition_id INT DEFAULT NULL, INDEX IDX_DADD4A253C947C0F (poll_id), INDEX IDX_DADD4A2543000DC9 (option_definition_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE question_definition ADD CONSTRAINT FK_FE4B0502D491D6E FOREIGN KEY (poll_definition_id) REFERENCES poll_definition (id)');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E2D491D6E FOREIGN KEY (poll_definition_id) REFERENCES poll_definition (id)');
        $this->addSql('ALTER TABLE option_definition ADD CONSTRAINT FK_855937E8F60519C2 FOREIGN KEY (question_definition_open_id) REFERENCES question_definition (id)');
        $this->addSql('ALTER TABLE option_definition ADD CONSTRAINT FK_855937E8D4B8DA6B FOREIGN KEY (question_definition_choice_id) REFERENCES question_definition (id)');
        $this->addSql('ALTER TABLE poll ADD CONSTRAINT FK_84BCFA452D491D6E FOREIGN KEY (poll_definition_id) REFERENCES poll_definition (id)');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A253C947C0F FOREIGN KEY (poll_id) REFERENCES poll (id)');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A2543000DC9 FOREIGN KEY (option_definition_id) REFERENCES option_definition (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE option_definition DROP FOREIGN KEY FK_855937E8F60519C2');
        $this->addSql('ALTER TABLE option_definition DROP FOREIGN KEY FK_855937E8D4B8DA6B');
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A2543000DC9');
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A253C947C0F');
        $this->addSql('ALTER TABLE question_definition DROP FOREIGN KEY FK_FE4B0502D491D6E');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873E2D491D6E');
        $this->addSql('ALTER TABLE poll DROP FOREIGN KEY FK_84BCFA452D491D6E');
        $this->addSql('DROP TABLE question_definition');
        $this->addSql('DROP TABLE offer');
        $this->addSql('DROP TABLE option_definition');
        $this->addSql('DROP TABLE poll');
        $this->addSql('DROP TABLE poll_definition');
        $this->addSql('DROP TABLE answer');
    }
}
