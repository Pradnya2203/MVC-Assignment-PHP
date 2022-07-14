<?php

namespace Controller;

class DenyReq{

    public function post(){
        session_start();
        if (!isset($_SESSION["Role"])) {
            echo \View\Loader::make()->render("templates/home.twig");
          } else {

        $bookname = $_POST["bookname"];
        $username = $_POST["username"];
    
        \Model\Book::denyReq($bookname,$username);
        echo "Denied request";
    echo \View\Loader::make()->render("templates/home.twig");
    }
}

}
