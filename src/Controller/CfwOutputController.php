<?php

namespace Drupal\cfw_output\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\cfw_output\Model\CfwOutputModel;
use \Drupal\cfw_output\Helper\CfwOutputHelper;

class CfwOutputController extends ControllerBase
{
    private $model;
    private $helper;
    
    public function __construct() {
        $this->model = new CfwOutputModel();
        $this->helper = new CfwOutputHelper();
    }
    
    
    public function cfw_result(string $formid)
    {
        $userSubmission = array();
        //$formData = $this->model->getSubmissionFieldsValues();
        $submissionData = $this->model->getSubmissionDataById($formid);
        
        foreach($submissionData as $sd){
            
            if(!empty($sd->name) && !empty($sd->value)) {
                $userSubmission[$sd->name]['value'][] = $sd->value; 
            }
            
            $text = "";
            $text = $this->helper->getTextByKeyValue($sd->name, $sd->value);
            
            if(!empty($text)) {
                $userSubmission[$sd->name]['text'][] = $text; 
            }
        }
        if(
            ( isset($userSubmission['sc_3_a_institution']['value'][0]))
            ||
            ( isset($userSubmission['sc2_a_institution_name']['value'][0]) )
        ){
            $theme = 'cfw-output-scenario-2';
            
        }else {
            $theme = 'cfw-output-scenario-1';
        }
       
        return [
            '#theme' => $theme,
            '#attached' => [
                'library' => [
                    'cfw_output/cfw-output-css-and-js',
                ]
            ],
            '#data' => $userSubmission,
            '#cache' => ['max-age' => 0]
            
        ];
    }
}
