<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250416143051 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE car (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, brand VARCHAR(255) NOT NULL, year INT NOT NULL, image VARCHAR(255) DEFAULT NULL, price DOUBLE PRECISION NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE user_favorites (car_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(car_id, user_id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_E489ED11C3C6F69F ON user_favorites (car_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_E489ED11A76ED395 ON user_favorites (user_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE "user" (id SERIAL NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified BOOLEAN NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_favorites ADD CONSTRAINT FK_E489ED11C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_favorites ADD CONSTRAINT FK_E489ED11A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_favorites DROP CONSTRAINT FK_E489ED11C3C6F69F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_favorites DROP CONSTRAINT FK_E489ED11A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE car
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE user_favorites
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE "user"
        SQL);
    }
}
