require_once '../controllers/UserController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['route'] == 'register') {
    $userController = new UserController();
    $userController->register($_POST['username'], $_POST['email'], $_POST['password']);
}
