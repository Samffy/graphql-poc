<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Class Version20180624103144
 * Description : Create application schema
 */
final class Version20180624103144 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'sqlite',
            'Migration can only be executed safely on \'sqlite\'.'
        );

        $this->addSql('CREATE TABLE person (id CLOB NOT NULL, animal_id CLOB DEFAULT NULL, name CLOB NOT NULL, title TEXT NOT NULL, birth_date DATETIME NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_34DCD1768E962C16 ON person (animal_id)');
        $this->addSql('CREATE UNIQUE INDEX person_idx ON person (id)');
        $this->addSql('CREATE TABLE person_has_vehicle (person_id CLOB NOT NULL, vehicle_id CLOB NOT NULL, PRIMARY KEY(person_id, vehicle_id))');
        $this->addSql('CREATE INDEX IDX_119AD3D5217BBB47 ON person_has_vehicle (person_id)');
        $this->addSql('CREATE INDEX IDX_119AD3D5545317D1 ON person_has_vehicle (vehicle_id)');
        $this->addSql('CREATE TABLE animal (id CLOB NOT NULL, name CLOB NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX animal_idx ON animal (id)');
        $this->addSql('CREATE TABLE vehicle (id CLOB NOT NULL, manufacturer CLOB NOT NULL, model CLOB NOT NULL, type VARCHAR(255) NOT NULL, seats_number INTEGER DEFAULT NULL, maximum_load INTEGER DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX vehicle_idx ON vehicle (id)');
    }

    public function down(Schema $schema) : void
    {
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'sqlite',
            'Migration can only be executed safely on \'sqlite\'.'
        );

        $this->addSql('DROP TABLE person');
        $this->addSql('DROP TABLE person_has_vehicle');
        $this->addSql('DROP TABLE animal');
        $this->addSql('DROP TABLE vehicle');
    }
}
