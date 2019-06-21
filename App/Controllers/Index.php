<?php

namespace App\Controllers;

use App\Controller;

class Index extends Controller
{
    public function Index()
    {
        $this->view->param = 'Index' . '<br>' .__METHOD__;;
        $this->view->display(__DIR__ . '/../../templates/index.php');
    }
}