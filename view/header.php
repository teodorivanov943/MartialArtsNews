<!DOCTYPE html>
<html>
    <head lang="bg">
        <meta charset="UTF-8">
        
        <link rel="stylesheet" href="assets/css/normalize.css"/>
        <link rel="stylesheet" href="assets/css/main.css"/>
        
        <script src="assets/js/jquery-2.1.3.min.js"></script>
        <script src="assets/js/main.js"></script>
        
        <title>Martial Arts News</title>
    </head>
    <body>
        
        <div class="container">
            <header class="header">
                <h1>Martial Arts <span>News</span></h1>
            </header>
            <?php if (isset($user)):?> 
            <div class="logged_panel">
                <p>Здравей, <?php echo $user->username;?></p>
                <form action="logout.php" method="POST">
                    <input type="submit" class="submit_btn" value="Изход"/>
                </form>
            </div>
            <?php endif;?>
            <nav class="navigation">
                <ul>
                    <li><a href="index.php">НАЧАЛО</a></li>
                    <li>
                        <a href="category.html">КАТЕГОРИИ</a>
                        <ul class="submenu">
                            <li><a href="category_boxing.html">Бокс</a></li>
                            <li><a href="category_kickbox.html">Кикбокс</a></li>
                            <li><a href="category_mma.html">ММА</a></li>
                        </ul>
                    </li>
                    <li class="mobile_nav"><a  href="category_boxing.html">Бокс</a></li>
                    <li class="mobile_nav"><a  href="category_kickbox.html">Кикбокс</a></li>
                    <li class="mobile_nav"><a  href="category_mma.html">ММА</a></li>

                    <li><a href="gallery.html">ГАЛЕРИЯ</a></li>
                    <li><a href="ranklist.html">РАНГЛИСТА</a></li>
                    <li><a href="contact.html">ЗА КОНТАКТИ</a></li>
                </ul>
            </nav>
        <section class="main">