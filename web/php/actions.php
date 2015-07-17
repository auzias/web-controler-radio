<?php


if (isset ($_POST[action])) { //If an action is requested and the variable is set:

  //Mute the sound sytem:
  if ($_POST["action"] == "mute") {
    dprint('muting');
    /* while `#amixer set Master mute` work fine,
       `#amixer set Master unmute` does not work at all.
       A tweak is then needed, that is to save the sound level in a cookie,
       before muting, and reading this same cookie to unmute.
    */
    set_cookie_current_volume();
    $output = set_volume (0);
  }

  //Unmute the sounds system:
  if ($_POST["action"] == "unmute") {
    if (get_volume() == 0) {
      dprint ('unmuting');
      set_volume ($_COOKIE['level']);
    } else {
      dprint ("skipped");
    }
  }

  //Set the volume level:
  if ($_POST["action"] == "volume") {
    if (isset ($_POST["level"])) { //Is the level variable also set?
      set_volume ($_POST["level"]);
      dprint ('set '.$_POST["level"]);
    }
  }

  //Set the sound level 5% louder:
  if ($_POST["action"] == "volup") {
    dprint('+5%');
    $output = shell_exec('sudo amixer set Master 5%+');;
  }

  //Set the sound level 5% lower:
  if ($_POST["action"] == "voldown") {
    dprint('+5%');
    $output = shell_exec('sudo amixer set Master 5%-');;
  }

}//end of isset ($_POST['action'])





?>
