<?php
    session_start();
    require_once "actions.php";
    require_once "db.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    // Load Composer's autoloader
    require '../vendor/autoload.php';

    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    if(isset($_POST['action']) && $_POST['action'] === 'register'){
        // print_r($_POST);
        $firstname = testInput($_POST['firstname']);
        $surname = testInput($_POST['surname']);
        $email = testInput($_POST['email']);
        $phone = testInput($_POST['phone']);
        $address = testInput($_POST['address']);
        $password = testInput($_POST['password']);
        $password2 = testInput($_POST['password2']);

        $token = bin2hex(random_bytes(50));

        // Hash password
        $hashPwd = password_hash($password,PASSWORD_DEFAULT);

        // check if email is already registered
        if(userExist($conn,$email)){
            echo displayMessage('warning',"This E-mail is already registered!");
        }else{
            $register = register($conn,$firstname,$surname,$email,$hashPwd,$phone,$address, $token);
            if($register){
                echo displayMessage('success', "Registered SuccessFully");
                $_SESSION['user'] = $email;
                try{
                    $mail->isSMTP();
                    $mail->Host = 'smtp.mailtrap.io';
                    $mail->SMTPAuth = true;
                    $mail->SMTPDebug  = 0;
                    $mail->Username   = "1e544c5e5f7d79";                    
                    $mail->Password   = "e841d92282037e";                              
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
                    $mail->Port       = 587;

                    $mail->setFrom("XpressManiac@mail.com",'Xpress Website');
                    $mail->addAddress($email);

                    $mail->isHTML(true);
                    $mail->Subject = 'Email Verification';
                    $mail->Body = '<h3>Click the link below to Verify your E-mail. <br>
                        <a href=http://localhost/Work%20Folder/particle/verify-email.php?email='.$email.'?token='.$token.'">Click here to verify your E-mail</a>
                        <br>Regards<br>Xpress Website</h3>';
                    $mail->send();
                }catch(Exception $e){
                    echo displayMessage('danger','Oops something went wrong! please try again');
                }
            }else{
                echo displayMessage('warning',"Server Error");
            }
        }
    }

    // handle login
    if(isset($_POST['action']) && $_POST['action'] === 'login'){
        print_r($_POST);
        $email = testInput(($_POST['username']));
        $pass = testInput(($_POST['login-password']));

        $loggedInUser = login($conn,$email);
        if($loggedInUser != null){
            if(password_verify($pass,$loggedInUser['password'])){
                if(!empty($_POST['rem'])){
                    setcookie('email',$email,time()+(30*24*60*60),'/');
                    setcookie('password',$pass,time()+(30*24*60*60),'/');
                }else{
                    setcookie('email','',1,'/');
                    setcookie('password','',1,'/');
                }
                echo 'login';
                $_SESSION['user'] = $email;
            }else{
                echo displayMessage('danger','Password is incorrect');
            }
        }else{
            echo displayMessage('danger','User not found!');
        }
    }

    // forgot password
    if(isset($_POST['action']) && $_POST['action'] === 'forgot'){
        $email = $user->testInput($_POST['email']);
        $userFound = $user->currentUser($email);
        // if($userFound != null){
        //     $token =uniqid();
        //     $token = str_shuffle($token);
        //     $user->forgot_password($token,$email);
        //     // try{
        //     //     $mail->isSMTP();
        //     //     $mail->Host = 'smtp.gmail.com';
        //     //     $mail->SMTPAuth = true;
        //     //     $mail->Username   = Database::USERNAME;                    
        //     //     $mail->Password   = Database::PASSWORD;                              
        //     //     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
        //     //     $mail->Port       = 587;

        //     //     $mail->setFrom(Database::USERNAME,'Xpress Website');
        //     //     $mail->addAddress($email);

        //     //     $mail->isHTML(true);
        //     //     $mail->Subject = 'Reset Password';
        //     //     $mail->Body = '<h3>Click the link below to reset your password. <br>
        //     //         <a href="http://localhost/Work%20Folder/particle/reset-pass.php?email='.$email.'&token='.$token.'">Click here to Reset Password</a>
        //     //         <br>Regards<br>Xpress Website</h3>';
        //     //     $mail->send();
        //     //     echo $user->displayMessage('success','A resest link has been sent to your email!');

        //     // }catch(Exception $e){
        //     //     echo $user->displayMessage('danger','Oops something went wrong! please try again');
        //     // }
        // }else{
        //     echo $user->displayMessage('warning','This Email is not registered!');
        // }
    }

?>