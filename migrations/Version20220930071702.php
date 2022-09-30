<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Основная миграция
 */
final class Version20220930071702 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Основная миграция';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE author (id VARCHAR(36) NOT NULL, name VARCHAR(255) NOT NULL, birth_date DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', gender VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE book (id VARCHAR(36) NOT NULL, name VARCHAR(255) NOT NULL, issue_date DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', create_date DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', rating DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE book_author (book_id VARCHAR(36) NOT NULL, author_id VARCHAR(36) NOT NULL, INDEX IDX_9478D34516A2B381 (book_id), INDEX IDX_9478D345F675F31B (author_id), PRIMARY KEY(book_id, author_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE book_genre (book_id VARCHAR(36) NOT NULL, genre_id VARCHAR(36) NOT NULL, INDEX IDX_8D92268116A2B381 (book_id), INDEX IDX_8D9226814296D31F (genre_id), PRIMARY KEY(book_id, genre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genre (id VARCHAR(36) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE book_author ADD CONSTRAINT FK_9478D34516A2B381 FOREIGN KEY (book_id) REFERENCES book (id)');
        $this->addSql('ALTER TABLE book_author ADD CONSTRAINT FK_9478D345F675F31B FOREIGN KEY (author_id) REFERENCES author (id)');
        $this->addSql('ALTER TABLE book_genre ADD CONSTRAINT FK_8D92268116A2B381 FOREIGN KEY (book_id) REFERENCES book (id)');
        $this->addSql('ALTER TABLE book_genre ADD CONSTRAINT FK_8D9226814296D31F FOREIGN KEY (genre_id) REFERENCES genre (id)');

    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE `book_genre`');
        $this->addSql('DROP TABLE `book_author`');
        $this->addSql('DROP TABLE `genre`');
        $this->addSql('DROP TABLE `author`');
        $this->addSql('DROP TABLE `book`');
    }
}
