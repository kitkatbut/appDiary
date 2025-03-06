<?php
    $host = 'localhost';
    $dbname = 'diary';
    $user = 'root';
    $password = '';
try {
    $pdo = new  PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_PERSISTENT => true
    ]);
}

catch(PDOException $e) {
    error_log(date("Y-m-d H:i:s") . "Erreur de connexion : " . $e->getMessage()); ?>
        <p class="error">Une erreur a été rencontrée. Veuillez réessayer plus tard.</p>
    <?php

    
}