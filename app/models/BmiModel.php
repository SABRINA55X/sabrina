<?php
class BmiModel {
    private $db;
    public function __construct($db) {
        $this->db = $db;
    }

    public function saveBmiRecord($userId, $name, $weight, $height, $bmi, $status) {
        $stmt = $this->db->prepare("INSERT INTO bmi_records (user_id, name, weight, height, bmi, status) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$userId, $name, $weight, $height, $bmi, $status]);
    }

    public function getBmiHistory($userId) {
        $stmt = $this->db->prepare("SELECT * FROM bmi_records WHERE user_id = ? ORDER BY timestamp DESC");
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }
}