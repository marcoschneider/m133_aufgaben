<?php
// Systemeinstellungen
// 06.06.2013 some changes we should not use register globals on
// 11.09.2013 error_reporting = E_ALL, show all errors,warnings and notices including coding standards
// 22.02.2017 mysql durch mysqli ersetzt
//                             

$id = "root";
$pw = "toor";
$host = "localhost";
$database = "test";
$table = "artikel1";
$meldung = "";

// Variablen from the forms


if (isset ($_REQUEST["nr"]))
 $nr = $_REQUEST["nr"];
 
if (isset ($_REQUEST["action"]))
 $action = $_REQUEST["action"];
else 
 $action ="";
 
if (isset ($_REQUEST["artnr"])) 
 $artnr = $_REQUEST["artnr"];

if (isset ($_REQUEST["titel"])) 
   $titel = $_REQUEST["titel"];
   
if (isset ($_REQUEST["preis"]))    
   $preis = $_REQUEST["preis"];
   
if (isset ($_REQUEST["inhalt"])) 
   $inhalt = $_REQUEST["inhalt"];

//  overwrite mysql_result because deprecated 

if (!function_exists('mysql_result')) {
    function mysql_result($result, $number, $field=0) {
        mysqli_data_seek($result, $number);
        $row = mysqli_fetch_array($result);
        return $row[$field];
    }
}



print_r($_REQUEST);
//var_dump($action);


$link = mysqli_connect ($host, $id, $pw) or die ("cannot connect");
mysqli_select_db($link, $database) or die ("cannot select DB");



if ($action == "loeschen") {
mysqli_query ($link,"delete from $table where nr = '$nr'");
$meldung = "Der Artikel wurde geloescht.";

// Aktualisiert einen Datensatz
} elseif($action == "save") {

  mysqli_query($link,"update $table set artnr = $artnr, titel = '$titel', preis = '$preis', inhalt = 
  '$inhalt' where nr = '$nr'");
  $meldung = "Der Artikel wurde upgedated.";

//  einen neuen Artikel hinzu
} elseif ($action == "neu") {
 
  mysqli_query ($link,"insert into $table (titel, artnr, preis, inhalt) VALUES('$titel', '$artnr', '$preis', '$inhalt')");
  $meldung = "Der Artikel wurde hinzugefuegt.";


// Selektiert den  Artikel zu Updaten
} elseif ($action == "update") {
  $result = mysqli_query($link,"select * from $table where nr =  '".$nr. "'");
  $titel = mysql_result($result,0, "titel");
  $artnr = mysql_result($result,0, "artnr");
  $preis = mysql_result ($result,0, "preis");
  $inhalt = mysql_result ($result,0, "inhalt");
?>

<table>
    <form action= <?php echo $_SERVER['PHP_SELF']; ?> method= "post">
    <input type=hidden name=action value="save">
    <input type=hidden name=nr VALUE="<? echo $nr ?>">
<tr>
<td>Art.-Nr.</td>
<td><input type=text name="artnr" value="<?php echo $artnr ?>"></td>
</tr><tr>
<td>Titel</td>
<td><input type=text name="titel" value="<?php echo $titel ?>"></td>
</tr><tr>
<td>Preis</td>
<td><input type=text name="preis" value="<?php echo $preis ?>"></td>
</tr><tr>
<td>Text</td>
<td><textarea name="inhalt"><?php echo $inhalt ?></textarea><td>
</tr><tr>
</tr> </td>
<td><input type=submit value="Artikel Updaten"></form></td>
</tr>
</table><p>

<?php

// Formular  ein neues Produkt
} elseif($action == "formneu" ) {

?>
<table>
<form action=<?php echo $_SERVER['PHP_SELF'];?> method="post">
<input type=hidden name=action value="neu">
<tr>
<td>Art.-Nr.</td>
<td><input type=text name="artnr"></td>
</tr><tr>
<td>Titel</td>
<td><input type=text name="titel"></td>
</tr><tr>
<td>Preis</td>
<td><input type=text name="preis"></td>


</tr><tr>
<td>Text</td>
<td><textarea name="inhalt"></textarea></td>
</tr><tr>
<td> </td>
<td><input type=submit value="Neuen Artikel hinzufuegen"></form></td>
</tr>
</table><p>

<?php
// Gibt alle Datensaetz aus der Datenbank aus.
} else {



echo "<ol><b>Alle Artikel in der Übersicht:</b>";
echo "<br>";
echo "<table border= 'l' width='700'>";
echo "<tr bgcolor='#00cc00'><td width='100'><b>Art.-Nr.<b></td>
<td width='100'><b>Artikel</b></td>
<td width='100'><b>Preis</b></td>
<td width='300'><b>inhalt</b></td>
<td width='50'><b>Kategorie</b></td>
<td width='50' ><b>Update</b></td>
<td width='50'><b>Loeschen</b></td></tr>";

$result = mysqli_query($link,"select * from $table");
if ($num = mysqli_num_rows($result)) {

 for ($i=0;$i < $num; $i++) {


  $bgColor = "#FFFFFF";
  $bgColor =   $bgColor=="#ffffff" ?  "#888888" : "#ffffff";
  $nr = mysql_result($result,$i,"nr");
  $artnr = mysql_result($result,$i,"artnr");
  $preis = mysql_result($result,$i,"preis");
  $titel = mysql_result($result,$i,"titel");
  $inhalt = mysql_result($result,$i,"inhalt"); 
  $kat = mysql_result($result,$i,"kat");

  echo "<tr bgColor = \"$bgColor\">";
  echo "<td>$artnr</td>";
  echo "<td>$titel</td>";
  echo "<td>$preis Fr. -</td>";
  echo "<td>$inhalt</td>";
  echo "<td>$kat</td>";
  echo "<td><a href=\"alter_test.php?nr=$nr&action=update\">Update</a></td>";
  echo "<td><a href=\"alter_test.php?nr=$nr&action=loeschen\">Loeschen</a></td>"; 
  }
 echo "</tr>";
    

} else echo "<tr><td colspan='6' width='100%'>kein Artikel vorhanden!</td></tr>";
echo "</table>";
echo "</ol>";
}
echo "<ol>";
if (!$meldung) $meldung = "Optionen<P>";
echo "$meldung";

echo "<p><a href=alter_test.php?action=start>Zur Startseite</a>";
echo " - <a href=alter_test.php?action=formneu>Neuen Artikel einfuegen?</a>";
echo "</ol>";
?>