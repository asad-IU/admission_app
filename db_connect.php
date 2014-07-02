<HTML>
<BODY>

<?php


	$con=mysqli_connect("localhost","root","","ticket_app");
	// Check connection
	if(mysqli_connect_errno())
		{	
			echo "Failed to connect to db: " . mysqli_connect_error();
		}
		
		
	$query_result = mysqli_query($con,"SELECT * FROM student_info WHERE STU_Code = '$_POST[std_id]'");
	
	if($query_result)
	{	// Student is not registered in this semester
		if(mysqli_num_rows($query_result) == 0)
		{	
			echo "Student is NOT eligible.";
		}
		else
		{
			$row=mysqli_fetch_array($query_result);
			// if ticket is not issued to eligible student
			if( ($row['Ticket_Issued']) == 0)
			{	
			$query_select = mysqli_query($con, "SELECT * FROM student_info WHERE STU_Code = '$_POST[std_id]'");
		
			$row=mysqli_fetch_array($query_select);
			mysqli_query($con, "update student_info set ticket_issued = 1 where stu_code = '$_POST[std_id]'");
			echo "Ticket Issued to the Student : " . $row['Student_Name'];
			}
			else
			{ // Ticket already issued
			echo "Ticket is issued to the Student";
			}
			
		}
	
	

	
	
	
	mysqli_close($con);

?>			
	
    	
</BODY>
</HTML>