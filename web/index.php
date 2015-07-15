<?php
  if (isset($_GET[debug])) { //Debug mode
    include ('mock-up/debug.html');
  } else {
    include ('mock-up/ihm.html');
  }

  $output = "";
  if (isset($_POST[action])) { //If an action is requested and the variable is set:

    //Mute the sound sytem:
    if ($_POST["action"] == "mute") {
      echo '<pre>muting</pre>';
      $output = shell_exec('sudo amixer set Master mute');
    }

    //Unmute the sounds system:
    if ($_POST["action"] == "unmute") {
      echo '<pre>unmuting</pre>';
      $output = shell_exec('sudo amixer set Master unmute');
    }

    //Set the volume level:
    if ($_POST["action"] == "volume") {
      if (isset($_POST["level"])) { //Is the level variable also set?
        $level = $_POST["level"];
        if ($level >= 0 && $level <= 100) { //Is the $level value correct?
          $output = shell_exec('sudo amixer set Master '.$level.'%');
        }
      }
    }
  }

  if (isset($_GET[debug])) { //Debug mode
    echo "<pre>$output</pre>";
  }

?>
