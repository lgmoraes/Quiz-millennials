<?php

/**
 * Gère les class Movie et DetailedMovie
 */
class MoviesManager
{
    /**
     * Retourne le film correspondant au nameId
     * 
     * @return Movie
     */
    public static function getMovieByNameId($nameId)
    {
        $db = DB::getInstance();

        $response = $db->prepare('SELECT * FROM movies WHERE nameId = :nameId');
        $response->execute(array('nameId' => $nameId));

        return new Movie($response->fetch(PDO::FETCH_ASSOC));
    }

    /**
     * Retourne la totalité des films de la base de données dans un tableau
     * 
     * @return array Tableau de films
     */
    public static function getAllMovies()
    {
        $db = DB::getInstance();
        $movies = [];

        $response = $db->query('SELECT * FROM movies');

        while ($data =  $response->fetch(PDO::FETCH_ASSOC)) {
            array_push($movies, new Movie($data));
        }

        return $movies;
    }

    /**
     * Retourne des nameId de film au hasard
     * 
     * @return array Tableau d'id
     */
    public static function getRandomMovieIds($nb = NB_QUESTIONS)
    {
        $db = DB::getInstance();
        $movieIds = [];

        $response = $db->query('SELECT nameId FROM movies');
        $data = $response->fetchAll(PDO::FETCH_ASSOC);

        shuffle($data);

        for ($i = 0; $i < $nb; $i++) {
            array_push($movieIds, $data[$i]['nameId']);
        }

        return $movieIds;
    }

    /**
     * Retourne la bonne réponse ainsi que 3 fausses réponses choisies au hasard
     * 
     * @return array Tableau de chaine
     */
    public static function getResponses(Movie $movie)
    {
        $responses = [];
        $falseResponses = $movie->falseResponses();

        shuffle($falseResponses);
        $responses = array_slice($falseResponses, 0, 3);
        array_splice($responses, random_int(0, 2), 0, $movie->name());

        return $responses;
    }
}
