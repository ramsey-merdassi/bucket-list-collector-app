<?php

require_once 'db.php';

global $db;

function createDatabaseQuery($sort_field, $order) {
    global $db;

    $activity_type_filters = [
        'travel' => 'travel_activity',
        'development' => 'development_activity',
        'giving' => 'giving_activity',
        'leisure' => 'leisure_activity',
    ];

    $continent_filters = [
        'asia' => 'Asia',
        'africa' => 'Africa',
        'north-america' => 'North America',
        'south-america' => 'South America',
        'antarctica' => 'Antarctica',
        'europe' => 'Europe',
        'oceania' => 'Oceania',
    ];

    $activity_filter_conditions = [];
    $continent_filter_conditions = [];

    $sql = "SELECT `activity_name`, `year`, `location`, `rating`, `image` FROM `bucket_items`";

    foreach ($activity_type_filters as $key => $value) {
        if (isset($_GET["$key-filter"])) {
            $activity_filter_conditions[] .= "`$value` = 1";
        }
    }

    foreach ($continent_filters as $key => $value) {
        if (isset($_GET["$key-filter"])) {
            $continent_filter_conditions[] .= "`continent` = '$value'";
        }
    }

    if (!empty($activity_filter_conditions)) {
        $sql .= " WHERE " . implode(" OR ", $activity_filter_conditions);
        if (!empty($continent_filter_conditions)) {
            $sql .= " AND (" . implode(" OR ", $continent_filter_conditions) . ")";
        }
    } elseif (!empty($continent_filter_conditions)) {
        $sql .= " WHERE " . implode(" OR ", $continent_filter_conditions);
    }

    $sql .= " ORDER BY $sort_field $order";
    return $db->prepare($sql);
}

function getSortFieldAndOrder() :array {
     $sortOptions = [
        'activity(asc)' => ['activity_name', 'ASC'],
        'activity(desc)' => ['activity_name', 'DESC'],
        'year(desc)' => ['year', 'DESC'],
        'year(asc)' => ['year', 'ASC'],
        'location(asc)' => ['location', 'ASC'],
        'location(desc)' => ['location', 'DESC'],
        'rating(desc)' => ['rating', 'DESC'],
        'rating(asc)' => ['rating', 'ASC'],
    ];

    $default = ['id', 'ASC'];

    if (isset($_GET['sort'])) {
        return $sortOptions[$_GET['sort']] ?? $default;
    }
    return $default;
}

if (isset($_GET['go'])) {
    [$sort_field, $order] = getSortFieldAndOrder();
    $query = createDatabaseQuery($sort_field, $order);
} else {
    $query = $db->prepare("SELECT `activity_name`, `year`, `location`, `rating`, `image` FROM `bucket_items`");
}

$query->execute();
$results = $query->fetchAll();