<?php

namespace App\Entity;

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
     * @var \DateTIme
     * @ORM\Column(type="date")
     */
    private $fechaVenta;

    /**
     * @var Cliente
     * @ORM\ManyToOne(targetEntity="Cliente", inversedBy="ventas")
     */
    private $cliente;

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
     * @return \DateTIme
     */
    public function getFechaVenta(): \DateTIme
    {
        return $this->fechaVenta;
    }

    /**
     * @param \DateTIme $fechaVenta
     * @return Venta
     */
    public function setFechaVenta(\DateTIme $fechaVenta): Venta
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


}