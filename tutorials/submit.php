<?php


//check if request method of the 
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $firstName = htmlspecialchars($_POST["firstName"]);
    $lastName = htmlspecialchars($_POST["lastName"]);
    $favoritePet = htmlspecialchars($_POST["favoritePet"]);

    echo "These are the data that are submitted through the form ";
    echo "<br>";
    echo $firstName;
    echo "<br>";
    echo $lastName;
    echo "<br>";
    echo favoritePet;

    header("location : ../index.php");
}else{
    header("Location : ../index.php");
}