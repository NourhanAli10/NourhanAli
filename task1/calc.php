<?php
if($_POST){

   
	    $value1 = $_POST['value1'];
					$value2 = $_POST['value2'];



 if(isset($_POST['sum'])){
  
    $result = "<p class='div'>" . $value1 +  $value2  . "</p>";


	}elseif(isset($_POST['sub'])){

        $result = "<p class='div'>" . $value1 -  $value2  . "</p>";

	}elseif(isset($_POST['multi'])){

        $result = "<p class='div'>" . $value1 *  $value2  . "</p>";		

	}elseif(isset($_POST['division'])){

      $result = "<p class='div'>" . $value1 /  $value2  . "</p>";	

	}elseif(isset($_POST['mod'])){

        $result = "<p class='div'>" . $value1 %  $value2  . "</p>";	
		
	}



}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .div{
background-color: #a1688a3b;
margin-top: 20px;
height: 50px;
width:40%;
padding-top: 50px;
margin:auto;
text-align: center;

    }  
div{
   
    text-align: center;
    margin: auto;
  }
.btn{
    margin-top: 20px;
    margin-bottom: 20px
  }
  .btn1{
    background-color: ;
    border :1px solid #cd2c6f ;
    width:14%;
    font-size: 20px;
    
  }
form{
    width:40%;
    margin: auto;
}
label{
    text-align: start;
    font-size: 20px;
    padding-top: 20px;
    display: block;
}
input{
    display: block;
    width:100%;
    height:25px;
    margin-top: 20px;
    border:1px solid #cd2c6f;
    border-radius: 30px;
    padding: 10px;
}
input[type=submit]{
   background-color:#cd2c6f;
   height:40px;
   color:#000;
   margin-top: 40px;
}
    </style>
</head>
<body>
     <div>
        <h1> Calculator</h1>
<form method="post">
<input type="number" name="value1" placeholder="enter value 1">
<input type="number"  name="value2" placeholder="enter value2">
<div class="btn">
<button class="btn1"  name ="sum" value ="sum" > + </button>
<button class="btn1" name ="sub"  value ="sub" >  - </button>
<button class="btn1" name ="multi" value ="multi"  >  *</button>
<button class="btn1" name ="division" value ="division"  > / </button>
<button  class="btn1" name ="mod"  value ="mod" >  % </button>
</div>

<!-- <input type="submit" name =" submit"> -->
</form>
     </div>
     <?php

  
    echo $result  ?? " ";
   

    
   
   ?>
</body>
</html>