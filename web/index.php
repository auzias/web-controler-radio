<?php
  $output = "";
  $DEFAULT_LEVEL = 30;

  require_once("./php/functions.php");
  require_once("./php/pages.php");
  require_once("./php/actions.php");

  dprint ("saved level:".$_COOKIE['level']);
  $output = shell_exec("sudo amixer get Master");
  echo "<pre>$output</pre>";

?>
