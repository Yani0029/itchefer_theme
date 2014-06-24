<?php

/**
 * @file
 * template.php
 */
function itchefer_theme_preprocess_page(&$vars, $hook) {
  if(arg(0) == 'min_side') {
    drupal_set_title('Min Kommune');
  }
}

function itchefer_theme_print_pdf_tcpdf_content($vars) {
  $pdf = $vars['pdf'];
  // set content font
  $pdf->setFont($vars['font'][0], $vars['font'][1], $vars['font'][2]);

  preg_match('!<body.*?>(.*)</body>!sim', $vars['html'], $matches);
  $pattern = '!(?:<div class="print-(?:logo|site_name|breadcrumb|footer)">.*?</div>|<hr class="print-hr" />)!si';
  $matches[1] = preg_replace($pattern, '', $matches[1]);

  // Make CCK fields look better
  $matches[1] = preg_replace('!(<div class="field.*?>)\s*!sm', '$1', $matches[1]);
  $matches[1] = preg_replace('!(<div class="field.*?>.*?</div>)\s*!sm', '$1', $matches[1]);
  $matches[1] = preg_replace('!<div( class="field-label.*?>.*?)</div>!sm', '<strong$1</strong>', $matches[1]);

  // Since TCPDF's writeHTML is so bad with <p>, do everything possible to make it look nice
  $matches[1] = preg_replace('!<(?:p(|\s+.*?)/?|/p)>!i', '<br$1 />', $matches[1]);
  $matches[1] = str_replace(array('<div', 'div>'), array('<span', 'span><br />'), $matches[1]);
  do {
    $prev = $matches[1];
    $matches[1] = preg_replace('!(</span>)<br />(\s*?</span><br />)!s', '$1$2', $matches[1]);
  } while ($prev != $matches[1]);

  @$pdf->writeHTML(
     '<head><link rel="stylesheet" type="text/css" href="'.drupal_get_path('theme','itchefer_theme') .'/css/print.css"></head>' . $matches[1]);

  return $pdf;
}

function itchefer_theme_form_alter(&$form, &$form_state, $form_id) {
  global $user;
  if ($form_id == 'user_register_form' || ($form_id == 'user_profile_form')) {
    //dpm($form);
    $form['locations'][0]['#title'] = "Fakturaadresse";
  }
  if ($form_id == 'user_register_form') {
    if (!isset($user->roles[3])){
      $form['og_group_ref']['#access'] = FALSE;
    }
  }
  if ($form_id == 'user_profile_form') {
    if ($user->uid != 1) {
      $form['og_user_node']['#access'] = FALSE;
      $form['contact']['#access'] = FALSE;
      $form['overlay_control']['#access'] = FALSE;
      $form['mimemail']['#access'] = FALSE;
      $form['ckeditor']['#access'] = FALSE;
      $form['account']['mail']['htmlmail_plaintext']['#access'] = FALSE;
    }
    if (!isset($user->roles[3])){
      $form['account']['name']['#disabled'] = TRUE;
    }
    
  }
  if ($form_id == 'user_login') {
    $form['name']['#title'] = t('Email/brugernavn');
    $form['name']['#description'] = t('Indtast din email eller dit brugernavn');
    $form['pass']['#description'] = t('Indtast adgangskode');
  }
  
   //dpm($form);
  if (isset($form['type']['#value']) && $form['type']['#value'] == 'group' && $user->uid != 1)  {
    //dpm($form);
    $form['group_register']['#access'] = FALSE;
    $form['og_roles_permissions']['#access'] = FALSE;
    $form['group_access']['#access'] = FALSE;

  }

}

function itchefer_theme_preprocess_node(&$variables) {
  $variables['submitted'] = "<i class='icon-user'></i> ". $variables['name']. " ". "<i class='icon-calendar2'></i> " . $variables['date'];
}
function itchefer_theme_preprocess_comment(&$variables) {
  $variables['submitted'] = "<i class='icon-user'></i> ". $variables['author']. " ". "<i class='icon-calendar2'></i> " . $variables['created'];
}

/**
 * Implements template_preprocess_field().
 */
function itchefer_theme_preprocess_field(&$vars, $hook) {
  // Add line breaks to plain text textareas.
  if (
    // Make sure this is a text_long field type.
    $vars['element']['#field_type'] == 'text_long'
    // Check that the field's format is set to null, which equates to plain_text.
    && $vars['element']['#items'][0]['format'] == null
  ) {
    $vars['items'][0]['#markup'] = nl2br($vars['items'][0]['#markup']);
  }
}
