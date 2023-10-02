<?php
$palvelin = "localhost";
$kayttaja = "root";  // tämä on tietokannan käyttäjä, ei tekemäsi järjestelmän
$salasana = "";
$tietokanta = "drinkityasin";

// luo yhteys
$conn = new mysqli($palvelin, $kayttaja, $salasana, $tietokanta);

// jos yhteyden muodostaminen ei onnistunut, keskeytä ja näytä virheilmoitus
if ($conn->connect_error) {
   die("Yhteyden muodostaminen epäonnistui: " . $conn->connect_error);
}
// aseta merkistökoodaus (muuten ääkköset sekoavat)
$conn->set_charset("utf8");
?>
