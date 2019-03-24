<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190317225704 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE deck (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, deck_name VARCHAR(25) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_4FAC3637A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE deck_cards (deck_id INT NOT NULL, cards_id INT NOT NULL, INDEX IDX_C59FA212111948DC (deck_id), INDEX IDX_C59FA212DC555177 (cards_id), PRIMARY KEY(deck_id, cards_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE deck ADD CONSTRAINT FK_4FAC3637A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE deck_cards ADD CONSTRAINT FK_C59FA212111948DC FOREIGN KEY (deck_id) REFERENCES deck (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE deck_cards ADD CONSTRAINT FK_C59FA212DC555177 FOREIGN KEY (cards_id) REFERENCES cards (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE deck_cards DROP FOREIGN KEY FK_C59FA212111948DC');
        $this->addSql('DROP TABLE deck');
        $this->addSql('DROP TABLE deck_cards');
    }
}
