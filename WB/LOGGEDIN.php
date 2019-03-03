<?php
     require("common.php"); 
    // $u="";
	// //username="";
		
		 $query = " SELECT * FROM loggedin "; 
		 $query_params = array(); 
		 define ('DB_Name','db1');
		 define ('DB_User','root');
		 define ('DB_Pass','');
		 define ('DB_Host','localhost');
		 $link= mysqli_connect(DB_Host,DB_User,'',DB_Name);

         try 
         { 
         //Execute the query against the database 
          $stmt = $db->prepare($query); 
          $result = $stmt->execute($query_params); 
		 } 
        catch(PDOException $ex) 
        { 
            // Note: On a production website, you should not output $ex->getMessage(). 
            // It may provide an attacker with helpful information about your code.  
            die("Failed to run query: " . $ex->getMessage()); 
        } 
         
        //This variable tells us whether the user has successfully logged in or not. 
        //We initialize it to false, assuming they have not. 
        //If we determine that they have entered the right details, then we switch it to true. 
        $login_ok = false; 
        // Retrieve the user data from the database.  If $row is false, then the username 
        // they entered is not registered. 
        $row = $stmt->fetch();
         
		
        if($row) 
        {$u=$row['username'];}
//$u contains user name
		
	$query1="SELECT account from kyc where username=:username";
		$query1_params=array(':username' =>$u);
			$stmt = $db->prepare($query1); 
            $result = $stmt->execute($query1_params); $row = $stmt->fetch(); 		
		$acc=$row['account'];
	 
		if ((isset($_POST['Logout'])))
		{
				
		$query = " TRUNCATE table loggedin"; 
		$query_params = array(); 
        try 
        { 
            // Execute the query against the database 
            $stmt = $db->prepare($query); 
             $result = $stmt->execute($query_params); 
			 echo($result);
			header("Location: login.html");
		} 
        catch(PDOException $ex) 
        { 
            // Note: On a production website, you should not output $ex->getMessage(). 
            // It may provide an attacker with helpful information about your code.  
            die("Failed to run query: " . $ex->getMessage()); 
        } 
			// define ('DB_Name','db1');
			 // define ('DB_User','root');
			 // define ('DB_Pass','');
			 // define ('DB_Host','localhost');
			// $link= mysqli_connect(DB_Host,DB_User,'',DB_Name);
			// $query1="TRUNCATE table loggedin;"
			// $result=$link->query($query1);
			#$result=mysqli_query($link,$query1);
			#if (!mysqli_query($link,$query1)){die('Error'.mysqli_error($link));}
			header("Location: login.html");
		}
		
?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Shop Homepage - Start Bootstrap Template</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/shop-homepage.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">CryptoTrakk</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.html">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
		  <form action ="" method="post">
            <a class="nav-link" href="login.html"><button type="submit" name="Logout"/>Logout</a>
			</form>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.html">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">

    <div class="row">

      <div class="col-lg-3">

        <h1 class="my-4">Donate ! Donate ! Donate !</h1>
        <div class="list-group">
          <a href="#" class="list-group-item">Make Donations</a>
          <a href="#" class="list-group-item">View Statistics</a>
          <a href="#" class="list-group-item">Track Donations</a>
        </div>

      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">

        <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <img class="d-block img-fluid" src="download1.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="download2.png" alt="Second slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="download3.png" alt="Third slide">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

        <div class="row">

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <a href="#"><img class="card-img-top" src="download.png" alt=""></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="#">American Civil Liberties Union Foundations</a>
                </h4><p class="card-text" >For almost 100 years, the ACLU has worked to defend and preserve the individual rights and liberties guaranteed by the Constitution and laws of the United States.</p>
				<h5><p>Procurement Agent: Brian J Jones LLC  Product: Attorney  Price: $2498 Trustworthy Factor: 4.9</p> </h5>
								<form class="form" role="form" method="post" action="login" accept-charset="UTF-8" id="login-nav">
                                    <div class="form-group">
                                       <label class="sr-only" for="exampleInputEmail2">Amount:</label>
                                       <input type="text" class="form-control" id="amm1" placeholder="Amount" required>
                                    </div>
									<div class="form-group">
                                       <label class="sr-only" for="exampleInputEmail2">Account Number:</label>
                                       <input type="email" class="form-control" id="acc1"  readonly="readonly" value="<?php echo ($acc);?>"required>
                                    </div>
                                    <div class="form-group">
                                       <label class="sr-only" for="exampleInputPassword2">Password</label>
                                       <input type="text" class="form-control" id="pswd1" required>
                                    </div>
                                    <div class="form-group">
                                       <button type="submit" class="btn btn-success btn-block">Donate</button>
                                    </div>
                                 </form>
 
              </div>
              <div class="card-footer">
                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9733;</small>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mb-4" onload="">
            <div class="card h-100">
              <a href="#"><img class="card-img-top" src="download.png" alt=""></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="#">Do Something</a>
                </h4>
                <p class="card-text">DoSomething is a global non-profit organization with the goal of motivating young people to make positive change both online and offline through campaigns that make an impact. The organization's CEO is Aria Finger.</p>
              <h5><p>Procurement Agent: Calmart  Product: Head Gears  Price: $750 Trustworthy Factor: 4.8</p> </h5>
								<form class="form" role="form" method="post" action="login" accept-charset="UTF-8" id="login-nav">
                                    <div class="form-group">
                                       <label class="sr-only" for="exampleInputEmail2">Amount:</label>
                                       <input type="text" class="form-control" id="amm2" placeholder="Amount" required>
                                    </div>
									<div class="form-group">
                                       <label class="sr-only" for="exampleInputEmail2">Account Number:</label>
                                       <input type="email" class="form-control" id="acc2"  readonly="readonly" value="<?php echo ($acc);?>"required>
                                    </div>
                                    <div class="form-group">
                                       <label class="sr-only" for="exampleInputPassword2">Password</label>
                                       <input type="text" class="form-control" id="pswd2" required>
                                    </div>
                                    <div class="form-group">
                                       <button type="button" onclick='Donate()' class="btn btn-success btn-block">Donate</button>
                                    </div>
                                 </form>
 
			  </div>
              <div class="card-footer">
                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <a href="#"><img class="card-img-top" src="download.png" alt=""></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="#">DonorsChoose.org</a>
                </h4>
                <p class="card-text">DonorsChoose.org is a United Statesâ€“based nonprofit organization that allows individuals to donate directly to public school classroom projects. Founded in 2000 by former public school teacher Charles Best, DonorsChoose.org was among the first civic crowdfunding platforms of its kind.</p>
              <h5><p>Procurement Agent: Calmart  Product: Boooks  Price: $1750 Trustworthy Factor: 4.85</p> </h5>
								<form class="form" role="form" method="post" action="login" accept-charset="UTF-8" id="login-nav">
                                    <div class="form-group">
                                       <label class="sr-only" for="exampleInputEmail2">Amount:</label>
                                       <input type="text" class="form-control" id="amm3" placeholder="Amount" required>
                                    </div>
									<div class="form-group">
                                       <label class="sr-only" for="exampleInputEmail2">Account Number:</label>
                                       <input type="email" class="form-control" id="acc3"  readonly="readonly" value="<?php echo ($acc);?>"required>
                                    </div>
                                    <div class="form-group">
                                       <label class="sr-only" for="exampleInputPassword2">Password</label>
                                       <input type="text" class="form-control" id="pswd3" required>
                                    </div>
                                    <div class="form-group">
                                       <button type="button" onclick='Donate()' class="btn btn-success btn-block">Donate</button>
                                    </div>
                                 </form>
 
			  
			  
			  </div>
              <div class="card-footer">
                <small class="text-muted">&#9733; &#9733; &#9733; &#9734; &#9734;</small>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <a href="#"><img class="card-img-top" src="download.png" alt=""></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="#">Natural Resources Defense Council</a>
                </h4>
                <p class="card-text">The Natural Resources Defense Council is a United States-based, non-profit international environmental advocacy group, with its headquarters in New York City and offices in Washington, D.C.; San Francisco; Los Angeles; New Delhi, India; Chicago; Bozeman, Montana; and Beijing, China.</p>
              <h5><p>Procurement Agent: Martin And PC  Product: Attorney  Price: $23500 </p> Trustworthy Factor: 4.78</h5>
								<form class="form" role="form" method="post" action="login" accept-charset="UTF-8" id="login-nav">
                                    <div class="form-group">
                                       <label class="sr-only" for="exampleInputEmail2">Amount:</label>
                                       <input type="text" class="form-control" id="amm4" placeholder="Amount" required>
                                    </div>
									<div class="form-group">
                                       <label class="sr-only" for="exampleInputEmail2">Account Number:</label>
                                       <input type="email" class="form-control" id="acc4"  readonly="readonly" value="<?php echo ($acc);?>"required>
                                    </div>
                                    <div class="form-group">
                                       <label class="sr-only" for="exampleInputPassword2">Password</label>
                                       <input type="text" class="form-control" id="pswd4" required>
                                    </div>
                                    <div class="form-group">
                                       <button type="button" onclick='Donate()' class="btn btn-success btn-block">Donate</button>
                                    </div>
                                 </form>
 
			  
			  
			  
			  </div>
              <div class="card-footer">
                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <a href="#"><img class="card-img-top" src="download.png" alt=""></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="#">Global Giving</a>
                </h4>
                <p class="card-text">GlobalGiving is 501 non-profit organization based in the United States that provides a global crowdfunding platform for grassroots charitable projects. Since 2002, more than 800,000 donors on GlobalGiving have raised more than $340 million to support more than 20,000 projects in 170 countries</p>
              <h5><p>Procurement Agent: BAYER  Product: Medicines  Price: $1147 Trustworthy Factor: 4.29</p> </h5>
								<form class="form" role="form" method="post" action="login" accept-charset="UTF-8" id="login-nav">
                                    <div class="form-group">
                                       <label class="sr-only" for="exampleInputEmail2">Amount:</label>
                                       <input type="text" class="form-control" id="amm5" placeholder="Amount" required>
                                    </div>
									<div class="form-group">
                                       <label class="sr-only" for="exampleInputEmail2">Account Number:</label>
                                       <input type="email" class="form-control" id="acc5"  readonly="readonly" value="<?php echo ($acc);?>"required>
                                    </div>
                                    <div class="form-group">
                                       <label class="sr-only" for="exampleInputPassword2">Password</label>
                                       <input type="text" class="form-control" id="pswd5" required>
                                    </div>
                                    <div class="form-group">
                                       <button type="button" onclick='Donate()' class="btn btn-success btn-block">Donate</button>
                                    </div>
                                 </form>
 
			  </div>
              <div class="card-footer">
                <small class="text-muted">&#9733; &#9733; &#9733; &#9734; &#9734;</small>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <a href="#"><img class="card-img-top" src="download.png" alt=""></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="#">American Heart Assosiation</a>
                </h4>
                <p class="card-text">The American Heart Association is a non-profit organization in the United States that funds cardiovascular medical research, educates consumers on healthy living and fosters appropriate cardiac care in an effort to reduce disability and deaths caused by cardiovascular disease and stroke.</p>
              <h5><p>Procurement Agent: John Hopkins  Product: Surgery  Price: $3750 Trustworthy Factor: 4.49</p> </h5>
								<form class="form" role="form" method="post" action="login" accept-charset="UTF-8" id="login-nav">
                                    <div class="form-group">
                                       <label class="sr-only" for="exampleInputEmail2">Amount:</label>
                                       <input type="text" class="form-control" id="amm6" placeholder="Amount" required>
                                    </div>
									<div class="form-group">
                                       <label class="sr-only" for="exampleInputEmail2">Account Number:</label>
                                       <input type="email" class="form-control" id="acc6"  readonly="readonly" value="<?php echo ($acc);?>"required>
                                    </div>
                                    <div class="form-group">
                                       <label class="sr-only" for="exampleInputPassword2">Password</label>
                                       <input type="text" class="form-control" id="pswd6" required>
                                    </div>
                                    <div class="form-group">
                                       <button type="button" id='release' class="btn btn-success btn-block">Donate</button>
                                    </div>
                                 </form>
 
			  </div>
              <div class="card-footer">
                <small class="text-muted">&#9733; &#9733; &#9733; &#9734; &#9734;</small>
              </div>
            </div>
          </div>

        </div>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; CryptoTrakk 2019</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>

<script>
$(document).ready(function(){
$("#release").click(function (){
	var var1= document.getElementById("amm6").value;
	var var2= document.getElementById("acc6").value;
	var var3= document.getElementById("pswd6").value;
	$.post('http://192.168.137.210:4000/sendTrans', {
	Amount:var1,Account:var2,Password:var3},
	function(result){
		console.log(result);
		console.log(result);
	});
	
});
});
// function Donate(double amm,string acc,string pswd){
// var var1= document.getElementById("amm").value;
// var var2= document.getElementById("acc").value;
// var var3= document.getElementById("pswd").value;
// console.lock();
// $.ajax({

        // type:"POST"
        // url:'http://:4000/sendTrans.js',
        // data:{Amount:var1,Account:var2,Password:var3},
        // success:success,
		// dataType: boolean
        // }
     // })

// }
</script>



