<?php
header('Content-Type: application/json');

// Data
$data = [
    'baranggayData' => [10, 40, 30, 20, 10, 5, 0],
    'baranggays' => [
        "Acmonan",
        "Bololmala",
        "Bunao",
        "Cebuano",
        "Crossing Rubber",
        "Kablon",
        "Kalkam",
        "Linan",
    ],
    'youthData' => [50, 80],
    'youthLabels' => ["Yes", "No"],
    'sexData' => [48, 52],
    'sexLabels' => ["Male", "Female"],
    'ageData' => [50, 40, 30, 20, 10, 5, 0],
    'ageLabels' => ["0-9", "10-19", "20-29", "30-39", "40-49", "50-59", "60+"],
    'ageClassificationData' => [50, 40, 30],
    'ageClassificationLabels' => [
        "CHILD YOUTH (15-17 YEARS OLD)",
        "CORE YOUTH (15-24 YEARS OLD)",
        "ADULT YOUTH (25-30 YEARS OLD)",
    ],
    'genderPrefData' => [50, 40, 30],
    'genderPrefLabels' => ["Girl", "Boy", "Lesbian", "Gay", "Prefer Not Say"],
    'civilStatusData' => [50, 40, 30, 20, 10],
    'civilStatusLabels' => [
        "Single",
        "Married",
        "Widowed",
        "Separated",
        "In Relationship",
    ],
];

// Return JSON encoded data
echo json_encode($data);
