<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

   
</head>

<style>
    body{
        margin: 0;
        padding: 0;
        /* display: flex; */
    }

    .login-section{
        /* display: flex; */
        height: 100%;
        align-items: center;
        justify-content: center;
        margin: 150px 0;
        
    }
    .head, .login{
        display: flex;
        justify-content: center;
    }

    form input{
        position: relative;
        padding: 5px 10px;
        margin: 10px 20px;
        font-size: 15px;
        width: 400px;
        height: 25px;
    }

    input:focus{
        box-shadow: 5px 2px 20px rgb(189, 245, 255);
        border-color: cadetblue;
        outline-color: cadetblue;
    }

    label{
        font-weight: bold;
    }

    button{
        
        margin: 30px auto;
        display: flex;
        justify-content: center;
        padding: 10px 25px;
        background: black;
        color: white;
        font-size: large;
        border: 2px solid black;
        transition: 0.3s ease;
    }

    button:hover{
        background: white;
        color: black;
        border-color: black;
    }
    
    a{
        text-decoration: none;

    }
    a:hover{
        color: red;
    }
</style>

<body>
<?php require_once 'account.php' ?>
    <div class="message">
        <?php if(isset($_SESSION['message'])): ?>
        <script> 
            alert('<?php 
               echo $_SESSION['message']; 
                unset($_SESSION['message']);
            ?>'); 
        </script>
        <?php endif; ?>
    </div>
    <div class="login-section">
        <div class="head">
            <h1>Login To Manage Tasks</h1>
        </div>
        <hr width="50%"><br>
        <div class="login">
            <form action="account.php" method="post">
                <div class="email">
                    <label for="email">Email Id</label><br>
                    <input type="email" name="email">
                </div>
                <div class="password">
                    <label for="password">Password</label><br>
                    <input type="password" name="password">
                </div>
                <a href="signup.php">New Here? Create a account</a>
                <button class="btn" type="submit" name="login">Login</button>
            </form>
        </div>
    </div>
</body>
</html>