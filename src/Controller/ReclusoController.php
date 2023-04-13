<?php

namespace App\Controller;

use App\Entity\Recluso;
use App\Form\ReclusoType;
use App\Repository\ReclusoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/recluso')]
class ReclusoController extends AbstractController
{
    #[Route('/', name: 'app_recluso_index', methods: ['GET'])]
    public function index(ReclusoRepository $reclusoRepository): Response
    {
        if ($this->isGranted('ROLE_ADMIN') || $this->isGranted('ROLE_VIGIA')) {

            return $this->render('recluso/index.html.twig', [
                'reclusos' => $reclusoRepository->findAll(),
            ]);
        } else {
            return $this->render('usuario/accesDenied.html.twig');
        }
    }

    #[Route('/new', name: 'app_recluso_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ReclusoRepository $reclusoRepository): Response
    {
        if ($this->isGranted('ROLE_ADMIN') || $this->isGranted('ROLE_VIGIA')) {

            $recluso = new Recluso();
            $form = $this->createForm(ReclusoType::class, $recluso);
            $form->handleRequest($request);
            
            if ($form->isSubmitted() && $form->isValid()) {
                $reclusoRepository->save($recluso, true);

                return $this->redirectToRoute('app_recluso_index', [], Response::HTTP_SEE_OTHER);
            }

            return $this->renderForm('recluso/new.html.twig', [
                'recluso' => $recluso,
                'form' => $form,
            ]);
        } else {
            return $this->render('usuario/accesDenied.html.twig');
        }
    }

    #[Route('/{idRecluso}', name: 'app_recluso_show', methods: ['GET'])]
    public function show(Recluso $recluso): Response
    {
        if ($this->isGranted('ROLE_ADMIN') || $this->isGranted('ROLE_VIGIA')) {


            return $this->render('recluso/show.html.twig', [
                'recluso' => $recluso,
            ]);
        } else {
            return $this->render('usuario/accesDenied.html.twig');
        }
    }

    #[Route('/{idRecluso}/edit', name: 'app_recluso_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Recluso $recluso, ReclusoRepository $reclusoRepository): Response
    {
        if ($this->isGranted('ROLE_ADMIN') || $this->isGranted('ROLE_VIGIA')) {


            $form = $this->createForm(ReclusoType::class, $recluso);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $reclusoRepository->save($recluso, true);

                return $this->redirectToRoute('app_recluso_index', [], Response::HTTP_SEE_OTHER);
            }

            return $this->renderForm('recluso/edit.html.twig', [
                'recluso' => $recluso,
                'form' => $form,
            ]);
        } else {
            return $this->render('usuario/accesDenied.html.twig');
        }
    }

    #[Route('/{idRecluso}', name: 'app_recluso_delete', methods: ['POST'])]
    public function delete(Request $request, Recluso $recluso, ReclusoRepository $reclusoRepository): Response
    {
        if ($this->isGranted('ROLE_ADMIN') || $this->isGranted('ROLE_VIGIA')) {

            if ($this->isCsrfTokenValid('delete' . $recluso->getIdRecluso(), $request->request->get('_token'))) {
                $reclusoRepository->remove($recluso, true);
            }

            return $this->redirectToRoute('app_recluso_index', [], Response::HTTP_SEE_OTHER);
        } else {
            return $this->render('usuario/accesDenied.html.twig');
        }
    }
}
