<?php
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

?>
