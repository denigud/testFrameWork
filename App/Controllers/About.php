<?php

namespace App\Controllers;

use App\Controller;

class About extends Controller
{
    public function Index()
    {
        $this->view->param = 'About' . '<br>' .__METHOD__;
        $this->view->display(__DIR__ . '/../../templates/index.php');
    }

    public function Handle()
    {
        $this->view->param = 'About' . '<br>' .__METHOD__;
        $this->view->display(__DIR__ . '/../../templates/index.php');
    }
}