<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Repository\GenreRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class APIGenreController extends AbstractController
{
    /**
     * @Route("/api/genres", name="api_genres", methods={"GET"})
     */
    public function list(GenreRepository $repo, SerializerInterface $serializer)
    {
        $genres=$repo->findAll();
        $resultat=$serializer->serialize(
            $genres,
            'json',
            [
                'groups'=>['listGenreFull']
            ]
        );

        return new JsonResponse($resultat,200,[],true);
    }

    /**
     * @Route("/api/genres/{id}", name="api_show", methods={"GET"})
     */
    public function show(Genre $genre, GenreRepository $repo, SerializerInterface $serializer)
    {
        $resultat=$serializer->serialize(
            $genre,
            'json',
            [
                'groups'=>['listGenreSimple']
            ]
        );

        return new JsonResponse($resultat,200,[],true);
    }
}