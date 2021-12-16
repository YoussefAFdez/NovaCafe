<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="empleado")
 */
class Empleado
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
     * @ORM\Column(type="string", unique=true)
     */
    private $dni;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $gerente;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $administrador;

    /**
     * @var Venta[]|Collection
     * @ORM\OneToMany(targetEntity="Venta", mappedBy="empleado")
     */
    private $ventas;

    /**
     * @var Categoria[]|Collection
     * @ORM\OneToMany(targetEntity="Categoria", mappedBy="creadaPor")
     */
    private $categorias;

    public function __construct()
    {
        $this->ventas = new ArrayCollection();
        $this->categorias = new ArrayCollection();
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
     * @return Empleado
     */
    public function setCodigo(string $codigo): Empleado
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
     * @return Empleado
     */
    public function setNombre(string $nombre): Empleado
    {
        $this->nombre = $nombre;
        return $this;
    }

    /**
     * @return string
     */
    public function getDni(): string
    {
        return $this->dni;
    }

    /**
     * @param string $dni
     * @return Empleado
     */
    public function setDni(string $dni): Empleado
    {
        $this->dni = $dni;
        return $this;
    }

    /**
     * @return bool
     */
    public function isGerente(): bool
    {
        return $this->gerente;
    }

    /**
     * @param bool $gerente
     * @return Empleado
     */
    public function setGerente(bool $gerente): Empleado
    {
        $this->gerente = $gerente;
        return $this;
    }

    /**
     * @return bool
     */
    public function isAdministrador(): bool
    {
        return $this->administrador;
    }

    /**
     * @param bool $administrador
     * @return Empleado
     */
    public function setAdministrador(bool $administrador): Empleado
    {
        $this->administrador = $administrador;
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
     * @return Empleado
     */
    public function setVentas($ventas)
    {
        $this->ventas = $ventas;
        return $this;
    }

    /**
     * @return Categoria[]|Collection
     */
    public function getCategorias()
    {
        return $this->categorias;
    }

    /**
     * @param Categoria[]|Collection $categorias
     * @return Empleado
     */
    public function setCategorias($categorias)
    {
        $this->categorias = $categorias;
        return $this;
    }


}