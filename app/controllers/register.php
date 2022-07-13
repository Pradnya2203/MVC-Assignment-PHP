<?php

namespace Controller;


session_start();

class Register {
    public function get() {
        
        echo \View\Loader::make()->render("templates/register.twig");
      }
    public function post()
    {
        $Name = $_POST["name"];
        $Username = $_POST["username"];
        $Password = $_POST["password"];
        $Password = hash("sha512", $Password);

        \Model\Client::createUser($Name, $Username, $Password);
        echo "$Name Registered";
        echo \View\Loader::make()->render("templates/home.twig");
        session_destroy();
    }

}
