<?php

include 'config.php';

// (B) CONNECT TO DATABASE
$error = NULL;
try {
  $pdo = new PDO(
    "mysql:host=" . DB_HOST . ";charset=" . DB_CHARSET . ";dbname=" . DB_NAME,
    DB_USER, DB_PASSWORD, [ 
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
  );
} catch (Exception $ex) { $error = $ex->getMessage(); }
 
// (C) INSERT
if (is_null($error)) {
  try {
    $stmt = $pdo->prepare("INSERT INTO `newletters_subscribe` (`email`) VALUES (?)");
    $stmt->execute([$_POST['email']]);
  } catch (Exception $ex) { $error = $ex->getMessage(); }
}

// (D) RESULTS
echo is_null($error) ? "Merci pour votre inscription!" : $error ;

?>