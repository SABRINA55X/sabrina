<?php
session_start();

require '../config/database.php';
require '../app/models/UserModel.php';
require '../app/models/BmiModel.php';
require '../app/controllers/AuthController.php';
require '../app/controllers/BmiController.php';

$userModel = new UserModel($db);
$auth = new AuthController($userModel);

$bmiModel = new BmiModel($db);
$bmi = new BmiController($bmiModel);

$action = $_GET['action'] ?? ($_SESSION['user_id'] ? 'form' : 'login');

switch ($action) {
    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $auth->login($_POST['username'], $_POST['password']);
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header("Location: index.php");
                exit;
            } else {
                echo "<script>alert('Invalid credentials');</script>";
            }
        }
        include '../app/views/login.php';
        break;

    case 'signup':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth->register($_POST['username'], $_POST['password']);
            header("Location: index.php?action=login");
            exit;
        }
        include '../app/views/signup.php';
        break;

    case 'calculate':
        if (!$_SESSION['user_id']) exit("Unauthorized");
        $result = $bmi->calculateBmi($_SESSION['user_id'], $_POST['name'], $_POST['weight'], $_POST['height']);
        include '../app/views/bmi_result.php';
        break;

    case 'history':
        if (!$_SESSION['user_id']) exit("Unauthorized");
        $history = $bmi->getHistory($_SESSION['user_id']);
        include '../app/views/history.php';
        break;

    default:
        if (!$_SESSION['user_id']) {
            header("Location: index.php?action=login");
            exit;
        }
        include '../app/views/bmi_form.php';
}