<?php
  require_once("./php/functions.php");

  $output = "";
  $DEFAULT_LEVEL = 30;

  require_once("./php/pages.php");
  require_once("./php/actions.php");

  dprint ("saved level:".$_COOKIE['level']);
  $output = shell_exec("sudo amixer get Master");
  echo "<pre>$output</pre>";
  echo "<br><br><br>";

  $output = shell_exec("sudo amixer get Master | grep 'Mono:' | awk '{print $4}'| tr -d '[%]'");
  echo "<pre>".$output."</pre>";
?>
