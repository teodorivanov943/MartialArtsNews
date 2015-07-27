<section>
    <div class="container">
        <form action="admin_surveys_add.php" method="post" enctype="multipart/form-data">
            
            <div class="form-group">
                <label for="question">Въпрос</label>
                <input type="text" name="question" class="form-control" placeholder="Примерен въпрос">
                <?php if(isset($errors['question'])) :?>
                <p class="text-danger"><?php echo $errors['question'];?></p>
                <?php endif;?>
            </div>
            
            <div class="form-group">
                <label for="question">Брой опции</label>
                <select name="option" class="form-control">
                    <option value="2"> 2 </option>
                    <option value="3"> 3 </option>
                    <option value="4"> 4 </option>
                    <option value="5"> 5 </option>
                </select>
                <?php if(isset($errors['categories'])) :?>
                <p class="text-danger"><?php echo $errors['categories'];?></p>
                <?php endif;?>
            </div>
            <input type="submit" name="options_cnt" class="btn btn-default" value="Изпълни">
            <?php if(isset($value)) :?>
                <?php for($i = 0; $i < $option_cnt; $i++) :?>
                <div class="form-group">
                    <label>Избор <?php echo $i + 1;?></label>
                    <input type="text" name="option<?php echo $i;?>" class="form-control" placeholder="Примерен избор">
                    <?php if(isset($errors['option' . $i])) :?>
                    <p class="text-danger"><?php echo $errors['option' . $i];?></p>
                    <?php endif;?>
                </div>
                <?php endfor ;?>
            <input type="submit" name="submit" class="btn btn-default" value="Запиши">
            <?php endif;?>
    </div>
</section>