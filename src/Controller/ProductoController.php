<?php

namespace App\Controller;

use App\Entity\Categoria;
use App\Entity\Producto;
use App\Form\ProductoType;
use App\Repository\ProductoRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductoController extends AbstractController
{

    /**
     * @Route("/producto", name="listadoProductos")
     * @Security("is_granted('ROLE_EMPLEADO')")
     */
    public function listado(ProductoRepository $productoRepository) : Response {
        $elementos = $productoRepository->findAllOrdenados();
        return $this->render('producto/listado.html.twig', [
           'elementos' => $elementos
        ]);
    }

    /**
     * @Route("/producto/nuevo", name="producto_nuevo")
     * @Security("is_granted('ROLE_GERENTE')")
     */
    public function nuevoProducto(Request $request, ProductoRepository $productoRepository) : Response {
        $producto = $productoRepository->nuevo();
        return $this->modificarProducto($request, $productoRepository, $producto);
    }

    /**
     * @Route("/producto/{id}", name="categoriaProducto")
     * @Security("is_granted('ROLE_EMPLEADO')")
     */
    public function categoriaDeProducto(ProductoRepository $productoRepository, Categoria $categoria) : Response {
        $productos = $productoRepository->findByCategoria($categoria->getId());
        return $this->render('producto/categoria.html.twig', [
            'productos' => $productos,
            'categoria' => $categoria->getNombre()
        ]);
    }

    /**
     * @Route("/producto/modificar/{id}", name="producto_modificar")
     * @Security("is_granted('ROLE_GERENTE')")
     */
    public function modificarProducto(Request $request, ProductoRepository $productoRepository, Producto $producto) {
        $form = $this->createForm(ProductoType::class, $producto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $productoRepository->guardar();
                return $this->redirectToRoute('listadoProductos');
            } catch (\Exception $exception) {

            }
        }

        return $this->render('producto/modificar.html.twig', [
            'producto' => $producto,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/producto/eliminar/{id}", name="producto_eliminar")
     * @Security("is_granted('ROLE_GERENTE')")
     */
    public function eliminarProducto(Request $request, ProductoRepository $productoRepository, Producto $producto) : Response {
        if ($request->get('confirmar', false)) {
            try {
                $productoRepository->eliminar($producto);
                return $this->redirectToRoute('listadoProductos');
            } catch (\Exception $e) {

            }
        }
        return $this->render('producto/eliminar.html.twig', [
            'producto' => $producto
        ]);
    }
}