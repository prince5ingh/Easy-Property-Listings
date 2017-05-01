<?php
/**
 * Hook for Statement of Inforamtion Button on Property Templates
 *
 * @package     EPL
 * @subpackage  Hooks/StatementOfInformation
 * @copyright   Copyright (c) 2017, Merv Barrett
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       3.1.13
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Outputs any floor plan links for virtual tours on the property templates
 *
 * When the hook epl_buttons_single_property is used and the property
 * has floor plans links they will be output on the template
 *
 * @since 1.0
 */
function epl_button_statement_of_information() {
	$statement	= get_post_meta( get_the_ID() , 'property_statement_of_information' , true );

	$links = array();
	if(!empty($statement)) {
		$links[] = $statement;
	}
	if(!empty($statement_2)) {
		$links[] = $statement_2;
	}

	if ( !empty($links) ) {
		foreach ( $links as $k=>$link ) {
			if(!empty($link)) {
				$number_string = '';
				if($k > 0) {
					$number_string = ' ' . $k + 1;
				}
				?><span class="epl-statement-of-information-button-wrapper<?php echo $number_string; ?>">
				<a type="button" class="fancybox image epl-button epl-statement-of-information" <?php echo apply_filters( 'epl_button_target_statement' , '' ); ?> href="<?php echo $link; ?>"><?php echo apply_filters( 'epl_button_label_statement' , __('Statement of Information', 'easy-property-listings') ) . ' ' . $number_string; ?></a></span><?php
			}
		}
	}
}
add_action('epl_buttons_single_property', 'epl_button_statement_of_information');
