<section class="content">
    
    <section class="box last_news">
        <header class="last_news_header">
            <h2>Последни <span>новини</span></h2>
        </header>
        <?php foreach($news as $new): ?>
        <article class="article">
            <h3><?php echo $new->title; ?></h3>
            <img src="assets/img/<?php echo $new->photo;?>" alt="<?php echo $new->photo?>" height="150" width="150"/>
            <p><?php
                    mb_internal_encoding("UTF-8");
                    echo mb_substr($new->content, 0, 170) . '...'; 
            ?></p>
        </article>
        <?php endforeach; ?>
        <div class="clearfix"></div>
    </section>
    <section class="box last_photos">
        <header>
            <h2>Последни <span>снимки</span></h2>
        </header>
        <img src="assets/img/milicic.png" alt="milicic" width="150" height="150"/>
        <img src="assets/img/floyd-manny.png" alt="floyd-manny" width="150" height="150"/>
        <img src="assets/img/schilling.png" alt="schilling" width="150" height="150"/>
        <img src="assets/img/wilder.png" alt="wilder" width="150" height="150"/>
        <img src="assets/img/cruz.png" alt="cruz" width="150" height="150"/>
        <img src="assets/img/jon.png" alt="jon" width="150" height="150"/>
        <img src="assets/img/pulev.png" alt="pulev" width="150" height="150"/>
        <img src="assets/img/ufc1.png" alt="ufc" width="150" height="150"/>
    </section>
</section>

