<?php

namespace App;

require DOCUMENT_ROOT . '/App/autoload.php';

abstract class Controller
{

    protected $view;

    /**
     * Controller constructor.
     * @throws \Exception
     */
    public function __construct()
    {
         $this->view = new View();
    }

    abstract protected function index();

}