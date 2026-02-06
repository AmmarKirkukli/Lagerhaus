<!DOCTYPE html>
 <html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../admin/public/lager.css">
    <link rel="stylesheet" href="../admin/public/css/all.min.css">
    <link rel="stylesheet" href="../admin/public/css/bootstrap.min.css">
    <title>Admin Dashboard</title>
</head>
<body>
    <div class="content">
        <?php
            include './view/navbarAdmin.php';
            include_once './model/Database.php';
            include_once './controller/usersController/usersController.php';
            include_once './controller/productsController/productsController.php';
            include_once './controller/orderController/OrderController.php';
            $allowed_actions = [
                    'loginAdmin', 'logoutAdmin', 'homeAdmin', 'userEdit', 'userUpdate', 
                    'userDelete', 'userlist', 'producteNew', 'producteEdit', 
                    'producteUpdate', 'producteDelete', 'Management', 'userNew', 
                    'Products', 'Users', 'createOrder', 'editOrder', 'listAllOrders', 'deleteOrder'];
            $action = isset($_REQUEST['action']) && in_array($_REQUEST['action'], 
        $allowed_actions) 
            ? $_REQUEST['action'] 
                    : 'homeAdmin';
            $UserController = new UserController();
            $ProductController = new ProductController();
            $OrderController = new OrderController();
            $OrderController->sendReminderEmails();
            $ProductController->sendLowStockAlerts();
        switch ($action) {
            case 'loginAdmin':
                require './view/login/login_view.php';
                break;

            case 'logoutAdmin':
                require './controller/adminController/logoutAdmin.php';
                break;

            case 'homeAdmin':
                require './view/Home/homeAdmin.php';
                break;

            case 'Products':
                require './view/Products/Products.php';
                break;

            case 'Users':
                require './view/User/Users.php';
                break;

            case 'userNew':
                require './view/Management/New/userNew.php';
                break;

            case 'userEdit':
                $user_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
                if ($user_id) {
                    $UserController->userEdit($user_id);
                } else {
                    echo "<div class='alert alert-danger'>Invalid User ID</div>";
                }
                break;

            case 'userUpdate':
                $user_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
                if ($user_id) {
                    $UserController->userUpdate($user_id);
                }
                break;

            case 'userDelete':
                $user_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
                if ($user_id) {
                    $UserController->userDelete($user_id);
                }
                break;

            case 'producteNew':
                require './view/Management/New/producteNew.php';
                break;

            case 'producteEdit':
                $product_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
                if ($product_id) {
                    $ProductController->editProduct($product_id);
                } else {
                    echo "<div class='alert alert-danger'>Invalid Product ID</div>";
                }
                break;

            case 'producteUpdate':
                $product_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
                if ($product_id) {
                    $ProductController->updateProduct($product_id);
                }
                break;

            case 'producteDelete':
                $product_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
                if ($product_id) {
                    $ProductController->deleteProduct($product_id);
                }
                break;

            case 'createOrder':
                $OrderController->createOrder();
                break;

            case 'deleteOrder':
                $order_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
                if ($order_id) {
                    $OrderController->deleteOrder($order_id);
                } else {
                    echo "<div class='alert alert-danger'>Invalid Order ID</div>";
                }
                break;

            case 'editOrder':
                $order_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
                if ($order_id) {
                    $OrderController->editOrder($order_id);
                } else {
                    echo "<div class='alert alert-danger'>Invalid Order ID</div>";
                }
                break;

            case 'listAllOrders':
                $OrderController->listAllOrders();
                break;

            case 'Management':
                require './view/Management/Management.php';
                break;

            default:
                require './view/login/login_view.php';
                break;
        }
        ?>
    </div>
    <script src="../admin/public/js/bootstrap.bundle.min.js"></script>
    <script src="../admin/public/js/all.min.js"></script>
</body>
</html>
