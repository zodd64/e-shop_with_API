<?php
    session_start();
	
	if(isset($_SESSION["user"])) {	
		header("Location: http://localhost/project/index.php");
		die();
	}

	$code = $_GET['code'];

	$url = 'http://localhost:8080/api/v1/users';
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_HTTPGET, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response_json = curl_exec($ch);
	curl_close($ch);
	$response=json_decode($response_json);

	foreach($response as $res){
		if($code == $res->confirmationToken){
			$url2 = 'http://localhost:8080/api/v1/activate/' . strVal($res->id);
			$ch2 = curl_init($url2);
			curl_setopt($ch2, CURLOPT_HTTPGET, true);
			curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
			$response_json2 = curl_exec($ch2);
			curl_close($ch2);
			$response2=json_decode($response_json2);
		
			$_SESSION["psa1Success"] = "Thank you for your registration!";
			$_SESSION["psa2Success"] = "You may now login.";
			
			header("Location: http://localhost/project/pages/verification.php");
			die();
		}
		else{
			$_SESSION["psaFail"] = "Hmm something went wrong here :(";
			
		}
		
	}
	
?>

