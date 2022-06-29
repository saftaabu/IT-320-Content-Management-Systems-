<?php
/*
*   Plugin Name: WP Posts Reader
*   Description: plugin to read the MySQL DB Posts table
*   Version: 2.0 
*   Author: Mr. Michael H Chase
*   File: wp-posts-reader.php
*   Folder to create: posts-tbl-reader
*   Short code: [wp-posts-reader-shortcode]
*/
   
  add_shortcode( 'wp-posts-reader-shortcode', 'wp_posts_reader_entry_point' );


function wp_posts_reader_entry_point ( $attributes ) {
	
	global $wpdb;
 
 	$output = "";
 	
 	//
	// PLEASE NOTE
	//    "posts" is the database table name without the prefix
	//    *** YOU MUST add the prefix before the table name***
	//    ***  We will use the $wpdb object prefix value ***
	// 
	
	//Use the concatinaiton operator to join the table prefix to the word comments
	// to create the correct db prefix + table name
	//
	$tableName =   $wpdb->prefix . "posts"; 

	//Echo out the $tablename varaible, which is the db prefix + table name
	//
	$output .= "$tableName";
	  

	//Query the vomments table and assign the returned array of table row objects
	// to the $result variable
	//
	$result = $wpdb->get_results( "SELECT * FROM $tableName");

    //Echo out a table header using start string values
    //
	$output .= "<table border=\"2\">";
	
	$output .=  "<tr>";
	
	$output .=  "<th>"  . "ID"        		. "</th>" 
		. "<th>" . "Post Title"     . "</th>" 
		. "<th>" . "Post Status" 	. "</th>" 
		. "<th>" . "Comment Status" . "</th>" 
		. "<th>" . "Post Type"     	. "</th>";
		
	$output .=  "</tr>";

	//Iterate the array of DB row objects and put them in HTML table cells
	// 
	foreach($result as $row)  {
	
	 if ( strlen($row->post_title) > 0 ) {
	 
	 	$output .= "<tr>";
	
		 //Each table row column data item is accessed using it's column name 
	 	// 

	 
		$output .=    "<td>" . $row->ID 	. "</td>"
		  . "<td>" . $row->post_title		. "</td>"
		  . "<td>" . $row->post_status  	. "</td>"
		  . "<td>" . $row->comment_status   . "</td>"
		  . "<td>" . $row->post_type  		. "</td>";
		  	
	 	$output .=  "</tr>";
		}
	}

	$output .=  "</table>";
	
	return $output;
}
?>
