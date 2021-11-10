<div id = "loginFooter">
<?php 

global $database;
($database->open_connection())? $database->close_connection(): null;   ?>
<h4 style="color: turquoise; font-size: 10px;">Copyright <?php echo strftime('%Y', time());?> Prime Internation School</h4>
</div>

</div>
</body>
</html>
