
<!-- Main hero unit for a primary marketing message or call to action -->
<div class="hero-unit">
    <h1>Welkom bij Monumentzo</h1>
    <div class="well black">
        <p>
            Bekijk de mooiste monumenten en ontdek de blijde wereld van het culturele erfgoed van Nederland.
        </p>
        <p>
            Gebruik de blader functie om op een interactieve wijze de monumenten van de lage landen te verkennen.
        </p> 
        <p>
            Registreer, om een bericht bij je favoriete monumenten achter te laten en nog veel meer!
        </p>
    </div>
    <p><a class="btn btn-primary btn-large" href="/browse/index">Bladeren <i class="icon-chevron-right icon-white"></i></a></p>
</div>

<!-- Example row of columns -->
<div class="row preview-monument">
    <?php foreach($monuments as $monument) {?>
    <div class="span4 overflow">
        <h2><?= $monument['Name']; ?></h2>
        <p>
            <img src="/assets/img/monuments/thumb/<?= $monument['MonumentID']?>.jpg" align="left" />
            <?= $monument['Description']?>
        </p>
        <p><a class="btn" href="/monument/view/<?= $monument['MonumentID'] ?>">Bekijk <i class="icon-chevron-right"></i></a></p>
    </div>
    <?php } ?>
</div>




