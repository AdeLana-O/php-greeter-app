<?php
// function to sanitize input
function clean($input) {
  $input = htmlspecialchars($input);
  $input = stripcslashes($input);
  $input = trim($input);
  return $input;
}

$name = $gender = $status = $dob = "";
$nameErr = $genderErr = $statusErr = $dobErr = "";
$currentYear = date("Y");

// Process the form when it's submitted
if($_POST) {

  // Validate name
  if(empty($_POST["name"])) {
    $nameErr = '<div class="error">Enter Your Name</div>';
  } else {
    $name = clean($_POST["name"]);

    if(!preg_match("/^([a-zA-Z]*)\s*([a-zA-Z]*)$/", $name)) {
      $nameErr = '<div class="error">Enter A Valid Name</div>';
    }
  }

  // Validate gender
  if(empty($_POST["gender"])) {
    $genderErr = '<div class="error">Select Your Gender</div>';
  } else {
    $gender = clean($_POST["gender"]);
  }

  // Validate marital status
  if(empty($_POST["status"])) {
    $statusErr = '<div class="error">Select you Marital Status</div>';
  } else {
    $status = clean($_POST["status"]);
  }

  // Validate date of birth
  if(empty($_POST["date"])) {
    $dobErr = '<div class="error">Select Date of Birth</div>';
  } else {
    $dob = clean(strtotime($_POST["date"]));
  }


  // If there are no errors, process the greeter message
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

    $birthYear = date("Y", $dob);
    $age = (($currentYear - $birthYear) >= 18) ? "adult" : "underage";

    if($gender == "male") {
      $title = ($age == "adult") ? "Mr" : "Master";
    }

    if($gender == "female") {
      if ($age == "underage") {
        $title = "Miss";
      } else {
        $title = ($status == "single" || $status == "divorced") ? "Miss" : "Mrs";
      }
    }

    $msg = '<div class="greeting">' . $greet . " " . $title . " " . $name . '</div>';
  }
}
?>