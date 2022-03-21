<?php

namespace App\Repository;


use App\Entity\Venta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Constraints\Date;

class VentaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Venta::class);
    }

    public function findAllOrdenados() : array {
        return $this
            ->getEntityManager()
            ->createQuery("SELECT v FROM App\Entity\Venta v ORDER BY v.fechaVenta DESC")
            ->getResult();
    }

    public function guardar()
    {
        $this->getEntityManager()->flush();
    }

    public function nuevo()
    {
        $venta = new Venta();
        $venta->setFechaVenta(new \DateTime());
        $this->getEntityManager()->persist($venta);

        return $venta;
    }

    public function eliminar(Venta $venta)
    {
        $this->getEntityManager()->remove($venta);
        $this->guardar();
    }

}