<?php
echo '
    <!DOCTYPE html>
    <html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>IT-Esercizio-6-PHP</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <body data-bs-theme="dark" class="text-center">
    <div class="card position-absolute top-50 start-50 translate-middle p-2" style="min-width:500px; border: 0; background-image: linear-gradient(to top right, #00e1ffbd 0%, #907dff 50%, #ffc400 100%);">
        <div class="card-body bg-dark rounded">
            <h1 class="card-title">Gioco dell\' Indovina Numero</h1>
    ';

//Logica del numero random
$rand = null;
if(isset($_POST['rand']))
    $rand = $_POST['rand'];
else $rand = rand(0,99);

//Logica dei tentativi
$nTentativo = null;
if(isset($_POST['nTentativo']))
    $nTentativo = $_POST['nTentativo'] + 1;
else $nTentativo = 1;

$form = '
<form method="post">
    Tentativo n.'.$nTentativo.' <input class="form-label" autofocus type=number name="scelta">
    <input type="hidden" name="nTentativo" value="'.$nTentativo.'">
    <input type="hidden" name="rand" value="'.$rand.'">
    <button class="btn border border-1" type="submit">Tenta</button>
</form>';

$reinizia_BTN = '<a href="."><button class="btn border border-1"> Gioca di nuovo</button></a>';

if($nTentativo > 5){
    echo '<h2>Spiacente, hai superato il numero massimo di tentativi!<h2>'. $reinizia_BTN;
    $nTentativo = 1;
    $rand = rand(0,99);
} else {
    //Comparazione
    if(isset($_POST['scelta']) && $_POST['scelta'] == $rand){
        echo '<h1>Bravo, hai indovinato in '. ($nTentativo - 1); if(($nTentativo - 1) == 1){echo ' tentativo';} else {echo ' tentativi';} echo '</h1>';
        echo $reinizia_BTN;
        $nTentativo = 1;
        $rand = rand(0,99);
    }
    else if (isset($_POST['scelta']) && $_POST['scelta'] < $rand){
        echo '<p>Il tuo numero è troppo piccolo</p>'. $form;
    }
    else if (isset($_POST['scelta']) && $_POST['scelta'] > $rand){
        echo '<p>Il tuo numero è troppo grande</p>'. $form;
    }
    else if (!isset($_POST['scelta'])) {
        echo '<p><b>Regole del gioco:</b> Si deve indovinare nel minor numero di tentativi un numero compreso fra 0 e 99 estratto casualmente dal sistema.</p>'. $form;
    }
}
echo '
    </div></div>
    <!--<h1>Numero random: '.$rand.'</h1>-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body></html>
';
?>