<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220214200925 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categoria (id INT AUTO_INCREMENT NOT NULL, creada_por_id INT NOT NULL, codigo VARCHAR(255) NOT NULL, nombre VARCHAR(255) NOT NULL, descripcion LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_4E10122D20332D99 (codigo), INDEX IDX_4E10122DEBBFCAF6 (creada_por_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cliente (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, apellido VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE empleado (id INT AUTO_INCREMENT NOT NULL, codigo VARCHAR(255) NOT NULL, nombre VARCHAR(255) NOT NULL, apellidos VARCHAR(255) NOT NULL, dni VARCHAR(255) NOT NULL, gerente TINYINT(1) NOT NULL, administrador TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_D9D9BF5220332D99 (codigo), UNIQUE INDEX UNIQ_D9D9BF527F8F253B (dni), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE producto (id INT AUTO_INCREMENT NOT NULL, categoria_id INT NOT NULL, codigo VARCHAR(255) NOT NULL, nombre VARCHAR(255) NOT NULL, descripcion LONGTEXT NOT NULL, precio DOUBLE PRECISION NOT NULL, stock INT NOT NULL, UNIQUE INDEX UNIQ_A7BB061520332D99 (codigo), INDEX IDX_A7BB06153397707A (categoria_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE venta (id INT AUTO_INCREMENT NOT NULL, cliente_id INT NOT NULL, empleado_id INT NOT NULL, codigo VARCHAR(255) NOT NULL, fecha_venta DATE NOT NULL, UNIQUE INDEX UNIQ_8FE7EE5520332D99 (codigo), INDEX IDX_8FE7EE55DE734E51 (cliente_id), INDEX IDX_8FE7EE55952BE730 (empleado_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE venta_producto (venta_id INT NOT NULL, producto_id INT NOT NULL, INDEX IDX_E054E8BF2A5805D (venta_id), INDEX IDX_E054E8B7645698E (producto_id), PRIMARY KEY(venta_id, producto_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categoria ADD CONSTRAINT FK_4E10122DEBBFCAF6 FOREIGN KEY (creada_por_id) REFERENCES empleado (id)');
        $this->addSql('ALTER TABLE producto ADD CONSTRAINT FK_A7BB06153397707A FOREIGN KEY (categoria_id) REFERENCES categoria (id)');
        $this->addSql('ALTER TABLE venta ADD CONSTRAINT FK_8FE7EE55DE734E51 FOREIGN KEY (cliente_id) REFERENCES cliente (id)');
        $this->addSql('ALTER TABLE venta ADD CONSTRAINT FK_8FE7EE55952BE730 FOREIGN KEY (empleado_id) REFERENCES empleado (id)');
        $this->addSql('ALTER TABLE venta_producto ADD CONSTRAINT FK_E054E8BF2A5805D FOREIGN KEY (venta_id) REFERENCES venta (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE venta_producto ADD CONSTRAINT FK_E054E8B7645698E FOREIGN KEY (producto_id) REFERENCES producto (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE producto_venta');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE producto DROP FOREIGN KEY FK_A7BB06153397707A');
        $this->addSql('ALTER TABLE venta DROP FOREIGN KEY FK_8FE7EE55DE734E51');
        $this->addSql('ALTER TABLE categoria DROP FOREIGN KEY FK_4E10122DEBBFCAF6');
        $this->addSql('ALTER TABLE venta DROP FOREIGN KEY FK_8FE7EE55952BE730');
        $this->addSql('ALTER TABLE venta_producto DROP FOREIGN KEY FK_E054E8B7645698E');
        $this->addSql('ALTER TABLE venta_producto DROP FOREIGN KEY FK_E054E8BF2A5805D');
        $this->addSql('CREATE TABLE producto_venta (producto_id INT NOT NULL, venta_id INT NOT NULL, INDEX IDX_CFC0E63F7645698E (producto_id), INDEX IDX_CFC0E63FF2A5805D (venta_id), PRIMARY KEY(producto_id, venta_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE categoria');
        $this->addSql('DROP TABLE cliente');
        $this->addSql('DROP TABLE empleado');
        $this->addSql('DROP TABLE producto');
        $this->addSql('DROP TABLE venta');
        $this->addSql('DROP TABLE venta_producto');
    }
}
