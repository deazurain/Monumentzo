
<!-- Main hero unit for a primary marketing message or call to action -->
<div class="hero-unit">
    <h1>Welkom bij Monumentzo</h1>
    <div class="well black">
        <p>
            Bekijk de mooiste monumenten en ontdek de blijde wereld van het culturele erfgoed van Nederland. Gebruik de blader functie om op een interactieve wijze de monumenten van de lage landen te verkennen. Registreer je om een bericht bij je favoriete monumenten achter te laten en nog veel meer!
        </p>
    </div>
    <p><a class="btn btn-primary btn-large" href="/browse/index">Bladeren »</a></p>
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
        <p><a class="btn" href="/monument/view/<?= $monument['MonumentID'] ?>">View details »</a></p>
    </div>
    <?php } ?>
</div>




