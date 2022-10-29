<?php

namespace App\authentication;

use App\database\models\model;


class validation {
private $input ; // value
private $inputName ;//name
public $errors =[];
private array $restrictedValues = [
    null,'',[],
];


public function require()
{
      if(in_array($this->input,$this->restrictedValues)){
        $this->errors[$this->inputName][__FUNCTION__] = "{$this->inputName} is required";
    }
  return $this;

}

public function string(){
    
    if(! is_string($this->input)){
        $this->errors[$this->inputName][__FUNCTION__] = "{$this->inputName} must be string ";
    }
  return $this;

}


public function between($min , $max){
    if(! (strlen($this->input) >= $min && strlen($this->input) <= $max)){
        $this->errors[$this->inputName][__FUNCTION__] = "{$this->inputName} must be between {$min} , {$max}";
    }
    return $this;
}


public function regex($pattern,$message=null){
    if(! preg_match($pattern,$this->input)){
        $this->errors[$this->inputName][__FUNCTION__] = $message ?? "{$this->inputName} invalid ";

    }
    return $this;

}

public function unique($table,$column){

    $query="SELECT * FROM {$table} WHERE {$column} =? ";
    $model= new model;
    $stat = $model->conn->prepare($query);
    if($stat == false){
        $this->errors[$this->inputName][__FUNCTION__] = "something went wrong ";

    }
    $stat->bind_param('s',$this->input);
    $stat->execute();
    if($stat->get_result()->num_rows > 0){
        $this->errors[$this->inputName][__FUNCTION__] = "{$this->inputName} already exists ";

    }
    return $this;

}


    public function exist($table,$column)  
    {
        $query = "SELECT * FROM {$table} WHERE {$column} = ?";
        $model = new Model;
        $stat = $model->conn->prepare($query);
        if(! $stat){
            $this->errors[$this->inputName][__FUNCTION__] = "Something went wrong";
        }   
        $stat->bind_param('s',$this->input);
        $stat->execute();
        if($stat->get_result()->num_rows == 0){
            $this->errors[$this->inputName][__FUNCTION__] = "{$this->inputName} doesn't Exist";
        }
         return $this;
    }




public function confirm($password_confirm){
    
if($this->input !== $password_confirm ){
    $this->errors[$this->inputName][__FUNCTION__] = " your {$this->inputName} doesn't match";

}

return $this;

}
public function in($values ){
    if(! in_array($this->input,$values)){
        $this->errors[$this->inputName][__FUNCTION__] = " {$this->inputName} choose between values ". implode(' ,',$values);

    }
    return $this;

}


public function numbers($numbers){
    if((strlen($this->input) !== $numbers)){
        $this->errors[$this->inputName][__FUNCTION__] = "{$this->inputName} must be {$numbers} digits ";
    }
    return $this;
}


public function numeric(){
    if(! is_numeric($this->input)){
        $this->errors[$this->inputName][__FUNCTION__] = "{$this->inputName} must be number  ";
    }
    return $this;
}





/**
 * Set the value of inputs
 *
 * @return  self
 */ 
public function setInputName($inputName)
{
$this->inputName = $inputName;

return $this;
}

/**
 * Set the value of inputValue
 *
 * @return  self
 */ 
public function setInput($input)
{
$this->input = $input;

return $this;

}


/**
 * Get the value of errors
 */ 
public function getErrors()
{


return $this->errors;
}

/**
 * Set the value of errors
 *
 * @return  self
 */ 
public function setErrors($errors)
{
$this->errors = $errors;

return $this;
}


public function getError($inputName){

    if(isset($this->errors[$inputName])){
        foreach($this->errors[$inputName] AS $error){
     return $error;
      }
    }
    return null;
}






}



