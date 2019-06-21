<?php

namespace App\Controllers;

use App\Controller;

class PageNotFound extends Controller
{
    public function Index()
    {
        $this->view->param = '404' . '<br>' .__METHOD__;
        $this->view->display(__DIR__ . '/../../templates/index.php');
    }

}