<?php

require_once 'db.php';
global $db;

if (isset($_POST['submit'])) {

    $activity_name = trim($_POST['activity-name']);

    if(isset($_POST['travel-activity'])) {
        $travel_activity = $_POST['travel-activity'];
    }
    if(isset($_POST['development-activity'])) {
        $development_activity = $_POST['development-activity'];
    }
    if(isset($_POST['giving-activity'])) {
        $giving_activity = $_POST['giving-activity'];
    }
    if(isset($_POST['leisure-activity'])) {
        $leisure_activity = $_POST['leisure-activity'];
    }

    $year = trim($_POST['year']);
    $location = trim($_POST['location']);
    $continent = trim($_POST['continent']);
    $image = trim($_POST['image']);
    $rating = $_POST['rating'];

    $add_data = $db->prepare('INSERT INTO `bucket_items`(`activity_name`, `travel_activity`, `development_activity`, `giving_activity`, `leisure_activity`, `year`, `location`, `continent`, `image`, `rating`) 
    VALUES (:activity_name, :travel_activity, :development_activity, :giving_activity, :leisure_activity, :year, :location, :continent, :image, :rating)');

    $add_data->bindParam(':activity_name', $activity_name);
    $add_data->bindParam(':travel_activity', $travel_activity);
    $add_data->bindParam(':development_activity', $development_activity);
    $add_data->bindParam(':giving_activity', $giving_activity);
    $add_data->bindParam(':leisure_activity', $leisure_activity);
    $add_data->bindParam(':year', $year);
    $add_data->bindParam(':location', $location);
    $add_data->bindParam(':continent', $continent);
    $add_data->bindParam(':image', $image);
    $add_data->bindParam(':rating', $rating);

    $add_data->execute();
}

header('Location: index.php');