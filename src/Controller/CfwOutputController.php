<?php

namespace Drupal\cfw_output\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\cfw_output\Model\CfwOutputModel;
use \Drupal\cfw_output\Helper\CfwOutputHelper;
use Symfony\Component\HttpFoundation\Response;

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
        $theme = 'cfw-output-no-data';
        
        if(count($submissionData) > 0) {
            
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
            
            $webform_submission = \Drupal\webform\Entity\WebformSubmission::load($formid);
            // Check if submission is returned.
            if (!empty($webform_submission)) {
                //Delete the Submission
                $webform_submission->delete();
            }
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
    
    public function dariah_change_lng(string $lng = 'en'): Response
    {
        $_SESSION['language'] = strtolower($lng);
        $response = new Response();
        $response->setContent(json_encode("language changed to: " . $lng));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
