<div id="browse-menu">
	<div class="browse-menu-header"></div>
    <div class="browse-menu-body">
    	<div class="btn-group pull-left" data-toggle="buttons-checkbox">
            <button class="btn">Plaats</button>
            <button class="btn">Tijd</button>
            <button class="btn">Categorie</button>
            <button class="btn">Attribuut</button>
        </div>
        <button class="btn btn-danger pull-right">Reset</button>
    </div>
    <div class="browse-menu-footer"></div>
</div>

<div id="browse-window">
	<h3 class="hud-title"></h3>
	<div class="hud-top"></div>
	<div class="hud-right"><button>&gt;</button></div>
	<div class="hud-bottom"></div>
	<div class="hud-left"><button>&lt;</button></div>
</div>

<?php echo HTML::script('assets/js/three.js'), PHP_EOL ?>
<?php echo HTML::script('assets/js/browse.js'), PHP_EOL ?>