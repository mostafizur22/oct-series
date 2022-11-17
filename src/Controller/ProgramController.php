<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/program', name:'program_')]
class ProgramController extends AbstractController
{
  #[Route('/', name: 'program_index')]
    public function index():Response
  {
    // return new Response('<html><body>Wild Series Index</body></html>');
    return $this->render('program/index.html.twig', ['website' => 'wild series']);

  }

  #[Route('/{id<\d+>}', methods:['GET'], name: 'program_show')]
    public function show($id):Response
  {
    
    // return new Response('<html><body>Wild Series Index</body></html>');
    return $this->render('program/show.html.twig', ['showProgram' => "program $id"]);

  }
}


