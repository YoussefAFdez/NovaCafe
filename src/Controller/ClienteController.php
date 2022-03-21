<?php

namespace App\Controller;

use App\Entity\Cliente;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClienteController extends AbstractController
{

    /**
     * @Route("/cliente", name="cliente_listar")
     */
    public function listarClientes(ClienteRepository $clienteRepository) : Response {
        $clientes = $clienteRepository->findAllOrdenados();
        return $this->render('cliente/listar.html.twig', [
           'clientes' => $clientes
        ]);
    }

    /**
     * @Route("/cliente/nuevo", name="cliente_nuevo")
     */
    public function nuevoCliente(Request $request, ClienteRepository $clienteRepository) : Response {
        $cliente = $clienteRepository->nuevo();
        return $this->nuevoCliente($request, $clienteRepository, $cliente);
    }

    /**
     * @Route("/cliente/modificar/{id}", name="cliente_modificar")
     */
    public function modificarCliente(Request $request, ClienteRepository $clienteRepository, Cliente $cliente) {
        $form = $this->createForm(CategoriaType::class, $cliente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $clienteRepository->guardar();
                return $this->redirectToRoute('cliente_listar');
            } catch (\Exception $exception) {

            }
        }

        return $this->render('cliente/modificar.html.twig', [
            'cliente' => $cliente,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/cliente/eliminar/{id}", name="cliente_eliminar")
     */
    public function eliminarCliente(Request $request, ClienteRepository $clienteRepository, Cliente $cliente) : Response {
        if ($request->get('confirmar', false)) {
            try {
                $clienteRepository->eliminar($cliente);
                return $this->redirectToRoute('cliente_listar');
            } catch (\Exception $e) {

            }
        }
        return $this->render('cliente/eliminar.html.twig', [
            'cliente' => $cliente
        ]);
    }
}