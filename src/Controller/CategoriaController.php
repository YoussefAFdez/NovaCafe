<?php

namespace App\Controller;

use App\Entity\Categoria;
use App\Form\CategoriaType;
use App\Repository\CategoriaRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoriaController extends AbstractController
{

    /**
     * @Route("/categoria", name="categoria_listar")
     * @Security("is_granted('ROLE_EMPLEADO')")
     */
    public function listado(CategoriaRepository $categoriaRepository) : Response {
        $categorias = $categoriaRepository->findAllOrdenados();
        return $this->render('categoria/listar.html.twig', [
           'categorias' => $categorias
        ]);
    }

    /**
     * @Route("/categoria/nuevo", name="categoria_nuevo")
     * @Security("is_granted('ROLE_GERENTE')")
     */
    public function nuevaCategoria(Request $request, CategoriaRepository $categoriaRepository) : Response {
        $categoria = $categoriaRepository->nuevo();
        return $this->modificarCategoria($request, $categoriaRepository, $categoria);
    }

    /**
     * @Route("/categoria/{id}", name="categoria_productos")
     * @Security("is_granted('ROLE_EMPLEADO')")
     */
    public function categoriaDeProducto(CategoriaRepository $categoriaRepository, Categoria $categoria) : Response {
        $productos = $categoriaRepository->findByCategoria($categoria->getId());
        return $this->render('categoria/productos.html.twig', [
            'productos' => $productos,
            'categoria' => $categoria->getNombre()
        ]);
    }

    /**
     * @Route("/categoria/modificar/{id}", name="categoria_modificar")
     * @Security("is_granted('ROLE_GERENTE')")
     */
    public function modificarCategoria(Request $request, CategoriaRepository $categoriaRepository, Categoria $categoria) {
        $form = $this->createForm(CategoriaType::class, $categoria);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $categoriaRepository->guardar();
                return $this->redirectToRoute('categoria_listar');
            } catch (\Exception $exception) {

            }
        }

        return $this->render('categoria/modificar.html.twig', [
            'categoria' => $categoria,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/categoria/eliminar/{id}", name="categoria_eliminar")
     * @Security("is_granted('ROLE_GERENTE')")
     */
    public function eliminarCategoria(Request $request, CategoriaRepository $categoriaRepository, Categoria $categoria) : Response {
        if ($request->get('confirmar', false)) {
            try {
                $categoriaRepository->eliminar($categoria);
                return $this->redirectToRoute('categoria_listar');
            } catch (\Exception $e) {

            }
        }
        return $this->render('categoria/eliminar.html.twig', [
            'categoria' => $categoria
        ]);
    }
}