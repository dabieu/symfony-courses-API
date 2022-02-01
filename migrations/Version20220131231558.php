<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220131231558 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE registration (id INT AUTO_INCREMENT NOT NULL, courseid_id INT NOT NULL, studentid_id INT NOT NULL, accountid_id INT NOT NULL, registration_date DATE NOT NULL, INDEX IDX_62A8A7A7EAC3334A (courseid_id), INDEX IDX_62A8A7A71D429594 (studentid_id), INDEX IDX_62A8A7A758E0A285 (accountid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE registration ADD CONSTRAINT FK_62A8A7A7EAC3334A FOREIGN KEY (courseid_id) REFERENCES course (id)');
        $this->addSql('ALTER TABLE registration ADD CONSTRAINT FK_62A8A7A71D429594 FOREIGN KEY (studentid_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE registration ADD CONSTRAINT FK_62A8A7A758E0A285 FOREIGN KEY (accountid_id) REFERENCES account (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE registration');
        $this->addSql('ALTER TABLE course CHANGE title title VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE student CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE email email VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE account CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE email email VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
