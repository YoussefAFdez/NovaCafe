<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="producto")
 */
class Producto
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", unique=true)
     */
    private $codigo;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $nombre;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $descripcion;

    /**
     * @var double
     * @ORM\Column(type="float")
     */
    private $precio;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $stock;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCodigo(): string
    {
        return $this->codigo;
    }

    /**
     * @param string $codigo
     * @return Producto
     */
    public function setCodigo(string $codigo): Producto
    {
        $this->codigo = $codigo;
        return $this;
    }

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     * @return Producto
     */
    public function setNombre(string $nombre): Producto
    {
        $this->nombre = $nombre;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    /**
     * @param string $descripcion
     * @return Producto
     */
    public function setDescripcion(string $descripcion): Producto
    {
        $this->descripcion = $descripcion;
        return $this;
    }

    /**
     * @return double
     */
    public function getPrecio(): double
    {
        return $this->precio;
    }

    /**
     * @param double $precio
     * @return Producto
     */
    public function setPrecio(double $precio): Producto
    {
        $this->precio = $precio;
        return $this;
    }

    /**
     * @return int
     */
    public function getStock(): int
    {
        return $this->stock;
    }

    /**
     * @param int $stock
     * @return Producto
     */
    public function setStock(int $stock): Producto
    {
        $this->stock = $stock;
        return $this;
    }


}