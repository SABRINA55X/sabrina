<?php
class BmiController {
    private $model;
    public function __construct($model) {
        $this->model = $model;
    }

    public function calculateBmi($userId, $name, $weight, $height) {
        $bmi = $weight / (($height / 100) * ($height / 100));
        $status = $this->getStatus($bmi);
        $this->model->saveBmiRecord($userId, $name, $weight, $height, $bmi, $status);
        return ['bmi' => round($bmi, 2), 'status' => $status];
    }

    private function getStatus($bmi) {
        if ($bmi < 18.5) return "Underweight";
        if ($bmi < 25) return "Normal weight";
        if ($bmi < 30) return "Overweight";
        return "Obese";
    }

    public function getHistory($userId) {
        return $this->model->getBmiHistory($userId);
    }
}