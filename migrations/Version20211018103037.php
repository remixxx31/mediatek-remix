<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211018103037 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book ADD author_book_id INT DEFAULT NULL, ADD title VARCHAR(255) NOT NULL, ADD description LONGTEXT DEFAULT NULL, ADD year VARCHAR(4) DEFAULT NULL');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A33153982CC2 FOREIGN KEY (author_book_id) REFERENCES author (id)');
        $this->addSql('CREATE INDEX IDX_CBE5A33153982CC2 ON book (author_book_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A33153982CC2');
        $this->addSql('DROP INDEX IDX_CBE5A33153982CC2 ON book');
        $this->addSql('ALTER TABLE book DROP author_book_id, DROP title, DROP description, DROP year');
    }
}
