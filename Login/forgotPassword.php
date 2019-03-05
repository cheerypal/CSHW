<?php
/**
 * @author : Euan Gordon
 * @TODO : Create email script so that interface can send an email to me
 * @see : Does not need SQL
 */

$email = $_POST['email'];
$subject = "Forgot Password CSHW";
$message = "Please click this link here to reset your password \n
            http://www2.macs.hw.ac.uk/~ejg9/CSHW/Login/Reset/";
mail($email,$subject,$message);

echo "Email Successfully Sent";