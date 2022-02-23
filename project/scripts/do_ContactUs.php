<?php
    session_start();

	if (isset($_POST["email"])) {

		if(isset( $_POST['name']))
			$name = $_POST['name'];
		if(isset( $_POST['email']))
			$email = $_POST['email'];
		if(isset( $_POST['message']))
			$message = $_POST['message'];
		if(isset( $_POST['subject']))
			$subject = $_POST['subject'];
			
		if ($name === ''){
			$_SESSION["error"] = "Name cannot be empty!";
			header("Location: ../pages/contactUSExperiment.php");
			die();
		}
		
		if ($email === ''){
			$_SESSION["error"] = "Email cannot be empty!";
			header("Location: ../pages/contactUSExperiment.php");
			die();
		} else {
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$_SESSION["error"] = "Email format invalid!";
				header("Location: ../pages/contactUSExperiment.php");
				die();
			}
		}
		
		if ($subject === ''){
			$_SESSION["error"] = "Subject cannot be empty!";
			header("Location: ../pages/contactUSExperiment.php");
			die();
		}
		
		if ($message === ''){
			$_SESSION["error"] = "Message cannot be empty!";
			header("Location: ../pages/contactUSExperiment.php");
			die();
		}
		
		$content="From: $name \nEmail: $email \nMessage: $message";
		$recipient = "tp4402smtp@gmail.com";
		$mailheader = "From: $email \r\n";
		mail($recipient, $subject, $content, $mailheader) or die("Error!");
		$_SESSION["success"] = "Thank you for contacting us!";
		header("Location: ../pages/contactUSExperiment.php");
		die();
	
	} else {
        header("Location: ../pages/contactUs.php");
        die();
    }  
?>