<!DOCTYPE html>
<html lang="de">
<head>
  <title>Linux-Arbeitsplatz</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
    body {
        display: flex; /* Setzt das Flexbox-Layout */
        min-height: 100vh; /* Setzt die minimale Höhe des body-Elements auf 100% der Viewport-Höhe */
        flex-direction: column; /* Legt die Hauptachse der Flexbox vertikal an */
        justify-content: center; /* Zentriert die Elemente auf der Hauptachse */
        align-items: center; /* Zentriert die Elemente auf der Querachse */
        background-image: url("images/background.webp");
        background-size: cover; /* Skaliert das Hintergrundbild auf die Größe des Bildschirms */
    }
    h1 {
        color: white;
    }
    /* Display footer at the very bottom */
    footer {
      text-align: center;
      margin-top: 30px;
      padding: 10px;
        position: absolute;
        bottom: 0;
    }
  </style>
</head>
<body>

<div class="container">
    <!-- Center the headline -->
    <div>
        <!-- weißer text -->
        <h1 class="text-center" >Linux-Arbeitsplatz</h1>
        <br>
    </div>
    
  <div class="row">
    <?php
$caddyfile = "/etc/caddy/Caddyfile"; // Pfad zur Caddyfile
$handle = fopen($caddyfile, "r"); // Öffnet die Caddyfile im Lesemodus

if ($handle) {
    while (($line = fgets($handle)) !== false) { // Zeile für Zeile durchgehen
        if (strpos($line, "{")) { // Wenn die Zeile keine öffnende Klammer hat
            $url = trim(substr($line, 0, strpos($line, "{"))); // Extrahiere die URL bis zur öffnenden Klammer
            
            // Falls mehrere URLs in einer Zeile sind, extrahiere nur die erste
            if (strpos($url, " ")) {
                $url = substr($url, 0, strpos($url, " "));
            }

            // Überpüfe ob die URL zwei Punkte enthält
            if (substr_count($url, ".") == 2) {

                // Extrahiere das Wort bis zum ersten Punkt
                $searchKeyword = substr($url, 0, strpos($url, "."));

                // Falls das Wort "portal" oder "office" ist, überspringe die URL
                if ($searchKeyword == "portal" or $searchKeyword == "office") {
                  continue;
                }
                
                // Durchlaufen jeder Zeile der CSV-Datei
                $name = "";
                $description = "";
                
                $csvFile = fopen('data.csv', 'r'); // Öffne die CSV-Datei im Lesemodus
                while (($line = fgetcsv($csvFile)) !== FALSE) {
                    // Überprüfen, ob das Schlüsselwort in der aktuellen Zeile vorkommt
                    if (in_array($searchKeyword, $line)) {
                        $name = $line[0];
                        $description = $line[1];
                    }
                }
                fclose($csvFile); // Schließe die CSV-Datei

                if ($name == "") {
                    $name = $searchKeyword;
                }

                // gib die URL in Form einer Kachel wie oben definiert aus
                echo "<div class='col-lg-3 col-md-6 mb-4'>
                <div class='card h-100'>
                  <div class='card-body'>
                    <h4 class='card-title'>$name</h4>
                    <p class='card-text'>$description</p>
                  </div>
                  <div class='card-footer text-center'>
                    <a href='https://$url' class='btn btn-primary'>Öffnen</a>
                  </div>
                </div>
              </div>";
                
            }
        }
    }
    fclose($handle); // Schließe die Caddyfile
} else {
    echo "Fehler beim Öffnen der Caddyfile";
}
?>
  </div>
</div>




</body>
<footer>
  <p><a href="https://www.linuxguides.de/" style="color: black;">Verwaltet von Linux Guides</a></p>
</html>
