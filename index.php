<?php

require "processor.php";

?> 

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Greeter App</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="index.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <div class="wrapper">
    <?php echo !empty($msg) ? $msg : ''; ?> 
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <div class="form-group <?php echo !empty($nameErr) ? 'form-error' : ''; ?>">
        <label>
          <span class="title">Name:</span>
          <input type="text" name="name" placeholder="Name">
        </label>
        <?php echo !empty($nameErr) ? $nameErr : ''; ?> 
      </div>
      <div class="form-group <?php echo !empty($genderErr) ? 'form-error' : ''; ?>">
        <span class="title">Gender:</span>
        <label for="male">Male:</label> <input type="radio" id="male" name="gender" value="male">
        <label for="female">Female:</label> <input type="radio" id="female" name="gender" value="female">
        <?php echo !empty($genderErr) ? $genderErr : ''; ?> 
      </div>
      <div class="form-group <?php echo !empty($statusErr) ? 'form-error' : ''; ?>">
        <span class="title">Marital Status:</span>
        <select name="status" size="3" multiple>
          <option value="married">Married</option>
          <option value="single">Single/Never Married</option>
          <option value="divorced">Divorced</option>
          <option value="separated">Separated</option>
        </select>
        <?php echo !empty($statusErr) ? $statusErr : ''; ?> 
      </div>
      <div class="form-group <?php echo !empty($dobErr) ? 'form-error' : ''; ?>">
        <label>
          <span class="title">D.O.B</span>
          <input type="date" name="date">
        </label>
        <?php echo !empty($dobErr) ? $dobErr : ''; ?> 
      </div>
      <input type="submit" value="Submit">
    </form>
  </div>
</body> 
</html>