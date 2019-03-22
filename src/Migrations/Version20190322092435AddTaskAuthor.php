<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190322092435AddTaskAuthor extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE task ADD COLUMN author INT NOT NULL DEFAULT 4');
        $this->addSql(
            'ALTER TABLE task ADD CONSTRAINT FK_527EDB25F675F31B FOREIGN KEY (author) REFERENCES user (id)'
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE task DROP COLUMN author');
    }
}
