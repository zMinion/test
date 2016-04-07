<?php
    echo "<b>Clean up started... </b><br> <br>";
    $path = "/home/u461268123/public_html/done/";
    foreach(glob($path . "*") as $file)
    {
            chmod($file, 0777);
            unlink($file);
	    echo "<br> File  <i>", $file, "</i>  have been removed";
    }
    echo "<br> <br> Job Done! ";
?>