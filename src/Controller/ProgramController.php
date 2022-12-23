<?php

namespace App\Controller;

// use App\Entity\Program;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProgramRepository;
#[Route('/program', name:'program_')]
class ProgramController extends AbstractController
{
  #[Route('/', name: 'index')]
    public function index( ProgramRepository $programRepository):Response
  {
    // querying program.
    $programs = $programRepository->findAll();
    
    // return new Response('<html><body>Wild Series Index</body></html>');
    return $this->render('program/index.html.twig', array('programs' =>$programs));

  }

  #[Route('/{id<\d+>}', methods:['GET'], name: 'show')]
    public function show($id, ProgramRepository $programRepository):Response
  {
    $program = $programRepository->findOneBy(['id'=>$id]);
    if (!$program){
      throw $this->createNotFoundException('No program with id : '.$id.' found in program\'s table.');
    }
    // return new Response('<html><body>Wild Series Index</body></html>');
    return $this->render('program/show.html.twig', ['program' => $program]);

  }
}


