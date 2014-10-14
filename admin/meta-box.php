<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Creates meta box settings on Edit screen to hide 
 * the Main Menu on a page-per-page basis.
 *
 * @since 1.0
 */

class kol_main_menu extends kol_api {

	/**
	 * Creates meta box and adds it to Main Menu suite.
	 *
	 * @since 1.0
	 */

	public function construct() {
		$this->suite = 'kol_main_menu';

		$this->meta_box = array(
			'name'    => __( 'Main Menu', 'kol-main-menu' ),
			'context' => 'side'
		);
	}


	/**
	 * Registers settings fields for use in fields() method.
	 * This is required to safely save settings.
	 *
	 * @since 1.0
	 */
	
	public function register_fields() {
		return array(
			'display' => array(
				'type' => 'checkbox',
				'options' => array( 'hide' )
			)
		);
	}


	/**
	 * Build meta box form settings.
	 *
	 * @since 1.0
	 */

	public function fields() { ?>

		<table class="form-table">
			<tbody>

				<!-- Hide Main Menu -->
		
				<tr valign="top">
					<td>

						<?php $this->field( 'checkbox', 'display', array(
							'hide' => __( 'Hide Main Menu', 'kol-main-menu' ),
						) ); ?>

					</td>
				</tr>

			</tbody>
		</table>

	<?php }
}