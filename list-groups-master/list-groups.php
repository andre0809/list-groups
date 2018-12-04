<?php
/*
Plugin Name: Groups List Users Show
Plugin URI: #
Description: List users of a group.
Author: Hendra Trisnayadi
Version: 1.0.0
Author URI: #
*/

add_shortcode('group_list', 'group_list');
function group_list( $atts, $content = null ) {
  $output = "";
  $options = shortcode_atts(
      array(
          'group_id' => null
      ),
      $atts
  );
  if ($options['group_id']) {
    $group = new Groups_Group($options['group_id']);
    if ($group) {
      $users = $group->__get("users");
      if (count($users)>0) {
        foreach ($users as $group_user) {
          $user = $group_user->user;
          $user_info = get_userdata($user->ID);
          $output .='<li> '. $user_info-> user_lastname .  ", " . $user_info-> user_firstname . "</li>";
            }
      }
    }
  }
  echo $output;
}