<?php
    $com_options = get_option("rpp_compatibility");
?>
<div id="wpdreams" class='wpdreams wrap'>
<div class="wpdreams-box">
    <?php ob_start(); ?>
    <div class="item">
        <?php
        $o = new wpdreamsYesNo("inline_styles", "Load inline stylesheets?",
            wpdreams_setval_or_getoption($com_options, 'inline_styles', 'rpp_compatibility_def'));
        $params[$o->getName()] = $o->getData();
        ?>
        <p class="descMsg">Turn it on if you have problems with saving the stylesheets.</p>
    </div>
    <div class="item">
        <?php
        $o = new wpdreamsYesNo("css_compress", "Minify the stylesheet files when saving?",
            wpdreams_setval_or_getoption($com_options, 'css_compress', 'rpp_compatibility_def'));
        $params[$o->getName()] = $o->getData();
        ?>
        <p class="descMsg">Don't use this if you have another CSS minifier activated.</p>
    </div>
    <div class="item">
        <?php
        $o = new wpdreamsCustomSelect("js_source", "Javascript source", array(
            'selects'=>wpdreams_setval_or_getoption($com_options, 'js_source_def', 'rpp_compatibility_def'),
            'value'=>wpdreams_setval_or_getoption($com_options, 'js_source', 'rpp_compatibility_def')
            )
        );
        $params[$o->getName()] = $o->getData();
        ?>
        <p class="descMsg">
            <ul style="float:right;text-align:left;width:50%;">
                <li><b>Non minified</b> - Low Compatibility, Medium space</li>
                <li><b>Minified</b> - Low Compatibility, Low space</li>
                <li><b>Non minified Scoped</b> - High Compatibility, High space</li>
                <li><b>Minified Scoped</b> - High Compatibility, Medium space</li>
            </ul>
            <div class="clear"></div>
        </p>
    </div>
    <div class="item">
        <input type='submit' class='submit' value='Save options'/>
    </div>
    <?php $_r = ob_get_clean(); ?>
  
  
  <?php
    $updated = false;
    if (isset($_POST) && isset($_POST['rpp_comp']) && (wpdreamsType::getErrorNum()==0)) {
        print "saving!";
        $values = array(
            "inline_styles" => $_POST['inline_styles'],
            "css_compress" => $_POST['css_compress'],
            "js_source" => $_POST['js_source']
        );
        update_option('rpp_compatibility', $values);
        $updated = true;
    }
  ?>
  <?php
  $_comp = wpdreamsCompatibility::Instance();
  if ($_comp->has_errors()): 
  ?>
  <div class="wpdreams-slider errorbox">
          <p class='errors'>Possible incompatibility! Please go to the <a href="<?php echo get_admin_url()."admin.php?page=ajax-search-pro/comp_check.php"; ?>">error check</a> page to see the details and solutions!</p> 
  </div>
  <?php endif; ?>
  <div class='wpdreams-slider'>
  <form name='rpp_compatibility' method='post'>
    <?php if($updated): ?><div class='successMsg'>Compatibility settings successfuly updated!</div><?php endif; ?>
    <fieldset>
      <legend>Compatibility Options</legend>
      <?php print $_r; ?> 
      <input type='hidden' name='rpp_comp' value='1' />
    </fieldset>
  </form>
  </div>        
</div>
</div>