<?php

namespace App\Repository;

use App\Entity\Cliente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ClienteRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cliente::class);
    }

    public function findAllOrdenados()
    {
        return $this
            ->getEntityManager()
            ->createQuery("SELECT c FROM App\Entity\Cliente c ORDER BY c.nombre")
            ->getResult();
    }

    public function guardar()
    {
        $this->getEntityManager()->flush();
    }

    public function nuevo()
    {
        $cliente = new Cliente();
        $this->getEntityManager()->persist($cliente);

        return $cliente;
    }

    public function eliminar(Cliente $cliente)
    {
        $this->getEntityManager()->remove($cliente);
        $this->guardar();
    }

    public function ventas(Cliente $cliente)
    {
        return $this
            ->getEntityManager()
            ->createQuery("SELECT v FROM App\Entity\Venta v WHERE v.cliente = :cliente")
            ->setParameter("cliente", $cliente)
            ->getResult();
    }

}