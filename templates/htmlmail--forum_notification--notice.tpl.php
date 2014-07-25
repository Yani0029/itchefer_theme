<?php

  $template_name = basename(__FILE__);
  $current_path = realpath(NULL);
  $current_len = strlen($current_path);
  $template_path = realpath(dirname(__FILE__));
  if (!strncmp($template_path, $current_path, $current_len)) {
    $template_path = substr($template_path, $current_len + 1);
  }
  $template_url = url($template_path, array('absolute' => TRUE));
?>

<div style="background-color: #e3e3e3;">
<table width = "766" id="main-table" style="text-align: center; margin: 0 auto; text-align: justify; border-collapse: collapse; background-color: white;max-width: 766px;">
    <tbody class="htmlmail_tpl_php" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;font-size: 14px;
    line-height: 1.428571429; color: #4b4b4a; max-width: 766px;position: relative;margin: 0 auto;">
      <tr>
        <td class="header">
          <div>
            <div class="logo" style="max-height: 116px;">
                <a href="<?php global $base_url; print $base_url; ?>" style="text-decoration: none;">
                    <img style="width: 100%" src="http://itchefer.dk/sites/all/themes/itchefer_theme/images/mail_logo_1.png" title="<?php print variable_get('site_name');?>"/>
                </a>
            </div>
          </div>
        </td>
      </tr>
      <tr>
       <td>
          <div class="htmlmail-simplenews-body htmlmail-body" style="margin: 10px 25px; background-color: #fff;">
            <?php echo $body; ?>
          </div>
       </td>
      </tr>
      <tr>
       <td class="footer" style="margin-top: 0px; border-top: 1px solid #e5e5e5;">
       <table style="width: 100%;">
        <tbody>
          <tr>
            <td style="margin: 0 20px; min-width: 320px; text-align: left;font-family: Helvetica Neue,Helvetica,Arial,sans-serif;color: #4b4b4a">
              Foreningen af Kommunale it-chefer / Sekretariatet / Tlf.: 3190 1155&nbsp;/ Email:&nbsp;<a href="mailto:mail@itchefer.dk" style="color: rgb(153, 153, 153); text-decoration: none; font-family: Arial, Helvetica, sans-serif; font-size: 14px;">mail@itchefer.dk</a>
            </td>
            <td style="max-width: 150px;">
              <img style = "width:150px;" src="http://itchefer.dk/sites/all/themes/itchefer_theme/images/footer.png">
            </td>
          </tr>
        </tbody>
       </table>
      </td>
      </tr>
    </tbody>
</table>
</div>
