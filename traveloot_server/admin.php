<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
}

$db = [];
if (file_exists('db.json')) {
    $raw_json = file_get_contents('db.json');
    $db = json_decode($raw_json, true);
}

?>
<!doctype html>
<html lang="it">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Traveloot Back-end</title>
    <link rel="apple-touch-icon" sizes="76x76" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
</head>

<body>
    <nav class="navbar" style="background-color: #e3f2fd;">
        <div class="container-fluid ">
            <a class="navbar-brand " href="#">Traveloot</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="d-flex">
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col">
                <h2>Inserisci cliente</h2>
                <form>
                    <div class="mb-3">
                        <label for="client-name" class="form-label">Cliente</label>
                        <input type="text" class="form-control" id="client-name" name="client-name"
                            aria-describedby="client-name-help">
                        <div id="client-name-help" class="form-text">Nome del cliente che richiede l'installazione di
                            punti Traveloot</div>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit-client">Aggiungi cliente</button>
                </form>
            </div> <!-- .col -->
            <div class="col">
                <h2>Inserisci punto traveloot</h2>
                <form>
                    <div class="mb-3">
                        <label for="point-name" class="form-label">Punto</label>
                        <input type="text" class="form-control" id="point-name" name="point-name"
                            aria-describedby="point-name-help">
                        <div id="point-name-help" class="form-text">Nome dell'attrazione turistica in cui è installato
                            il punto Traveloot</div>
                        <label for="point-lat" class="form-label">Latitudine</label>
                        <input type="text" class="form-control" id="point-lat" name="point-lat"
                            aria-describedby="point-latlon-help">
                        <label for="point-lon" class="form-label">Longitudine</label>
                        <input type="text" class="form-control" id="point-lon" name="point-lon"
                            aria-describedby="point-latlon-help">
                        <div id="point-latlon-help" class="form-text">Coordinate geografiche del punto Traveloot (es.
                            41.123 e 12.3232)</div>
                        <label for="point-client" class="form-label">Cliente del punto Traveloot</label>
                        <select id="point-client" class="form-select">
                            <option>Disabled select</option>
                        </select>

                    </div>
                    <button type="submit" class="btn btn-primary" name="submit-point">Aggiungi punto</button>
                </form>
            </div> <!-- .col -->
        </div> <!-- .row -->
        <hr>
        <div class="row">
            <div class="col">
                <h2>Lista clienti</h2>
            </div> <!-- .col -->
            <div class="col">
                <h2>Lista punti Traveloot</h2>
            </div> <!-- .col -->
        </div> <!-- .row -->
    </div> <!-- .container -->

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>

</html>