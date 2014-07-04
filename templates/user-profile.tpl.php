<?php

/**
 * @file
 *
 *   Where the html is handled for the group.
 * @see user-profile-item.tpl.php
 *   Where the html is handled for each item in the group.
 * @see template_preprocess_user_profile()
 *
 * @ingroup themeable
 */
?>
<div class="profile"<?php print $attributes; ?>>
  <?php if (isset($user_profile['field_firstname'])) {
//         if( $user_profile['field_firstname']['#object']->uid != 26) { 
//           print render($user_profile);
           print "<div class='group_page_2_row'><div class='group_logo_left'>";
           print render($user_profile['user_picture']);
           print render($user_profile['field_user_description']);
           print "</div>";
           print "<div class='group_page_right'>";
           print "<h5>".render($user_profile['field_firstname']['#object']->name)."</h5>";
           print "<h6>".render($user_profile['field_user_title'])."</h6>";
           print "<h6 style='min-height:6px'>".render($user_profile['field_region'])."</h6>";
           if( $user_profile['field_firstname']['#object']->uid != 26)
           print "<h6>".render($user_profile['og_group_ref'])."</h6>";
           print "<i class='icon-office'></i> Afdeling - ";
           if (isset($user_profile['field_user_department']))
           print $user_profile['field_user_department'][0]['#markup'];
           print "<br /><a href='mailto:".$user_profile['field_firstname']['#object']->mail."'> <i class='icon-mail'></i> ";
           print render($user_profile['field_firstname']['#object']->mail) ."</a>";
           print "<br /><i class='icon-phone'></i> ";
           if (isset($user_profile['field_telephone_number']))
           print $user_profile['field_telephone_number'][0]['#markup'];
           print "<br /><i class='icon-bubble'></i> ";
           print render($user_profile['privatemsg_send_new_message']);
           print "</div></div>";


           print "<div class='work_areas'>";
           print "<h2 class='group_block_title'>Arbejdsområde</h2>";
           print render($user_profile['field_recruitment_function'])."</div>";
           print "<div class='user_locations'>";
           //print "<h2 class='group_block_title'>Fakturaadresse</h2>";
           print render($user_profile['locations'])."</div>";
        // }
        } else {
           print render($user_profile['user_picture']);
         }

  ?>
</div>
