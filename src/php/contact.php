<?php
$array = array("firstName" => "", "name" => "", "email" => "", "phone" => "", "message" => "",
    "firstNameError" => "", "nameError" => "", "emailError" => "", "phoneError" => "", "messageError" => "",
    "isSuccess" => false);

$emailTo = "tallaedd@yahoo.fr";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $array["firstName"] = verifyInput($_POST["firstName"]);
    $array["name"] = verifyInput($_POST["name"]);
    $array["email"] = verifyInput($_POST["email"]);
    $array["phone"] = verifyInput($_POST["phone"]);
    $array["message"] = verifyInput($_POST["message"]);
    $array["isSuccess"] = true;
    $emailText = "";
    if (empty($array["firstName"])) {
        $array["firstNameError"] = "je veux connaitre ton Prénom";
        $array["isSuccess"] = false;
    } else {
        $emailText .= "FirstName: {$array["firstName"]}\n";
    }
    if (empty($array["name"])) {
        $array["nameError"] = "Et oui je veux connaitre meme ton nom";
        $array["isSuccess"] = false;
    } else {
        $emailText .= "Name: {$array["name"]}\n";
    }
    if (empty($array["message"])) {
        $array["messageError"] = "T' as pas entré de message";
        $array["isSuccess"] = false;
    } else {
        $emailText .= "Email: {$array["message"]} \n";
    }
    if (!isEmail($array["email"])) {
        $array["emailError"] = "Entre un Email valid Please";
        $array["isSuccess"] = false;
    } else {
        $emailText .= "Message: {$array["email"]}\n";
    }
    if (!isphone($array["phone"])) {
        //chiffres et espace
        $array["phoneError"] = "Entre un numero valide";
        $array["isSuccess"] = false;
    } else {
        $emailText .= "Phone: {$array["phone"]}\n";
    }

    if ($array["isSuccess"]) {
        //$array["firstName"] = $array["name"] = $array["email"] = $array["phone"] = $array["message"] = "";
        $headers = "From: {$array["firstName"]} {$array["name"]} <{$array["email"]}>\r\nReply-To: {$array["email"]}";
        mail($emailTo, "Hello World from mycv ", $emailText, $headers);
    }
    echo json_encode($array);  //the result
}


function verifyInput($var)
{
    $var = trim($var);
    $var = stripcslashes($var);
    $var = htmlspecialchars($var);
    return $var;
}

function isPhone($var)
{
    return preg_match("/^[0-9 ]*$/", $var);
}

function IsEmail($var)
{
    return filter_var($var, FILTER_VALIDATE_EMAIL);
}

?>