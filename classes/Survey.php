<?php

class Survey extends Model
{
    public static function findSurvey($survey_id)
    {
        
        $query = 'SELECT * FROM Survey '
        .           'LEFT JOIN survey_options ON Survey.survey_id = survey_options.survey_id '
        .            'WHERE Survey.survey_id=?';
    
        $param[] = $survey_id;
        
        $result = self::runQuery($query, $param);
        
        return $result;
    }
    
    public function getOptions()
    {
        $result = Survey_options::where(array('survey_id' => $this->survey_id), DB::MULTIPLE_RESULT);
    
        return $result;
    }
}
