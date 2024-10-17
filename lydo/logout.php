<?php
session_start();
require_once 'core/SessionController.php';  

$sessionController = new SessionController();
$sessionController->logout();
