<?php 

$conn = mysqli_connect("localhost","root","","amc");

if(!$conn)
{
    die("cant connect".mysqli_connect_error());
}
