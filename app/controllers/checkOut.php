<?php

namespace Controller;

class CheckOut{

    public function post()
    {
        $bookname = $_POST["bookname"];
        $username = $_POST["username"];
        
        $books = \Model\Book::booksData($username,$bookname);
        date_default_timezone_set('Asia/Kolkata');
        $date = date('d-m-y h:i:s');

        $fine = (($date-$books[3])/1000*60*60*24)-7;
        if($fine <=0){
            $fine=0;
        }

        \Model\Book::setDate($bookname,$username);
        \Model\Book::deleteBook($bookname,$username);
        \Model\Book::setFine($bookname,$fine);
        \Model\Book::updateBook($bookname);
    
        echo "$bookname Checked Out";
        echo \View\Loader::make()->render("templates/home.twig");
    }

}
