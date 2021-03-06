<?php
	session_start();
	require '../../../includes/db.php';

  if (isset($_SESSION['CNP'])){
	$date = filter_input(INPUT_POST, 'date_cons', FILTER_SANITIZE_STRING);
	$text = filter_input(INPUT_POST, 'text_cons', FILTER_SANITIZE_STRING);
	$id = $_SESSION['utilizator_edit'];
	if(isset($date) && preg_match("/^(((0[1-9]|[12]\d|3[01])\-(0[13578]|1[02])\-((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\-(0[13456789]|1[012])\-((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\-02\-((19|[2-9]\d)\d{2}))|(29\-02\-((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))\s([0-1][0-9]|[2][0-3]):([0-5][0-9])$/", $date))
	{
		$name = $_SESSION['utilizator'];
		$newEndDate = date('Y-m-d H:i', strtotime($date));		
		if(isset($text))
		{
			$newText = mysqli_real_escape_string($connection, $text);
			$query = "INSERT INTO consultatii_pacient (accountID, medicName, date, mention) VALUES ('$id','$name','$newEndDate', '$newText')";
			
			mysqli_query($connection, $query);
			header('Location: https://hospiweb.novacdan.ro/panel/profil/utilizator?id='.$_SESSION['utilizator_edit']);
		}
		else
		{
			$query = "INSERT INTO consultatii_pacient (accountID, medicName, date) VALUES ('$id','$name','$newEndDate')";
			
			mysqli_query($connection, $query);
			header('Location: https://hospiweb.novacdan.ro/panel/profil/utilizator?id='.$_SESSION['utilizator_edit']);
		}
	}
	else 
		header('Location: https://hospiweb.novacdan.ro/panel/profil/utilizator?id='.$_SESSION['utilizator_edit']);
  } else header('Location: https://hospiweb.novacdan.ro/login');
?>