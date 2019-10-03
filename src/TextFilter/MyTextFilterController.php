<?php

namespace Sibj\TextFilter;

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
class MyTextFilterController implements AppInjectableInterface
{
    use AppInjectableTrait;


    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object
     */
    public function indexAction() : object
    {
        $title = "TextFilter index";

        $this->app->page->add("textfilter/index");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function bbcodeAction() : object
    {
        $title = "TextFilter bbcode";

        $this->app->page->add("textfilter/bbcode");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function clickableAction() : object
    {
        $title = "TextFilter link";

        $this->app->page->add("textfilter/clickable");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function sampleAction() : object
    {
        $title = "TextFilter markdown";

        $this->app->page->add("textfilter/sample");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function nl2brAction() : object
    {
        $title = "TextFilter nl2br";

        $this->app->page->add("textfilter/nl2br");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }
}
