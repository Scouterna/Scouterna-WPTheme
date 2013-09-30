<!-- sidebar -->
<div id="sidebar" class="sidebar-left">
    <div class="holder">
        <div class="frame">
            <div class="block">            	
            	<?php
            						
					if( is_active_sidebar('left-sidebar') ){
						dynamic_sidebar( 'left-sidebar' );
					}
					else{
					   if(function_exists('hip_folded_submenu')){
						   	echo '<nav>';
								echo hip_folded_submenu('none');
							echo '</nav>';
						}
				    }
					
				?>
            </div>
        </div>
    </div>
</div><!-- end #sidebar -->