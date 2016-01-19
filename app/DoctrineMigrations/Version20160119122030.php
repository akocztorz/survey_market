<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160119122030 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE question_definition (id INT AUTO_INCREMENT NOT NULL, poll_definition_id INT DEFAULT NULL, position INT NOT NULL, question LONGTEXT NOT NULL, inactivated TINYINT(1) DEFAULT NULL, definition_type VARCHAR(255) NOT NULL, max_choices INT DEFAULT NULL, INDEX IDX_FE4B0502D491D6E (poll_definition_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offer (id INT AUTO_INCREMENT NOT NULL, poll_definition_id INT DEFAULT NULL, offer_name LONGTEXT NOT NULL, quantity INT NOT NULL, min_quantity INT NOT NULL, price NUMERIC(4, 2) NOT NULL, due_date DATETIME NOT NULL, sealed TINYINT(1) NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, inactivated TINYINT(1) DEFAULT NULL, INDEX IDX_29D6873E2D491D6E (poll_definition_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE option_definition (id INT AUTO_INCREMENT NOT NULL, question_definition_open_id INT DEFAULT NULL, question_definition_choice_id INT DEFAULT NULL, response LONGTEXT NOT NULL, free_text TINYINT(1) NOT NULL, response_type VARCHAR(255) NOT NULL, INDEX IDX_855937E8F60519C2 (question_definition_open_id), INDEX IDX_855937E8D4B8DA6B (question_definition_choice_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE poll (id INT AUTO_INCREMENT NOT NULL, poll_definition_id INT DEFAULT NULL, deal_id INT DEFAULT NULL, completed TINYINT(1) DEFAULT NULL, last_answered_question INT NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, INDEX IDX_84BCFA452D491D6E (poll_definition_id), INDEX IDX_84BCFA45F60E2305 (deal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fos_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, username_canonical VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, email_canonical VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, locked TINYINT(1) NOT NULL, expired TINYINT(1) NOT NULL, expires_at DATETIME DEFAULT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', credentials_expired TINYINT(1) NOT NULL, credentials_expire_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_957A647992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_957A6479A0D96FBF (email_canonical), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE poll_definition (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, inactivated TINYINT(1) DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE deal (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, offer_id INT DEFAULT NULL, quantity INT NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, INDEX IDX_E3FEC116A76ED395 (user_id), INDEX IDX_E3FEC11653C674EE (offer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE answer (id INT AUTO_INCREMENT NOT NULL, poll_id INT DEFAULT NULL, option_definition_id INT DEFAULT NULL, checked TINYINT(1) DEFAULT NULL, free_text LONGTEXT DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, INDEX IDX_DADD4A253C947C0F (poll_id), INDEX IDX_DADD4A2543000DC9 (option_definition_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE question_definition ADD CONSTRAINT FK_FE4B0502D491D6E FOREIGN KEY (poll_definition_id) REFERENCES poll_definition (id)');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E2D491D6E FOREIGN KEY (poll_definition_id) REFERENCES poll_definition (id)');
        $this->addSql('ALTER TABLE option_definition ADD CONSTRAINT FK_855937E8F60519C2 FOREIGN KEY (question_definition_open_id) REFERENCES question_definition (id)');
        $this->addSql('ALTER TABLE option_definition ADD CONSTRAINT FK_855937E8D4B8DA6B FOREIGN KEY (question_definition_choice_id) REFERENCES question_definition (id)');
        $this->addSql('ALTER TABLE poll ADD CONSTRAINT FK_84BCFA452D491D6E FOREIGN KEY (poll_definition_id) REFERENCES poll_definition (id)');
        $this->addSql('ALTER TABLE poll ADD CONSTRAINT FK_84BCFA45F60E2305 FOREIGN KEY (deal_id) REFERENCES deal (id)');
        $this->addSql('ALTER TABLE deal ADD CONSTRAINT FK_E3FEC116A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE deal ADD CONSTRAINT FK_E3FEC11653C674EE FOREIGN KEY (offer_id) REFERENCES offer (id)');
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
        $this->addSql('ALTER TABLE deal DROP FOREIGN KEY FK_E3FEC11653C674EE');
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A2543000DC9');
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A253C947C0F');
        $this->addSql('ALTER TABLE deal DROP FOREIGN KEY FK_E3FEC116A76ED395');
        $this->addSql('ALTER TABLE question_definition DROP FOREIGN KEY FK_FE4B0502D491D6E');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873E2D491D6E');
        $this->addSql('ALTER TABLE poll DROP FOREIGN KEY FK_84BCFA452D491D6E');
        $this->addSql('ALTER TABLE poll DROP FOREIGN KEY FK_84BCFA45F60E2305');
        $this->addSql('DROP TABLE question_definition');
        $this->addSql('DROP TABLE offer');
        $this->addSql('DROP TABLE option_definition');
        $this->addSql('DROP TABLE poll');
        $this->addSql('DROP TABLE fos_user');
        $this->addSql('DROP TABLE poll_definition');
        $this->addSql('DROP TABLE deal');
        $this->addSql('DROP TABLE answer');
    }
}
