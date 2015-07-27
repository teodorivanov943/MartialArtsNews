<?php
include 'bootstrap.php';
include 'classes/Survey.php';
include 'classes/Survey_options.php';
header('Content-Type: text/html;charset=utf-8');

$view = new View('view', 'admin_template');
$surveys = Survey::where(array('deleted' => 0), DB::MULTIPLE_RESULT);
foreach($surveys as $survey)
{
    $options[$survey->survey_id] = $survey->getOptions();
}

$view->addParam('surveys', $surveys);
$view->addParam('options', $options);

$view->render('admin_surveys');
//TODO: Операции с анкета и опции