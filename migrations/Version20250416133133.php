<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250416133133 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE user_favorites DROP CONSTRAINT fk_e489ed11a76ed395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_favorites DROP CONSTRAINT fk_e489ed11c3c6f69f
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE user_favorites
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "user" DROP is_verified
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE user_favorites (user_id INT NOT NULL, car_id INT NOT NULL, PRIMARY KEY(user_id, car_id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX idx_e489ed11c3c6f69f ON user_favorites (car_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX idx_e489ed11a76ed395 ON user_favorites (user_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_favorites ADD CONSTRAINT fk_e489ed11a76ed395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_favorites ADD CONSTRAINT fk_e489ed11c3c6f69f FOREIGN KEY (car_id) REFERENCES car (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "user" ADD is_verified BOOLEAN NOT NULL
        SQL);
    }
}
