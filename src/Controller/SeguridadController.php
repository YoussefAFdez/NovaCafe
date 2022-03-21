<?php

namespace App\Controller;

use App\Entity\Empleado;
use App\Form\EmpleadoType;
use App\Repository\EmpleadoRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SeguridadController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils) : Response {
        return $this->render('seguridad/login.html.twig', [
            'error' => $authenticationUtils->getLastAuthenticationError(),
            'last_user' => $authenticationUtils->getLastUsername()
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout() : Response {
        throw new AccessDeniedHttpException();
    }

    /**
     * @Route("/clave/cambio", name="cambio_clave")
     * @Security("is_granted('ROLE_EMPLEADO')")
     */
    public function cambioClave(Request $request, EmpleadoRepository $empleadoRepository, UserPasswordEncoderInterface $userPasswordEncoder) : Response {
        $usuario = $this->getUser();
        $empleado = $empleadoRepository->findEmpleado($usuario->getUsername());

        $form = $this->createForm(EmpleadoType::class, $usuario, [
            'mode' => 'edit'
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $empleado->setClave(
                    $userPasswordEncoder->encodePassword(
                        $empleado, $form->get('clave')->get('first')->getData()
                    )
                );
                $empleadoRepository->guardar();
                return $this->redirectToRoute('principal');
            } catch (\Exception $exception) {

            }
        }

        return $this->render('seguridad/cambioClave.html.twig', [
            'empleado' => $empleado,
            'form' => $form->createView(),
        ]);
    }

}