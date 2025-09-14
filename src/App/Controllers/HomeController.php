<?php

namespace App\Controllers;
use Framework\TemplateEngine;
use App\Config\Paths;




class HomeController
{
  

    public function __construct( private TemplateEngine $view)
    {   
        
       
    }


   public function home(): void
   {
        echo $this->view->render('index.php',[
            'title' => 'Welcome to Home Page from Home Controller',
            'content' => 'This is the content of the home page.'

        ]);
   }




}
