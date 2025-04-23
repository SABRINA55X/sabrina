<!DOCTYPE html>
<html>
<head>
    <title>BMI Calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Welcome, <?= $_SESSION['username'] ?> | <a href="logout.php">Logout</a></h2>
    <h4>Calculate your BMI</h4>
    <form method="post" action="?action=calculate">
        <div class="mb-3">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Weight (kg):</label>
            <input type="number" name="weight" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Height (cm):</label>
            <input type="number" name="height" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Calculate</button>
        <a href="?action=history" class="btn btn-secondary">View History</a>
    </form>
</body>
</html>