<?php

namespace App\Repository;

use App\Entity\Empleado;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class EmpleadoRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Empleado::class);
    }

    public function findAllOrdenados()
    {
        return $this
            ->getEntityManager()
            ->createQuery("SELECT e FROM App\Entity\Empleado e ORDER BY e.nombre")
            ->getResult();
    }

    public function findVentasEmpleado(Empleado $empleado)
    {
        return $this
            ->getEntityManager()
            ->createQuery("SELECT v FROM App\Entity\Venta v WHERE v.empleado = :empleado")
            ->setParameter("empleado", $empleado)
            ->getResult();
    }

    public function findCategoriasEmpleado(Empleado $empleado)
    {
        return $this
            ->getEntityManager()
            ->createQuery("SELECT c FROM App\Entity\Categoria c WHERE c.creadaPor = :empleado")
            ->setParameter("empleado", $empleado)
            ->getResult();
    }

    public function guardar()
    {
        $this->getEntityManager()->flush();
    }

    public function nuevo()
    {
        $empleado = new Empleado();
        $this->getEntityManager()->persist($empleado);

        return $empleado;
    }

    public function eliminar(Empleado $empleado)
    {
        $this->getEntityManager()->remove($empleado);
        $this->guardar();
    }

    public function findEmpleado(string $getUsername)
    {
        return $this
            ->getEntityManager()
            ->createQuery("SELECT e FROM App\Entity\Empleado e WHERE e.nombreUsuario = :nombreUsuario")
            ->setParameter("nombreUsuario", $getUsername)
            ->getSingleResult();
    }

}