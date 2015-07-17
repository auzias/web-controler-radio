<?php

  if (isset ($_GET[debug])) { //Debug mode
    include ('mock-up/debug.html');
  } else {
    include ('mock-up/ihm.html');
  }

?>
