<?php

include 'bootstrap.php';
include 'classes/Survey.php';
include 'classes/Survey_options.php';
$view = new View('view', 'admin_template');

if (isset($_POST['options_cnt']))
{
    $categories = array(1, 2, 3, 4, 5);
    $option_cnt = isset($_POST['option']) ? (int) $_POST['option'] : "";
    
    if(!in_array($option_cnt, $categories))
    {
        $errors['categories'] = 'Невалиден брой опции';
    }
    
    else
    {
        setcookie('opt_counter', $option_cnt);
        $view->addParam('option_cnt', $option_cnt);
    }
}

if (isset($_POST['submit']))
{

    $question = isset($_POST['question']) ? trim($_POST['question']) : '';
    //getting the number of options and unsetting the cookie
    if (isset($_COOKIE['opt_counter']))
    {
        $option_cnt = (int)$_COOKIE['opt_counter'];
        
        setcookie('opt_counter', $option_cnt, 1);
        header('Content-Type: text/html;charset=utf-8');
        for ($i = 0; $i < $option_cnt; $i++)
        {
            $option[$i] = isset($_POST['option' . $i]) ? trim($_POST['option' . $i]) : '';
            
            if(strlen($option[$i]) <= 0)
            {
                $errors['option' . $i] = 'Опцията е задължителна';
            }
        }
        $view->addParam('option_cnt', $option_cnt);
        
        if(strlen($question) <= 0)
        {
            $errors['question'] = 'Въпросът е задължителен';
        }
        
        if(!empty($errors))
        {
            $view->addParam('errors', $errors);
        }
        
        else
        {
            $survey = new Survey();
            $survey->question = $question;
            $survey->save();
            
            $query = 'SELECT MAX(Survey_id) as max_id FROM Survey';
            $survey_id = Survey::runQuery($query, array(), DB::SINGLE_RESULT);
           
            $survey = Survey::findByID($survey_id['max_id']);
            
            for($i = 0; $i < $option_cnt; $i++)
            {
                $survey_opt[$i] = new Survey_options();
                $survey_opt[$i]->survey_id = $survey->survey_id;
                $survey_opt[$i]->name = $option[$i];
                $survey_opt[$i]->save();
            }
            header('Location: admin_surveys.php');
        }
    }
}

$view->render('admin_surveys_add');
//TODO: fix survey_id