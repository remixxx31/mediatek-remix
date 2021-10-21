<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211021125519 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book ADD holder_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A331DEEE62D0 FOREIGN KEY (holder_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_CBE5A331DEEE62D0 ON book (holder_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6497DD8AC20');
        $this->addSql('DROP INDEX IDX_8D93D6497DD8AC20 ON user');
        $this->addSql('ALTER TABLE user DROP books_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A331DEEE62D0');
        $this->addSql('DROP INDEX IDX_CBE5A331DEEE62D0 ON book');
        $this->addSql('ALTER TABLE book DROP holder_id');
        $this->addSql('ALTER TABLE user ADD books_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6497DD8AC20 FOREIGN KEY (books_id) REFERENCES book (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_8D93D6497DD8AC20 ON user (books_id)');
    }
}
