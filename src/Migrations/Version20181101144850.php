<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181101144850 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_5076A4C03EB8070A');
        $this->addSql('DROP INDEX IDX_5076A4C0C36A3328');
        $this->addSql('CREATE TEMPORARY TABLE __temp__run AS SELECT id, cluster_id, program_id, start, label, description, date_end, status FROM run');
        $this->addSql('DROP TABLE run');
        $this->addSql('CREATE TABLE run (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, cluster_id INTEGER NOT NULL, program_id INTEGER DEFAULT NULL, label VARCHAR(255) DEFAULT NULL COLLATE BINARY, description CLOB DEFAULT NULL COLLATE BINARY, date_end DATETIME DEFAULT NULL, status VARCHAR(255) DEFAULT NULL COLLATE BINARY, start DATETIME DEFAULT NULL, CONSTRAINT FK_5076A4C0C36A3328 FOREIGN KEY (cluster_id) REFERENCES cluster (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_5076A4C03EB8070A FOREIGN KEY (program_id) REFERENCES program (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO run (id, cluster_id, program_id, start, label, description, date_end, status) SELECT id, cluster_id, program_id, start, label, description, date_end, status FROM __temp__run');
        $this->addSql('DROP TABLE __temp__run');
        $this->addSql('CREATE INDEX IDX_5076A4C03EB8070A ON run (program_id)');
        $this->addSql('CREATE INDEX IDX_5076A4C0C36A3328 ON run (cluster_id)');
        $this->addSql('DROP INDEX IDX_43B9FE3C3EB8070A');
        $this->addSql('DROP INDEX IDX_43B9FE3C59D8A214');
        $this->addSql('CREATE TEMPORARY TABLE __temp__step AS SELECT id, program_id, recipe_id, type, rank, value FROM step');
        $this->addSql('DROP TABLE step');
        $this->addSql('CREATE TABLE step (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, program_id INTEGER DEFAULT NULL, recipe_id INTEGER DEFAULT NULL, type VARCHAR(255) NOT NULL COLLATE BINARY, rank INTEGER NOT NULL, value VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_43B9FE3C3EB8070A FOREIGN KEY (program_id) REFERENCES program (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_43B9FE3C59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO step (id, program_id, recipe_id, type, rank, value) SELECT id, program_id, recipe_id, type, rank, value FROM __temp__step');
        $this->addSql('DROP TABLE __temp__step');
        $this->addSql('CREATE INDEX IDX_43B9FE3C3EB8070A ON step (program_id)');
        $this->addSql('CREATE INDEX IDX_43B9FE3C59D8A214 ON step (recipe_id)');
        $this->addSql('DROP INDEX IDX_46DC8952DC90A29E');
        $this->addSql('CREATE TEMPORARY TABLE __temp__pcb AS SELECT id, luminaire_id, crc, serial, n, type, temperature FROM pcb');
        $this->addSql('DROP TABLE pcb');
        $this->addSql('CREATE TABLE pcb (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, luminaire_id INTEGER DEFAULT NULL, crc VARCHAR(6) DEFAULT NULL COLLATE BINARY, serial VARCHAR(10) DEFAULT NULL COLLATE BINARY, n INTEGER DEFAULT NULL, type INTEGER DEFAULT NULL, temperature DOUBLE PRECISION DEFAULT NULL, CONSTRAINT FK_46DC8952DC90A29E FOREIGN KEY (luminaire_id) REFERENCES luminaire (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO pcb (id, luminaire_id, crc, serial, n, type, temperature) SELECT id, luminaire_id, crc, serial, n, type, temperature FROM __temp__pcb');
        $this->addSql('DROP TABLE __temp__pcb');
        $this->addSql('CREATE INDEX IDX_46DC8952DC90A29E ON pcb (luminaire_id)');
        $this->addSql('DROP INDEX IDX_A2F98E47DC90A29E');
        $this->addSql('DROP INDEX IDX_A2F98E47B262EAC9');
        $this->addSql('CREATE TEMPORARY TABLE __temp__channel AS SELECT id, luminaire_id, led_id, channel, i_peek, pcb, current_intensity FROM channel');
        $this->addSql('DROP TABLE channel');
        $this->addSql('CREATE TABLE channel (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, luminaire_id INTEGER DEFAULT NULL, led_id INTEGER DEFAULT NULL, channel INTEGER DEFAULT NULL, i_peek INTEGER DEFAULT NULL, pcb INTEGER DEFAULT NULL, current_intensity INTEGER DEFAULT NULL, CONSTRAINT FK_A2F98E47DC90A29E FOREIGN KEY (luminaire_id) REFERENCES luminaire (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_A2F98E47B262EAC9 FOREIGN KEY (led_id) REFERENCES led (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO channel (id, luminaire_id, led_id, channel, i_peek, pcb, current_intensity) SELECT id, luminaire_id, led_id, channel, i_peek, pcb, current_intensity FROM __temp__channel');
        $this->addSql('DROP TABLE __temp__channel');
        $this->addSql('CREATE INDEX IDX_A2F98E47DC90A29E ON channel (luminaire_id)');
        $this->addSql('CREATE INDEX IDX_A2F98E47B262EAC9 ON channel (led_id)');
        $this->addSql('DROP INDEX IDX_6BAF7870B262EAC9');
        $this->addSql('DROP INDEX IDX_6BAF787059D8A214');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ingredient AS SELECT id, led_id, recipe_id, level FROM ingredient');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('CREATE TABLE ingredient (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, led_id INTEGER NOT NULL, recipe_id INTEGER DEFAULT NULL, level INTEGER NOT NULL, CONSTRAINT FK_6BAF787059D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_6BAF7870B262EAC9 FOREIGN KEY (led_id) REFERENCES led (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO ingredient (id, led_id, recipe_id, level) SELECT id, led_id, recipe_id, level FROM __temp__ingredient');
        $this->addSql('DROP TABLE __temp__ingredient');
        $this->addSql('CREATE INDEX IDX_6BAF7870B262EAC9 ON ingredient (led_id)');
        $this->addSql('CREATE INDEX IDX_6BAF787059D8A214 ON ingredient (recipe_id)');
        $this->addSql('DROP INDEX IDX_8F3F68C5DC90A29E');
        $this->addSql('DROP INDEX IDX_8F3F68C5C36A3328');
        $this->addSql('CREATE TEMPORARY TABLE __temp__log AS SELECT id, cluster_id, luminaire_id, type, value, comment, time FROM log');
        $this->addSql('DROP TABLE log');
        $this->addSql('CREATE TABLE log (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, cluster_id INTEGER DEFAULT NULL, luminaire_id INTEGER DEFAULT NULL, type VARCHAR(255) NOT NULL COLLATE BINARY, value CLOB DEFAULT NULL COLLATE BINARY --(DC2Type:json)
        , comment CLOB DEFAULT NULL COLLATE BINARY, time DATETIME NOT NULL, CONSTRAINT FK_8F3F68C5C36A3328 FOREIGN KEY (cluster_id) REFERENCES cluster (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_8F3F68C5DC90A29E FOREIGN KEY (luminaire_id) REFERENCES luminaire (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO log (id, cluster_id, luminaire_id, type, value, comment, time) SELECT id, cluster_id, luminaire_id, type, value, comment, time FROM __temp__log');
        $this->addSql('DROP TABLE __temp__log');
        $this->addSql('CREATE INDEX IDX_8F3F68C5DC90A29E ON log (luminaire_id)');
        $this->addSql('CREATE INDEX IDX_8F3F68C5C36A3328 ON log (cluster_id)');
        $this->addSql('DROP INDEX IDX_BF3BAD1BC36A3328');
        $this->addSql('CREATE TEMPORARY TABLE __temp__luminaire AS SELECT id, cluster_id, serial, address FROM luminaire');
        $this->addSql('DROP TABLE luminaire');
        $this->addSql('CREATE TABLE luminaire (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, cluster_id INTEGER DEFAULT NULL, serial VARCHAR(255) DEFAULT NULL COLLATE BINARY, address INTEGER DEFAULT NULL, CONSTRAINT FK_BF3BAD1BC36A3328 FOREIGN KEY (cluster_id) REFERENCES cluster (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO luminaire (id, cluster_id, serial, address) SELECT id, cluster_id, serial, address FROM __temp__luminaire');
        $this->addSql('DROP TABLE __temp__luminaire');
        $this->addSql('CREATE INDEX IDX_BF3BAD1BC36A3328 ON luminaire (cluster_id)');
        $this->addSql('DROP INDEX IDX_F478AB4CE254CE66');
        $this->addSql('DROP INDEX IDX_F478AB4CDC90A29E');
        $this->addSql('CREATE TEMPORARY TABLE __temp__luminaire_luminaire_status AS SELECT luminaire_id, luminaire_status_id FROM luminaire_luminaire_status');
        $this->addSql('DROP TABLE luminaire_luminaire_status');
        $this->addSql('CREATE TABLE luminaire_luminaire_status (luminaire_id INTEGER NOT NULL, luminaire_status_id INTEGER NOT NULL, PRIMARY KEY(luminaire_id, luminaire_status_id), CONSTRAINT FK_F478AB4CDC90A29E FOREIGN KEY (luminaire_id) REFERENCES luminaire (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_F478AB4CE254CE66 FOREIGN KEY (luminaire_status_id) REFERENCES luminaire_status (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO luminaire_luminaire_status (luminaire_id, luminaire_status_id) SELECT luminaire_id, luminaire_status_id FROM __temp__luminaire_luminaire_status');
        $this->addSql('DROP TABLE __temp__luminaire_luminaire_status');
        $this->addSql('CREATE INDEX IDX_F478AB4CE254CE66 ON luminaire_luminaire_status (luminaire_status_id)');
        $this->addSql('CREATE INDEX IDX_F478AB4CDC90A29E ON luminaire_luminaire_status (luminaire_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_A2F98E47DC90A29E');
        $this->addSql('DROP INDEX IDX_A2F98E47B262EAC9');
        $this->addSql('CREATE TEMPORARY TABLE __temp__channel AS SELECT id, luminaire_id, led_id, channel, i_peek, pcb, current_intensity FROM channel');
        $this->addSql('DROP TABLE channel');
        $this->addSql('CREATE TABLE channel (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, luminaire_id INTEGER DEFAULT NULL, led_id INTEGER DEFAULT NULL, channel INTEGER DEFAULT NULL, i_peek INTEGER DEFAULT NULL, pcb INTEGER DEFAULT NULL, current_intensity INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO channel (id, luminaire_id, led_id, channel, i_peek, pcb, current_intensity) SELECT id, luminaire_id, led_id, channel, i_peek, pcb, current_intensity FROM __temp__channel');
        $this->addSql('DROP TABLE __temp__channel');
        $this->addSql('CREATE INDEX IDX_A2F98E47DC90A29E ON channel (luminaire_id)');
        $this->addSql('CREATE INDEX IDX_A2F98E47B262EAC9 ON channel (led_id)');
        $this->addSql('DROP INDEX IDX_6BAF787059D8A214');
        $this->addSql('DROP INDEX IDX_6BAF7870B262EAC9');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ingredient AS SELECT id, recipe_id, led_id, level FROM ingredient');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('CREATE TABLE ingredient (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, recipe_id INTEGER DEFAULT NULL, led_id INTEGER NOT NULL, level INTEGER NOT NULL)');
        $this->addSql('INSERT INTO ingredient (id, recipe_id, led_id, level) SELECT id, recipe_id, led_id, level FROM __temp__ingredient');
        $this->addSql('DROP TABLE __temp__ingredient');
        $this->addSql('CREATE INDEX IDX_6BAF787059D8A214 ON ingredient (recipe_id)');
        $this->addSql('CREATE INDEX IDX_6BAF7870B262EAC9 ON ingredient (led_id)');
        $this->addSql('DROP INDEX IDX_8F3F68C5C36A3328');
        $this->addSql('DROP INDEX IDX_8F3F68C5DC90A29E');
        $this->addSql('CREATE TEMPORARY TABLE __temp__log AS SELECT id, cluster_id, luminaire_id, type, value, comment, time FROM log');
        $this->addSql('DROP TABLE log');
        $this->addSql('CREATE TABLE log (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, cluster_id INTEGER DEFAULT NULL, luminaire_id INTEGER DEFAULT NULL, type VARCHAR(255) NOT NULL, value CLOB DEFAULT NULL --(DC2Type:json)
        , comment CLOB DEFAULT NULL, time DATETIME NOT NULL)');
        $this->addSql('INSERT INTO log (id, cluster_id, luminaire_id, type, value, comment, time) SELECT id, cluster_id, luminaire_id, type, value, comment, time FROM __temp__log');
        $this->addSql('DROP TABLE __temp__log');
        $this->addSql('CREATE INDEX IDX_8F3F68C5C36A3328 ON log (cluster_id)');
        $this->addSql('CREATE INDEX IDX_8F3F68C5DC90A29E ON log (luminaire_id)');
        $this->addSql('DROP INDEX IDX_BF3BAD1BC36A3328');
        $this->addSql('CREATE TEMPORARY TABLE __temp__luminaire AS SELECT id, cluster_id, serial, address FROM luminaire');
        $this->addSql('DROP TABLE luminaire');
        $this->addSql('CREATE TABLE luminaire (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, cluster_id INTEGER DEFAULT NULL, serial VARCHAR(255) DEFAULT NULL, address INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO luminaire (id, cluster_id, serial, address) SELECT id, cluster_id, serial, address FROM __temp__luminaire');
        $this->addSql('DROP TABLE __temp__luminaire');
        $this->addSql('CREATE INDEX IDX_BF3BAD1BC36A3328 ON luminaire (cluster_id)');
        $this->addSql('DROP INDEX IDX_F478AB4CDC90A29E');
        $this->addSql('DROP INDEX IDX_F478AB4CE254CE66');
        $this->addSql('CREATE TEMPORARY TABLE __temp__luminaire_luminaire_status AS SELECT luminaire_id, luminaire_status_id FROM luminaire_luminaire_status');
        $this->addSql('DROP TABLE luminaire_luminaire_status');
        $this->addSql('CREATE TABLE luminaire_luminaire_status (luminaire_id INTEGER NOT NULL, luminaire_status_id INTEGER NOT NULL, PRIMARY KEY(luminaire_id, luminaire_status_id))');
        $this->addSql('INSERT INTO luminaire_luminaire_status (luminaire_id, luminaire_status_id) SELECT luminaire_id, luminaire_status_id FROM __temp__luminaire_luminaire_status');
        $this->addSql('DROP TABLE __temp__luminaire_luminaire_status');
        $this->addSql('CREATE INDEX IDX_F478AB4CDC90A29E ON luminaire_luminaire_status (luminaire_id)');
        $this->addSql('CREATE INDEX IDX_F478AB4CE254CE66 ON luminaire_luminaire_status (luminaire_status_id)');
        $this->addSql('DROP INDEX IDX_46DC8952DC90A29E');
        $this->addSql('CREATE TEMPORARY TABLE __temp__pcb AS SELECT id, luminaire_id, crc, serial, n, type, temperature FROM pcb');
        $this->addSql('DROP TABLE pcb');
        $this->addSql('CREATE TABLE pcb (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, luminaire_id INTEGER DEFAULT NULL, crc VARCHAR(6) DEFAULT NULL, serial VARCHAR(10) DEFAULT NULL, n INTEGER DEFAULT NULL, type INTEGER DEFAULT NULL, temperature DOUBLE PRECISION DEFAULT NULL)');
        $this->addSql('INSERT INTO pcb (id, luminaire_id, crc, serial, n, type, temperature) SELECT id, luminaire_id, crc, serial, n, type, temperature FROM __temp__pcb');
        $this->addSql('DROP TABLE __temp__pcb');
        $this->addSql('CREATE INDEX IDX_46DC8952DC90A29E ON pcb (luminaire_id)');
        $this->addSql('DROP INDEX IDX_5076A4C0C36A3328');
        $this->addSql('DROP INDEX IDX_5076A4C03EB8070A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__run AS SELECT id, cluster_id, program_id, start, label, description, date_end, status FROM run');
        $this->addSql('DROP TABLE run');
        $this->addSql('CREATE TABLE run (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, cluster_id INTEGER NOT NULL, program_id INTEGER DEFAULT NULL, label VARCHAR(255) DEFAULT NULL, description CLOB DEFAULT NULL, date_end DATETIME DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, start DATETIME NOT NULL)');
        $this->addSql('INSERT INTO run (id, cluster_id, program_id, start, label, description, date_end, status) SELECT id, cluster_id, program_id, start, label, description, date_end, status FROM __temp__run');
        $this->addSql('DROP TABLE __temp__run');
        $this->addSql('CREATE INDEX IDX_5076A4C0C36A3328 ON run (cluster_id)');
        $this->addSql('CREATE INDEX IDX_5076A4C03EB8070A ON run (program_id)');
        $this->addSql('DROP INDEX IDX_43B9FE3C3EB8070A');
        $this->addSql('DROP INDEX IDX_43B9FE3C59D8A214');
        $this->addSql('CREATE TEMPORARY TABLE __temp__step AS SELECT id, program_id, recipe_id, type, rank, value FROM step');
        $this->addSql('DROP TABLE step');
        $this->addSql('CREATE TABLE step (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, program_id INTEGER DEFAULT NULL, recipe_id INTEGER DEFAULT NULL, type VARCHAR(255) NOT NULL, rank INTEGER NOT NULL, value VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO step (id, program_id, recipe_id, type, rank, value) SELECT id, program_id, recipe_id, type, rank, value FROM __temp__step');
        $this->addSql('DROP TABLE __temp__step');
        $this->addSql('CREATE INDEX IDX_43B9FE3C3EB8070A ON step (program_id)');
        $this->addSql('CREATE INDEX IDX_43B9FE3C59D8A214 ON step (recipe_id)');
    }
}
