<html>
<head>
	<title>Admission Result</title>
    <script>
		function validateForm()
		{
			var x = document.forms["adm_Form"]["seatno"].value;
			if(x == "" || x == NULL || isNaN(x))
			{
				alert("Invalid Seat no.");
				return false;
			}
		}
	</script>
</head>
<body background="bg.jpg">

	<div style="background: none repeat scroll 0 0 #FFFFFF;
    border-radius: 5px;
    float: left;
    margin: 110px 68px auto 378px;
    padding: 9px;
    width: 500px;">
    <div style=" float: left;
    overflow: hidden;
    width: 500px;">
    	<img src="header.png"  />
    </div>
    
    
        
    <form name="adm_Form" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" onSubmit="return validateForm()">	
        <table>
			<tr>
				<td>Enter Seat No: </td>
				<td><input type="input" name="seatno" /></td>
			</tr>
		<table>
	</form>
    
    
   

<?php
	
if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$con=mysqli_connect("localhost","root","","ticket_app");
		// Check connection
		if(mysqli_connect_errno())
		{	
			echo "Failed to connect to db: " . mysqli_connect_error();
		}
		$seatno = $_POST['seatno'];
		$query_result = mysqli_query($con,"SELECT * FROM `table 5` WHERE seatno like '$seatno'");
		
		if(mysqli_num_rows($query_result) != 0)
		{
			while($row = mysqli_fetch_array($query_result))
			{
				echo "<p style='color:green;font-size:20px;text-align:center'>Congratulations!<br />You have cleared the admission test.</p>".
					
					"Name: ".$row['name']."<br />
					Seat no: ".$row['seatno']."<br />
					Admission Degree: ".$row['adm_degree']."<br /> 
					<span style='font-weight:bold'>Your interview is scheduled on ".$row['interview_date']." at ".$row['interview_time']."</span>
					
					<br /><br /><span style='color:red;font-weight:bold'>Note:</span><br />
					You are requested to be formally dressed up and bring all original academic documents along with you on interview day.";
			}
		}
		else
		{
			echo "<p style='color:red; text-align:center; font-falimy:Arial'>You have failed the test.</p>";
		}
		
		
	mysqli_close($con);
			
	}
	
?>


</div>

</body>
</html>