<?php

namespace Drupal\cfw_output\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\cfw_output\Model\CfwOutputModel;


/**
 * Provides a 'SubmissionsLeftBlock' block.
 *
 * @Block(
 *   id = "submissionsleftblock",
 *   admin_label = @Translation("SubmissionsLeftBlock Left Block"),
 *   category = @Translation("Provides SubmissionsLeftBlock")
 * )
 */
class SubmissionsLeftBlock extends BlockBase
{
    private $model;
    
    /**
     * Left block build function
     * @return type
     */
    public function build()
    {
        $this->model = new CfwOutputModel();
        $result = array();
        $result = $this->model->getLastTenSubmission();
       
        return [
            '#theme' => 'cfw-submissions-left-block',
            '#data' => $result,
            '#cache' => ['max-age' => 0]
        ];
    }
}
