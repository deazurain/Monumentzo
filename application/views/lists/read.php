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
            <h4><?= $book['Author'] ?></h4>
            <p><?= $book['Description'] ?></p>
        </div>
    </div><hr />
    <?php endforeach; ?>
</div>