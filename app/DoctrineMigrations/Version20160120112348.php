<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160120112348 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE poll_definition ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE poll_definition ADD CONSTRAINT FK_D22BCEF4A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)');
        $this->addSql('CREATE INDEX IDX_D22BCEF4A76ED395 ON poll_definition (user_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE poll_definition DROP FOREIGN KEY FK_D22BCEF4A76ED395');
        $this->addSql('DROP INDEX IDX_D22BCEF4A76ED395 ON poll_definition');
        $this->addSql('ALTER TABLE poll_definition DROP user_id');
    }
}
