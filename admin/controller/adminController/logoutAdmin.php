<?php
session_start();
session_destroy();
header("Location: ../../../Lagerhaus/admin/index.php?action=loginAdmin");
include_once(__DIR__ . '/../../model/adminModel/adminModel.php');
?>
