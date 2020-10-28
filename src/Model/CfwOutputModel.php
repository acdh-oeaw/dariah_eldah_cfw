<?php

namespace Drupal\cfw_output\Model;

/**
 * Description of CfwOutputModel
 *
 * @author norbertczirjak
 */
class CfwOutputModel {
    
    private $data = array();
    
    public function getSubmissionDataById(int $id): array {
        try {
            $this->data = \Drupal::database()->select('webform_submission_data', 'n')
            ->fields('n', array('webform_id', 'sid', 'name', 'value'))
            ->where('sid = '.$id)
            ->execute()->fetchAll();
        } catch (Exception $ex) {
            return array();
        }
        
        
        return $this->data;
    }
    
    public function getSubmissionFieldsValues(): string {
        
        try {
            $this->data = \Drupal::database()->select('config', 'c')
            ->fields('c', array('data', 'name'))
            ->where("name = 'webform.webform.dariah_eldah_consent_form_wizard'")
            ->execute()->fetchAll();
            
        } catch (Exception $ex) {
            return '';
        }
        
        
        return $this->data[0]->data;
    }
    
    public function getLastTenSubmission(): array {
        try {
            $this->data = \Drupal::database()->select('webform_submission_data', 'n')
            ->fields('n', array('sid'))
            ->orderBy('sid', 'DESC')
            ->range(0, 10)
            ->distinct()->execute()->fetchAll();
        } catch (Exception $ex) {
            return array();
        }
        return $this->data;
    }
    
    
    public function deleteSubmission(string $formid): bool {
        try {
            $this->data = \Drupal::database()->delete('webform_submission_data')
            ->condition('sid', $formid)->execute();
        } catch (Exception $ex) {
            return false;
        } catch (\Exception $ex) {
            return false;
        }
        return bool;
    }
    
    
}
