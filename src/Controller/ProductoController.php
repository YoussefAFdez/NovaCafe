<?php

namespace App\Controller;

use App\Entity\Categoria;
use App\Entity\Producto;
use App\Factory\CategoriaFactory;
use App\Repository\ProductoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductoController extends AbstractController
{

    /**
     * @Route("/producto", name="listadoProductos")
     */
    public function listado(ProductoRepository $productoRepository) : Response {
        $elementos = $productoRepository->findAllOrdenados();
        return $this->render('producto/listado.html.twig', [
           'elementos' => $elementos
        ]);
    }

    /**
     * @Route("/producto/{id}", name="categoriaProducto")
     */
    public function categoriaDeProducto(ProductoRepository $productoRepository, Categoria $categoria) : Response {
        $productos = $productoRepository->findByCategoria($categoria->getId());
        return $this->render('producto/categoria.html.twig', [
            'productos' => $productos,
            'categoria' => $categoria->getNombre()
        ]);
    }
}