<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Student;

/**
 * @Route("/students", name="students_")
 */
class StudentController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(): Response
    {
        $students = $this->getDoctrine()->getRepository(Student::class)->findAll();

        return $this->json([
            'data' => $students
        ]);
    }

    /**
     * @Route("/{studentId}", name="show", methods={"GET"})
     */
    public function show($studentId)
    {
        $student = $this->getDoctrine()->getRepository(Student::class)->find($studentId);

        return $this->json([
            'data' => $student
        ]);

    }

    /**
     * @Route("/", name="create", methods={"POST"})
     */
    public function create(Request $request)
    {
        $data = $request->request->all();

        $student = new Student();
        $student->setName($data['name']);
        $student->setEmail($data['email']);
        $student->setBirthdate(\DateTime::createFromFormat('d-m-Y', $data['birthdate']));
        $student->setStatus($data['status']);

        $doctrine = $this->getDoctrine()->getManager();

        $doctrine->persist($student);
        $doctrine->flush();

        return $this->json([
            'data' => 'Aluno cadastrado com sucesso!'
        ]);
    }

    /**
     * @Route("/{studentId}", name="update", methods={"PUT", "PATCH"})
     */
    public function update($studentId, Request $request)
    {
        $data = $request->request->all();
        $doctrine = $this->getDoctrine();

        $student = $doctrine->getRepository(Student::class)->find($studentId);

        if($request->request->has('name'))
            $student->setName($data['name']);
            
        if($request->request->has('email'))
            $student->setEmail($data['email']);

        if($request->request->has('birthdate'))
            $student->setBirthdate(\DateTime::createFromFormat('d-m-Y', $data['birthdate']));

        if($request->request->has('status'))
            $student->setStatus($data['status']);

        $manager = $doctrine->getManager();
        $manager->flush();

        return $this->json([
            'data' => 'Aluno atualizado com sucesso!'
        ]);

    }

    /**
     * @Route("/{studentId}", name="delete", methods={"DELETE"})
     */
    public function delete($studentId)
    {
        $doctrine = $this->getDoctrine();
        $student = $doctrine->getRepository(Student::class)->find($studentId);

        $manager = $doctrine->getManager();
        $manager->remove($student);
        $manager->flush();

        return $this->json([
            'data' => 'Aluno removido com sucesso!'
        ]);
    }
}
