<?php
    function OpenCon()
     {
     $dbhost = " ";
     $dbuser = " ";
     $dbpass = " ";
     $db = " - ";
     $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
     
     return $conn;
     }
     
    function CloseCon($conn)
     {
     $conn -> close();
     }

     function OpenCon2()
     {
     $dbhost = " ";
     $dbuser = " ";
     $dbpass = " !";
     $db = " - - ";
     $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
     
     return $conn;
     }

    ?>