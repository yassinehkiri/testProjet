<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221118220523 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE emp DROP FOREIGN KEY fk_MGR');
        $this->addSql('ALTER TABLE emp CHANGE DEPTNO DEPTNO INT DEFAULT NULL COMMENT \'Department\'\'s identification number\'');
        $this->addSql('ALTER TABLE emp ADD CONSTRAINT FK_310BB40FBD5E2E9B FOREIGN KEY (MGR) REFERENCES emp (EMPNO)');
        $this->addSql('ALTER TABLE proj DROP FOREIGN KEY fk_PROJ');
        $this->addSql('ALTER TABLE proj CHANGE PROJID PROJID INT AUTO_INCREMENT NOT NULL, CHANGE EMPNO EMPNO INT DEFAULT NULL');
        $this->addSql('ALTER TABLE proj ADD CONSTRAINT FK_520C3C90DB6AB0FE FOREIGN KEY (EMPNO) REFERENCES emp (EMPNO)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE emp DROP FOREIGN KEY FK_310BB40FBD5E2E9B');
        $this->addSql('ALTER TABLE emp CHANGE DEPTNO DEPTNO INT NOT NULL');
        $this->addSql('ALTER TABLE emp ADD CONSTRAINT fk_MGR FOREIGN KEY (MGR) REFERENCES emp (EMPNO) ON UPDATE CASCADE ON DELETE SET NULL');
        $this->addSql('ALTER TABLE proj DROP FOREIGN KEY FK_520C3C90DB6AB0FE');
        $this->addSql('ALTER TABLE proj CHANGE PROJID PROJID INT NOT NULL, CHANGE EMPNO EMPNO INT NOT NULL');
        $this->addSql('ALTER TABLE proj ADD CONSTRAINT fk_PROJ FOREIGN KEY (EMPNO) REFERENCES emp (EMPNO) ON UPDATE CASCADE ON DELETE NO ACTION');
    }
}
