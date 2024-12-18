<?php
include 'connection.php'

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $firstname = $_POST['firstname'];
   $lastname = $_POST['lastname'];
   $country = $_POST['country'];
   $subject = $_POST['subject'];

   
   $sql = "INSERT INTO contact (firstname, lastname, country, subject) VALUES ('$firstname', '$lastname', '$country', '$subject')";

   if ($conn->query($sql) === TRUE) {
       echo " ";
   } else {
       echo "Error: " . $sql . "<br>" . $conn->error;
   }
}
?>