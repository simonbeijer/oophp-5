<?php

namespace Sibj\Blogg;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

require "function.php";


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
class BloggController implements AppInjectableInterface
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
     * Initialize the database.
     *
     * @return void
     */
    public function initialize() : void
    {
        $this->app->db->connect();
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
        $title = "Blogg | oophp";

        $sql = "SELECT * FROM content;";
        $resultset = $this->app->db->executeFetchAll($sql);
        $sql2 = "SELECT `slug` FROM `content`;";
        $slugs = $this->app->db->executeFetchAll($sql2);

        $data = [
            "resultset" => $resultset,
            "slugs" => $slugs,
        ];

        $this->app->page->add("blogg/header");

        $this->app->page->add("blogg/show-all", $data);
        $this->app->page->add("blogg/footer");


        return $this->app->page->render([
            "title" => $title,
        ]);
    }


    public function adminAction() : object
    {
        $title = "Blogg | oophp";

        $sql = "SELECT * FROM content;";
        $resultset = $this->app->db->executeFetchAll($sql);

        $data = [
            "resultset" => $resultset
        ];

        $this->app->page->add("blogg/header");
        $this->app->page->add("blogg/admin", $data);
        $this->app->page->add("blogg/footer");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function deleteActionGet() : object
    {
        $title = "Delete | oophp";

        $id = $this->app->request->getGet("id");

        $sql = "SELECT id, title FROM content WHERE id = ?;";

        $resultset = $this->app->db->executeFetch($sql, [$id]);

        $data = [
            "resultset" => $resultset,
            "id" => $id,
        ];


        $this->app->page->add("blogg/header");
        $this->app->page->add("blogg/delete", $data);
        $this->app->page->add("blogg/footer");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }


    public function deleteActionPost() : object
    {
        $title = "Delete | oophp";

        if (hasKeyPost("doDelete")) {
            $id = $this->app->request->getGet("id");
            $sql = "UPDATE content SET deleted=NOW() WHERE id=?;";
            $this->app->db->execute($sql, [$id]);
            return $this->app->response->redirect("blogg/admin");
        }

        return $this->app->page->render([
            "title" => $title,
        ]);
    }




    public function editAction() : object
    {
        $title = "Edit | oophp";

        $id = $_GET['id'];
        $sql = "SELECT * FROM content WHERE id = ?;";

        $resultset = $this->app->db->executeFetch($sql, [$id]);

        $sql2 = "SELECT `slug` FROM `content`;";
        $slugs = $this->app->db->executeFetchAll($sql2);

        $data = [
            "resultset" => $resultset,
            "id" => $id,
            "slugs" => $slugs,

        ];

        $this->app->page->add("blogg/header");
        $this->app->page->add("blogg/edit", $data);
        $this->app->page->add("blogg/footer");


        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function editActionPost() : object
    {
        $title = "Edit | oophp";

        // $id = $_GET['id'];
        $id = $this->app->request->getPost("id");
        $sql = "SELECT * FROM content WHERE id = ?;";

        $resultset = $this->app->db->executeFetch($sql, [$id]);

        $sql2 = "SELECT `slug` FROM `content`;";
        $slugs = $this->app->db->executeFetchAll($sql2);
        $tests = array_column($slugs, 'slug');
        $count = count($tests);

        $id = $this->app->request->getGet("id");


        $doDelete = $this->app->request->getPost("doDelete");
        $doSave = $this->app->request->getPost("doSave");
        if (isset($doDelete)) {
             return $this->app->response->redirect("blogg/delete?id=$id");
        } elseif (isset($doSave)) {
            $title = $this->app->request->getPost("contentTitle");
            $path = $this->app->request->getPost("contentPath");
            $slug = $this->app->request->getPost("contentSlug");
            $data = $this->app->request->getPost("contentData");
            $type = $this->app->request->getPost("contentType");
            $filter = $this->app->request->getPost("contentFilter");
            $publish = $this->app->request->getPost("contentPublish");
            $id = $this->app->request->getPost("contentId");
            $title = slugify($title);
            if ($slug) {
                for ($i=0; $i < $count; $i++) {
                    if ($slug == $tests[$i]) {
                        return $this->app->response->redirect("blogg/edit?id=$id&slug=$slug");
                    }
                }
            } elseif (!$slug) {
                        $slug = slugify($title);
            }
            if ($path == "") {
                    $path = null;
            }

                    $params = [$title, $path, $slug, $data, $type, $filter, $publish, $id];


                    $sql = "UPDATE content SET title=?, path=?, slug=?, data=?, type=?, filter=?, published=? WHERE id = ?;";
                    $this->app->db->execute($sql, array_values($params));
                    return $this->app->response->redirect("blogg/edit?id=$id");
        }

        $data = [
            "resultset" => $resultset,
            "id" => $id,
            "slug" => $slug,
        ];

        $this->app->page->add("blogg/header");
        $this->app->page->add("blogg/edit", $data);
        $this->app->page->add("blogg/footer");


        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function createAction() : object
    {
        $title = "Create | oophp";

        if (hasKeyPost("doCreate")) {
            $title = getPost("contentTitle");

            $sql = "INSERT INTO content (title) VALUES (?);";
            $this->app->db->execute($sql, [$title]);
            $id = $this->app->db->lastInsertId();
            return $this->app->response->redirect("blogg/edit?id=$id");
        }



        $this->app->page->add("blogg/header");
        $this->app->page->add("blogg/create");
        $this->app->page->add("blogg/footer");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }



    public function pagesActionGet() : object
    {
        $title = "View pages | oophp";
        $sql = <<<EOD
SELECT
    *,
    CASE
        WHEN (deleted <= NOW()) THEN "isDeleted"
        WHEN (published <= NOW()) THEN "isPublished"
        ELSE "notPublished"
    END AS status
FROM content
WHERE type=?
;
EOD;
        $resultset = $this->app->db->executeFetchAll($sql, ["page"]);

        $data = [
            "resultset" => $resultset,
        ];

        $this->app->page->add("blogg/header");
        $this->app->page->add("blogg/pages", $data);
        $this->app->page->add("blogg/footer");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }


    public function pageActionGet() : object
    {
        $title = "View page | oophp";
        $path = $this->app->request->getGet("path");
        if ($path == null) {
            return $this->app->response->redirect("blogg/");
        }

        $sql = <<<EOD
SELECT
    *,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS modified_iso8601,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS modified
FROM content
WHERE
    path = ?
    AND type = ?
    AND (deleted IS NULL OR deleted > NOW())
    AND published <= NOW()
;
EOD;

        $resultset = $this->app->db->executeFetchAll($sql, [$path, "page"]);
        $text = $resultset[0];
        $filter = new \Sibj\TextFilter\MyTextFilter();
        $html = $filter->parse($text->data, $text->filter);
        $data = [
            "resultset" => $resultset[0],
            "html" => $html,
            "text" => $text,
        ];

        $this->app->page->add("blogg/header");
        $this->app->page->add("blogg/page", $data);
        $this->app->page->add("blogg/footer");
        return $this->app->page->render([
            "title" => $title,
        ]);
    }


    public function blogActionGet() : object
    {
        $title = "Blogg | oophp";

        $sql = <<<EOD
SELECT
    *,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
FROM content
WHERE
        type=?
ORDER BY published DESC
;
EOD;
        $resultset = $this->app->db->executeFetchAll($sql, ["post"]);

        $text = $resultset[0];
        $filter = new \Sibj\TextFilter\MyTextFilter();
        $html = $filter->parse($text->data, $text->filter);

        $data = [
            "resultset" => $resultset,
            "html" => $html,
        ];

        $this->app->page->add("blogg/header");
        $this->app->page->add("blogg/blog", $data);
        $this->app->page->add("blogg/footer");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function blogPostActionGet($slug) : object
    {
        $title = "Blogg | oophp";

        $sql = <<<EOD
SELECT
    *,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
FROM content
WHERE
        slug=?
        AND
        type=?
ORDER BY published DESC
;
EOD;
        $resultset = $this->app->db->executeFetchAll($sql, [$slug, "post"]);
        $text = $resultset[0];
        $filter = new \Sibj\TextFilter\MyTextFilter();
        $html = $filter->parse($text->data, $text->filter);
        if (!$resultset) {
                $title = "404";
                $this->app->page->add("blogg/header");
                $this->app->page->add("blogg/404");
                $this->app->page->add("blogg/footer");
        }
        $data = [
            "resultset" => $resultset,
            "html" => $html,
        ];

        $this->app->page->add("blogg/header");
        $this->app->page->add("blogg/blog", $data);
        $this->app->page->add("blogg/footer");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }
}
