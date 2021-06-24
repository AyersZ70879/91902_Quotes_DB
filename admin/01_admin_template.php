<?php

// check the user is logged in... 
if (isset($_SEISSION['admin'])) {

} // end user logged in if

else {
    $login_error = 'Please login to access this page';
    header("Location: index.php?page=../admin/login&error=$login_error");

} // end user not logged in else

?>