<nav id="main-menu" class="main-menu box-sec links-sec <?php echo kol_has_menu( 'main' ) ? 'has-menu-main' : 'main-menu-simple block-single-tb text-center'; ?> close-on-mobile">

	<div class="inner">

		<?php if ( kol_main_menu_items() ) : ?>

			<div id="main-menu-triggers" class="main-menu-triggers <?php echo kol_menu_triggers_classes(); ?>">
	
				<?php if ( kol_has_menu( 'main' ) ) : ?>
					<span id="menu-trigger-menu" class="menu-trigger-menu menu-trigger col close-on-desktop">
						<i class="kol-icon kol-icon-menu"></i> <span class="menu-trigger-text close-on-mobile"><?php echo kol_get_menu_name( 'main' ); ?></span>
					</span>
				<?php endif; ?>
	
				<?php do_action( 'kol_hook_main_menu_triggers' ); ?>
	
				<?php if ( kol_has_menu_search() ) : ?>
					<span id="menu-trigger-search" class="menu-trigger-search menu-trigger col">
						<i class="kol-icon kol-icon-search"></i> <span class="menu-trigger-text close-on-desktop close-on-mobile"><?php _e( 'Search', 'kol-main-menu' ); ?></span>
					</span>
				<?php endif; ?>

				<?php if ( kol_has_menu( 'social' ) ) : ?>
					<span id="menu-trigger-social" class="menu-trigger-social menu-trigger col close-on-desktop">
						<i class="kol-icon kol-icon-user-add"></i> <span class="menu-trigger-text close-on-mobile"><?php echo kol_get_menu_name( 'social' ); ?></span>
					</span>
				<?php endif; ?>

			</div>

			<?php if ( kol_has_menu( 'main' ) ) : ?>

				<?php wp_nav_menu( array(
					'theme_location' => 'main',
					'container'      => false,
					'fallback_cb'    => false,
					'items_wrap'     => '<ul id="main-menu-menu" class="%2$s menu-main menu-content menu close-on-tablet">%3$s</ul>',
					'walker'         => new kol_menu_main_walker()
				) ); ?>	

			<?php endif; ?>

			<?php if ( kol_has_menu_search() ) : ?>
				<?php kol_main_menu_search(); ?>
			<?php endif; ?>

			<?php if ( kol_has_menu( 'social' ) ) : ?>
	
				<?php wp_nav_menu( array(
					'theme_location' => 'social',
					'container'      => false,
					'fallback_cb'    => false,
					'menu_id'        => 'main-menu-social',
					'menu_class'     => 'menu-social menu menu-content close-on-tablet',
					'depth'          => 1,
					'walker'         => new kol_menu_social_walker()
				) ); ?>
	
			<?php endif; ?>

			<?php do_action( 'kol_hook_main_menu_content' ); ?>

		<?php endif; ?>

	</div>

</nav>