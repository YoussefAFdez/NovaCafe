<?php

namespace App\Repository;


use App\Entity\Categoria;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CategoriaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Categoria::class);
    }

    public function findAllOrdenados() : array {
        return $this
            ->getEntityManager()
            ->createQuery("SELECT c FROM App\Entity\Categoria c ORDER BY c.nombre")
            ->getResult();
    }

    public function guardar()
    {
        $this->getEntityManager()->flush();
    }

    public function nuevo()
    {
        $categoria = new Categoria();
        $this->getEntityManager()->persist($categoria);

        return $categoria;
    }

    public function eliminar(Categoria $categoria)
    {
        $this->getEntityManager()->remove($categoria);
        $this->guardar();
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