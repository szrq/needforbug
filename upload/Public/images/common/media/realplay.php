<?php
/* [NeedForBug!] (C)Dianniu From 2010.
   Needforbug realplay($)*/

@header("Content-Disposition: attachment; filename=\"realplayer.php\"");
@header("Content-Type: application/octet-stream");
echo (get_magic_quotes_gpc()?stripslashes($_GET['link']):$_GET['link']);
?>