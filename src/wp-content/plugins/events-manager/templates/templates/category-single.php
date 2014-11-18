<?php
/*
 * This page displays a single event, called during the em_content() if this is an event page.
 * You can override the default display settings pages by copying this file to yourthemefolder/plugins/events-manager/templates/ and modifying it however you need.
 * You can display events however you wish, there are a few variables made available to you:
 * 
 * $args - the args passed onto EM_Events::output() 
 */

$page_for_category = get_option('dbem_categories_page');
$category_page = get_post($page_for_category);
$page_base = $category_page->post_content;

global $EM_Category;
$page_content = $EM_Category->output_single();

if(preg_match('/CONTENTS/', $page_base) ){
	$final_content = str_replace('CONTENTS', $page_content, $page_base);
	echo $final_content;
}



?>