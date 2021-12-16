<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="categoria")
 */
class Categoria
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
     * @return Categoria
     */
    public function setCodigo(string $codigo): Categoria
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
     * @return Categoria
     */
    public function setNombre(string $nombre): Categoria
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
     * @return Categoria
     */
    public function setDescripcion(string $descripcion): Categoria
    {
        $this->descripcion = $descripcion;
        return $this;
    }


}