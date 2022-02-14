<?php

namespace App\Repository;

use App\Entity\Producto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ProductoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Producto::class);
    }

    public function findAllOrdenados() : array {
        return $this
            ->getEntityManager()
            ->createQuery("SELECT p AS producto, SIZE(p.ventas) AS total FROM App\Entity\Producto p ORDER BY p.nombre")
            ->getResult();
    }

    public function findByCategoria(int $getId)
    {
        return $this
            ->getEntityManager()
            ->createQuery("SELECT p FROM App\Entity\Producto p WHERE p.categoria = :categoriaId")
            ->setParameter('categoriaId', $getId)
            ->getResult();
    }

}