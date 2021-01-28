<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210128193954 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE country (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');

        $this->addSql('CREATE TABLE city (id SERIAL NOT NULL, country_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B0234F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id) NOT DEFERRABLE INITIALLY IMMEDIATE');

        $this->addSql('CREATE TABLE "user" (id SERIAL NOT NULL, city_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) DEFAULT NULL, second_name VARCHAR(255) DEFAULT NULL, height DOUBLE PRECISION DEFAULT NULL, weight DOUBLE PRECISION DEFAULT NULL, sex INT DEFAULT NULL, birthday DATE DEFAULT NULL, age INT DEFAULT NULL, phone INT DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, post_code VARCHAR(255) DEFAULT NULL, create_at TIMESTAMP(0) WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, update_at TIMESTAMP(0) WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, delete_at TIMESTAMP(0) WITH TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_327C5DE78BAC62AF FOREIGN KEY (city_id) REFERENCES city (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_327C5DE7E7927C74 ON public."user" (email)');

        $this->addSql('CREATE TABLE exercise (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, video_path VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');

        $this->addSql('CREATE TABLE exercise_video (id SERIAL NOT NULL, exercise_id INT NOT NULL, user_training_id INT NOT NULL, video_path VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_59F12DEEE934951A ON exercise_video (exercise_id)');
        $this->addSql('ALTER TABLE exercise_video ADD CONSTRAINT FK_59F12DEEE934951A FOREIGN KEY (exercise_id) REFERENCES exercise (id) NOT DEFERRABLE INITIALLY IMMEDIATE');

        $this->addSql('CREATE TABLE nutrition (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, mill INT NOT NULL, calories INT NOT NULL, protein INT NOT NULL, PRIMARY KEY(id))');

        $this->addSql('CREATE TABLE food (id SERIAL NOT NULL, nutrition_id INT DEFAULT NULL, name TEXT NOT NULL, count INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE food ADD CONSTRAINT FK_D43829F7B5D724CD FOREIGN KEY (nutrition_id) REFERENCES nutrition (id) NOT DEFERRABLE INITIALLY IMMEDIATE');

        $this->addSql('CREATE TABLE training (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');

        $this->addSql('CREATE TABLE training_exercise (training_id INT NOT NULL, exercise_id INT NOT NULL, PRIMARY KEY(training_id, exercise_id))');
        $this->addSql('ALTER TABLE training_exercise ADD CONSTRAINT FK_7A28E8E2BEFD98D1 FOREIGN KEY (training_id) REFERENCES exercise (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE training_exercise ADD CONSTRAINT FK_7A28E8E2E934951A FOREIGN KEY (exercise_id) REFERENCES training (id) NOT DEFERRABLE INITIALLY IMMEDIATE');

        $this->addSql('CREATE TABLE user_training (training_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(training_id, user_id))');
        $this->addSql('ALTER TABLE user_training ADD CONSTRAINT FK_9DCD923BEFD98D1 FOREIGN KEY (training_id) REFERENCES training (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_training ADD CONSTRAINT FK_9DCD923A76ED395 FOREIGN KEY (user_id) REFERENCES public."user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_327C5DE78BAC62AF');
        $this->addSql('ALTER TABLE city DROP CONSTRAINT FK_2D5B0234F92F3E70');
        $this->addSql('ALTER TABLE training_exercise DROP CONSTRAINT FK_7A28E8E2BEFD98D1');
        $this->addSql('ALTER TABLE exercise_video DROP CONSTRAINT FK_59F12DEEE934951A');
        $this->addSql('ALTER TABLE training_exercise DROP CONSTRAINT FK_49BFC68BE934951A');
        $this->addSql('ALTER TABLE food DROP CONSTRAINT FK_D43829F7B5D724CD');
        $this->addSql('ALTER TABLE training_exercise DROP CONSTRAINT FK_7A28E8E2E934951A');
        $this->addSql('ALTER TABLE user_training DROP CONSTRAINT FK_9DCD923BEFD98D1');
        $this->addSql('ALTER TABLE training_exercise DROP CONSTRAINT FK_49BFC68BBEFD98D1');
        $this->addSql('ALTER TABLE user_training DROP CONSTRAINT FK_359F6E8FBEFD98D1');
        $this->addSql('ALTER TABLE user_trainings DROP CONSTRAINT FK_B96062A0BEFD98D1');
        $this->addSql('ALTER TABLE user_training DROP CONSTRAINT FK_9DCD923A76ED395');
        $this->addSql('ALTER TABLE user_training DROP CONSTRAINT FK_359F6E8FA76ED395');
        $this->addSql('ALTER TABLE user_trainings DROP CONSTRAINT FK_B96062A0A76ED395');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE exercise');
        $this->addSql('DROP TABLE training_exercise');
        $this->addSql('DROP TABLE exercise_video');
        $this->addSql('DROP TABLE food');
        $this->addSql('DROP TABLE nutrition');
        $this->addSql('DROP TABLE training');
        $this->addSql('DROP TABLE user_training');
        $this->addSql('DROP TABLE training_exercise');
        $this->addSql('DROP TABLE public."user"');
    }
}
