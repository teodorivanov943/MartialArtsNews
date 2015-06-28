<?php
include(DIRECTORY_SEPARATOR . 'bootstrap.php');

$db = DB::getInstance();
$categoriesSQL = "SELECT * FROM news_categories";
$categories = $db->runQuery($categoriesSQL, array());

$categoriesIds = array_map(function ($data) {
    return (int)$data['id'];
}, $categories);

$errors = array();
if (isset($_POST['submit'])) {
    $ds = DIRECTORY_SEPARATOR;
    $uploadDir = "assets" . $ds . "upload" . $ds . "news" . $ds . uniqid();
    $file = new File($_FILES["picture"]["tmp_name"], $_FILES["picture"]["size"], $_FILES["picture"]["name"]);

    //normlaize input data
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    $content = isset($_POST['content']) ? trim($_POST['content']) : '';
    $category = isset($_POST['category']) ? (int)$_POST['category'] : '';

    if (isset($_FILES["picture"]["tmp_name"]) && strlen($_FILES["picture"]["tmp_name"]) > 0) {
        if (!$file->isImage()) {
            $errors['file']['is_image'] = 'Невалиден файл';
        }

        if (!$file->isAllowedType()) {
            $errors['file']['is_allowed_type'] = 'Разширението на картинката не е позволено';
        }

        if (!$file->isValidSize()) {
            $errors['file']['is_image'] = 'Невалиден размер на картинката!';
        }

        if (!$file->exist()) {
            $errors['file']['is_image'] = 'Картинката вече съществува';
        }
    } else {
        $errors['file']['file_required'] = "Няма избран файл";
    }
    if (strlen($title) <= 0) {
        $errors['title']['too_short'] = 'Заглавието е задалжително';
    }

    if (strlen($content) <= 0) {
        $errors['content']['too_short'] = 'Съдържанието е задължително';
    }

    if (!in_array($category, $categoriesIds)) {
        $errors['category']['invalid_category'] = 'Невалидна категория';
    }


    if (empty($errors)) {
        //upload image to filesystem and upload data to database
        $today = new DateTime();
        $file->upload($uploadDir);
        $photo = $file->getNewFileName();
        $dateString = $today->format("Y-m-d h:m:s");
        $saveNewSQL = 'INSERT INTO news(title, category_id, content, photo)
                      VALUES(?, ?, ?, ?)';
        $db = DB::getInstance();
        $db->runQuery($saveNewSQL, array($title, (int)$category, $content, $photo));
    }

}


$view = new View('view', 'admin_template');
$view->render('admin_news_add', array('categories' => $categories, 'errors' => $errors));