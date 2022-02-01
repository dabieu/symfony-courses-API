<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Account;

/**
 * @Route("/api/accounts", name="accounts_")
 */
class AccountController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(): Response
    {
        $accounts = $this->getDoctrine()->getRepository(Account::class)->findAll();

        return $this->json([
            'data' => $accounts
        ]);
    }

    /**
     * @Route("/{accountId}", name="show", methods={"GET"})
     */
    public function show($accountId)
    {
        $account = $this->getDoctrine()->getRepository(Account::class)->find($accountId);

        return $this->json([
            'data' => $account
        ]);
    }

    /**
     * @Route("/", name="create", methods={"POST"})
     */
    public function create(Request $request)
    {
        $data = $request->request->all();

        $account = new Account();
        $account->setName($data['name']);
        $account->setEmail($data['email']);
        $account->setStatus($data['status']);

        $doctrine = $this->getDoctrine()->getManager();

        $doctrine->persist($account);
        $doctrine->flush();

        return $this->json([
            'data' => 'Usuário cadastrado com sucesso!'
        ]);
    }

    /**
     * @Route("/{accountId}", name="update", methods={"PUT", "PATCH"})
     */
    public function update($accountId, Request $request)
    {
        $data = $request->request->all();
        $doctrine = $this->getDoctrine();

        $account = $doctrine->getRepository(Account::class)->find($accountId);

        if($request->request->has('name'))
            $account->setName($data['name']);
            
        if($request->request->has('email'))
            $account->setEmail($data['email']);

        if($request->request->has('status'))
            $account->setStatus($data['status']);

        $manager = $doctrine->getManager();
        $manager->flush();

        return $this->json([
            'data' => 'Usuário atualizado com sucesso!'
        ]);

    }

    /**
     * @Route("/{accountId}", name="delete", methods={"DELETE"})
     */
    public function delete($accountId)
    {
        $doctrine = $this->getDoctrine();
        $account = $doctrine->getRepository(Account::class)->find($accountId);

        $manager = $doctrine->getManager();
        $manager->remove($account);
        $manager->flush();

        return $this->json([
            'data' => 'Usuário removido com sucesso!'
        ]);
    }
}
