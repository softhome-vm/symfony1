<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\Migrations\AbstractMigration;

final class Version20261027070000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creates the movie table and adds the films required by the assignment.';
    }

    public function up(\Doctrine\DBAL\Schema\Schema $schema): void
    {
        $this->addSql('CREATE TABLE movie (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, year INT NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql("INSERT INTO movie (title, year, description) VALUES ('Inception', 2010, 'Тестовое описание фильма Inception.')");
        $this->addSql("INSERT INTO movie (title, year, description) VALUES ('Interstellar', 2014, 'Тестовое описание фильма Interstellar.')");
        $this->addSql("INSERT INTO movie (title, year, description) VALUES ('The Matrix', 1999, 'Тестовое описание фильма The Matrix.')");
    }

    public function down(\Doctrine\DBAL\Schema\Schema $schema): void
    {
        $this->addSql('DROP TABLE movie');
    }
}
