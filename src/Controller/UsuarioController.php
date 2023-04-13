<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Form\UsuarioType;
use App\Repository\UsuarioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/usuario')]
class UsuarioController extends AbstractController
{
    #[Route('/', name: 'app_usuario_index', methods: ['GET'])]
    public function index(UsuarioRepository $usuarioRepository): Response
    {
        if ($this->isGranted('ROLE_ADMIN') || $this->isGranted('ROLE_VIGIA')) {


            return $this->render('usuario/index.html.twig', [
                'usuarios' => $usuarioRepository->findAll(),
            ]);
        } else {
            return $this->render('usuario/accesDenied.html.twig');
        }
    }

    #[Route('/new', name: 'app_usuario_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UsuarioRepository $usuarioRepository, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        if ($this->isGranted('ROLE_ADMIN')) {

            $usuario = new Usuario();
            $form = $this->createForm(UsuarioType::class, $usuario);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $usuario->setEstado('A');
                $usuario->setRoles(['ROLE_VIGIA']);

                $usuario->setClave(
                    $userPasswordHasher->hashPassword(
                        $usuario,
                        $form->get('clave')->getData()
                    )
                );

                $usuarioRepository->save($usuario, true);

                return $this->redirectToRoute('app_usuario_index', [], Response::HTTP_SEE_OTHER);
            }

            return $this->renderForm('usuario/new.html.twig', [
                'usuario' => $usuario,
                'form' => $form,
            ]);
        } else if ($this->isGranted('ROLE_VIGIA')) {

            $usuario = new Usuario();
            $form = $this->createForm(UsuarioType::class, $usuario);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $usuario->setEstado('A');
                $usuario->setRoles(['ROLE_GUARDIA']);
                $usuarioRepository->save($usuario, true);

                return $this->redirectToRoute('app_usuario_index', [], Response::HTTP_SEE_OTHER);
            }

            return $this->renderForm('usuario/newGuardia.html.twig', [
                'usuario' => $usuario,
                'form' => $form,
            ]);
        } else {
            return $this->render('usuario/accesDenied.html.twig');
        }
    }

    #[Route('/{idUsuario}', name: 'app_usuario_show', methods: ['GET'])]
    public function show(Usuario $usuario): Response
    {
        if ($this->isGranted('ROLE_ADMIN') || $this->isGranted('ROLE_VIGIA')) {
            return $this->render('usuario/show.html.twig', [
                'usuario' => $usuario,
            ]);
        } else {
            return $this->render('usuario/accesDenied.html.twig');
        }
    }

    #[Route('/{idUsuario}/edit', name: 'app_usuario_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Usuario $usuario, UsuarioRepository $usuarioRepository): Response
    {
        if ($this->isGranted('ROLE_ADMIN') || $this->isGranted('ROLE_VIGIA')) {
            $form = $this->createForm(UsuarioType::class, $usuario);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $usuarioRepository->save($usuario, true);

                return $this->redirectToRoute('app_usuario_index', [], Response::HTTP_SEE_OTHER);
            }

            return $this->renderForm('usuario/edit.html.twig', [
                'usuario' => $usuario,
                'form' => $form,
            ]);
        } else {
            return $this->render('usuario/accesDenied.html.twig');
        }
    }

    #[Route('/{idUsuario}', name: 'app_usuario_delete', methods: ['POST'])]
    public function delete(Request $request, Usuario $usuario, UsuarioRepository $usuarioRepository): Response
    {
        if ($this->isGranted('ROLE_ADMIN') || $this->isGranted('ROLE_VIGIA')) {
            if ($this->isCsrfTokenValid('delete' . $usuario->getIdUsuario(), $request->request->get('_token'))) {
                $usuarioRepository->remove($usuario, true);
            }

            return $this->redirectToRoute('app_usuario_index', [], Response::HTTP_SEE_OTHER);
        }
    }
}
