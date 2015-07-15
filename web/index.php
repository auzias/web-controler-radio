<?php
  $output = "";
  $DEFAULT_LEVEL = 30;

/*****************
 *   Functions   *
 *****************/
  function dprint ($message) {
      if (isset ($_GET[debug])) { //Debug mode
        echo "<pre>$message</pre>";
      }
  }

   function get_volume () {
       return shell_exec("sudo amixer get Master | grep 'Mono:' | awk '{print $4}'| tr -d '[%]'");
   }

    function set_volume ($level) {
        if ($level < 0 && $level > 100) { //Is the $level value correct?
          $level = $DEFAULT_LEVEL;
        }
        $output = shell_exec('sudo amixer set Master '.$level.'%');
    }

  function set_cookie_current_volume() {
    $level = get_volume();
    setcookie('level', $level, time() + 7*24*3600, null, null, false, true);
    dprint (">>Saving to ".$level);
    return $level;
  }

  /*****************
   *     Page      *
   *****************/
  if (isset ($_GET[debug])) { //Debug mode
    include ('mock-up/debug.html');
  } else {
    include ('mock-up/ihm.html');
  }

  /*****************
   *    Actions    *
   *****************/
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
  }

  dprint ("saved level:".$_COOKIE['level']);
  $output = shell_exec("sudo amixer get Master");
  echo "<pre>$output</pre>";
  echo "<br><br><br>";

  $output = shell_exec("sudo amixer get Master | grep 'Mono:' | awk '{print $4}'| tr -d '[%]'");
  echo "<pre>".$output."</pre>";
?>
