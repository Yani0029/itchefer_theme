<?php

/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct URL of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type; for example, "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type; for example, story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode; for example, "full", "teaser".
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined; for example, $node->body becomes $body. When needing to
 * access a field's raw values, developers/themers are strongly encouraged to
 * use these variables. Otherwise they will have to explicitly specify the
 * desired field language; for example, $node->body['en'], thus overriding any
 * language negotiation rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 *
 * @ingroup themeable
 */
?>
<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <?php //print $user_picture; ?>

  <?php print render($title_prefix); ?>
  <?php /*if (!$page): ?>
    <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
  <?php endif; */?>
  <?php print render($title_suffix); ?>

  <?php /*if ($display_submitted): ?>
    <div class="submitted">
      <?php print $submitted; ?>
    </div>
  <?php endif; */?>

  <div class="content"<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      //print render($content);
      print render($content['print_links']);
      if (isset($content['field_invoice_company'])) {      
        print render($content['field_invoice_company']);
      }
      if (isset($content['field_invoice_date'])) {
        print "<div class = 'float-right'>";
        print render($content['field_invoice_date']);
        if (isset($content['field_invoice_no'])) {
          print render($content['field_invoice_no']);
        }
        print "</div>";
      }
      if (isset($content['field_signup_user'])) {
        print "<div class = 'float-left'>";
        //print render($content['field_signup_user']);
        $address = $content['field_event_node_id']['#object']->field_signup_user['und'][0]['entity']->location;
        if (!empty($address)) {
          print $address['name'] . "<br>";
          print $address['street'] . "<br>";
          if ($address['additional'])
          print $address['additional'] . "<br>";
          print $address['postal_code']. " ".$address['city'] . "<br>";
          if (isset($content['field_event_node_id']['#object']->field_signup_user['und'][0]['entity']->field_firstname['und'])) {
            print "Att.: ";
            print $content['field_event_node_id']['#object']->field_signup_user['und'][0]['entity']->field_firstname['und'][0]['value'] ." ";
            if (isset($content['field_event_node_id']['#object']->field_signup_user['und'][0]['entity']->field_lastname['und']))
              print $content['field_event_node_id']['#object']->field_signup_user['und'][0]['entity']->field_lastname['und'][0]['value'];
          }
        }
        if (isset($content['field_event_node_id']['#object']->field_signup_user['und'][0]['entity']->field_ean_number['und'])) {
          Print "<br><br>EAN nr. : " . $content['field_event_node_id']['#object']->field_signup_user['und'][0]['entity']->field_ean_number['und']['0']['value'];
        }
        print "</div>";
      }
      
      if (isset($content['field_event_node_id'])) {
        print "<div class = 'arrangementer'>";

        print "<strong>Deltagelse i ";
        print render($content['field_event_node_id']['#object']->field_event_node_id['und'][0]['entity']->title). " den ";
        $dato = $content['field_event_node_id']['#object']->field_event_node_id['und'][0]['entity']->field_arrangement_dato_1;
        $dato_1 = $dato['und'][0]['value'];
        $dato_1 = explode(" ", $dato_1);
        print $dato_1[0];
        if ($dato['und'][0]['value2'] != $dato['und'][0]['value']) {
          print " til ";
          $dato_2 = $dato['und'][0]['value2'];
          $dato_2 = explode(" ", $dato_2);
          print $dato_2[0];
        }
        $sted = $content['field_event_node_id']['#object']->field_event_node_id['und'][0]['entity']->location;

        if (!empty($sted)) {
           print " på " ;
           print $sted['name'];
           if(!empty($sted['street'])) print ", ".$sted['street'];
           if(!empty($sted['postal_code'])) print ", " . $sted['postal_code'];
           if(!empty($sted['city'])) print " ".$sted['city'];
                                  
         }
         print "</strong>";
         print "<hr>";

         print " <br>Egenbetaling for deltagelse i seminaret for: <br>";
         if (isset($content['field_event_node_id']['#object']->field_signup_user['und'][0]['entity']->field_firstname['und'])) {
           print $content['field_event_node_id']['#object']->field_signup_user['und'][0]['entity']->field_firstname['und'][0]['value'] ." ";
           if (isset($content['field_event_node_id']['#object']->field_signup_user['und'][0]['entity']->field_lastname['und']))
           print $content['field_event_node_id']['#object']->field_signup_user['und'][0]['entity']->field_lastname['und'][0]['value'];
         }
        

        print "</div>";
      }

    //  print " <br> Egenbetaling for deltagelse i seminaret for: <br>";
     // print $content['field_event_node_id']['#object']->field_signup_user['und'][0]['entity']->field_firstname['und'][0]['value'] ." ";
   //   print $content['field_event_node_id']['#object']->field_signup_user['und'][0]['entity']->field_lastname['und'][0]['value'];
      print "<div class='pris'>";
      if (isset($content['field_event_price'])) {
        print "<div class = 'event-price'>";
        print render($content['field_event_price']);
        print "</div>";
      }
      if (isset($content['field_moms'])) {
        print "<div class = 'event-moms'>";
        print render($content['field_moms']);
        print "</div>";
      }
      if (isset($content['field_event_total_price'])) {
        print "<div class = 'event-total-price'>";
        print render($content['field_event_total_price']);
        print "</div>";
      }
       print "</div>";
      // Betales senest den (dato + 8 dage)
      print "<div class='pay_date'>";
      print "<strong>Betales senest den ";
      $d = strtotime($content['field_invoice_date']['#items'][0]['value']);
      $d = $d + 8*24*60*60;
      $d = date('d-m-Y',$d);
      print $d . "</strong></div>";
      if (isset($content['field_andre_info'])) {
        print "<div class = 'andre-info'>";
        print render($content['field_andre_info']);
        print "</div>";
      }

    ?>
  </div>
  <?php //print $user_picture; ?>
  <?php /*if ($display_submitted): ?>
    <div class="submitted">
      <?php print $submitted; ?>
    </div>
  <?php endif; */?>
  <?php //print render($content['links']); ?>

  <?php //print render($content['comments']); ?>

</div>
