<?php
  function specialChars($value) {
    return htmlspecialchars($value, ENT_QUOTES);
  }

  function dbConnect() {
	  $db = new mysqli('mysql:3306', 'root', 'root_password', 'min_bbs');
    if (!$db) {
      die($db->error);
    }

    return $db;
  }
?>