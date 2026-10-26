<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MovieController extends AbstractController
{
    /** @return list<array{id: int, title: string, year: int, description: string}> */
    private function movies(): array
    {
        return [
            ['id' => 1, 'title' => 'Inception', 'year' => 2010, 'description' => 'Тестовое описание фильма Inception.'],
            ['id' => 2, 'title' => 'Interstellar', 'year' => 2014, 'description' => 'Тестовое описание фильма Interstellar.'],
            ['id' => 3, 'title' => 'The Matrix', 'year' => 1999, 'description' => 'Тестовое описание фильма The Matrix.'],
        ];
    }

    #[Route('/movies', name: 'movie_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('movie/index.html.twig', ['movies' => $this->movies()]);
    }

    #[Route('/movies/random', name: 'movie_random', methods: ['GET'])]
    public function random(): Response
    {
        $movies = $this->movies();

        return $this->render('movie/show.html.twig', ['movie' => $movies[array_rand($movies)]]);
    }

    #[Route('/movies/{id}', name: 'movie_show', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function show(int $id): Response
    {
        foreach ($this->movies() as $movie) {
            if ($movie['id'] === $id) {
                return $this->render('movie/show.html.twig', ['movie' => $movie]);
            }
        }

        throw $this->createNotFoundException('Фильм не найден.');
    }
}
