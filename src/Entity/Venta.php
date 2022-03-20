<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="venta")
 */
class Venta
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
     * @var \DateTime
     * @ORM\Column(type="date")
     */
    private $fechaVenta;

    /**
     * @var Cliente
     * @ORM\ManyToOne(targetEntity="Cliente", inversedBy="ventas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cliente;

    /**
     * @var Producto[]|Collection
     * @ORM\ManyToMany(targetEntity="Producto", inversedBy="ventas")
     */
    private $productos;

    /**
     * @var Empleado
     * @ORM\ManyToOne(targetEntity="Empleado", inversedBy="ventas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $empleado;

    public function __construct()
    {
        $this->productos = new ArrayCollection();
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
     * @return Venta
     */
    public function setCodigo(string $codigo): Venta
    {
        $this->codigo = $codigo;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getFechaVenta(): \DateTime
    {
        return $this->fechaVenta;
    }

    /**
     * @param \DateTime $fechaVenta
     * @return Venta
     */
    public function setFechaVenta(\DateTime $fechaVenta): Venta
    {
        $this->fechaVenta = $fechaVenta;
        return $this;
    }

    /**
     * @return Cliente
     */
    public function getCliente(): Cliente
    {
        return $this->cliente;
    }

    /**
     * @param Cliente $cliente
     * @return Venta
     */
    public function setCliente(Cliente $cliente): Venta
    {
        $this->cliente = $cliente;
        return $this;
    }

    /**
     * @return Producto[]|Collection
     */
    public function getProductos()
    {
        return $this->productos;
    }

    /**
     * @param Producto[]|Collection $productos
     * @return Venta
     */
    public function setProductos($productos)
    {
        $this->productos = $productos;
        return $this;
    }

    /**
     * @return Empleado
     */
    public function getEmpleado(): Empleado
    {
        return $this->empleado;
    }

    /**
     * @param Empleado $empleado
     * @return Venta
     */
    public function setEmpleado(Empleado $empleado): Venta
    {
        $this->empleado = $empleado;
        return $this;
    }

}