<?php
include 'bootstrap.php';
include 'classes/Survey.php';

if(!empty($_GET))
{
    $survey_id = isset($_GET['survey_id']) ? $_GET['survey_id'] : NULL;
    
    $survey = Survey::findByID($survey_id);
    $survey->update(array('deleted' => 1));
}

header('Location: admin_surveys.php'); 