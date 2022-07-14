<?php

namespace Controller;

class CheckIn{
    

    public function post()
    {
        $bookname = $_POST["bookname"];
        $username = $_POST["username"];
        \Model\Book::checkIn($bookname,$username);
        echo "Check in request sent";

        echo \View\Loader::make()->render("templates/home.twig");
    }

}