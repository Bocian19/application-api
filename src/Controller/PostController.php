<?php

namespace App\Controller;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/lista", name="lista")
     */
    public function showPosts(EntityManagerInterface $entityManager): Response
    {

        $posts = $entityManager->getRepository(Post::class)->findAll();


        return $this->render('/lista.html.twig', ['posts' => $posts]);
    }


    /**
     * @Route("/delete/{id}", name="delete-post")
     */
    public function deletePost(int $id, EntityManagerInterface $entityManager): \Symfony\Component\HttpFoundation\RedirectResponse
    {

        $post = $entityManager->getRepository(Post::class)->find($id);
        $entityManager->remove($post);
        $entityManager->flush();

        return $this->redirectToRoute('lista');

    }

}