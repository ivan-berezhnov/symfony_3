<?php declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180731190143 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE genus_note ADD genus_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE genus_note ADD CONSTRAINT FK_6478FCEC85C4074C FOREIGN KEY (genus_id) REFERENCES genus (id)');
        $this->addSql('CREATE INDEX IDX_6478FCEC85C4074C ON genus_note (genus_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE genus_note DROP FOREIGN KEY FK_6478FCEC85C4074C');
        $this->addSql('DROP INDEX IDX_6478FCEC85C4074C ON genus_note');
        $this->addSql('ALTER TABLE genus_note DROP genus_id');
    }
}
