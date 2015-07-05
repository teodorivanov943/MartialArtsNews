<section class="content">
    <header>
        <h2>Форма за <span>регистрация</span></h2>
    </header>
    
    <form action="<?php $_PHP_SELF?>" method="POST" class="reg_form">
        <div class="register">
            <label>Потребителско име: </label>
            <input type="text" name="username">
        </div>
        
        <div class="register">
            <label>Парола: </label>
            <input type="password" name="password">
        </div>
            
        <div class="register">
            <label>Потвърди парола: </label>
            <input type="password" name="confirm_pass">
        </div>
        
        <div class="register">
            <label>E-mail: </label>
            <input type="email" name="email">
        </div>
        
        <div>
            <input class="submit_btn" type="submit" value="Sign up">
        </div>    
        
    </form>
</section>