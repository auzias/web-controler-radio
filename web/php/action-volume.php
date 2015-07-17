<?php
$VOL_MUTE = "mute";
$VOL_UNMUTE = "unmute";
$VOL_SET = "set";
$VOL_UP = "up";
$VOL_DOWN = "down";
$action = $_POST["volume"];

  //Mute the sound sytem:
  if ($action == $VOL_MUTE) {
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
  if ($action == $VOL_UNMUTE) {
    if (get_volume() == 0) {
      dprint ('unmuting');
      set_volume ($_COOKIE['level']);
    } else {
      dprint ("skipped");
    }
  }

  //Set the volume level:
  if ($action == $VOL_SET) {
    if (isset ($_POST["level"])) { //Is the level variable also set?
      dprint ('set '.$_POST["level"]);
      set_volume ($_POST["level"]);
    }
  }

  //Set the sound level 5% louder:
  if ($action == $VOL_UP) {
    dprint('+5%');
    $output = shell_exec('sudo amixer set Master 5%+');;
  }

  //Set the sound level 5% lower:
  if ($action == $VOL_DOWN) {
    dprint('+5%');
    $output = shell_exec('sudo amixer set Master 5%-');;
  }


?>
