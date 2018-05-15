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
		<link rel="stylesheet" href="css/styles.css"/>
		<title>Frage der Woche</title>
	</head>
	<body>
		<main>
			<h1>Frage der Woche:</h1>
			<h3>Welcher Start-Trek Film gefällt Ihnen am besten?</h3>
			<form method="POST" action="">
				<fieldset id="bestSeries">
					<?php foreach ($checkboxLabelText as $label){
						$cleanedLabel = cleanString($label);?>
						<label>
							<span><?php echo $label; ?></span>
							<input name="bestSeries" type="radio" value="<?= $cleanedLabel?>"/>
						</label>
						<br/>
					<?php } ?>
          <? if(count($errors) != 0): ?>
            <? foreach($errors as $error): ?>
              <p class="red-text"><?= $error ?></p>
            <? endforeach; ?>
          <? endif; ?>
				</fieldset>
				<br/>
				<input name="submit" type="submit" value="Fortsetzung folgt..."/>
			</form>
		</main>
	</body>
</html>