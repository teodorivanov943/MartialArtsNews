<section class="content">

    <section class="box last_news">
        <header class="last_news_header">
            <h2>Последни <span>новини</span></h2>
        </header>
        <?php foreach($news as $new): ?>
        <article class="article">
            <h3><?php echo $new['title']; ?></h3>
            <img src="assets/img/dalakliev.png" alt="dalakliev" height="150" width="150"/>
            <p><?php echo $new['content']; ?></p>
        </article>
        <?php endforeach; ?>
        <!--
        <article class="article">
            <h3>Джон Джоунс с <span>победа </span>срещу Кормиер</h3>
            <img src="assets/img/jon.png" alt="jones" height="150" width="150"/>
            <p>Шампионът на UFC в лека-тежка категория Джон Джоунс надви2 след съдийско решение Даниел Кормиер в
                един от най-чаканите	мачове през последните месеци. Шампионът доминираше с отличната си игра в стойка.</p>
        </article>
        <article  class="article">
            <h3>Луйс Тейлър контузен и <span>освободен </span>от UFC</h3>
            <img src="assets/img/luis.png" alt="taylor" height="150" width="150"/>
            <p>Миналата седмица Костас Филипо получи контузия преди двубоя си на 18 януари. Той бе заменен от Луйс Тейлър,
                който обаче вчера също се е контузил и няма да може да излезе срещу Урая Хол.</p>
        </article>
        -->
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

