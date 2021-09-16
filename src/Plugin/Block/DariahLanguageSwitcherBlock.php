<?php

namespace Drupal\cfw_output\Plugin\Block;

/**
 * Description of DariahLanguageSwitcherBlock
 *
 * @author nczirjak
 */

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'DariahLanguageSwitcherBlock' block.
 *
 * @Block(
 *   id = "dariah_lang_switcher_block",
 *   admin_label = @Translation("DARIAH Language Switcher"),
 *   category = @Translation("Custom DARIAH language switcher")
 * )
 */
class DariahLanguageSwitcherBlock extends BlockBase
{
    /**
     * Class block
     *
     * @return type
     */
    public function build()
    {
        if (isset($_SESSION['language'])) {
            $lang = strtolower($_SESSION['language']);
        } else {
            $lang = "en";
        }
        
        $return = array(
            '#theme' => 'helper-lng-switcher',
            '#language' => $lang
        );
        return $return;
    }
}
