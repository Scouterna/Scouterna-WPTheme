<!-- sidebar -->
<div id="sidebar" class="sidebar-left">
    <div class="holder">
        <div class="frame">
            <div class="block">            	
            	<?php
            		if( is_active_sidebar('blog-sidebar') ) :
						dynamic_sidebar( 'blog-sidebar' );
					endif;					
				?>
            </div>
        </div>
    </div>
</div><!-- end #sidebar -->
