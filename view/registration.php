<section class="content">
    <header>
        <h2>Форма за <span>регистрация</span></h2>
    </header>
    
    <form action="registration.php" method="POST" class="reg_form">
        <div class="register">
            <label>Потребителско име: </label>
            <input type="text" name="username">
            
            <?php if(isset($errors['username'])) : ?>
                <p class="error"><?php echo $errors['username']?></p>
            <?php endif ?>
        
        </div>
        
        <div class="register">
            <label>Парола: </label>
            <input type="password" name="password">
            
            <?php if(isset($errors['password'])) : ?>
                <p class="error"><?php echo $errors['password']?></p>
            <?php endif ?>    
        
        </div>
            
        <div class="register">
            <label>Потвърди парола: </label>
            <input type="password" name="confirm_pass">
        
            <?php if(isset($errors['match_pass'])) : ?>
                <p class="error"><?php echo $errors['match_pass']?></p>
            <?php endif ?>    
        
        </div>
        
        <div class="register">
            <label>E-mail: </label>
            <input type="email" name="email">
            
            <?php if(isset($errors['email'])) : ?>
                <p class="error"><?php echo $errors['email']?></p>
            <?php endif ?>    
        
        </div>
        
        <div>
            <input class="submit_btn" type="submit" value="Регистрация">
            
            <?php if(isset($errors['database'])) : ?>
                <p class="error"><?php echo $errors['database']?></p>
            <?php endif ?>    
            
            <?php if(isset($success)) : ?>
                <p class="success"><?php echo $success?></p>
            <?php endif ?>    
        
        </div>    
        
        
    </form>
    <?php if(isset($msg)): ?>
        
        <?php foreach($msg as $m):?>
    <p><?php  echo $m;?></p>
        <?php endforeach; ?>   
           
    <?php endif;?>
    
</section>