<div class="aside aside-wrapper">
	<?php if(is_active_sidebar('main-sidebar')) : ?>
		<div class="aside mainwidgets">
			<?php dynamic_sidebar( 'main-sidebar' ); ?>
		</div>
	<?php endif; ?>
	
	<?php if(is_active_sidebar('ad-sidebar')) : ?>
		<div class="aside banners">
			<?php dynamic_sidebar( 'ad-sidebar' ); ?>
		</div>
	<?php endif; ?>
</div>