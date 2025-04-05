<?php

require_once 'db.php';

global $db;
$query = $db->prepare('SELECT `activity`, `year`, `location`, `rating`, `image` FROM `bucket_items`');
$query->execute();

$results = $query->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Bucket List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>My Bucket List</header>
    <main>
        <section class='bucket-list'>
            <?php foreach($results as $result) : ?>
                    <div class='bucket-item'>
                        <div class='item-image' style='background-size: cover; background-position: center; background-image: url(<?= $result['image'] ?>);'>
                            <div class='item-name'><?= $result['activity'] ?></div>
                        </div>
                        <div class='stats'>
                            <div>Year<div class='stats-data'><?= $result['year'] ?></div></div>
                            <div>Location<div class="stats-data"><?= $result['location'] ?></div></div>
                            <?php if($result['rating'] === 1) : ?>
                                <div>Rating<div class='stats-data'><i class='bx bx-star'></i></div></div>
                            <?php elseif($result['rating'] === 2) : ?>
                                <div>Rating<div class='stats-data'><i class='bx bx-star'></i><i class='bx bx-star'></i></div></div>
                            <?php elseif($result['rating'] === 3) : ?>
                                <div>Rating<div class='stats-data'><i class='bx bx-star'></i><i class='bx bx-star'></i><i class='bx bx-star'></i></div></div>
                            <?php elseif($result['rating'] === 4) : ?>
                                <div>Rating<div class='stats-data'><i class='bx bx-star'></i><i class='bx bx-star'></i><i class='bx bx-star'></i><i class='bx bx-star'></i></div></div>
                            <?php elseif($result['rating'] === 5) : ?>
                                <div>Rating<div class='stats-data'><i class='bx bx-star'></i><i class='bx bx-star'></i><i class='bx bx-star'></i><i class='bx bx-star'></i><i class='bx bx-star'></i></div></div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
        </section>
    </main>
    <section class='add-activity'>
        <div class='form'>
            <h1>New activity</h1>
            <form action='add_activity.php' method='post'>
                <label for='activity'>Activity</label>
                <input required maxlength='26' id='activity' type='text' name='activity'>
                <label for='year'>Year</label>
                <input required min='1983' id='year' type='number' name='year'>
                <label for='location'>Location</label>
                <input required maxlength='21' id='location' type='text' name='location'>
                <label for='image'>Image (url)</label>
                <input required id='image' type='url' name='image'>
                <label for='rating'>Rate my experience</label>
                <select required id='rating' name='rating'>
                    <option disabled selected value></option>
                    <option value='1'>1</option>
                    <option value='2'>2</option>
                    <option value='3'>3</option>
                    <option value='4'>4</option>
                    <option value='5'>5</option>
                </select>
                <div class='submit-activity'>
                    <input type='submit' name='submit' value='Add'>
                </div>
            </form>
        </div>
    </section>
</body>

</html>
