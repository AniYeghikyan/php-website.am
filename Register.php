<?php
require "variables.php";

require 'ConnectMysql.php';

class Register extends ConnectMysql
{
    private $login;
    protected $password;
    public $is_logined;

    /*
     *Draw Register form
     * @return string $html
     * */
    public function drawRegisterForm()
    {
        $html = '  <h1>Register/Login</h1>
  <div class="content">
  <form method="post" action="/">
	    
    <div class="contentform">
    	<div id="sendmessage"> Your message has been sent successfully. Thank you. </div>


    	
			      <div class="form-group">
			        <p>Surname<span>*</span></p>
			        <span class="icon-case"><i class="fa fa-male"></i></span>
				        <input type="text" name="lastname" id="nom" data-rule="required" data-msg="Vérifiez votre saisie sur les champs : Le champ \'Nom\' doit être renseigné."/>
                <div class="validation"></div>
       </div> 

            <div class="form-group">
            <p>Name <span>*</span></p>
            <span class="icon-case"><i class="fa fa-user"></i></span>
				<input type="text" name="name" id="prenom" data-rule="required" data-msg="Vérifiez votre saisie sur les champs : Le champ \'Prénom\' doit être renseigné."/>
                <div class="validation"></div>
			</div>

			<div class="form-group">
			<p>E-mail <span>*</span></p>	
			<span class="icon-case"><i class="fa fa-envelope-o"></i></span>
                <input type="email" name="email" id="email" data-rule="email" data-msg="Vérifiez votre saisie sur les champs : Le champ \'E-mail\' est obligatoire."/>
                <div class="validation"></div>
			</div>	

			<div class="form-group">
			<p>Age <span>*</span></p>
			<span class="icon-case"><i class="fa fa-home"></i></span>
				<input type="number" name="age" id="society" data-rule="required" data-msg="Vérifiez votre saisie sur les champs : Le champ \'Société\' doit être renseigné."/>
                <div class="validation"></div>
			</div>

			<div class="form-group">
			<p>Password <span>*</span></p>
			<span class="icon-case"><i class="fa fa-location-arrow"></i></span>
				<input type="text" name="password" id="adresse" data-rule="required" data-msg="Vérifiez votre saisie sur les champs : Le champ \'Adresse\' doit être renseigné."/>
                <div class="validation"></div>
			</div>

			<div class="form-group">
			<p>Gender <span>*</span></p>
			<div class="content">
			<span class="icon-case">Male</span>
				<input type="radio" value="male" name="gender" id="postal" data-rule="required" data-msg="Vérifiez votre saisie sur les champs : Le champ \'Code postal\' doit être renseigné."/>
            
			<span class="icon-case">Female</span>
				<input type="radio" name="gender" value="female" id="postal" data-rule="required" data-msg="Vérifiez votre saisie sur les champs : Le champ \'Code postal\' doit être renseigné."/>
            </div>
			</div>	



	
	</div>
<input type="submit" name="submit_register" value="Send" class="bouton-contact">
	
</form>
  <form method="post" action="index.php">
	    
    <div class="contentform">
    	<div id="sendmessage"> Your message has been sent successfully. Thank you. </div>


    	
			      <div class="form-group">
			        <p>Email<span>*</span></p>
			        <span class="icon-case"><i class="fa fa-male"></i></span>
				        <input type="email" name="email" id="nom" data-rule="required" data-msg="Vérifiez votre saisie sur les champs : Le champ \'Nom\' doit être renseigné."/>
                <div class="validation"></div>
       </div> 

            <div class="form-group">
            <p>Password <span>*</span></p>
            <span class="icon-case"><i class="fa fa-user"></i></span>
				<input type="password" name="password" id="prenom" data-rule="required" data-msg="Vérifiez votre saisie sur les champs : Le champ \'Prénom\' doit être renseigné."/>
                <div class="validation"></div>
			</div>
	</div>
<input type="submit" name="submit_login" value="Send" class="bouton-contact">
	
</form>	</div>';
        return $html;

    }


    public function registerUser($data)
    {

        if (!empty($data)) {
            if (!empty($data['name'])) {

                $name = $data['name'];
                $lastname = $data['lastname'];
                $email = $data['email'];
                $password = md5($data['password']);
                $age = $data['age'];
                $gender = $data['gender'];
                $connect = $this->connectDb();
                $query_str = "SELECT MAX(ID) FROM `users`";

                $a = mysqli_query($this->connectDb(), $query_str);
                if ($a < 1) {
                    $user_id = 1;
                } else {
                    $result = mysqli_fetch_all($a);
                    $user_id = $result[0][0];
                    $user_id = $user_id + 1;
                }



                $query_str = "INSERT INTO `users` (`ID`,`name`,`email`,`password`,`age`,`gender`,`lastname`) VALUES ('$user_id','{$name}','{$email}','{$password}','{$age}','{$gender}','{$lastname}')";
                echo $query_str;
                if ($connect) {
                    $result = mysqli_query($connect, $query_str);
                    if ($result) {
                        $_SESSION["user_id"] = $user_id;
                        $_SESSION["is_logged_in"] = 1;
                        return "OK";

                    } else {
                        return "All fields are required";
                    }

                }

            } else {
                return "no name";
            }
        }
    }


    public function login($username, $password)
    {
        $password = md5($password);
        $query_str = "SELECT * FROM `users` WHERE `email`='$username' AND `password`='{$password}';";

        $a = mysqli_query($this->connectDb(), $query_str);
        $user_data = [];
        while ($row = $a->fetch_assoc()) {
            $user_data["id"] = $row["id"];

            $user_data["email"] = $row["email"];
            $user_data["password"] = $row["password"];
        }


        if (!empty($user_data)) {


            $_SESSION["user_id"] = $user_data["id"];
            $_SESSION["is_logged_in"] = 1;
            return true;
        }

    }

    public function logOut()
    {
        unset($_SESSION['is_logged_in']);
        unset($_SESSION['user_id']);

    }
}