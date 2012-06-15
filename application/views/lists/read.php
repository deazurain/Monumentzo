<div class="page-header">
	<h1>Leeslijst</h1>
</div>
<div id="list-read">
	<!-- Book information -->
    <?php foreach($readList as $book): ?>
    <div class="book row">
        <!-- Book image -->
        <div class="span3">
            <img src="<?= $book['ImgUrl'] ?>" alt="Book cover" />
        </div>
    
        <div class="book-info span9">
            <h2><?= $book['Title'] ?></h2>
            <h4><?= ($book['Author'] == NULL) ? 'Geen schrijver bekend' : $book['Author'] ?></h4>
            <p><?= ($book['Description'] == NULL) ? 'Geen beschrijving beschikbaar' : $book['Description'] ?></p>
            <a href="<?= $book['Link'] ?>">Meer informatie via Google Books</a>
            <a class="btn btn-danger pull-right" 
                href="<?= url::base() ?>list/read/remove/<?= $book['BookID'] ?>">
                <i class="icon-remove icon-white"></i>
            </a>
        </div>
    </div><hr />
    <?php endforeach; ?>
</div>