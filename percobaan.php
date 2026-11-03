<?php
$password = '12345678';
$salt = 'Drkguq5EvjSVTn0NzkE7T8UtjT0G';
$crypted = md5(md5($salt.$password.$salt));
echo $crypted;