<?php
/*
Plugin Name: Wordpress category lister plugin
Plugin URI:  https://github.com/gyolac/wpcategorylister
Description: List your worpdress categories as a link directory.
Version:     1.0
Author:      Gyolac                 
Author URI:  http://github.com/gyolac
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/
function showCategories(){
  $categories = get_categories( array(
    'orderby' => 'name',
    'order'   => 'ASC'                                                                                                                
  ) );
 
 $cats = array();
 $parents = array();
 $subs = array();
  foreach( $categories as $category ) {
    $id = $category->term_id;
    $name = $category->name;
    $parent = $category->parent;
    $c = array($id,$name,$parent);
    array_push($cats,$c);
  } 
  
  foreach($cats as $c){
      if($c[2] == 0){
        array_push($parents,$c);
      }else{
        array_push($subs,$c);
      }
  }
  
  for($i = 0; $i < count($parents); $i++){
    $p = $parents[$i];
    echo "<div style=\"float:left; padding:5%; width:40%;\">";
    echo "<h3 style=\"padding-bottom:4px; margin:0px;\">".$p[1]."</h3>";
    for($j = 0; $j < count($subs); $j++){
      $s = $subs[$j];
      if($s[2] == $p[0]){
        echo "<a href=\"".get_category_link( $s[0] )."\">".$s[1]."</a>";
        if($j+1 < count($subs)){
          echo ", ";
        }
      }
    }
    echo "</div>";
  }  
}
                         

add_shortcode( 'wpcatdir', 'showCategories');
?>