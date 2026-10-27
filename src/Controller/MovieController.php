<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MovieController extends AbstractController
{
    public function __construct(private MovieRepository $movieRepository)
    {
    }

    #[Route('/movies', name: 'movie_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('movie/index.html.twig', [
            'movies' => $this->movieRepository->findAll(),
        ]);
    }

    #[Route('/movies/random', name: 'movie_random', methods: ['GET'])]
    public function random(): Response
    {
        $movie = $this->movieRepository->findRandom();

        if ($movie === null) {
            throw $this->createNotFoundException('Фильмов пока нет.');
        }

        return $this->render('movie/show.html.twig', ['movie' => $movie]);
    }

    #[Route('/movies/{id}', name: 'movie_show', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function show(Movie $movie): Response
    {
        return $this->render('movie/show.html.twig', ['movie' => $movie]);
    }
}
