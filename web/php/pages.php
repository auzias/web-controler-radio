<?php

  if (isset ($_GET[debug])) { //Debug mode
    include ('mock-up/debug.html');
  } else if (isset ($_GET[level])) { //Debug mode
    echo get_volume ();
  } else {
    include ('mock-up/ihm.html');
  }

?>
