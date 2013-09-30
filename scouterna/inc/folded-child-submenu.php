<?php
function hip_folded_submenu_exclude($exclusions = "") {
/*
	This function returns an exclude list for wp_list_pages
	to create a cascading menu effect.
*/
  global $post, $wpdb;
/*
	Find the parents of the pages to be displayed
	by working back up the tree from the current page
*/
    if (isset($post->ID)) {
        $x = $post->ID;
        $inclusions = "(post_parent <> " . strval($x) . ")";
        do {
           $hip_select = "SELECT post_parent " .
                "FROM $wpdb->posts " .
                "WHERE ID = " . $x . " " .
                " LIMIT 1";
                
            $include = $wpdb->get_results($hip_select,ARRAY_N);
            $x = $include[0][0];
            $inclusions .= " AND (post_parent <> " . $x . ")";
            
        } while ($x <> 0);
        
    /*
        The exclude list consist of all the pages 
        whose IDs are *not* on the include list
    */
        $rows = $wpdb->get_results("SELECT ID FROM $wpdb->posts WHERE (post_type = 'page') AND $inclusions", ARRAY_N);
        if ( count($rows) ) {
            foreach ( $rows as $row ) {
                foreach ( $row as $ro ) {
                    if ($exclusions <> "")
                        $exclusions .= ",";
                    $exclusions .= strval($ro);
                }
            }
        }
	} 

	if ($exclusions <> "") 
		$exclusions = "exclude=" . $exclusions;
	return $exclusions;
}

function hip_folded_submenu($excluded, $page=false){
		
	global $post,$wpdb;
	
	if(false !== $page) {
		$post = get_page_by_path($page);
	}
    
    $exclude = hip_folded_submenu_exclude('123456789');
    
    if($excluded != 'none'){
		$exclude = $exclude .','. $excluded;
	}
	
	$args = "";
    if($post->ancestors)
	{
        $ancestors = end( $post->ancestors );	
		$ancestral_count = count( $post->ancestors );
		$last_protected_ancestor = '';
		
		foreach( $post->ancestors as $item ) {
			// if the ancestor page is password protected save it's ID into the array
			if( post_password_required( $item ) ) $password_protected_ancestors[] = $item;
		}
		if( !empty( $password_protected_ancestors ) ) {
			// the page that is the last ancestor with a password
			$last_protected_ancestor = end( $password_protected_ancestors );
		}			
		
		$post_password_is_required = post_password_required( $post->ID );
		
		if( !empty( $password_protected_ancestors ) ) :
			
			// get all child pages of $last_protected_ancestor	
			$children = get_pages( array( 'child_of' => $last_protected_ancestor ) );			
			// exclude all children of $last_protected_ancestor
			foreach( $children as $item ) {
				$exclude .= ",$item->ID";	
			}		
		
		elseif( $post_password_is_required ) : 
			/* if the page we're on requires a password we don't want to print it's children until the password has been provided */
			$args = "&depth=$ancestral_count";		
		endif;		
		
        $out = wp_list_pages("title_li=&child_of=".$ancestors."&sort_column=menu_order&exclude=".$exclude."&echo=0$args");  		

	}
	else if($post->post_parent)
	{
        $ancestors = end($post->ancestors);
        $out = wp_list_pages("title_li=&child_of=".$post->post_parent."&sort_column=menu_order&exclude=".$exclude."&echo=0$args");
	}
	else{
		$post_password_is_required = post_password_required( $post->ID );
		if( $post_password_is_required ) { 
			$args = "&exclude_tree=$post->ID";
		}
	  	$out = wp_list_pages("title_li=&child_of=".$post->ID."&sort_column=menu_order&exclude=".$exclude."&echo=0&before_li=$args");

	}
		
	if( $out ){	   
	   return "<ul class='submenu'>".$out."</ul>";	   
	}

}