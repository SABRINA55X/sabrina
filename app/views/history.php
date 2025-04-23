<!DOCTYPE html>
<html>
<head>
    <title>BMI History</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>BMI History for <?= $_SESSION['username'] ?></h2>
    <a href="?action=form" class="btn btn-primary mb-3">Back to Form</a>
    <canvas id="bmiChart" width="400" height="200"></canvas>

    <script>
        const ctx = document.getElementById('bmiChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?= json_encode(array_column($history, 'timestamp')) ?>,
                datasets: [{
                    label: 'BMI',
                    data: <?= json_encode(array_column($history, 'bmi')) ?>,
                    borderColor: 'blue',
                    fill: false
                }]
            }
        });
    </script>
</body>
</html>