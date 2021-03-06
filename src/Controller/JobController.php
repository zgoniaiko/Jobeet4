<?php

namespace App\Controller;

use App\Entity\Job;
use App\Form\JobType;
use App\Repository\JobRepository;
use App\Repository\CategoryRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/job")
 */
class JobController extends Controller
{
    /**
     * @Route("/", name="job_index", methods="GET")
     * @View\Template()
     */
    public function index(CategoryRepository $categoryRepository): array
    {
        return ['categories' => $categoryRepository->findWithActiveJobs()];
    }

    /**
     * @Route("/new", name="job_new", methods="GET|POST")
     * @View\Template()
     */
    public function new(Request $request)
    {
        $job = new Job();
        $form = $this->createForm(JobType::class, $job);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($job);
            $em->flush();

            return $this->redirectToRoute('job_index');
        }

        return [
            'job' => $job,
            'form' => $form->createView(),
        ];
    }

    /**
     * @Route("/{id}", name="job_show", methods="GET", requirements={"id" = "\d+"})
     * @View\Template()
     *
     * @View\Entity("job", expr="repository.findActiveJob(id)")
     */
    public function show(Job $job): array
    {
        return ['job' => $job];
    }

    /**
     * @Route("/{id}/edit", name="job_edit", methods="GET|POST")
     * @View\Template()
     */
    public function edit(Request $request, Job $job)
    {
        $form = $this->createForm(JobType::class, $job);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('job_edit', ['id' => $job->getId()]);
        }

        return [
            'job' => $job,
            'form' => $form->createView(),
        ];
    }

    /**
     * @Route("/{id}", name="job_delete", methods="DELETE")
     */
    public function delete(Request $request, Job $job): Response
    {
        if ($this->isCsrfTokenValid('delete'.$job->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($job);
            $em->flush();
        }

        return $this->redirectToRoute('job_index');
    }
}
