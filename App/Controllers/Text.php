<?php

namespace App\Controllers;

use App\Controller;

class Text extends Controller
{

    public $param;

    public function Index()
    {
        $this->view->param = 'Text' . '<br>' .__METHOD__;

        if(is_array($this->param)){

            foreach ($this->param as $key=>$param) {

                if(is_array($param)){

                    foreach ($param as $paramKey=>$value) {

                        $this->view->param .= '<br>' . $paramKey . ' = ' . $value;

                    }

                }else {

                    $this->view->param .= '<br>' . $key . ' = ' . $param;

                }

            }

        } else {

            $this->view->param .= '<br>' . $this->param;

        }

        $this->view->display(__DIR__ . '/../../templates/index.php');
    }

}