<?php
require_once('./conn.php');
function createNewUser($name, $email, $password, $conn)
{
    // $password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users VALUES ('$name', '$email', '$password', 'user')";
    if ($conn->query($sql)) {
        return 'User Created successfully.';
    } else if ($conn->error) {
        // return $conn->error;
        if (!strpos($conn->error, "Duplicate")) {
            return "User already exists.";
        } else {
            return "Unexpected error while creating user.";
        }
    }
}

session_start();
if (isset($_SESSION) && isset($_SESSION['email']) && isset($_SESSION['type']) && $_SESSION['type'] == 'admin' && isset($_SESSION['name'])) {
    $msg = null;
    if (isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {
        if (!empty($_POST['name']) && !empty($_POST['password']) && !empty($_POST['email'])) {
            $msg = createNewUser($_POST['name'], $_POST['email'], $_POST['password'], $conn);
        } else {
            $msg = 'Some fields are missing !';
        }
    }
} else {
    header('Location:' . './index.php');
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style-user.css">
    <link rel="stylesheet" href="./assets/bootstrap.style/styles.css">
    <script src="./assets/fontawesome/font-awesome.js"></script>
    <title>User Management</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+Antique&display=swap');

    * {
        font-family: 'Zen Kaku Gothic Antique', sans-serif;
    }

    form {
        display: flex;
        flex-direction: column;
        align-items: center;
        height: 100%;
    }

    .dataTables_filter {
        display: flex;
        justify-content: flex-end;
    }
</style>

<body>
    <div class="headings">
    </div>

    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <div class="center-user1 col-lg-8 shadow rounded m-auto p-4">
            <h1 class="text-center py-2">User Management</h1>
            <div class="message" id="message"></div>

            <style>
                .btn-group {
                    width: 100%;
                }
            </style>
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-primary active">
                    <input type="radio" name="options" id="option1" autocomplete="off" checked> Register User
                </label>
                <label class="btn btn-primary">
                    <input type="radio" name="options" id="option2" autocomplete="off">
                    View Users
                </label>
            </div>

            <br>

            <div id="create_user">
                <div class="pt-3">
                    <label class="email-lab"><b>Name</b></label>
                    <input type="text" name="name" class="fields form-control">
                </div>

                <div class="pt-3">
                    <label class="email-lab"><b>Email</b></label>
                    <input type="text" name="email" class="fields form-control">
                </div>


                <div class="pt-3">
                    <label class="pass-lab"><b>Password</b></label>
                    <input type="text" name="password" class="fields form-control">
                </div>

                <br>

                <button class="login-button btn btn-primary"><b>Create User</b></button>
            </div>

            <div id="users" style="display: none">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        Users
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>User Email</th>
                                        <th>Name</th>
                                        <th>User Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require_once('./allUsers.php');
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </form>

    <?php
    if (isset($msg)) {
    ?>
        <script>
            window.onload = function() {
                var div = document.getElementById('message');
                div.innerHTML = "<?php echo $msg; ?>";
                div.style.display = 'block';
                setTimeout(() => {
                    div.style.display = 'none'
                }, 4000);
            }
        </script>
    <?php
    }
    ?>
</body>
<script src="./assets/Jquery.js"></script>
<script src="./assets/bootstrap.js/bootstrap.bundle.min.js"></script>
<script src="./assets/datatables/jquery.dataTables.min.js"></script>
<script src="./assets/datatables/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
<script src="./js/user-management.js"></script>

</html>