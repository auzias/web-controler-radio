<?php
  function dprint ($message) {
      if (isset ($_GET[debug])) { //Debug mode
        echo "<pre>$message</pre>";
      }
  }

   function get_volume () {
       return shell_exec("sudo amixer get Master | grep 'Mono:' | awk '{print   $4}'| tr -d '[%]'");
   }

    function set_volume ($level) {
        if ($level < 0 && $level > 100) { //Is the $level value correct?
          $level = $DEFAULT_LEVEL;
        }
        $output = shell_exec('sudo amixer set Master '.$level.'%');
    }

  function save_current_volume() {
    //Get current volume
    $level = get_volume();

    //Open (and create if non existent) to write (only) the file
    $sound_file = fopen('saved_volume.txt', 'r+');
    //Cursor at the beginning of the file
    fseek($sound_file, 0);
    //Save the value in the file
    fputs($sound_file, $level);
    //Close the file
    fclose($sound_file);

    return $level;
  }

  function get_saved_volume() {
    //Open the file (read only)
    $sound_file = fopen('saved_volume.txt', 'r');
    //Read the value
    $level = fgets($monfichier);
    //Close the file
    fclose($sound_file);

    return $level;
  }
?>
