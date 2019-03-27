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
        $this->addSql("ALTER TABLE task ADD COLUMN author INT");
        $this->addSql(
            "UPDATE task SET author = (SELECT id FROM user WHERE roles LIKE '%ROLE_ANONYMOUS_USER%' LIMIT 1) WHERE task.author IS NULL;"
        );
        $this->addSql("ALTER TABLE task ADD CONSTRAINT author foreign key (author) references user (id)");
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE task DROP CONSTRAINT author');
        $this->addSql('ALTER TABLE task DROP COLUMN author');
    }
}
