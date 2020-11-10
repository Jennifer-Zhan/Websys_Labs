<?php

abstract class Operation {
  protected $operand_1;
  protected $operand_2;
  public function __construct($o1, $o2) {
    // Make sure we're working with numbers...
    if (!is_numeric($o1) || !is_numeric($o2)) {
      throw new Exception('Non-numeric operand.');
    }

    // Assign passed values to member variables
    $this->operand_1 = $o1;
    $this->operand_2 = $o2;
  }
  public abstract function operate();
  public abstract function getEquation();
}

interface myInterface {
  public function operate();
  public function getEquation();
}

// Add subclasses for Subtraction, Multiplication and Division here

// Addition subclass inherits from Operation
class Addition extends Operation implements myInterface{
  public function operate() {
    return $this->operand_1 + $this->operand_2;
  }
  public function getEquation() {
    return $this->operand_1 . ' + ' . $this->operand_2 . ' = ' . $this->operate();
  }
}

class Subtract extends Operation implements myInterface{
  public function operate() {
    return $this->operand_1 - $this->operand_2;
  }
  public function getEquation() {
    return $this->operand_1 . ' - ' . $this->operand_2 . ' = ' . $this->operate();
  }
}

class Multiply extends Operation implements myInterface{
  public function operate() {
    return $this->operand_1 * $this->operand_2;
  }
  public function getEquation() {
    return $this->operand_1 . ' * ' . $this->operand_2 . ' = ' . $this->operate();
  }
}

class Divide extends Operation implements myInterface{
  public function operate() {
    return $this->operand_1 / $this->operand_2;
  }
  public function getEquation() {
    return $this->operand_1 . ' / ' . $this->operand_2 . ' = ' . $this->operate();
  }
}

class Square_root extends Operation implements myInterface{
  public function operate() {
    return sqrt($this->operand_1);
  }
  public function getEquation() {
    return ' sqrt( ' . $this->operand_1 . ' ) ' . ' = ' . $this->operate();
  }
}

class Square extends Operation implements myInterface{
  public function operate() {
    return $this->operand_1 * $this->operand_1;
  }
  public function getEquation() {
    return $this->operand_1 . ' ^ ' . ' 2 ' . ' = ' . $this->operate();
  }
}

class xpy extends Operation implements myInterface{
  public function operate() {
    if($this->operand_2 == 0){
      return 1;
    }
    else if($this->operand_2 > 0){
      $a = $this->operand_1;
      for($x = 1; $x < $this->operand_2; $x++){
        $a = $a * $this->operand_1;
      }
      return $a;
    }
    else{
      $a = $this->operand_1;
      for($x = -1; $x > $this->operand_2; $x--){
        $a = $a * $this->operand_1;
      }
      return 1/$a;
    }
  }
  public function getEquation() {
    return $this->operand_1 . ' ^ ' . $this->operand_2 . ' = ' . $this->operate();
  }
}

class tp extends Operation implements myInterface{
  public function operate() {
    if($this->operand_1 == 0){
      return 1;
    }
    else if($this->operand_1 > 0){
      $a = 10;
      for($x = 1; $x < $this->operand_1; $x++){
        $a = $a * 10;
      }
      return $a;
    }
    else{
      $a = 10;
      for($x = -1; $x > $this->operand_1; $x--){
        $a = $a * 10;
      }
      return 1/$a;
    }
  }
  public function getEquation() {
    return ' 10 ' . ' ^ ' . $this->operand_1 . ' = ' . $this->operate();
  }
}

class ep extends Operation implements myInterface{
  public function operate() {
    if($this->operand_1 == 0){
      return 1;
    }
    else if($this->operand_1 > 0){
      $a = 2.71828182845904523536;
      for($x = 1; $x < $this->operand_1; $x++){
        $a = $a * 2.71828182845904523536;
      }
      return $a;
    }
    else{
      $a = 2.71828182845904523536;
      for($x = -1; $x > $this->operand_1; $x--){
        $a = $a * 2.71828182845904523536;
      }
      return 1/$a;
    }
  }
  public function getEquation() {
    return ' e ' . ' ^ ' . $this->operand_1 . ' = ' . $this->operate();
  }
}

class sin extends Operation implements myInterface{
  public function operate() {
    return sin($this->operand_1);
  }
  public function getEquation() {
    return ' sin( ' . $this->operand_1 . ' ) ' . ' = ' . $this->operate();
  }
}

class cos extends Operation implements myInterface{
  public function operate() {
    return cos($this->operand_1);
  }
  public function getEquation() {
    return ' cos( ' . $this->operand_1 . ' ) ' . ' = ' . $this->operate();
  }
}

class tan extends Operation implements myInterface{
  public function operate() {
    return tan($this->operand_1);
  }
  public function getEquation() {
    return ' tan( ' . $this->operand_1 . ' ) ' . ' = ' . $this->operate();
  }
}

class ln extends Operation implements myInterface{
  public function operate() {
    return log($this->operand_1);
  }
  public function getEquation() {
    return ' ln( ' . $this->operand_1 . ' ) ' . ' = ' . $this->operate();
  }
}

class log extends Operation implements myInterface{
  public function operate() {
    return log($this->operand_1,10);
  }
  public function getEquation() {
    return ' log( ' . $this->operand_1 . ' ) ' . ' = ' . $this->operate();
  }
}



// Some debugs - uncomment these to see what is happening...
// echo '$_POST print_r=>',print_r($_POST);
// echo "<br>",'$_POST vardump=>',var_dump($_POST);
// echo '<br/>$_POST is ', (isset($_POST) ? 'set' : 'NOT set'), "<br/>";
// echo "<br/>---";


// Check to make sure that POST was received
// upon initial load, the page will be sent back via the initial GET at which time
// the $_POST array will not have values - trying to access it will give undefined message

  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $o1 = $_POST['op1'];
    $o2 = $_POST['op2'];
  }
  $err = Array();


// Instantiate an object for each operation based on the values returned on the form
// For example, check to make sure that $_POST is set and then check its value and
// instantiate its object
//
// The Add is done below.  Go ahead and finish the remiannig functions.
// Then tell me if there is a way to do this without the ifs
// We might cover such a way on Tuesday...

  try {
    if (isset($_POST['add']) && $_POST['add'] == 'Add') {
      $op = new Addition($o1, $o2);
    }
    if (isset($_POST['sub']) && $_POST['sub'] == 'Subtract') {
      $op = new Subtract($o1, $o2);
    }
    if (isset($_POST['mult']) && $_POST['mult'] == 'Multiply') {
      $op = new Multiply($o1, $o2);
    }
    if (isset($_POST['divi']) && $_POST['divi'] == 'Divide') {
      $op = new Divide($o1, $o2);
    }
    if (isset($_POST['sqrt']) && $_POST['sqrt'] == 'Square_root') {
      $op = new Square_root($o1, 0);
    }
    if (isset($_POST['power']) && $_POST['power'] == 'x^y') {
      $op = new xpy($o1, $o2);
    }
    if (isset($_POST['sqr']) && $_POST['sqr'] == 'x^2') {
      $op = new Square($o1, 0);
    }
    if (isset($_POST['tenPower']) && $_POST['tenPower'] == '10^x') {
      $op = new tp($o1, 0);
    }
    if (isset($_POST['ePower']) && $_POST['ePower'] == 'e^x') {
      $op = new ep($o1, 0);
    }
    if (isset($_POST['sin']) && $_POST['sin'] == 'Sin(x)') {
      $op = new sin($o1, 0);
    }
    if (isset($_POST['cos']) && $_POST['cos'] == 'Cos(x)') {
      $op = new cos($o1, 0);
    }
    if (isset($_POST['tan']) && $_POST['tan'] == 'Tan(x)') {
      $op = new tan($o1, 0);
    }
    if (isset($_POST['ln']) && $_POST['ln'] == 'ln') {
      $op = new ln($o1, 0);
    }
    if (isset($_POST['log']) && $_POST['log'] == 'log(10)') {
      $op = new log($o1, 0);
    }
// Put code for subtraction, multiplication, and division here


  }
  catch (Exception $e) {
    $err[] = $e->getMessage();
  }
?>

<!doctype html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="calc.css">
<title>PHP Calculator</title>
</head>
<body>
  <pre id="result">
  <?php
    if (isset($op)) {
      try {
        echo $op->getEquation();
      }
      catch (Exception $e) {
        $err[] = $e->getMessage();
      }
    }

    foreach($err as $error) {
        echo $error . "\n";
    }
  ?>
  </pre>
	<div id="inside-calc">
  <form name="calc" method="post" action="calculator.php">
    <input type="text" name="op1" id="name" value="" />
    <input type="text" name="op2" id="name" value="" />
    <br/>
		<br/>
    <!-- Only one of these will be set with their respective value at a time -->
    <input type="submit" name="add" value="Add" />
    <input type="submit" name="sub" value="Subtract" />
    <input type="submit" name="mult" value="Multiply" />
    <input type="submit" name="divi" value="Divide" />
    <input type="submit" name="sqrt" value="Square_root"/>
    <input type="submit" name="sqr" value="x^2"/>
    <input type="submit" name="power" value="x^y"/>
    <input type="submit" name="tenPower" value="10^x"/>
    <input type="submit" name="ePower" value="e^x"/>
    <input type="submit" name="sin" value="Sin(x)"/>
    <input type="submit" name="cos" value="Cos(x)"/>
    <input type="submit" name="tan" value="Tan(x)"/>
    <input type="submit" name="log" value="log(10)"/>
    <input type="submit" name="ln" value="ln"/>
		
		<br/>
		<br/>
		
		
		<p>First number</p>
		<input type="button" value=" 1 " onclick="calc.op1.value += '1'" />
    <input type="button" value=" 2 " onclick="calc.op1.value += '2'" />
    <input type="button" value=" 3 " onclick="calc.op1.value += '3'" />
		
		<input type="button" value=" 4 " onclick="calc.op1.value += '4'" />
    <input type="button" value=" 5 " onclick="calc.op1.value += '5'" />
    <input type="button" value=" 6 " onclick="calc.op1.value += '6'" />
          
    <input type="button" value=" 7 " onclick="calc.op1.value += '7'" />
    <input type="button" value=" 8 " onclick="calc.op1.value += '8'" />
    <input type="button" value=" 9 " onclick="calc.op1.value += '9'" />
        
		<input type="button" value=" 0 " onclick="calc.op1.value += '0'" />
    <input type="button" value=" clean all " onclick="calc.op1.value = ''" />
		
    <br/>
		
		<p>Second number(if needed)</p>
		<input type="button" value=" 1 " onclick="calc.op2.value += '1'" />
    <input type="button" value=" 2 " onclick="calc.op2.value += '2'" />
    <input type="button" value=" 3 " onclick="calc.op2.value += '3'" />
		
		<input type="button" value=" 4 " onclick="calc.op2.value += '4'" />
    <input type="button" value=" 5 " onclick="calc.op2.value += '5'" />
    <input type="button" value=" 6 " onclick="calc.op2.value += '6'" />
          
    <input type="button" value=" 7 " onclick="calc.op2.value += '7'" />
    <input type="button" value=" 8 " onclick="calc.op2.value += '8'" />
    <input type="button" value=" 9 " onclick="calc.op2.value += '9'" />
        
		<input type="button" value=" 0 " onclick="calc.op2.value += '0'" />
    <input type="button" value=" clean all " onclick="calc.op2.value = ''" />
		
    <br/>
  </form>
		<div id="name">
			<p>Made In China</p>
		</div>
	</div>
	
</body>
</html>

