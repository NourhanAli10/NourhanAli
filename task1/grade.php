<?php

define('Max_grade' ,100);

if ($_POST){

    $Physics = $_POST['Physics'];
    $Chemistry = $_POST['Chemistry'];
    $Biology = $_POST['Biology'];
    $Mathematics = $_POST['Mathematics'];
    $Computer = $_POST['Computer'];
    $result = $Physics + $Chemistry + $Biology + $Mathematics + $Computer ;
    $percentage = $result / (Max_grade*5)  *100 ;

    if($percentage >=90 && $percentage <= 100) {
           $_message="<div class='div'> your result is {$percentage} % / Grade A</div>" ;
    } 
    elseif($percentage >=80 && $percentage < 90) {
        $_message="<div class='div'> your result is {$percentage} %  / Grade B</div>" ;

    }
 elseif($percentage >=70 && $percentage < 80) {
    $_message="<div class='div'> your result is {$percentage} % /Grade C</div>" ;

}
 elseif($percentage >=60 && $percentage < 70) {
    $_message="<div class='div'> your result is {$percentage} % Grade D</div>" ;

}
 elseif($percentage >=40 && $percentage < 60) {
    $_message="<div class='div'> your result is {$percentage} % Grade E</div>" ;

}
elseif($percentage < 40 && $percentage >= 0) {
    $_message="<div class='div'> your result is {$percentage} % Grade E</div>" ;

}
    else{
        $_message="<div class='div'> Not Valid Number </div>" ;

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
background-color: #edc5323b;
margin-top: 20px;
height: 50px;
width:40%;
padding-top: 50px;

    }  
div{
   
    text-align: center;
    margin: auto;
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
    border:1px solid #FFB200;
    border-radius: 30px;
    padding: 10px;
}
input[type=submit]{
   background-color:#FFB200;
   height:40px;
   color:#000;
   margin-top: 40px;
}
    </style>
</head>
<body>
     <div>
        <h1> Students Grades</h1>
<form method="post">
<label for=" one">Physics</label>
<input type="number" id="one" name="Physics">


<label for=" two">Chemistry</label>
<input type="number" id="two" name="Chemistry">


<label for=" three">Biology</label>
<input type="number" id="three" name="Biology">


<label for ="four">Mathematics </label>
<input type="number" id="four" name="Mathematics">


<label for="five">Computer</label>
<input type="number" id="five" name="Computer">


<input type="submit">

</form>
     </div>
     <?php

  
    echo $_message  ?? " ";
   

    
   
   ?>
</body>
</html>