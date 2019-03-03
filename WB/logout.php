<?php

			define ('DB_Name','db1');
			define ('DB_User','root');
			define ('DB_Pass','');
			define ('DB_Host','localhost');
			echo("Logging out");
 			$link= mysqli_connect(DB_Host,DB_User,'',DB_Name);
			$query1="Truncate loggedin"
			$result=mysqli_query($link,$query);
?>