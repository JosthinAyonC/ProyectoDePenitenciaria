<?php

namespace App\Controller;

use App\Entity\Pabellon;
use App\Form\PabellonType;
use App\Repository\PabellonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/pabellon')]
class PabellonController extends AbstractController
{
    #[Route('/', name: 'app_pabellon_index', methods: ['GET'])]
    public function index(PabellonRepository $pabellonRepository): Response
    {
        if ($this->isGranted('ROLE_ADMIN') || $this->isGranted('ROLE_GUARDIA')) {


            return $this->render('pabellon/index.html.twig', [
                'pabellons' => $pabellonRepository->findAll(),
            ]);
        } else {
            return $this->render('usuario/accesDenied.html.twig');
        }
    }

    #[Route('/new', name: 'app_pabellon_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PabellonRepository $pabellonRepository): Response
    {
        if ($this->isGranted('ROLE_ADMIN') || $this->isGranted('ROLE_GUARDIA')) {


            $pabellon = new Pabellon();
            $form = $this->createForm(PabellonType::class, $pabellon);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $pabellonRepository->save($pabellon, true);

                return $this->redirectToRoute('app_pabellon_index', [], Response::HTTP_SEE_OTHER);
            }

            return $this->renderForm('pabellon/new.html.twig', [
                'pabellon' => $pabellon,
                'form' => $form,
            ]);
        } else {
            return $this->render('usuario/accesDenied.html.twig');
        }
    }

    #[Route('/{idPabellon}', name: 'app_pabellon_show', methods: ['GET'])]
    public function show(Pabellon $pabellon): Response
    {
        if ($this->isGranted('ROLE_ADMIN') || $this->isGranted('ROLE_GUARDIA')){
            
            
            return $this->render('pabellon/show.html.twig', [
                'pabellon' => $pabellon,
            ]);
            
        } else {
            return $this->render('usuario/accesDenied.html.twig');
        }
    }

    #[Route('/{idPabellon}/edit', name: 'app_pabellon_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Pabellon $pabellon, PabellonRepository $pabellonRepository): Response
    {
        if ($this->isGranted('ROLE_ADMIN') || $this->isGranted('ROLE_GUARDIA')){
            
            
            $form = $this->createForm(PabellonType::class, $pabellon);
            $form->handleRequest($request);
    
            if ($form->isSubmitted() && $form->isValid()) {
                $pabellonRepository->save($pabellon, true);
    
                return $this->redirectToRoute('app_pabellon_index', [], Response::HTTP_SEE_OTHER);
            }
    
            return $this->renderForm('pabellon/edit.html.twig', [
                'pabellon' => $pabellon,
                'form' => $form,
            ]);
            
        } else {
            return $this->render('usuario/accesDenied.html.twig');
        }
    }

    #[Route('/{idPabellon}', name: 'app_pabellon_delete', methods: ['POST'])]
    public function delete(Request $request, Pabellon $pabellon, PabellonRepository $pabellonRepository): Response
    {
        if ($this->isGranted('ROLE_ADMIN') || $this->isGranted('ROLE_GUARDIA')){
            
            
            if ($this->isCsrfTokenValid('delete' . $pabellon->getIdPabellon(), $request->request->get('_token'))) {
                $pabellonRepository->remove($pabellon, true);
            }
    
            return $this->redirectToRoute('app_pabellon_index', [], Response::HTTP_SEE_OTHER);
            
        } else {
            return $this->render('usuario/accesDenied.html.twig');
        }
    }
}
