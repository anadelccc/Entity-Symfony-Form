<?php

namespace App\Controller;

use App\Entity\Formulario;
use App\Form\FormularioType;
use App\Repository\FormularioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/formulario')]
class FormularioController extends AbstractController
{
    #[Route('/', name: 'app_formulario_index', methods: ['GET'])]
    public function index(FormularioRepository $formularioRepository): Response
    {
        return $this->render('formulario/index.html.twig', [
            'formularios' => $formularioRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_formulario_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FormularioRepository $formularioRepository): Response
    {
        $formulario = new Formulario();
        $form = $this->createForm(FormularioType::class, $formulario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formularioRepository->save($formulario, true);

            return $this->redirectToRoute('app_formulario_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('formulario/new.html.twig', [
            'formulario' => $formulario,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_formulario_show', methods: ['GET'])]
    public function show(Formulario $formulario): Response
    {
        return $this->render('formulario/show.html.twig', [
            'formulario' => $formulario,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_formulario_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Formulario $formulario, FormularioRepository $formularioRepository): Response
    {
        $form = $this->createForm(FormularioType::class, $formulario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formularioRepository->save($formulario, true);

            return $this->redirectToRoute('app_formulario_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('formulario/edit.html.twig', [
            'formulario' => $formulario,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_formulario_delete', methods: ['POST'])]
    public function delete(Request $request, Formulario $formulario, FormularioRepository $formularioRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formulario->getId(), $request->request->get('_token'))) {
            $formularioRepository->remove($formulario, true);
        }

        return $this->redirectToRoute('app_formulario_index', [], Response::HTTP_SEE_OTHER);
    }
}
