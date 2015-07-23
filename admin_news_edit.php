<?php
include 'bootstrap.php';
include 'classes/News.php';

$view = new View('view', 'admin_template');

$categoriesSQL = "SELECT * FROM news_categories";
$categories = Model::runQuery($categoriesSQL, array());
$categoriesIds = array_map(function ($data)
{
    return (int) $data['id'];
}, $categories);

$errors = array();

if (!empty($_GET))
{
    $new_id = isset($_GET['news_id']) ? $_GET['news_id'] : NULL;

    if ($new_id != NULL)
        $new = News::findByID($new_id);
    
    if (!empty($_POST))
    {
        $ds = DIRECTORY_SEPARATOR;
        $uploadDir = "assets" . $ds . "upload" . $ds . "news" . $ds . uniqid();
        $file = new File($_FILES["picture"]["tmp_name"], $_FILES["picture"]["size"], $_FILES["picture"]["name"]);
    
        //normlaize input data
        $title = isset($_POST['title']) ? trim($_POST['title']) : '';
        $content = isset($_POST['content']) ? trim($_POST['content']) : '';
        $category = isset($_POST['category']) ? (int) $_POST['category'] : '';
        if (isset($_FILES["picture"]["tmp_name"]) && strlen($_FILES["picture"]["tmp_name"]) > 0)
        {
            if (!$file->isImage())
            {
                $errors['file']['is_image'] = 'Невалиден файл';
            }
            if (!$file->isAllowedType())
            {
                $errors['file']['is_allowed_type'] = 'Разширението на картинката не е позволено';
            }
            if (!$file->isValidSize())
            {
                $errors['file']['is_image'] = 'Невалиден размер на картинката!';
            }
            if (!$file->exist())
            {
                $errors['file']['is_image'] = 'Картинката вече съществува';
            }
        }
        else
        {
            $errors['file']['file_required'] = "Няма избран файл";
        }
        if (strlen($title) <= 0)
        {
            $errors['title']['too_short'] = 'Заглавието е задължително';
        }
        if (strlen($content) <= 0)
        {
            $errors['content']['too_short'] = 'Съдържанието е задължително';
        }
        if (!in_array($category, $categoriesIds))
        {
            $errors['category']['invalid_category'] = 'Невалидна категория';
        }
        if (empty($errors))
        {
            $new = News::findByID($new_id);
            
            $param = array();
            $param['last_update'] = date('Y-m-d h:i:s', time());
            
            //checking which fields are changed
            $new->title != $title ? $param['title'] = $title : NULL;
            $new->category_id != (int) $category ? $param['category_id'] = (int) $category : NULL;
            $new->content != $content ? $param['content'] = $content : NULL;
            //add photo check 
            
            $file->upload($uploadDir);
            $photo = $file->getNewFileName();
            
            $param['photo'] = $photo;
            
            //building the query for the update
            $query = 'UPDATE News SET ';
            $iterCnt = 0;
            
            foreach ($param as $key => $val)
            {
                $iterCnt++;
            
                if($iterCnt == count($param))
                {
                    $query = $query . $key . '=? ';
                    break;
                }
                $query = $query . $key . '=?, ';
            }
            
            $query = $query . 'WHERE news_id = ?';
            $param['news_id'] = $new->news_id;
                        
            Model::runQuery($query, $param);
            header('Location: admin_news.php');
        }
    }
}
if(!empty($errors))
{
    $view->addParam ('errors', $errors);
}

$view->render('admin_news_edit', array('categories' => $categories, 'new' => $new));
