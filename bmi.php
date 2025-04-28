<?php
// تأكد أن البيانات أُرسلت بـ POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $weight = $_POST['weight'] ?? null;
    $height = $_POST['height'] ?? null;

    if ($weight && $height && is_numeric($weight) && is_numeric($height)) {
        // حساب BMI
        $bmi = $weight / (($height / 100) ** 2);

        echo json_encode([
            "success" => true,
            "bmi" => round($bmi, 2),
            "message" => "تم الحساب بنجاح"
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "الرجاء إدخال الطول والوزن بشكل صحيح"
        ]);
    }
} else {
    echo json_encode([
        "success" => false,
        "message" => "لم يتم استقبال بيانات"
    ]);
}
?>