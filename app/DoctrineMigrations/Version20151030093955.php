<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151030093955 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE question_definition ADD poll_definition_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE question_definition ADD CONSTRAINT FK_FE4B0502D491D6E FOREIGN KEY (poll_definition_id) REFERENCES poll_definition (id)');
        $this->addSql('CREATE INDEX IDX_FE4B0502D491D6E ON question_definition (poll_definition_id)');
        $this->addSql('ALTER TABLE option_definition ADD question_definition_id INT DEFAULT NULL, ADD question_definition_open_id INT DEFAULT NULL, ADD question_definition_choice_id INT DEFAULT NULL, ADD response_type VARCHAR(255) NOT NULL, CHANGE response response LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE option_definition ADD CONSTRAINT FK_855937E8495F6356 FOREIGN KEY (question_definition_id) REFERENCES question_definition (id)');
        $this->addSql('ALTER TABLE option_definition ADD CONSTRAINT FK_855937E8F60519C2 FOREIGN KEY (question_definition_open_id) REFERENCES question_definition (id)');
        $this->addSql('ALTER TABLE option_definition ADD CONSTRAINT FK_855937E8D4B8DA6B FOREIGN KEY (question_definition_choice_id) REFERENCES question_definition (id)');
        $this->addSql('CREATE INDEX IDX_855937E8495F6356 ON option_definition (question_definition_id)');
        $this->addSql('CREATE INDEX IDX_855937E8F60519C2 ON option_definition (question_definition_open_id)');
        $this->addSql('CREATE INDEX IDX_855937E8D4B8DA6B ON option_definition (question_definition_choice_id)');
        $this->addSql('ALTER TABLE poll ADD poll_definition_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE poll ADD CONSTRAINT FK_84BCFA452D491D6E FOREIGN KEY (poll_definition_id) REFERENCES poll_definition (id)');
        $this->addSql('CREATE INDEX IDX_84BCFA452D491D6E ON poll (poll_definition_id)');
        $this->addSql('ALTER TABLE answer ADD poll_id INT DEFAULT NULL, ADD option_definition_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A253C947C0F FOREIGN KEY (poll_id) REFERENCES poll (id)');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A2543000DC9 FOREIGN KEY (option_definition_id) REFERENCES option_definition (id)');
        $this->addSql('CREATE INDEX IDX_DADD4A253C947C0F ON answer (poll_id)');
        $this->addSql('CREATE INDEX IDX_DADD4A2543000DC9 ON answer (option_definition_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A253C947C0F');
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A2543000DC9');
        $this->addSql('DROP INDEX IDX_DADD4A253C947C0F ON answer');
        $this->addSql('DROP INDEX IDX_DADD4A2543000DC9 ON answer');
        $this->addSql('ALTER TABLE answer DROP poll_id, DROP option_definition_id');
        $this->addSql('ALTER TABLE option_definition DROP FOREIGN KEY FK_855937E8495F6356');
        $this->addSql('ALTER TABLE option_definition DROP FOREIGN KEY FK_855937E8F60519C2');
        $this->addSql('ALTER TABLE option_definition DROP FOREIGN KEY FK_855937E8D4B8DA6B');
        $this->addSql('DROP INDEX IDX_855937E8495F6356 ON option_definition');
        $this->addSql('DROP INDEX IDX_855937E8F60519C2 ON option_definition');
        $this->addSql('DROP INDEX IDX_855937E8D4B8DA6B ON option_definition');
        $this->addSql('ALTER TABLE option_definition DROP question_definition_id, DROP question_definition_open_id, DROP question_definition_choice_id, DROP response_type, CHANGE response response VARCHAR(1000) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE poll DROP FOREIGN KEY FK_84BCFA452D491D6E');
        $this->addSql('DROP INDEX IDX_84BCFA452D491D6E ON poll');
        $this->addSql('ALTER TABLE poll DROP poll_definition_id');
        $this->addSql('ALTER TABLE question_definition DROP FOREIGN KEY FK_FE4B0502D491D6E');
        $this->addSql('DROP INDEX IDX_FE4B0502D491D6E ON question_definition');
        $this->addSql('ALTER TABLE question_definition DROP poll_definition_id');
    }
}
