<?php
// function to sanitize input
function clean($input) {
  $input = htmlspecialchars($input);
  $input = stripcslashes($input);
  $input = trim($input);
  return $input;
}

// Initialize variables
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
    
    // Use RegExp to ensure proper name format
    if(!preg_match("/^[a-zA-Z\s]+$/", $name)) {
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
    $birthYear = date("Y", $dob); // Extract the birth year

    //Calculate current age to determine the proper title for the greeter message
    $age = (($currentYear - $birthYear) >= 18) ? "adult" : "underage";
  }

  // Determine the correct title for all males based on gender, age
  if($gender == "male" && $age == "adult") {
    $sex = "Mr";
  } else {
    $sex = "Master";
  }

  // Get the correct title for all females based on gender, age, and marital status
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


  // If there are no errors, process the greeter message
  if(empty($nameErr) && empty($genderErr) && empty($statusErr) && empty($dobErr)) {
    $timeOfDay = date("H"); // Get the hour of the day

    // Print the correct greeting based on the hour of the day
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

    // The greeter message
    $msg = '<div class="greeting">' . $greet . " " . $sex . " " . $name . '</div>';
  }
}

?>