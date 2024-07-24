 <?php
    require 'functions.php';

    if (isset($_POST["register"])) {
        if (registrasi($_POST) > 0) {
            echo "<script>
                alert('user baru berhasil di tambahkan');    
                </script>";
        } else {
            echo mysqli_error($conn);
        }
    }
    ?>

 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Halaman Registrasi</title>
     <link rel="stylesheet" href="src/registrasi.css">
 </head>

 <body>
     <div class="container">
         <img src="img/register.jpg" width="500">
         <form method="post" action="">
             <h1>Sign Up</h1>
             <ul>
                 <li>
                     <label for="username">Username :</label>
                     <input type="text" name="username" id="username">
                 </li>
                 <li>
                     <label for="password">password :</label>
                     <input type="password" name="password" id="password">
                 </li>
                 <li>
                     <label for="password2">konfirmasi password :</label>
                     <input type="password" name="password2" id="password2">
                 </li>
                 <li>
                     <button type="submit" name="register" id="submit">submit</button>
                     <a href="login.php">Login</a>

                 </li>

             </ul>
         </form>
     </div>
 </body>

 </html>