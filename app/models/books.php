<?php

namespace Model;


class Book
{

  public static function findAvailable()
  {
    $db = \DB::get_instance();
    $Sth = $db->prepare("SELECT * FROM Book");
    $Sth->execute();

    $Result = $Sth->fetchAll();
    //echo "job done";
    return $Result;
  }

  public static function addBookData($bookname, $number)
  {

    $db = \DB::get_instance();
    $stmt = $db->prepare("INSERT INTO Book (bookname, number) VALUES (?,?)");
    $stmt->execute([$bookname, $number]);

    return;
  }

  public static function myBooks($username)
  {
    $db = \DB::get_instance();
    $Sth = $db->prepare("SELECT * FROM books WHERE username ='$username' AND status = '1' ");
    $Sth->execute();
    $Result = $Sth->fetchAll();
    return $Result;
  }

  public static function requests()
  {
    $db = \DB::get_instance();
    $Sth = $db->prepare("SELECT * FROM books WHERE status='0'");
    $Sth->execute();

    $Result = $Sth->fetchAll();
    return $Result;
  }


  public static function checkIn($bookname,$username)
  {
    $db = \DB::get_instance();
    $stmt = $db->prepare("INSERT INTO books (bookname,username) VALUES (?,?)");
    $stmt->execute([$bookname, $username]);
    return;
  }

  public static function checkOut($bookname,$username,$fine)
  {
    date_default_timezone_set('Asia/Kolkata');
    $date = date('d-m-y h:i:s');
    $db = \DB::get_instance();
    $stmt = $db->prepare("DELETE FROM books WHERE username='$username' AND bookname='$bookname' ");
    //$stmt = $db->prepare("UPDATE Book SET number=number+1 WHERE bookname='$bookname'");
    $stmt->execute([$bookname, $username]);
    $stmt = $db->prepare("UPDATE books SET  returned_on='$date' WHERE username='$username' AND bookname='$bookname'");
    $stmt->execute([$date,$bookname, $username]);
    $stmt = $db->prepare("UPDATE Book SET number=number+1 WHERE bookname='$bookname'");
    $stmt->execute([$bookname]);
    $stmt = $db->prepare("UPDATE client SET fine=fine+$fine WHERE username='$username'");
    $stmt->execute([$username, $fine]);
    return;
  }

  public static function acceptReq($bookname,$username)
  {
    date_default_timezone_set('Asia/Kolkata');
    $date = date('d-m-y h:i:s');
    $db = \DB::get_instance();
    $stmt = $db->prepare("UPDATE books SET status='1' WHERE username='$username' AND bookname='$bookname'");
    $stmt->execute([$bookname, $username]);
    $stmt = $db->prepare("UPDATE books SET issued_on='$date' WHERE username='$username' AND bookname='$bookname'");
    $stmt->execute([$date,$bookname, $username]);
    $stmt = $db->prepare("UPDATE Book SET number=number-1 WHERE bookname='$bookname'");
    $stmt->execute([$bookname]);
    return;
  }

  public static function denyReq($bookname,$username)
  {
    $db = \DB::get_instance();
    $stmt = $db->prepare("DELETE FROM books WHERE username='$username' AND bookname='$bookname'");
    $stmt->execute([$bookname, $username]);
    return;
  }



}