<?php
/**
 * Created by PhpStorm.
 * User: Euan Gordon
 * Date: 10/02/2019
 * Time: 20:07
 */
require_once("configureDataBase.php");

$username = $_POST['username'];
$firstName= $_POST['firstName'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$password = $_POST['password'];
$yearOfStudy = $_POST['yearOfStudy'];
$subject = $_POST['subject'];

$encryptedPass = password_hash($password, PASSWORD_DEFAULT);

$stmt = $con->prepare("INSERT INTO  Users(username, firstName, surname, email, password, yearOfStudy, subject) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssis", $username, $firstName, $surname, $email, $encryptedPass, $yearOfStudy, $subject);
$stmt->execute();


