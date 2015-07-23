<section>
    <div class="container">
        <a class="btn btn-success pull-right" href="admin_news_add.php"
           role="button">Добави</a>
        <table class="table">
            <caption>Таблица с новините</caption>
            <thead>
            <tr>
                <th>Заглавие</th>
                <th>Текст</th>
                <th>Създадена на</th>
                <th>Последно редактирана</th>
                <th>Редактирай</th>
                <th>Изтрий</th>
            </tr>
            </thead>
            <tbody>

            <?php foreach ($news as $new): ?>
                <tr>
                    <td><?php echo $new['title']; ?></td>
                    <td><?php echo $new['content']; ?></td>
                    <td><?php echo $new['created_at']; ?></td>
                    <td><?php echo $new['last_update']; ?></td>
                    <td>
                        <a class="btn btn-warning" href="admin_news_edit.php?news_id=<?php echo $new['news_id']; ?>"
                           role="button">Редактирай</a>
                    </td>
                    <td>
                        <a class="btn btn-danger" href="admin_news_delete.php?news_id=<?php echo $new['news_id']; ?>"
                           role="button">Изтрий</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>