<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160115131903 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE deal (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, offer_id INT DEFAULT NULL, quantity INT NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, INDEX IDX_E3FEC116A76ED395 (user_id), INDEX IDX_E3FEC11653C674EE (offer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE deal ADD CONSTRAINT FK_E3FEC116A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE deal ADD CONSTRAINT FK_E3FEC11653C674EE FOREIGN KEY (offer_id) REFERENCES offer (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE deal');
    }
}
