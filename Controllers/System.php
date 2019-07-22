<?php

class SystemController {

    //Vezi DashboardController.php pentru explicatii legate de membri clasei unui Controller
    public function __construct()
    {
        
    }

    public function default($req){

    }

    public function bounds_exceeded(){
        echo "This webapp is designed to only operate under the index.php, you got out of bound.<br> ";
        echo " <a href=\"".Kernel::GetRoot()."index.php/Dashboard\">Return to Dashboard</a>";
    }

    public function HTTP404(){
        echo "<h1>This is a 404</h1><br>";
        echo " <a href=\"".Kernel::GetRoot()."index.php/Dashboard\">Return to Dashboard</a>";
    }
}

?>