<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

   
</head>

<style>
    body{
        margin: 0;
        padding: 0;
        /* display: flex; */
        transition: 0.5s ease;
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
            <h1>Sign Up</h1>
        </div>
        <hr width="50%"><br>
        <div class="login">
            <form action="account.php" method="post">
                <div class="email">
                    <label for="email">Email Id</label><br>
                    <input type="email" name="email" required>
                </div>
                <div class="password1">
                    <label for="password">Password</label><br>
                    <input type="password" name="password1" id="password1" onkeyup="checkpass()" required>
                </div>
                <div class="password2">
                    <label for="password">Confirm Password</label><br>
                    <input type="password" name="password2"  id="password2" onkeyup="checkpass()" required>
                    <p id="message" style="color:red"></p>
                </div>
                <a href="login.php">Already member? Login</a>
                <button class="btn" type="submit" id="button" name="signup">Sign Up</button>
            </form>
        </div>
    </div>
</body>
</html>

<script>
    function checkpass(){
        var pass = document.getElementById('password1').value;
        var conpass = document.getElementById('password2').value;
        var message;
        if(pass==''){
            document.getElementById('message').innerHTML = "Please set a password";
            document.getElementById('message').style = 'color:red';
        }else
        if(pass === conpass){
            document.getElementById('message').innerHTML = "Password Matched";
            document.getElementById('message').style = 'color:green';
            document.getElementById('button').disabled = false;

        }else{
            document.getElementById('message').innerHTML = "Password Doesn't match";
            document.getElementById('message').style = 'color:red';
            document.getElementById('button').disabled = true;
        }
    }
</script>