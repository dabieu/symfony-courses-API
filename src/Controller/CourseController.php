<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Course;

/**
 * @Route("/courses", name="courses_")
 */
class CourseController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(): Response
    {
        $courses = $this->getDoctrine()->getRepository(Course::class)->findAll();

        return $this->json([
            'data' => $courses
        ]);
    }

    /**
     * @Route("/{courseId}", name="show", methods={"GET"})
     */
    public function show($courseId)
    {
        $course = $this->getDoctrine()->getRepository(Course::class)->find($courseId);

        return $this->json([
            'data' => $course
        ]);

    }

     /**
     * @Route("/", name="create", methods={"POST"})
     */
    public function create(Request $request)
    {
        $data = $request->request->all();

        $course = new Course();
        $course->setTitle($data['title']);
        $course->setDescription($data['description']);
        $course->setStartDate(\DateTime::createFromFormat('d-m-Y', $data['startdate']));
        $course->setEndDate(\DateTime::createFromFormat('d-m-Y', $data['enddate']));

        $doctrine = $this->getDoctrine()->getManager();

        $doctrine->persist($course);
        $doctrine->flush();

        return $this->json([
            'data' => 'Curso cadastrado com sucesso!'
        ]);
    }

     /**
     * @Route("/{courseId}", name="update", methods={"PUT", "PATCH"})
     */
    public function update($courseId, Request $request)
    {
        $data = $request->request->all();
        $doctrine = $this->getDoctrine();

        $course = $doctrine->getRepository(Course::class)->find($courseId);

        if($request->request->has('title'))
            $course->setTitle($data['title']);
            
        if($request->request->has('description'))
            $course->setDescription($data['description']);

        if($request->request->has('startdate'))    
            $course->setStartDate(\DateTime::createFromFormat('d-m-Y', $data['startdate']));

        if($request->request->has('enddate'))
            $course->setEndDate(\DateTime::createFromFormat('d-m-Y', $data['enddate']));

        $manager = $doctrine->getManager();
        $manager->flush();

        return $this->json([
            'data' => 'Curso atualizado com sucesso!'
        ]);

    }

    /**
     * @Route("/{courseId}", name="delete", methods={"DELETE"})
     */
    public function delete($courseId)
    {
        $doctrine = $this->getDoctrine();
        $course = $doctrine->getRepository(Course::class)->find($courseId);

        $manager = $doctrine->getManager();
        $manager->remove($course);
        $manager->flush();

        return $this->json([
            'data' => 'Curso removido com sucesso!'
        ]);
    }
}
