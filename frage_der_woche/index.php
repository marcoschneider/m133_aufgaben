<?php

//error_reporting(E_ALL & ~ 8);

session_start();

$errors = [];
$submit = [];

$checkboxLabelText = [
	'Animated Adventures',
	'Enterprise',
	'Original Series',
	'dwa',
	'Deep Space Nine',
	'Next Generation',
	'Voyager',
	'zzz'
];

function cleanString($label){
	$label = strtolower($label);
	$label = str_replace(' ', '_', $label);
	return $label;
}

if(isset($_POST['submit'])){
	if(!isset($submit['countedSubmit'])){
		$submit['countedSubmit'] = 0;
	}else{
		if(count($_POST) < 1){
			$submit['countedSubmit'] = $submit['countedSubmit'] + 1;
		}else{
			$errors['notValid'] = "Bitte auswahl auswählen";
		}
	}
}

echo 'Post Array';
var_dump($_POST);
echo '<br>';

echo 'Errors Array';
var_dump($errors);
echo '<br>';

echo 'Submit Array';
var_dump($submit);
echo '<br>';

?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<!--<link rel="stylesheet" href="css/styles.css"/>-->
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.css">
		<title>Frage der Woche</title>
	</head>
	<body>
		<div class="container">
      <div class="row mb-3">
        <h1 class="col-12">Frage der Woche:</h1>
        <h3 class="col-12">Welcher Start-Trek Film gefällt Ihnen am besten?</h3>
      </div>
      <div class="row">
        <form method="POST" action="" class="col-6">
          <?php
            foreach ($checkboxLabelText as $label){
              $cleanedLabel = cleanString($label);
        echo '<div class="custom-control custom-radio">
                <input type="radio" id="' . $cleanedLabel . '" name="bestSeries" class="custom-control-input">
                <label class="custom-control-label" for="' . $cleanedLabel . '">' . $label . '</label>
              </div>';
            }
          if (isset($_POST['submit'])){
            if(count($errors) > 0){
              foreach($errors as $error){
                echo '<p class="red-text">' . $error . '</p>';
              }
            }
          }
          ?>
          <input class="btn btn-primary mt-4" name="submit" type="submit" value="Fortsetzung folgt..."/>
        </form>
      </div>
    </div>
	</body>
</html>