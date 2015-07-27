<?php
include 'bootstrap.php';
include 'classes/Survey.php';

if(!empty($_GET))
{
    $survey_id = isset($_GET['survey_id']) ? $_GET['survey_id'] : NULL;
    $surveys = Survey::getAll();
    $match = false;
    
    foreach($surveys as $survey)
    {
        if($survey->survey_id == $survey_id && $survey->deleted == 0)
        {
            $match = true;
        }
    }
    
    if(!$match)
    {
        $message = 'Невалидна анкета';
    }
    else
    {
        $message = 'Анкетата активирана';
        file_put_contents('assets/survey_id.txt', $survey_id);
    }   
}

$view = new View('view', 'admin_template');
$view->render('admin_surveys_activate', array('message' => $message));