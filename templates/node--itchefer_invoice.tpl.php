<?php

/**
 * @file
 * Default theme implementation to display a node.
 *
 */
?>
<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <?php print render($title_prefix); ?>

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

      $dato = $content['field_event_node_id']['#object']->field_event_node_id['und'][0]['entity']->field_arrangement_dato_1;
      $dato_1 = $dato['und'][0]['value'];
      $dato_1 = date('d-m-Y',strtotime($dato_1));
      if ( $dato['und'][0]['value2'] != $dato['und'][0]['value']) {
        $day2 = 1;
        $dato_2 = $dato['und'][0]['value2'];
        $dato_2 = date('d-m-Y',strtotime($dato_2));
      }
      else {
        $day2 = 0;
      }

      // Signup checked values.
      $signup_1 = $content['field_node_signup_id']['#object']->field_node_signup_id['und'][0]['entity']->field_signup_days;
      $field_1 = field_collection_item_load($signup_1['und'][0]['value']);
      $field_1_checked = $field_1->field_signup_day_2_dato['und'][0]['value'];
      $signup_2 = $content['field_node_signup_id']['#object']->field_node_signup_id['und'][0]['entity']->field_signup_day_2;
      $field_2 = field_collection_item_load($signup_2['und'][0]['value']);
      $field_2_checked = $field_2->field_signup_day_2_dato['und'][0]['value'];
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
        print "<br /><strong>Deltagelse dag(e) - " ;
        if($field_1_checked && $field_2_checked) {
          $text = "Begge dage";
        }
        elseif ($field_1_checked) {
          $text = "Dag 1";
        }
        elseif ($field_2_checked) {
          $text = "Dag 2";
        }
        print " " . $text;
        print "</strong></div>";
      }
      
      if (isset($content['field_event_node_id'])) {
        print "<div class = 'arrangementer'>";

        print "<strong>Deltagelse i ";
        print render($content['field_event_node_id']['#object']->field_event_node_id['und'][0]['entity']->title) . " den ";
        print $dato_1;
        if ($day2) {
          print " til ";
          print $dato_2;
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

         print "Egenbetaling for deltagelse i seminaret for: <br>";
         if (isset($content['field_event_node_id']['#object']->field_signup_user['und'][0]['entity']->field_firstname['und'])) {
           print $content['field_event_node_id']['#object']->field_signup_user['und'][0]['entity']->field_firstname['und'][0]['value'] ." ";
           if (isset($content['field_event_node_id']['#object']->field_signup_user['und'][0]['entity']->field_lastname['und']))
           print $content['field_event_node_id']['#object']->field_signup_user['und'][0]['entity']->field_lastname['und'][0]['value'];
         }

        print "</div>";
      }

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
</div>
