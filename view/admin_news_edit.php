<section>
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Заглавие</label>
                <input type="text" name="title" class="form-control" value="<?php if(isset($new)) echo $new->title;?>" placeholder="Примерно заглавие">

                <?php if(isset($errors['title']) && count($errors['title']) > 0): ?>
                    <?php foreach($errors['title'] as $titleError): ?>
                        <p class="text-danger"><?php echo $titleError; ?></p>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
            <div class="form-group">
                <label for="category">Категория</label>
                <select name="category" class="form-control">
                    <?php foreach($categories as $category): ?>
                        <option value="<?php echo $category['id'] ?>" 
                                <?php if($new->category_id == $category['id']) echo 'selected'?> >
                                <?php echo $category['name'] ?></option>
                    <?php endforeach; ?>
                </select>

                <?php if(isset($errors['category']) && count($errors['category']) > 0): ?>
                    <?php foreach($errors['category'] as $categoryError): ?>
                        <p class="text-danger"><?php echo $categoryError; ?></p>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
            <div class="form-group">
                <label for="content">Съдържание</label>
                <textarea name="content" class="form-control" rows="7"><?php if(isset($new)) echo $new->content;
                ?></textarea>

                <?php if(isset($errors['content']) && count($errors['content']) > 0): ?>
                    <?php foreach($errors['content'] as $contentError): ?>
                        <p class="text-danger"><?php echo $contentError; ?></p>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
            <div class="form-group">
                <label for="picture">Картинка</label>
                <input type="file" id="picture" name="picture">
                <p class="text-info">Изберете снимка за новината</p>

                <?php if(isset($errors['file']) && count($errors['file']) > 0): ?>
                    <?php foreach($errors['file'] as $fileError): ?>
                        <p class="text-danger"><?php echo $fileError; ?></p>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>

            <input type="submit" name="submit" value="Запиши" class="btn btn-default">
        </form>
    </div>
</section>