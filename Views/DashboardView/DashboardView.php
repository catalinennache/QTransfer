<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="http://<?php echo $root; ?>Views/DashboardView/style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="http://<?php echo $root; ?>Views/DashboardView/main.js"></script>
</head>
<body>
    <div class="fixed-nav">
        <h4 style="font-family:monospace; color:white; float:left;width: 100%; margin-top: 15px;text-align:center;font-size:16px;">Traistaru Bogdan</h4>
        <input type="button" class="nav-btns" value="Add"  id="add" style="right:0px;">
    </div>

    <div class="stage">
        <div class="select-wrapper">
        <select>
            <?php
               foreach($model["tables"] as $table){
                  echo" <option value=\"".$table."\">".$table."</option>";
               }
            ?>
        </select>
        </div>
        <table>
           
        </table>
    </div>
    <div  class="modal-background" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5));">
        <div class="modal" style="display:block;position:relative;margin:0 auto;top:20%;width:500px;height:350px;background:white;">
               
        </div>
    </div>
</body>
<script>
document.body.addEventListener('mouseover')
</script>
</html>