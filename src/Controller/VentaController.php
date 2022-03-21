<?php

namespace App\Controller;

use App\Entity\Venta;
use App\Form\VentaType;
use App\Repository\VentaRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VentaController extends AbstractController
{

    /**
     * @Route("/venta", name="venta_listar")
     * @Security("is_granted('ROLE_EMPLEADO'))
     */
    public function listarVentas(VentaRepository $ventaRepository) : Response {
        $ventas = $ventaRepository->findAllOrdenados();
        return $this->render('venta/listar.html.twig', [
           'ventas' => $ventas
        ]);
    }

    /**
     * @Route("/venta/nueva", name="venta_nueva")
     * @Security("is_granted('ROLE_EMPLEADO'))
     */
    public function nuevaVenta(Request $request, VentaRepository $ventaRepository) : Response {
        $venta = $ventaRepository->nuevo();
        return $this->modificarVenta($request, $ventaRepository, $venta);
    }

    /**
     * @Route("/venta/modificar/{id}", name="venta_modificar")
     * @Security("is_granted('ROLE_GERENTE'))
     */
    public function modificarVenta(Request $request, VentaRepository $ventaRepository, Venta $venta) {
        $form = $this->createForm(VentaType::class, $venta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $ventaRepository->guardar();
                return $this->redirectToRoute('venta_listar');
            } catch (\Exception $exception) {

            }
        }

        return $this->render('venta/modificar.html.twig', [
            'venta' => $venta,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/venta/eliminar/{id}", name="venta_eliminar")
     * @Security("is_granted('ROLE_EMPLEADO'))
     */
    public function eliminarVenta(Request $request, VentaRepository $ventaRepository, Venta $venta) : Response {
        if ($request->get('confirmar', false)) {
            try {
                $ventaRepository->eliminar($venta);
                return $this->redirectToRoute('venta_listar');
            } catch (\Exception $e) {

            }
        }
        return $this->render('venta/eliminar.html.twig', [
            'venta' => $venta
        ]);
    }
}