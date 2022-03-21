<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="cliente")
 */
class Cliente
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
     * @ORM\Column(type="string")
     */
    private $nombre;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $apellido;

    /**
     * @var Venta[]|Collection
     * @ORM\OneToMany(targetEntity="Venta", mappedBy="cliente")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ventas;

    public function __construct()
    {
        $this->ventas = new ArrayCollection();
    }

    public function __toString() {
        return $this->getNombre() . ' ' . $this->getApellido();
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     * @return Cliente
     */
    public function setNombre(string $nombre): Cliente
    {
        $this->nombre = $nombre;
        return $this;
    }

    /**
     * @return string
     */
    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    /**
     * @param string $apellido
     * @return Cliente
     */
    public function setApellido(string $apellido): Cliente
    {
        $this->apellido = $apellido;
        return $this;
    }

    /**
     * @return Collection|Venta[]
     */
    public function getVentas()
    {
        return $this->ventas;
    }

    /**
     * @param Collection|Venta[] $ventas
     * @return Cliente
     */
    public function setVentas($ventas)
    {
        $this->ventas = $ventas;
        return $this;
    }


}