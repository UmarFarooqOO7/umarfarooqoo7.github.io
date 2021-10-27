

<?php
    require_once('./conn.php');
    $GLOBALS['err']= $_GET && $_GET['error'] ? $_GET['error'] : null;
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(!empty($_POST['email']) && !empty($_POST['password'])){
            $this_pass= $_POST['password'];
            $email = $_POST['email'];
            $sql =  "SELECT * FROM users WHERE email= '".$email."'";
            $result= $conn -> query($sql);
            if($result -> num_rows > 0){
                $row= $result -> fetch_assoc();
                if(!empty($row) && password_verify($this_pass, $row['password'])){
                    session_start();
                    $_SESSION['type']= $row['type'];
                    $_SESSION['email']= $row['email'];
                    $_SESSION['name']= $row['name'];
                    header('Location:'.'./index.php');
                    die();
                }else{
                    $err = "Username or password don't match";
                }
            }else{
                $err = "Username or password don't match";
            }
        }else{
            $err= 'Email and password required.';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./style/style-login.css">
<link rel="stylesheet" href="assets/bootstrap.style/styles.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">

<style>
        form{
            display: flex;
    flex-direction: column;
    align-items: center;
    height: 100%;
        }
        
        .tk-intro {
    font-size: 21px;
    line-height: 1.38105;
    font-weight: 400;
    letter-spacing: .011em;
}
</style>
</head>
<body>

    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
        <div class="center-login1 col-lg-3 m-auto shadow p-4 rounded">
        <h1 tabindex="-1" class="si-container-title tk-intro  text-center">
        Security check	
              
        </h1>
            <div class="error d-none">* 
                <?php if(isset($err)){
                        echo $err;
                    }else
                        echo 'Enter email and password';
                ?></div>
            <div class="pt-4">
                <!-- <label class="email-lab"></label> -->
                <input type="email" name="email" placeholder="Email" class="fields" required>
            </div>

            <div class="pt-4">
                <!-- <label class="pass-lab">Password</label> -->
                <input type="password" name="password"  placeholder="Password" class="fields" required>
            </div>

           
<div class="text-right pt-4"> <button type="submit" name='login' value='Login' class="btn btn-primary btn-lg">Login <i class="bi bi-arrow-right-circle"></i></button></div>
        </div>
    </form>
</body>
</html>