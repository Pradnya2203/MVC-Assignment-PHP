<?php

namespace Controller;

class AcceptReq{
    public function post(){
        session_start();
    if (!isset($_SESSION["Role"])) {
        echo \View\Loader::make()->render("templates/home.twig");
      } else {
    $bookname = $_POST["bookname"];
    $username = $_POST["username"];
    \Model\Book::setStatus($bookname,$username);
    \Model\Book:: setStartDate($bookname,$username);
    \Model\Book::updateNumber($bookname);
    echo "Accepted request";
    echo \View\Loader::make()->render("templates/home.twig");

    }
}
}