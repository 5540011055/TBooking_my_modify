<?php
if (eregi("config.in.php",$PHP_SELF)) {
    die();
}
define("DB_HOST","localhost");
define("DB_NAME","admin_web");
define("DB_USERNAME","admin_MANbooking");
define("DB_PASSWORD","252631MANbooking");
define("GALLERY","web_gallery_place");
define("Transferplace_3","web_transferplace_new_3");
define("Transferplace_2","web_transferplace_new_2");
define("Transferplace","web_transferplace_new");
?>