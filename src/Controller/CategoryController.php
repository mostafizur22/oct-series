<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;

#[Route('/category', name:'category_')]
class CategoryController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();
        // var_dump ($categories);
        return $this->render('category/index.html.twig', [
            'categories' => $categories]);
    }

    #[Route('/show/{id<^[0-9]+$>}', name: 'show')]
    public function show($id, CategoryRepository $categoryRepository): Response
    {
        $category = $categoryRepository->findOneby(['id' => $id]);
        return $this->render('category/show.html.twig', ['category'=>$category]);
    }

}