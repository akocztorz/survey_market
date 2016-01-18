<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160118103124 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE poll ADD deal_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE poll ADD CONSTRAINT FK_84BCFA45F60E2305 FOREIGN KEY (deal_id) REFERENCES deal (id)');
        $this->addSql('CREATE INDEX IDX_84BCFA45F60E2305 ON poll (deal_id)');
        $this->addSql('ALTER TABLE deal DROP FOREIGN KEY FK_E3FEC1163C947C0F');
        $this->addSql('DROP INDEX IDX_E3FEC1163C947C0F ON deal');
        $this->addSql('ALTER TABLE deal DROP poll_id');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE deal ADD poll_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE deal ADD CONSTRAINT FK_E3FEC1163C947C0F FOREIGN KEY (poll_id) REFERENCES poll (id)');
        $this->addSql('CREATE INDEX IDX_E3FEC1163C947C0F ON deal (poll_id)');
        $this->addSql('ALTER TABLE poll DROP FOREIGN KEY FK_84BCFA45F60E2305');
        $this->addSql('DROP INDEX IDX_84BCFA45F60E2305 ON poll');
        $this->addSql('ALTER TABLE poll DROP deal_id');
    }
}
