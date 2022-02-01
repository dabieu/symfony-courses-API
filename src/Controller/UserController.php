<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;

/**
 * @Route("/users", name="users_")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(): Response
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->json([
            'data' => $users
        ]);
    }

    /**
     * @Route("/{userId}", name="show", methods={"GET"})
     */
    public function show($userId)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($userId);

        return $this->json([
            'data' => $user
        ]);
    }

    /**
     * @Route("/", name="create", methods={"POST"})
     */
    public function create(Request $request)
    {
        $data = $request->request->all();

        $user = new User();
        $user->setName($data['name']);
        $user->setEmail($data['email']);
        $user->setStatus($data['status']);

        $doctrine = $this->getDoctrine()->getManager();

        $doctrine->persist($user);
        $doctrine->flush();

        return $this->json([
            'data' => 'Usuário cadastrado com sucesso!'
        ]);
    }

    /**
     * @Route("/{userId}", name="update", methods={"PUT", "PATCH"})
     */
    public function update($userId, Request $request)
    {
        $data = $request->request->all();
        $doctrine = $this->getDoctrine();

        $user = $doctrine->getRepository(User::class)->find($userId);

        if($request->request->has('name'))
            $user->setName($data['name']);
            
        if($request->request->has('email'))
            $user->setEmail($data['email']);

        if($request->request->has('status'))
            $user->setStatus($data['status']);

        $manager = $doctrine->getManager();
        $manager->flush();

        return $this->json([
            'data' => 'Usuário atualizado com sucesso!'
        ]);

    }

    /**
     * @Route("/{userId}", name="delete", methods={"DELETE"})
     */
    public function delete($userId)
    {
        $doctrine = $this->getDoctrine();
        $user = $doctrine->getRepository(User::class)->find($userId);

        $manager = $doctrine->getManager();
        $manager->remove($user);
        $manager->flush();

        return $this->json([
            'data' => 'Usuário removido com sucesso!'
        ]);
    }
}
