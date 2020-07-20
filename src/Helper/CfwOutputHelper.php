<?php

namespace Drupal\cfw_output\Helper;
/**
 * Description of CfwOutputHelper
 *
 * @author norbertczirjak
 */
class CfwOutputHelper {
    
    private $webforms;
    
   
    
    
    // first value is the output value, second is the drupal form value
    
    const q1ValuesArr = array(
        'Project_name' => array('key' => 'please_state_the_name_of_your_project_'),
        //'Generic_Categories' => array('key' => 'generic_categories' 'values' => array('q1b_dc_1'))
    );
    
    const q1Values = array(
        'q1_what_are_you_planning_to_do' => 'What are you planning to do?'
    );

    const q1AValues = array(
        'a_in_what_form_are_you_gathering_recording_the_data_from_your_pa' => '',
    );
    
    const q1BValues = array(
        
        'sensitive_categories' => 'Sensitive Categories',
        'are_you_collecting_information_about_third_persons_' => 'Are you collecting information about third persons?',
        'are_they_identifiable_' => 'Are they identifiable?',
        'are_they_still_alive_' => 'Are they still alive?'
    );
    
    const q1CValues = array(
        'purpose_' => 'Purpose?',
        
        'please_identify_the_domain_of_your_project_e_g_digital_humanitie' => 'Please identify the domain of your project (e.g. Digital Humanities, Linguistics, Cultural Studies):',
        'please_briefly_describe_the_central_research_interest_that_you_w' => 'Please briefly describe the central research interest that you want to answer with your survey/interview:',
        'please_provide_the_address_of_the_project_website_' => 'Please provide the address of the project website:',
    );
    
    const q1DValues = array(
        'are_you_collecting_data_' => 'Are you collecting data..',
        'name' => 'Name',
        'contact_details_address_' => 'Contact details (address)',
        'contact_details_e_mail_' => 'Contact details (e-mail):',
        'name_' => 'Name',
        'affiliation_' => 'Affiliation ',
        'contact_details_address_institution' => 'Contact details (address):',
        'contact_details_e_mail_institutuion' => 'Contact details (e-mail)',
        'does_your_institution_have_a_dedicated_data_protection_officer_' => 'Does your institution have a dedicated data protection officer?',
        'name_of_the_data_protection_officer' => 'Name of the Data Protection Officer',
        'contact_information_e_mail_of_the_data_protection_officer_' => 'Contact information (e-mail) of the Data Protection Officer: ',
    );
    
    const q1EValues = array(
        'q1e_lrru_1_text' => 'Date',
        'q1e_lrru_2_text' => 'Months'
    );
    
    const q1FValues = array(
        'will_you_share_the_data_' => 'Will you share the data?',
        'will_you_anonymize_or_pseudonymize_the_data_before_sharing_' => 'Will you anonymize or pseudonymize the data before sharing?',
        'colleagues_at_your_research_institution' => 'colleagues at your research institution',
        'project_partners_within_the_specific_project' => 'project partners within the specific project',
        'other_researchers_from_other_institutions_e_g_through_domain_spe' => 'other researchers from other institutions (e.g. through domain-specific closed repositories, or through other closed data transmission channels) ',
        'the_general_public_through_an_open_access_repository_' => 'the general public (through an open access repository)',
        'institution_name' => '1.Institution name',
        'country' => '1.Country',
        'institution_name_2' => '2.Institution name',
        'country_2' => '2.Country',
        'institution_name_3' => '3.Institution name',
        'country_3' => '3.Country'
    );
    
    const valuesToFields = array(
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
    );
    
     public function __construct() {
        $this->webforms = \Drupal::entityTypeManager()->getStorage('webform')->loadByProperties([]);
    }
    
    public function getTextByKeyValue(string $key, string $value): string {
        
        foreach ($this->webforms as $webform) {
        //q1_what_are_you_planning_to_do
            $val = array();
            $val = $this->search($webform->getElementsDecoded(), $key );
            if(count($val) > 0) {
                
                if(isset($val[0][$key]['#options'][$value])){
                    return (string)$val[0][$key]['#options'][$value];
                }
            }
        }
        return '';
    }
    
    
    private function search($array, $key)
    {
        $results = array();

        if (is_array($array)) {
            if (isset($array[$key])) {
                $results[] = $array;
            }

            foreach ($array as $subarray) {
                $results = array_merge($results, $this->search($subarray, $key));
            }
        }

        return $results;
    }
    
        
        
    
    
    
}
