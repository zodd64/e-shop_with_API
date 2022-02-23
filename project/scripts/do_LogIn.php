<?php
    session_start();
	
	if (isset($_POST["email"])) {
	
		$url = 'http://localhost:8080/api/v1/users';
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPGET, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response_json = curl_exec($ch);
		curl_close($ch);
		$response=json_decode($response_json);
	

		foreach($response as $res){
			if($_POST["email"] == $res->email && password_verify($_POST["psw"], $res->password) && $res->enabled == true){
				$url2 = 'http://localhost:8080/api/v1/activate/' . strVal($res->id);
				$ch2 = curl_init($url2);
				curl_setopt($ch2, CURLOPT_HTTPGET, true);
				curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
				$response_json2 = curl_exec($ch2);
				curl_close($ch2);
				$response2=json_decode($response_json2);

				$_SESSION["user"] = $res->firstName;
    			$_SESSION["email"] = $res->email;
				$_SESSION["id"] = $res->id;

				header("Location: ../index.php");
    			die();
			}
			else if($_POST["email"] == $res->email && password_verify($_POST["psw"], $res->password) &&$res->enabled == false){
				$_SESSION["error"] = "Account is not verified." ;
				header("Location: ../pages/logIn.php");
    			die();
			}
			else{
				$_SESSION["error"] = "Username or password is wrong";
				header("Location: ../pages/logIn.php");
    			die();
			}

			
		}
	}

?>