<?php
/*
*   Plugin Name: WP Term Taxonomy Reader
*   Description: plugin to read the MySQL DB Term Taxonomy table
*   Version: 1.0 
*   Author: Syed A Uddin
*   File: wp-term-taxonomy-reader.php
*   Folder to create: taxonomy-tbl-reader
*   Short code: [wp-term-taxonomy-reader-shortcode]
*/
   
  add_shortcode( 'wp-term-taxonomy-reader-shortcode', 'wp_term_taxonomy_reader_entry_point' );


function wp_term_taxonomy_reader_entry_point ( $attributes ) {
	
	global $wpdb;
 
 	$output = "";

	
	//Use the concatinaiton operator to join the table prefix to the word comments
	// to create the correct db prefix + table name
	//
	$tableName =   $wpdb->prefix . "term_taxonomy"; 

	//Echo out the $tablename varaible, which is the db prefix + table name
	//
	//echo "$tableName";
	  

	//Query the vomments table and assign the returned array of table row objects
	// to the $result variable
	//
	$result = $wpdb->get_results( "SELECT * FROM $tableName");

    //Echo out a table header using start string values
    //
	$output .=  "<table border=\"1\">";
	
	$output .=  "<tr>";
	$output .=  "<th>"  . "Term Taxonomy ID"   . "</th>" 
		. "<th>" . "Term ID"    		. "</th>" 
		. "<th>" . "Taxonomy" 			. "</th>" 
		. "<th>" . "Count"    			. "</th>";
	
	$output .=  "</tr>";

	//Iterate the array of DB row objects and put them in HTML table cells
	// 
	foreach($result as $row)  {
	
		 if (   $row->count > 0 ) 
	 	 {
	 		$output .=  "<tr>";
	
	 		//Each table row column data item is accessed using it's column name 
	 		// 
	 		$output .=   "<td>" . $row->term_taxonomy_id . "</td>"
				 . "<td>" . $row->term_id			. "</td>"
		 		 . "<td>" . $row->taxonomy  	    . "</td>"
		 		 . "<td>" . $row->count		    . "</td>";
		  
	 		$output .=  "</tr>";
	  	 }
	}

	$output .=  "</table>";
	return $output;
}
?>
