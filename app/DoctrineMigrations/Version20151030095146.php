<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151030095146 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE option_definition DROP FOREIGN KEY FK_855937E8495F6356');
        $this->addSql('DROP INDEX IDX_855937E8495F6356 ON option_definition');
        $this->addSql('ALTER TABLE option_definition DROP question_definition_id');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE option_definition ADD question_definition_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE option_definition ADD CONSTRAINT FK_855937E8495F6356 FOREIGN KEY (question_definition_id) REFERENCES question_definition (id)');
        $this->addSql('CREATE INDEX IDX_855937E8495F6356 ON option_definition (question_definition_id)');
    }
}
