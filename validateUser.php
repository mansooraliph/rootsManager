<?php

	include('dbcon.php');
	//include('composeMail.php');

	//sleep(5);
	
	$jsonString = file_get_contents('php://input');
	$jsonObj = json_decode($jsonString, true);
	
	$currentDate = date("d-m-Y") ;
	
		//echo " mansoor:: jsonObj : $jsonObj";
		$a = array();
		$b = array();
		foreach ($jsonObj as $result)
		{
			$name 		= $result["name"];
			$mobile 	= $result["mobile"];
			$imeiNo	 	= $result["imeiNo"];
			$password	= $result["password"];
						
			$result1 = $db->query("SET NAMES utf8");			
			$userQuery 	= " SELECT * FROM users WHERE  mobile = '$mobile'
							AND mobilePassword = '$password' ";
			
			$stmt = $db->query($userQuery);				
			$num_row = $stmt->rowCount();
			
			if($num_row >0)
			{			
				$row = $stmt->fetch(PDO::FETCH_ASSOC);	
				
				$id 				= $row['id'];	
				$b["name"] 			= $row["name"];	
				$b["imeiNo"] 		= $imeiNo;	
				$b["userId"] 		= $row['id'];			
				$b["mobile"] 		= $row['mobile'];
				$b["userType"] 		= $row['userType'];				
				$b["userLevel"] 	= $row['userLevel'];			
				$b["userSubLevel"] 	= $row['userSubLevel'];
				$b["position"] 		= $row['position'];
				$b["wing"] 			= $row['wing'];			
				$b["district"] 		= $row['district'];
				$b["zone"] 			= $row['zone'];
				$b["unit"] 			= $row['unit'];			
								
				
				$Q1 = "Update users set appLoggedFlag = 'Y', modtime = ADDTIME( NOW() ,'0 00:00:00.00' ) where  id = ?  ";
				$stmt = $db->prepare($Q1);
				$stmt->execute(array( $id ));
				$affected_rows = $stmt->rowCount();
								
			}
			else
			{						
				$id 				= "";	
				$b["name"] 			= $name;	
				$b["userId"] 		= "";	
				$b["mobile"] 		= "";	
				$b["userType"] 		= "";			
				$b["userLevel"] 	= "";			
				$b["userSubLevel"] 	= "";	
				$b["position"] 		= "";	
				$b["wing"] 			= "";		
				$b["district"] 		= "";	
				$b["zone"] 			= "";	
				$b["unit"] 			= "";	
							
			}

			
			array_push($a,$b);
					
		}
		//echo " mansoor:: success  :: $a";
		//echo "  $a";
		echo json_encode($a);
		

	
?>