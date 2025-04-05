<?php

require_once 'db.php';
global $db;

if (isset($_POST['submit'])) {

$activity = $_POST['activity'];
$year = $_POST['year'];
$location = $_POST['location'];
$image = $_POST['image'];
$rating = $_POST['rating'];

$add_data = $db->prepare('INSERT INTO `bucket_items`(`activity`, `year`, `location`, `image`, `rating`) 
VALUES (:activity, :year, :location, :image, :rating)');

$add_data->bindParam(':activity', $activity);
$add_data->bindParam(':year', $year);
$add_data->bindParam(':location', $location);
$add_data->bindParam(':image', $image);
$add_data->bindParam(':rating', $rating);

$add_data->execute();
}

header('Location: index.php');