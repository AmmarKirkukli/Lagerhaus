
<?php



if (!isset($_SESSION['admin_id'])) {
    
    header("Location: index.php?action=loginAdmin");
    exit(); 
}


?>
    
    <h2 class="ms-2 me-2">Welcome, <?php echo $_SESSION['admin_name']; ?></h2>

    <a class="btn btn-outline-secondary rounded-pill main-btn ms-2 me-2 " class="btn btn-success" href="index.php?action=logoutAdmin">Logout</a> 
    