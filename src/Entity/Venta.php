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


}