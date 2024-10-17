<?php
session_start();
require_once 'core/sessionController.php';

$sessionController = new sessionController();
$sessionController->logout();
