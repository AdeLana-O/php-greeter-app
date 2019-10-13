<?php

function clean($input) {
  $input = htmlspecialchars($input);
  $input = stripcslashes($input);
  $input = trim($input);
  return $input;
}

$name = $gender = $status = $dob = "";
$nameErr = $genderErr = $statusErr = $dobErr = "";
$currentYear = date("Y");

if($_POST) {

  if(empty($_POST["name"])) {
    $nameErr = '<div class="error">Enter Your Name</div>';
  } else {
    $name = clean($_POST["name"]);
    
    if(!preg_match("/^[a-zA-Z ]*$/", $name)) {
      $nameErr = '<div class="error">Enter A Valid Name</div>';
    }
  }

  if(empty($_POST["gender"])) {
    $genderErr = '<div class="error">Select Your Gender</div>';
  } else {
    $gender = clean($_POST["gender"]);
  }

  if(empty($_POST["status"])) {
    $statusErr = '<div class="error">Select you Marital Status</div>';
  } else {
    $status = clean($_POST["status"]);
  }

  if(empty($_POST["date"])) {
    $dobErr = '<div class="error">Select Date of Birth</div>';
  } else {
    $dob = strtotime(clean($_POST["date"]));
    $birthYear = date("Y", $dob);

    $age = (($currentYear - $birthYear) >= 18) ? "adult" : "underage";
  }


  if($gender == "male" && $age == "adult") {
    $sex = "Mr";
  } else {
    $sex = "Master";
  }

  if($gender == "female" && $status == "married") {
    $sex = "Mrs";
  }	elseif($gender == "female" && $age == "adult" && (
    $status == "divorced" || $status == "single" ||
    $status == "separated")) {
    $sex = "Ms";
  } elseif($gender == "female" && $age == "underage") {
    $sex = "Miss";
  } else {

  }



  if(empty($nameErr) && empty($genderErr) && empty($statusErr) && empty($dobErr)) {
    $timeOfDay = date("H");

    switch($timeOfDay) {
      case $timeOfDay < 12:
        $greet = "Good Morning";
        break;
      case $timeOfDay > 18:
        $greet = "Good Evening";
        break;
      default:
        $greet = "Good Day";
    } 
    $msg = '<div class="greeting">' . $greet . " " . $sex . " " . $name . '</div>';
  }
}

?>