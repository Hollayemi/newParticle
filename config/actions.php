<?php
    require_once "db.php";

    function testInput($data){
        $data = trim($data);
        $data = stripslashes($data); 
        $data = htmlspecialchars($data);
        return $data;
    }

        // Message 
        function displayMessage($type,$msg){
            return '<div class="alert alert-'.$type.' alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong class="text-center">'.$msg.'</strong>
            </div>';
        }

    function register($conn,$firstname,$surname,$email,$password,$phone,$address, $token)
    {
        $sql = "INSERT INTO users(first_name,surname,email,password, phone, address, token) VALUES(:first_name,:surname,:email,:password,:phone,:address,:token)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['first_name'=>$firstname, 'surname'=>$surname, 'email'=>$email,'password'=>$password, 'phone'=>$phone, 'address'=>$address, 'token'=>$token]);
        return true;
    }

    // check if email exist
    function userExist($conn,$email)
    {
        $sql = "SELECT email FROM users WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['email'=>$email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    // login existing user
    function login($conn,$email)
    {
        $sql = "SELECT email, password FROM users WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['email'=>$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    // retreiving current users detatil
    function currentUser($conn,$email)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['email'=>$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    // forgot password
    function forgot_password($conn,$token,$email)
    {
        $sql='UPDATE users SET token = :token WHERE email = :email';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['token'=>$token,'email'=>$email]);
        return true;
    }

    //reset password
    function resetPassword($conn,$email,$token)
    {
        $sql = "SELECT id FROM users WHERE email =:email AND token =:token AND token !=''";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['email'=>$email,'token'=>$token]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    // Update Password
    function updatePassword($conn,$pass,$email)
    {
        $sql = 'UPDATE users SET token="", password=:pass WHERE email=:email';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['pass'=>$pass,'email'=>$email]);
        return true;
    
    }
    function afterVerify($conn,$email)
    {
        $sql = 'UPDATE users SET token="" WHERE email=:email';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['email'=>$email]);
        return true;
    
    }
?>