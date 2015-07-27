<aside class="sidebar">
    <form action="login.php" method="POST" <?php if (isset($user)) echo 'style="display: none;"'; ?> class="reg_form">
        <div class="register">
            <label>Потребителско име</label>
            <input type="text" name="username">
        </div>

        <div class="register">
            <label>Парола</label>
            <input type="password" name="password">
        </div>

        <input class="submit_btn" type="submit" value="Вход">
        <a href="registration.php">Регистрация</a>
    </form>
    <?php if (isset($loginError)): ?>

        <p class="error"> <?php echo $loginError; ?> </p>

    <?php endif; ?>

    <?php if (isset($survey)) : ?>

        <section class="box survey">
            <header class="survey_header">
                <h2>Анкета</h2>
            </header>
            <p><?php echo $survey->question ?></p>
            <form method="post" action="index.php" onsubmit="return false;">
                <?php $iterCnt = 0;?>
                <?php foreach ($options as $opt) : ?>
                    <?php $iterCnt++; ?>
                    <div class="survey_row">
                        <input type="radio" name="survey" value="<?php echo $iterCnt; ?>"/>
                        <span class="survey_text"><?php echo $opt->name; ?></span>
                    </div>
                <?php endforeach; ?>
                    <input id="vote" class="submit_btn" type="submit" value="Гласувай">
            </form>
        </section>
    <?php endif; ?>

    <section class="box social_networks">
        <header class="social_header">
            <h2>Social <span>networks</span></h2>
        </header>
        <img src="assets/img/fb.png" alt="facebook" class="share" id="Facebook"/>
        <img src="assets/img/twtr.png" alt="twitter" class="share" id="Twitter"/>
        <img src="assets/img/gplus.png" alt="googleplus" class="share" id="Google+"/>
    </section>
</aside>
<div class="clearfix"></div>
