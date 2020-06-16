<?php
require 'variables.php';
require 'ConnectMysql.php';

class User extends ConnectMysql
{
    public function getUserData($user_id)
    {
        $query_str = "SELECT * FROM `users` WHERE ID=$user_id";

        $a = mysqli_query($this->connectDb(), $query_str);
        $user_data = [];
        while ($row = $a->fetch_assoc()) {
            $user_data["id"] = $row["id"];
            $user_data["name"] = $row["name"];
            $user_data["email"] = $row["email"];
            $user_data["lastname"] = $row["lastname"];
            $user_data["gender"] = $row["gender"];
            $user_data["age"] = $row["age"];
            $user_data["image"] = $row["image"];

        }
        return $user_data;

    }

    public function drawUpdateForm()
    {
        $html = '  <h1>Update</h1>
  <div class="content">
  <form method="post" action="account.php" enctype="multipart/form-data" >
	    
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
			<p>Password <span>*</span></p>
			<span class="icon-case"><i class="fa fa-location-arrow"></i></span>
				<input type="file" name="img" id="img" data-rule="required" data-msg="Vérifiez votre saisie sur les champs : Le champ \'Adresse\' doit être renseigné."/>
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
<input type="submit" name="submit_update" value="Send" class="bouton-contact">
	
</form>
';
        return $html;

    }

    public function updateUser($data, $user_id)
    {

        if (!empty($data)) {
            $name = $data['name'];
            $lastname = $data['lastname'];
            $age = $data['age'];
            $email = $data['email'];
            $gender = $data['gender'];

            $is_ok = true;
            if (isset($_FILES)) {
                if ($_FILES['img']["size"] > 900000) {
                    echo "Max size";
                    $is_ok = false;
                }
                if ($_FILES['img']["type"] != "image/jpeg" && $_FILES['img']["type"] != "image/png") {
                    echo $_FILES['img']["type"] . " not allowed";
                    $is_ok = false;
                }
                if (file_exists(basename($_FILES["img"]["name"]))) {
                    echo $_FILES['img']["name"] . "  exists ";
                    $is_ok = false;
                }
                if ($is_ok) {
                    move_uploaded_file($_FILES['img']["tmp_name"], "images/" . $_FILES['img']["name"]);
                }

                $user_image = $_FILES['img']["name"];
                $query_str ="UPDATE `users` SET `name`='{$name}',`lastname`='{$lastname}',`age`='{$age}',`image`='{$user_image}' WHERE  `id`={$user_id}; ";
//                if(!empty($name)){
//                    $query_str .= "`name`='{$name}'";
//                }

                mysqli_query($this->connectDb(),$query_str);
            }


        }

    }


}
