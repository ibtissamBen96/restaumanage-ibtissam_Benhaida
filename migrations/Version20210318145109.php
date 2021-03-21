<?php
declare(strict_types=1);
namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210318145109 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $querys=file('scripts/db.sql',FILE_IGNORE_NEW_LINES);

        foreach($querys as $query){
            $this->addSql($query);
        }
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE restaurant ADD create_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, DROP create_at');
        $this->addSql('ALTER TABLE review ADD create_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, DROP create_at');
       
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE restaurant ADD created_at DATETIME NOT NULL, DROP create_at');
        $this->addSql('ALTER TABLE review ADD created_at DATETIME NOT NULL, DROP create_at');
    }
}
