<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * This function prints inline JavaScript to the
 * site's footer based on which settings are enabled.
 *
 * @since 1.0
 */

if ( ! function_exists( 'kol_main_menu_js' ) ) :

	function kol_main_menu_js() {
		if ( ! kol_has_main_menu() )
			return;
	?>
	
		<script>

			<?php if ( kol_has_menu_search() ) : ?>
				document.getElementById( 'menu-trigger-search' ).onclick = function( e ) {
					apollo.addClass( document.getElementById( 'main-menu-triggers' ), 'close-on-desktop' );
		
					// search
					apollo.removeClass( document.getElementById( 'main-menu-search' ), 'close-on-desktop' );
					apollo.toggleClass( document.getElementById( 'menu-trigger-search' ), 'menu-trigger-active' );
					apollo.toggleClass( document.getElementById( 'main-menu-search' ), 'close-on-tablet' );
					document.getElementById( 'menu-search-input' ).focus();
		
					<?php if ( kol_has_menu( 'social' ) ) : ?>
						// social
						apollo.addClass( document.getElementById( 'main-menu-social' ), 'close-on-desktop' );
						apollo.removeClass( document.getElementById( 'menu-trigger-social' ), 'menu-trigger-active' );
						apollo.addClass( document.getElementById( 'main-menu-social' ), 'close-on-tablet' );
					<?php endif; ?>
		
					<?php if ( kol_has_menu( 'main' ) ) : ?>
						// menu
						apollo.removeClass( document.getElementById( 'menu-trigger-menu' ), 'menu-trigger-active' );
						apollo.addClass( document.getElementById( 'main-menu-menu' ), 'close-on-tablet' );	
					<?php endif; ?>
			
					e.preventDefault();
				}
		
				document.onclick = function( e ) {
					var target = e.target || e.srcElement;
			
					do {
						if ( document.getElementById( 'main-menu-triggers' ) === target ) return;
			
						target = target.parentNode;
					}
					while ( target ) {
						apollo.removeClass( document.getElementById( 'main-menu-triggers' ), 'close-on-desktop' );
		
						// search
						apollo.addClass( document.getElementById( 'main-menu-search' ), 'close-on-desktop' );
						apollo.addClass( document.getElementById( 'main-menu-search' ), 'close-on-tablet' );
						apollo.removeClass( document.getElementById( 'menu-trigger-search' ), 'menu-trigger-active' );	
		
						<?php if ( kol_has_menu( 'social' ) ) : ?>
							// social
							apollo.removeClass( document.getElementById( 'main-menu-social' ), 'close-on-desktop' );
						<?php endif; ?>
		
					}
				}
			<?php endif; ?>

			<?php if ( kol_has_menu( 'main' ) ) : ?>
				document.getElementById( 'menu-trigger-menu' ).onclick = function( e ) {
	
					apollo.toggleClass( document.getElementById( 'main-menu-menu' ), 'close-on-tablet' );
					apollo.toggleClass( document.getElementById( 'menu-trigger-menu' ), 'menu-trigger-active' );
	
					<?php if ( kol_has_menu_search() ) : ?>
						// search
						apollo.addClass( document.getElementById( 'main-menu-search' ), 'close-on-tablet' );
						apollo.removeClass( document.getElementById( 'menu-trigger-search' ), 'menu-trigger-active' );
					<?php endif; ?>
	
					<?php if ( kol_has_menu( 'social' ) ) : ?>
						// social
						apollo.addClass( document.getElementById( 'main-menu-social' ), 'close-on-tablet' );
						apollo.removeClass( document.getElementById( 'menu-trigger-social' ), 'menu-trigger-active' );
					<?php endif; ?>
	
					e.preventDefault();
				}
			<?php endif; ?>

			<?php if ( kol_has_menu( 'social' ) ) : ?>
				document.getElementById( 'menu-trigger-social' ).onclick = function( e ) {

					apollo.toggleClass( document.getElementById( 'main-menu-social' ), 'close-on-tablet' );
					apollo.toggleClass( document.getElementById( 'menu-trigger-social' ), 'menu-trigger-active' );

					<?php if ( kol_has_menu( 'main' ) ) : ?>
						// main menu
						apollo.addClass( document.getElementById( 'main-menu-menu' ), 'close-on-tablet' );
						apollo.removeClass( document.getElementById( 'menu-trigger-menu' ), 'menu-trigger-active' );
					<?php endif; ?>

					<?php if ( kol_has_menu_search() ) : ?>
						// search
						apollo.addClass( document.getElementById( 'main-menu-search' ), 'close-on-tablet' );
						apollo.removeClass( document.getElementById( 'menu-trigger-search' ), 'menu-trigger-active' );
					<?php endif; ?>

					e.preventDefault();
				}
			<?php endif; ?>

		</script>
	
	<?php }

endif;

add_action( 'kol_hook_js', 'kol_main_menu_js' );