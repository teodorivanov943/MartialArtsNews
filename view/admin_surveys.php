<section>
    <div class="container">
        <a class="btn btn-success pull-right" href="admin_surveys_add.php"
           role="button">Добави</a>
        <table class="table">
            <caption>Таблица с анкетите</caption>
            <thead>
            <tr>
                <th>Въпрос</th>
                <th>Опции</th>
                <th>Активирай</th>
                <th>Редактирай</th>
                <th>Изтрий</th>
            </tr>
            </thead>
            <tbody>

            <?php foreach ($surveys as $survey): ?>
                <tr>
                    <td><?php echo $survey->question; ?></td>
                    <td><?php foreach($options[$survey->survey_id] as $option ) :?>
                            
                        <p><?php echo $option->name;?></p>
                            
                        <?php endforeach;?>
                    </td>
                    <td>
                        <a class="btn btn-success" href="admin_surveys_activate.php?survey_id=<?php echo $survey->survey_id; ?>"
                           role="button">Активирай</a>
                    </td>
                    
                    <td>
                        <a class="btn btn-warning" href="admin_surveys_edit.php?survey_id=<?php echo $survey->survey_id; ?>"
                           role="button">Редактирай</a>
                    </td>
                    <td>
                        <a class="btn btn-danger" href="admin_surveys_delete.php?survey_id=<?php echo $survey->survey_id; ?>"
                           role="button">Изтрий</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>