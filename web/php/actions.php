<?php


  if (isset ($_POST["volume"])) { //If an action on the volume is requested:
      include("./php/action-volume.php");
  } else {
      drpint("POST volume not set");
  }//end of isset ($_POST["volume"])


?>
