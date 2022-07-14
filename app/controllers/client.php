<?php

namespace Controller;


class Client {

    public function post()
    {
        session_start();

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
            if($Result['username'] === "artemis"){
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

