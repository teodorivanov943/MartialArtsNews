<?php
require_once 'bootstrap.php'; 

require_once 'classes/User.php';
require_once 'classes/News.php';
require_once 'classes/Survey.php';
require_once 'classes/Survey_options.php';

Model::init();

$view = new View('view', 'template');
$survey_id = file_get_contents('assets/survey_id.txt');

$survey = Survey::where(array('survey_id' => $survey_id));
$survey_options = Survey_options::where(array('survey_id' => $survey_id),
                                                                        DB::MULTIPLE_RESULT);

$view->addParam('survey', $survey);
$view->addParam('options', $survey_options);

if (isset($_SESSION['login_error']))
{
    $view->addParam('loginError', $_SESSION['login_error']);
    unset($_SESSION['login_error']);
}

if (isset($_SESSION['is_admin']) && $_SESSION['logged'])
{
    header('Location: admin_index.php');
}

if(isset($_SESSION['logged']) && $_SESSION['logged'])
{
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;
    $user=User::findByID($user_id);
    $view->addParam('user', $user);
}

$query = 'SELECT * FROM News WHERE deleted=? LIMIT ?';


$param[0] = 0;
$param[1] = 3;
$news_assoc = News::runQuery($query, $param);

foreach($news_assoc as $new)
{
   $news[] = News::findByID($new['news_id']);
}

$view->addParam('news', $news);
$view->render('index');

//refferer