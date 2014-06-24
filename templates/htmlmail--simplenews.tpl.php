<div style="background-color: #f3f3f3">
    <div class="htmlmail_tpl_php" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;font-size: 14px;
    line-height: 1.428571429; color: #333; max-width:960px;position: relative;margin: 0 auto;">
        <div class="header" style="background-color: #4b4b4a; max-height: 116px">
            <div class="logo" style="margin: 0 20px">
                <a href="<?php global $base_url; print $base_url; ?>" style="text-decoration: none;">
                    <img src="<?php print theme_get_setting('logo','itchefer_theme'); ?>" title="<?php print variable_get('site_name');?>"/>
                    <span style="font-size: 21px; color:#fff; position: absolute; top:70px;"><?php print variable_get('site_slogan');?></span>
                </a>
            </div>
        </div>
       <div style="padding: 20px 20px; background-color: #fff;">
          <div class="htmlmail-simplenews-body htmlmail-body">
            <?php echo $body; ?>
          </div>
       </div>
       <div class="footer" style="background: url('<?php print $base_url;?>/sites/all/themes/itchefer_theme/images/footer.png') 100% 100% no-repeat #fff; margin-top: 0px; padding-top: 35px; padding-bottom: 36px; border-top: 1px solid #e5e5e5;">
        <div style="margin: 0 20px; max-width: 70%; ">
      Foreningen af Kommunale it-chefer / Sekretariatet / Tlf.: 3190 1155&nbsp;/ Email:&nbsp;<a href="mailto:mail@itchefer.dk" style="color: rgb(153, 153, 153); text-decoration: none; font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 14.296875px;">mail@itchefer.dk</a>
        </div>
      </div>
    </div>
</div>