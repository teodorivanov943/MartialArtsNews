<aside class="sidebar">
    <section class="box survey">
        <header class="survey_header">
            <h2>Анкета</h2>
        </header>
        <p>Кого бихте определили като най-велик боксьор в историята на спорта?</p>
        <form method="post" action="index.php.html" onsubmit="return false;">
            <div class="survey_row">
                <input id="1" type="radio" name="survey" value="1"/>
                <span class="survey_text 1">Мохамед Али</span>
            </div>
            <div class="survey_row">
                <input id="2" type="radio" name="survey" value="2"/>
                <span class="survey_text 2">Роки Марчиано</span>
            </div>
            <div class="survey_row">
                <input id="3" type="radio" name="survey" value="3"/>
                <span class="survey_text 3">Майк Тайсън</span>
            </div>
            <div class="survey_row">
                <input id="4" type="radio" name="survey" value="4"/>
                <span class="survey_text 4">Флойд Мейуедър</span>
            </div>
            <div class="survey_row">
                <input id="5" type="radio" name="survey" value="5"/>
                <span class="survey_text 5">Джо Луис</span>
            </div>

            <input class="submit_btn" type="submit" value="Гласувай" onclick="vote()">
        </form>
    </section>
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