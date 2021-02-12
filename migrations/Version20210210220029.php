<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210210220029 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE exercise ADD create_at TIMESTAMP(0) WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE exercise ADD update_at TIMESTAMP(0) WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE exercise ADD deleted_at TIMESTAMP(0) WITH TIME ZONE DEFAULT NULL');

        $this->addSql('ALTER TABLE nutrition ADD create_at TIMESTAMP(0) WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE nutrition ADD update_at TIMESTAMP(0) WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE nutrition ADD deleted_at TIMESTAMP(0) WITH TIME ZONE DEFAULT NULL');

        $this->addSql('CREATE TABLE training_nutrition (id SERIAL NOT NULL, training_id INT NOT NULL, nutrition_id INT NOT NULL, week_day SMALLINT DEFAULT NULL)');
        $this->addSql('ALTER TABLE training_nutrition ADD CONSTRAINT FK_59F12DEEE934951B FOREIGN KEY (training_id) REFERENCES training (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE training_nutrition ADD CONSTRAINT FK_59F12DEEE934951C FOREIGN KEY (nutrition_id) REFERENCES nutrition (id) NOT DEFERRABLE INITIALLY IMMEDIATE');

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE training_nutrition DROP CONSTRAINT FK_59F12DEEE934951B');
        $this->addSql('ALTER TABLE training_nutrition DROP CONSTRAINT FK_59F12DEEE934951C');
        $this->addSql('DROP TABLE training_nutrition');

        $this->addSql('ALTER TABLE exercise DROP create_at');
        $this->addSql('ALTER TABLE exercise DROP update_at');
        $this->addSql('ALTER TABLE exercise DROP deleted_at');

        $this->addSql('ALTER TABLE nutrition DROP create_at');
        $this->addSql('ALTER TABLE nutrition DROP update_at');
        $this->addSql('ALTER TABLE nutrition DROP deleted_at');
    }
}
