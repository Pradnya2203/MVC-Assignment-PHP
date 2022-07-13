<?php

namespace Controller;

session_start();

class Client {

    // public function get() {    
    //     echo \View\Loader::make()->render("templates/client.twig");
    // }

    public function post()
    {
        $Username = $_POST["username"];
        $Password = $_POST["password"]; 
        $Result = \Model\Client::verifyLogin($Username, $Password);
        

        if ($Result['username'] == null) {
            echo "enter username";
            echo \View\Loader::make()->render("templates/home.twig");

        } 
        else if ($Result['password'] == null) {
            echo "enter password";
            echo \View\Loader::make()->render("templates/home.twig");

        }else if (hash("sha512", $Password) === $Result['password']) {

            $_SESSION["Username"] = $Username;
            $_SESSION["Role"] = "Admin";
            if($Result['username'] == "artemis"){
                echo \View\Loader::make()->render("templates/admin.twig",array(
                    "requests" => \Model\Book::requests(),
                    "booksavailable" => \Model\Book::findAvailable(),
                ));

            }else{
                $_SESSION["Username"] = $Username;
                echo \View\Loader::make()->render("templates/client.twig", array(
                    "client" => \Model\Client::verifyLogin($Username,$Password),
                    "booksavailable" => \Model\Book::findAvailable(),
                    "myBooks" =>  \Model\Book::myBooks($Username),
    
                ));
            }
        } else {
            echo "wrong pw";
            echo \View\Loader::make()->render("templates/home.twig", array(
                "wrongpw" => true,
            ));
        }
    }
}

class Book{


    public function get()
    {
        // if (!isset($_SESSION)) {
        //     echo \View\Loader::make()->render("templates/home.twig");
        // } else {
            //$Email = $_SESSION["UserEmail"];

            echo \View\Loader::make()->render("templates/book.twig", array(
                "booksavailable" => \Model\Book::findAvailable(),

            ));
        
    }


    public function post()
    {

         if (!isset($_SESSION["Role"])) {
           echo \View\Loader::make()->render("templates/home.twig");
         } else {

            $bookname = $_POST["bookname"];
            $number = $_POST["number"];

            if ($number < 0) {

                echo \View\Loader::make()->render("templates/admin.twig", array(
                    "invaliddata" => true,
                    "bookdata" =>  \Model\Book::findAvailable(),

                ));
            } else {
                \Model\Book::addBookData($bookname, $number);
                echo "added book data";

                 echo \View\Loader::make()->render("templates/home.twig", array(
                    

                 ));
            }
        }
    
    }


}

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

class CheckOut{

    public function post()
    {
        $bookname = $_POST["bookname"];
        $username = $_POST["username"];
        
        $client = \Model\Client::clientData($username);
        date_default_timezone_set('Asia/Kolkata');
        $date = date('d-m-y h:i:s');
        
        $fine=($client[4]('d') - $date('d'))*1;
        if($fine <=0){
            $fine=0;
        }

        \Model\Book::checkOut($bookname,$username,$fine);

        echo "$bookname Checked Out";
        echo \View\Loader::make()->render("templates/home.twig");
    }

}

class AcceptReq{
    public function post(){
    if (!isset($_SESSION["Role"])) {
        echo \View\Loader::make()->render("templates/home.twig");
      } else {


   
    $bookname = $_POST["bookname"];
    $username = $_POST["username"];

    \Model\Book::acceptReq($bookname,$username);
    echo "Accepted request";
    echo \View\Loader::make()->render("templates/home.twig");

    }
}
        

}

class DenyReq{

    public function post(){
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



