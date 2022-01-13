<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220112221822 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avatar (id INT AUTO_INCREMENT NOT NULL, picture VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE board_game (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name VARCHAR(50) NOT NULL, description LONGTEXT NOT NULL, picture VARCHAR(255) NOT NULL, INDEX IDX_F9BD68AF12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE board_game_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, event_id INT NOT NULL, user_id INT NOT NULL, reference BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_E00CEDDE71F7E88B (event_id), INDEX IDX_E00CEDDEA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comic (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name VARCHAR(50) NOT NULL, description LONGTEXT NOT NULL, picture VARCHAR(255) NOT NULL, author VARCHAR(50) NOT NULL, INDEX IDX_5B7EA5AA12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comic_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, place_id INT DEFAULT NULL, owner_id INT NOT NULL, activity_id INT NOT NULL, name VARCHAR(100) NOT NULL, description LONGTEXT NOT NULL, picture VARCHAR(255) NOT NULL, start_at DATETIME NOT NULL, end_at DATETIME NOT NULL, capacity INT DEFAULT NULL, game_level VARCHAR(50) DEFAULT NULL, INDEX IDX_3BAE0AA712469DE2 (category_id), INDEX IDX_3BAE0AA7DA6A219 (place_id), INDEX IDX_3BAE0AA77E3C61F9 (owner_id), INDEX IDX_3BAE0AA781C06096 (activity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_activity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE manga (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name VARCHAR(50) NOT NULL, description LONGTEXT NOT NULL, picture VARCHAR(255) NOT NULL, author VARCHAR(50) NOT NULL, INDEX IDX_765A9E0312469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE manga_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE place (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, street VARCHAR(120) NOT NULL, zipcode VARCHAR(12) NOT NULL, city VARCHAR(60) NOT NULL, country VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE platform (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, profile_id INT DEFAULT NULL, level_id INT DEFAULT NULL, picture_id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(50) NOT NULL, birthdate DATE NOT NULL, city VARCHAR(60) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649CCFA12B8 (profile_id), INDEX IDX_8D93D6495FB14BA7 (level_id), INDEX IDX_8D93D649EE45BDBF (picture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_video_game (user_id INT NOT NULL, video_game_id INT NOT NULL, INDEX IDX_83DBAABCA76ED395 (user_id), INDEX IDX_83DBAABC16230A8 (video_game_id), PRIMARY KEY(user_id, video_game_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_board_game (user_id INT NOT NULL, board_game_id INT NOT NULL, INDEX IDX_5EDAAE43A76ED395 (user_id), INDEX IDX_5EDAAE43AC91F10A (board_game_id), PRIMARY KEY(user_id, board_game_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_manga (user_id INT NOT NULL, manga_id INT NOT NULL, INDEX IDX_9498655BA76ED395 (user_id), INDEX IDX_9498655B7B6461 (manga_id), PRIMARY KEY(user_id, manga_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_comic (user_id INT NOT NULL, comic_id INT NOT NULL, INDEX IDX_B9BC5EF2A76ED395 (user_id), INDEX IDX_B9BC5EF2D663094A (comic_id), PRIMARY KEY(user_id, comic_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_level (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_profile (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video_game (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name VARCHAR(50) NOT NULL, description LONGTEXT NOT NULL, picture VARCHAR(255) NOT NULL, INDEX IDX_24BC6C5012469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video_game_platform (video_game_id INT NOT NULL, platform_id INT NOT NULL, INDEX IDX_996C03DD16230A8 (video_game_id), INDEX IDX_996C03DDFFE6496F (platform_id), PRIMARY KEY(video_game_id, platform_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video_game_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE board_game ADD CONSTRAINT FK_F9BD68AF12469DE2 FOREIGN KEY (category_id) REFERENCES board_game_category (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE71F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comic ADD CONSTRAINT FK_5B7EA5AA12469DE2 FOREIGN KEY (category_id) REFERENCES comic_category (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA712469DE2 FOREIGN KEY (category_id) REFERENCES event_category (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7DA6A219 FOREIGN KEY (place_id) REFERENCES place (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA77E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA781C06096 FOREIGN KEY (activity_id) REFERENCES event_activity (id)');
        $this->addSql('ALTER TABLE manga ADD CONSTRAINT FK_765A9E0312469DE2 FOREIGN KEY (category_id) REFERENCES manga_category (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649CCFA12B8 FOREIGN KEY (profile_id) REFERENCES user_profile (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6495FB14BA7 FOREIGN KEY (level_id) REFERENCES user_level (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649EE45BDBF FOREIGN KEY (picture_id) REFERENCES avatar (id)');
        $this->addSql('ALTER TABLE user_video_game ADD CONSTRAINT FK_83DBAABCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_video_game ADD CONSTRAINT FK_83DBAABC16230A8 FOREIGN KEY (video_game_id) REFERENCES video_game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_board_game ADD CONSTRAINT FK_5EDAAE43A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_board_game ADD CONSTRAINT FK_5EDAAE43AC91F10A FOREIGN KEY (board_game_id) REFERENCES board_game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_manga ADD CONSTRAINT FK_9498655BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_manga ADD CONSTRAINT FK_9498655B7B6461 FOREIGN KEY (manga_id) REFERENCES manga (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_comic ADD CONSTRAINT FK_B9BC5EF2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_comic ADD CONSTRAINT FK_B9BC5EF2D663094A FOREIGN KEY (comic_id) REFERENCES comic (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE video_game ADD CONSTRAINT FK_24BC6C5012469DE2 FOREIGN KEY (category_id) REFERENCES video_game_category (id)');
        $this->addSql('ALTER TABLE video_game_platform ADD CONSTRAINT FK_996C03DD16230A8 FOREIGN KEY (video_game_id) REFERENCES video_game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE video_game_platform ADD CONSTRAINT FK_996C03DDFFE6496F FOREIGN KEY (platform_id) REFERENCES platform (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649EE45BDBF');
        $this->addSql('ALTER TABLE user_board_game DROP FOREIGN KEY FK_5EDAAE43AC91F10A');
        $this->addSql('ALTER TABLE board_game DROP FOREIGN KEY FK_F9BD68AF12469DE2');
        $this->addSql('ALTER TABLE user_comic DROP FOREIGN KEY FK_B9BC5EF2D663094A');
        $this->addSql('ALTER TABLE comic DROP FOREIGN KEY FK_5B7EA5AA12469DE2');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE71F7E88B');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA781C06096');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA712469DE2');
        $this->addSql('ALTER TABLE user_manga DROP FOREIGN KEY FK_9498655B7B6461');
        $this->addSql('ALTER TABLE manga DROP FOREIGN KEY FK_765A9E0312469DE2');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7DA6A219');
        $this->addSql('ALTER TABLE video_game_platform DROP FOREIGN KEY FK_996C03DDFFE6496F');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDEA76ED395');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA77E3C61F9');
        $this->addSql('ALTER TABLE user_video_game DROP FOREIGN KEY FK_83DBAABCA76ED395');
        $this->addSql('ALTER TABLE user_board_game DROP FOREIGN KEY FK_5EDAAE43A76ED395');
        $this->addSql('ALTER TABLE user_manga DROP FOREIGN KEY FK_9498655BA76ED395');
        $this->addSql('ALTER TABLE user_comic DROP FOREIGN KEY FK_B9BC5EF2A76ED395');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6495FB14BA7');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649CCFA12B8');
        $this->addSql('ALTER TABLE user_video_game DROP FOREIGN KEY FK_83DBAABC16230A8');
        $this->addSql('ALTER TABLE video_game_platform DROP FOREIGN KEY FK_996C03DD16230A8');
        $this->addSql('ALTER TABLE video_game DROP FOREIGN KEY FK_24BC6C5012469DE2');
        $this->addSql('DROP TABLE avatar');
        $this->addSql('DROP TABLE board_game');
        $this->addSql('DROP TABLE board_game_category');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE comic');
        $this->addSql('DROP TABLE comic_category');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE event_activity');
        $this->addSql('DROP TABLE event_category');
        $this->addSql('DROP TABLE manga');
        $this->addSql('DROP TABLE manga_category');
        $this->addSql('DROP TABLE place');
        $this->addSql('DROP TABLE platform');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_video_game');
        $this->addSql('DROP TABLE user_board_game');
        $this->addSql('DROP TABLE user_manga');
        $this->addSql('DROP TABLE user_comic');
        $this->addSql('DROP TABLE user_level');
        $this->addSql('DROP TABLE user_profile');
        $this->addSql('DROP TABLE video_game');
        $this->addSql('DROP TABLE video_game_platform');
        $this->addSql('DROP TABLE video_game_category');
    }
}
