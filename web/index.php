<?php
  include ('mock-up/ihm.php');
  $output = "";
  if (isset($_POST[action])) { //If an action is requested and the variable is set:

    //Mute the sound sytem:
    if ($_POST["action"] == "mute") {
      echo '<pre>muting</pre>';
      $output = shell_exec('sudo amixer set Master mute');
      echo "<pre>$output</pre>";
    }

    //Unmute the sounds system:
    if ($_POST["action"] == "unmute") {
      echo '<pre>unmuting</pre>';
      $output = shell_exec('sudo amixer set Master unmute');
      echo "<pre>$output</pre>";
    }

    //Set the volume level:
    if ($_POST["action"] == "volume") {
      if (isset($_POST["level"])) { //Is the level variable also set?
        $level = $_POST["level"];
        if ($level >= 0 && $level <= 100) { //Is the $level value correct?
          $output = shell_exec('amixer set Master $level%');
        }
      }
    }
  $output = shell_exec('whoami');
  echo "<pre>$output</pre>";
  } else { //end (isset($_POST["action"]))
    echo '<pre>no $_POST["action"] has been set.</pre>';
  }

  echo "<pre>$output</pre>";

?>
