<?php

namespace Sibj\Movie;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $app if implementing the interface
 * AppInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class MovieController implements AppInjectableInterface
{
    use AppInjectableTrait;



    /**
     * @var string $db a sample member variable that gets initialised
     */


    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function indexAction()
    {
        // Deal with the action and return a response.
        return "Index!";
    }

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function indexActionGet() : object
    {
        $title = "Movie database | oophp";
        //
        $this->app->db->connect();
        $sql = "SELECT * FROM movie;";
        $resultset = $this->app->db->executeFetchAll($sql);

        $this->app->page->add("movie/index", [
            "resultset" => $resultset,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }






    public function searchTitleActionGet() : object
    {
        $session = $this->app->session;
        $title = "Search database | oophp";


        $searchTitle = $session->get("searchTitle");

        $resultset = $session->get("resultset");

        $session->set("resultset", null);

        $data = [
            "resultset" => $resultset ?? null,
            "searchTitle" => $searchTitle,
        ];

        $this->app->page->add("movie/search-title", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }


    public function searchTitleActionPost() : object
    {
        $request = $this->app->request;
        $session = $this->app->session;
        $response = $this->app->response;


        $searchTitle = $request->getPost("searchTitle");

        if ($searchTitle) {
            $this->app->db->connect();
            $sql = "SELECT * FROM movie WHERE title LIKE ?;";
            $resultset = $this->app->db->executeFetchAll($sql, [$searchTitle]);
        }
        $session->set("resultset", $resultset);

        return $response->redirect("movie/search-title");
    }



    public function searchYearActionGet() : object
    {
        $session = $this->app->session;
        $title = "Search database | oophp";

        $searchTitle = $session->get("searchTitle");
        $resultset = $session->get("resultset");

        $session->set("resultset", null);


        $data = [
            "resultset" => $resultset,
            "searchTitle" => $searchTitle,
        ];

        $this->app->page->add("movie/search-year", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }


    public function searchYearActionPost() : object
    {
        $request = $this->app->request;
        $session = $this->app->session;
        $response = $this->app->response;

        $session->set("resultset", $resultset);

        $year1 = $request->getPost("year1");
        $year2 = $request->getPost("year2");

        $this->app->db->connect();

        if ($year1 && $year2) {
            $sql = "SELECT * FROM movie WHERE year >= ? AND year <= ?;";
            $resultset = $this->app->db->executeFetchAll($sql, [$year1, $year2]);
        } elseif ($year1) {
            $sql = "SELECT * FROM movie WHERE year >= ?;";
            $resultset = $this->app->db->executeFetchAll($sql, [$year1]);
        } elseif ($year2) {
            $sql = "SELECT * FROM movie WHERE year <= ?;";
            $resultset = $this->app->db->executeFetchAll($sql, [$year2]);
        }
        $session->set("resultset", $resultset);

        return $response->redirect("movie/search-year");
    }



    public function movieSelectAction() : object
    {
        $request = $this->app->request;
        $response = $this->app->response;
        $title = "Select a movie | oophp";

        $this->app->db->connect();

        $movieId = $request->getPost("movieId");

        if ($request->getPost("doDelete")) {
            $sql = "DELETE FROM movie WHERE id = ?;";
            $this->app->db->execute($sql, [$movieId]);
            return $response->redirect("movie/movie-select");
        } elseif ($request->getPost("doAdd")) {
            $sql = "INSERT INTO movie (title, year, image) VALUES (?, ?, ?);";
            $this->app->db->execute($sql, ["A title", 2017, "img/noimage.png"]);
            $movieId = $this->app->db->lastInsertId();
            return $response->redirect("movie/movie-edit?movieId=$movieId");
        } elseif ($request->getPost("doEdit") && is_numeric($movieId)) {
            return $response->redirect("movie/movie-edit?movieId=$movieId");
        }


        $sql = "SELECT id, title FROM movie;";
        $movies = $this->app->db->executeFetchAll($sql);

        $this->app->page->add("movie/movie-select", [
            "movies" => $movies,
            "movieId" => $movieId,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }


    public function movieEditAction() : object
    {
        $request = $this->app->request;
        $response = $this->app->response;
        $title = "Edit database | oophp";

        $this->app->db->connect();

        $movieId    = $request->getPost("movieId") ?: $request->getGet("movieId");
        $movieTitle = $request->getPost("movieTitle");
        $movieYear  = $request->getPost("movieYear");
        $movieImage = $request->getPost("movieImage");


        if ($request->getPost("doSave")) {
            $sql = "UPDATE movie SET title = ?, year = ?, image = ? WHERE id = ?;";
            $this->app->db->execute($sql, [$movieTitle, $movieYear, $movieImage, $movieId]);
            return $response->redirect("movie/index");
        }

        $sql = "SELECT * FROM movie WHERE id = ?;";
        $movie = $this->app->db->executeFetchAll($sql, [$movieId]);
        $movie = $movie[0];

        $this->app->page->add("movie/movie-edit", [
            "movie" => $movie,
            "movieId" => $movieId,
            "movieTitle" => $movieTitle,
            "movieYear" => $movieYear,
            "movieImage" => $movieImage,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }
}
