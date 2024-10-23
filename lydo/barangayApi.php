<?php

header('Content-Type: application/json');


class BarangayAPI
{

    private const BARANGGAY_NAMES = [
        "Acmonan",
        "Bololmala",
        "Bunao",
        "Cebuano",
        "Crossing Rubber",
        "Kablon",
        "Kalkam",
        "Linan",
    ];

    private const YOUTH_LABELS = ["Yes", "No"];
    private const SEX_LABELS = ["Male", "Female"];
    private const AGE_LABELS = ["0-9", "10-19", "20-29", "30-39", "40-49", "50-59", "60+"];
    private const AGE_CLASSIFICATION_LABELS = [
        "CHILD YOUTH (15-17 YEARS OLD)",
        "CORE YOUTH (18-24 YEARS OLD)",
        "ADULT YOUTH (25-30 YEARS OLD)",
    ];
    private const GENDER_PREF_LABELS = ["Girl", "Boy", "Lesbian", "Gay", "Prefer Not Say"];
    private const CIVIL_STATUS_LABELS = [
        "Single",
        "Married",
        "In Relationship",
        "Widowed",
        "Separated",
    ];



    private function getBarangayData(): array
    {
        return [10, 40, 7.8, 15.8, 10, 5, 10, 15.8];
    }

    private function getYouthData(): array
    {
        return [50, 80];
    }

    private function getSexData(): array
    {
        return [48, 52];
    }

    private function getAgeData(): array
    {
        return [50, 40, 30, 20, 10, 5, 0];
    }

    private function getAgeClassificationData(): array
    {
        return [30.6, 47.9, 21.5];
    }

    private function getGenderPreferenceData(): array
    {
        return [43, 47.3, 0, 1, 8.7];
    }

    private function getCivilStatusData(): array
    {
        return [80.3, 12.8, 7, 0, 0];
    }

    public function getData(): array
    {
        return [
            'baranggayData' => $this->getBarangayData(),
            'baranggays' => self::BARANGGAY_NAMES,
            'youthData' => $this->getYouthData(),
            'youthLabels' => self::YOUTH_LABELS,
            'sexData' => $this->getSexData(),
            'sexLabels' => self::SEX_LABELS,
            'ageData' => $this->getAgeData(),
            'ageLabels' => self::AGE_LABELS,
            'ageClassificationData' => $this->getAgeClassificationData(),
            'ageClassificationLabels' => self::AGE_CLASSIFICATION_LABELS,
            'genderPrefData' => $this->getGenderPreferenceData(),
            'genderPrefLabels' => self::GENDER_PREF_LABELS,
            'civilStatusData' => $this->getCivilStatusData(),
            'civilStatusLabels' => self::CIVIL_STATUS_LABELS,
        ];
    }
}


$api = new BarangayAPI();
$data = $api->getData();
echo json_encode($data);
