<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @var Venta[]|Collection
     * @ORM\ManyToMany(targetEntity="Venta", inversedBy="productos")
     */
    private $ventas;

    /**
     * @var Categoria
     * @ORM\ManyToOne(targetEntity="Categoria", inversedBy="productos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categoria;

    public function __construct()
    {
        $this->ventas = new ArrayCollection();
    }

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

    /**
     * @return Venta[]|Collection
     */
    public function getVentas()
    {
        return $this->ventas;
    }

    /**
     * @param Venta[]|Collection $ventas
     * @return Producto
     */
    public function setVentas($ventas)
    {
        $this->ventas = $ventas;
        return $this;
    }

    /**
     * @return Categoria
     */
    public function getCategoria(): Categoria
    {
        return $this->categoria;
    }

    /**
     * @param Categoria $categoria
     * @return Producto
     */
    public function setCategoria(Categoria $categoria): Producto
    {
        $this->categoria = $categoria;
        return $this;
    }



}