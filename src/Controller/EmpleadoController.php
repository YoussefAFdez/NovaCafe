<?php

namespace App\Controller;

use App\Entity\Empleado;
use App\Form\EmpleadoType;
use App\Repository\EmpleadoRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class EmpleadoController extends AbstractController
{
    /**
     * @Route("/empleado", name="empleado_listar")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function listarEmpleados(EmpleadoRepository $empleadoRepository) : Response {
        $empleados = $empleadoRepository->findAllOrdenados();
        $usuario = $this->getUser();

        return $this->render("empleado/listar.html.twig", [
            'empleados' => $empleados,
            'usuario' => $usuario
        ]);
    }

    /**
     * @Route("/empleado/ventas/{id}", name="empleado_ventas")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function ventasEmpleado(EmpleadoRepository $empleadoRepository, Empleado $empleado) {
        $ventas = $empleadoRepository->findVentasEmpleado($empleado);
        return $this->render("empleado/ventas.html.twig", [
            'ventas' => $ventas,
            'empleado' => $empleado
        ]);
    }

    /**
     * @Route("/empleado/categorias/{id}", name="empleado_categorias")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function categoriasEmpleado(EmpleadoRepository $empleadoRepository, Empleado $empleado) {
        $categorias = $empleadoRepository->findCategoriasEmpleado($empleado);
        return $this->render("empleado/categorias.html.twig", [
            'categorias' => $categorias,
            'empleado' => $empleado
        ]);

    }

    /**
     * @Route("/empleado/modificar/{id}", name="empleado_modificar")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function modificarEmpleado(Request $request, UserPasswordEncoderInterface $userPasswordEncoder, EmpleadoRepository $empleadoRepository, Empleado $empleado) {
        $form = $this->createForm(EmpleadoType::class, $empleado);
        $form->handleRequest($request);

        $usuario = $this->getUser();

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $empleado->setClave(
                    $userPasswordEncoder->encodePassword(
                        $empleado, $form->get('clave')->get('first')->getData()
                    )
                );
                $empleadoRepository->guardar();
                return $this->redirectToRoute('empleado_listar');
            } catch (\Exception $exception) {

            }
        }

        return $this->render('empleado/modificar.html.twig', [
            'empleado' => $empleado,
            'form' => $form->createView(),
            'usuario' => $usuario
        ]);
    }

    /**
     * @Route("/empleado/nuevo", name="empleado_nuevo")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function nuevoEmpleado(Request $request, UserPasswordEncoderInterface $userPasswordEncoder, EmpleadoRepository $empleadoRepository) : Response {
        $empleado = $empleadoRepository->nuevo();
        return $this->modificarEmpleado($request, $userPasswordEncoder, $empleadoRepository, $empleado);
    }

    /**
     * @Route("/empleado/eliminar/{id}", name="empleado_eliminar")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function eliminarEmpleado(Request $request, EmpleadoRepository $empleadoRepository, Empleado $empleado) : Response {
        if ($request->get('confirmar', false)) {
            try {
                $empleadoRepository->eliminar($empleado);
                return $this->redirectToRoute('empleado_listar');
            } catch (\Exception $e) {

            }
        }
        return $this->render('empleado/eliminar.html.twig', [
            'empleado' => $empleado
        ]);
    }
}