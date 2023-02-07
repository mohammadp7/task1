<?PHP
   session_start();
   session_unset();
   session_destroy();
   
   echo "
   <p>شما با موفقیت خارج شدید.</p>
   <a href='login.php'><button type='button'>login</button></a>
   <a href='index.php'><button type='button'>main page</button></a>";

   exit();
?> 