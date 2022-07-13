<?php

require __DIR__."/../vendor/autoload.php";


Toro::serve(array(
    "/" => "\Controller\Home",
    "/register" => "\Controller\Register",
    "/client" => "\Controller\Client",
    "/addBook" => "\Controller\Book",
    "/availablebook" => "\Controller\Book",
    "/checkIn" => "\Controller\CheckIn",
    "/checkOut" => "\Controller\CheckOut",
    "/acceptReq" => "\Controller\AcceptReq",
    "/denyReq" => "\Controller\DenyReq",
    
   
));
