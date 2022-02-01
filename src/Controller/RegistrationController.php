<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use App\Entity\Registration;
use App\Entity\Course;
use App\Entity\Student;
use App\Entity\User;

/**
 * @Route("/registrations", name="registrations_")
 */
class RegistrationController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(): Response
    {
        $registrations = $this->getDoctrine()->getRepository(Registration::class)->findAll();

        return $this->json([
            'data' => $registrations
        ], 200, [], [ObjectNormalizer::CIRCULAR_REFERENCE_HANDLER => function($object){
            return $object->getId();
        }]);
    }

    /**
     * @Route("/{registrationId}", name="show", methods={"GET"})
     */
    public function show($registrationId)
    {
        $registration = $this->getDoctrine()->getRepository(Registration::class)->find($registrationId);

        return $this->json([
            'data' => $registration
        ], 200, [], [ObjectNormalizer::CIRCULAR_REFERENCE_HANDLER => function($object){
            return $object->getId();
        }]);
    }

     /**
     * @Route("/", name="create", methods={"POST"})
     */
    public function create(Request $request)
    {
        $data = $request->request->all();
        $doctrine = $this->getDoctrine();

        $course = $doctrine->getRepository(Course::class)->find($data['courseid']);
        $student = $doctrine->getRepository(Student::class)->find($data['studentid']);
        $user = $doctrine->getRepository(User::class)->find($data['userid']);

        $registration = new Registration();
        $registration->setCourseid($course);
        $registration->setStudentid($student);
        $registration->setUserid($user);
        $registration->setRegistrationDate(new \DateTime('now', new \DateTimeZone('America/Sao_Paulo')));

        $manager = $doctrine->getManager();

        $manager->persist($registration);
        $manager->flush();

        return $this->json([
            'data' => 'Matrícula cadastrada com sucesso!'
        ]);
    }

    /**
     * @Route("/{registrationId}", name="update", methods={"PUT", "PATCH"})
     */
    public function update($registrationId, Request $request)
    {
        $data = $request->request->all();
        $doctrine = $this->getDoctrine();

        $registration = $doctrine->getRepository(Registration::class)->find($registrationId);

        if($request->request->has('courseid'))
            $course = $doctrine->getRepository(Course::class)->find($data['courseid']);
            $registration->setCourseid($course);
            
        if($request->request->has('studentid'))
            $student = $doctrine->getRepository(Student::class)->find($data['studentid']);
            $registration->setStudentid($student);

        if($request->request->has('userid'))
            $user = $doctrine->getRepository(User::class)->find($data['userid']);
            $registration->setUserid($user);

        $manager = $doctrine->getManager();
        $manager->flush();

        return $this->json([
            'data' => 'Matrícula atualizada com sucesso!'
        ]);

    }

    /**
     * @Route("/{registrationId}", name="delete", methods={"DELETE"})
     */
    public function delete($registrationId)
    {
        $doctrine = $this->getDoctrine();
        $registration = $doctrine->getRepository(Registration::class)->find($registrationId);

        $manager = $doctrine->getManager();
        $manager->remove($registration);
        $manager->flush();

        return $this->json([
            'data' => 'Matrícula removida com sucesso!'
        ]);
    }
}
