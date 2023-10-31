<?php 
    require_once('importants/connect.php');

    if(isset($_POST['user']) && isset($_POST['password'])) {
        $username = $_POST['user'];
        $password = $_POST['password'];

        if(empty($username)) {
            header("Location: login.php?error=Username is Required");
        }
        else if (empty($password)) {
            header("Location: login.php?error=Password is Required");
        }
        else {
            $conn = connectToDatabase();

            $sql = $conn->prepare("SELECT * FROM users WHERE user=?");

            $sql->execute([$username]);

            if($sql->rowCount() === 1) {
                $user = $sql->fetch();

                if(password_verify($password, $user['password'])) {
                    session_start();
                    $_SESSION['user_id'] = $user['id'];

                    // Redirect to dashboard.php
                    header("Location: dashboard.php");
                }
                else {
                    header("Location: login.php?error=Incorrect Password");
                }
            }
            else {
                header("Location: login.php?error=Incorrect Email or Password");
            }
        }
    }

?>