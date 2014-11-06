<?php
/**
 * General options panel for rpp_instance.php
 * 
 * Usage: include(tabs/instance_general_options.php);  
 */ 
?>
<?php
    $themes = array(
        array('option'=>'Pinteresting', 'value'=>'pinteresting'),
        array('option'=>'Pinteresting transparent', 'value'=>'pinteresting-transparent'),
        array('option'=>'Polaroid', 'value'=>'polaroid'),
        array('option'=>'Polaroid transparent', 'value'=>'polaroid-transparent'),
        array('option'=>'Curvy', 'value'=>'curvy'),
        array('option'=>'Curvy transparent', 'value'=>'Curvy-transparent')
    );
?>
<div class="item">
    <?php
    $o = new wpdreamsCustomSelect("theme", "Theme", array(
        'selects'=>$themes,
        'value'=>wpdreams_setval_or_getoption($_so, 'theme', $_dk)
    ));
    $params[$o->getName()] = $o->getData();
    ?>
</div>
<div class="item">
  <?php
  $option_name = "items_count";
  $option_desc = "Max items count";
  $o = new wpdreamsTextSmall($option_name, "Max items count", 
           wpdreams_setval_or_getoption($_so, $option_name, $_dk));
  $params[$o->getName()] = $o->getData();
  ?>
</div>
<div class="item">
  <?php
    $option_name = "on_lesscontent";
    $option_desc = "On less content fill the items with";
    $o = new wpdreamsCustomSelect($option_name, $option_desc, array(
        'selects'=>wpdreams_setval_or_getoption($_so, $option_name.'_def', $_dk),
        'value'=>wpdreams_setval_or_getoption($_so, $option_name, $_dk)
    ));
    $params[$o->getName()] = $o->getData();
  ?>
</div>
<div class="item">
  <?php
    $o = new wpdreamsCustomSelect("on_nocontent", "On no results fill the items with", array(
        'selects'=>wpdreams_setval_or_getoption($_so, 'on_nocontent_def', $_dk),
        'value'=>wpdreams_setval_or_getoption($_so, 'on_nocontent', $_dk)
    ));
    $params[$o->getName()] = $o->getData();
  ?>
</div> 
<div class="item">
  <?php
    $o = new wpdreamsYesNo("hide_on_no_results", "Hide if no content is found whatsoever?", 
         wpdreams_setval_or_getoption($_so, 'hide_on_no_results', $_dk));
    $params[$o->getName()] = $o->getData();
  ?>
</div>

<div class="item">
    <?php
    $option_name = "show_images";
    $option_desc = "Show images in results?";
    $o = new wpdreamsYesNo($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk));
    $params[$o->getName()] = $o->getData();
    ?>
</div>
<div class="item">
    <?php
    $option_name = "image_width";
    $option_desc = "Image width";
    $o = new wpdreamsTextSmall($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk));
    $params[$o->getName()] = $o->getData();
    ?>
</div>
<div class="item">
    <?php
    $option_name = "image_height";
    $option_desc = "Image height";
    $o = new wpdreamsTextSmall($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk));
    $params[$o->getName()] = $o->getData();
    ?>
</div>
<fieldset>
    <legend>Image source settings</legend>
    <div class="item">
        <?php
        $option_name = "image_source1";
        $option_desc = "Primary image source";
        $o = new wpdreamsCustomSelect($option_name, $option_desc, array(
            'selects'=>wpdreams_setval_or_getoption($_so, 'image_sources', $_dk),
            'value'=>wpdreams_setval_or_getoption($_so, $option_name, $_dk)
        ));
        $params[$o->getName()] = $o->getData();
        ?>
    </div>
    <div class="item">
        <?php
        $option_name = "image_source2";
        $option_desc = "Alternative image source 1";
        $o = new wpdreamsCustomSelect($option_name, $option_desc, array(
            'selects'=>wpdreams_setval_or_getoption($_so, 'image_sources', $_dk),
            'value'=>wpdreams_setval_or_getoption($_so, $option_name, $_dk)
        ));
        $params[$o->getName()] = $o->getData();
        ?>
    </div>
    <div class="item">
        <?php
        $option_name = "image_source3";
        $option_desc = "Alternative image source 2";
        $o = new wpdreamsCustomSelect($option_name, $option_desc, array(
            'selects'=>wpdreams_setval_or_getoption($_so, 'image_sources', $_dk),
            'value'=>wpdreams_setval_or_getoption($_so, $option_name, $_dk)
        ));
        $params[$o->getName()] = $o->getData();
        ?>
    </div>
    <div class="item">
        <?php
        $option_name = "image_source4";
        $option_desc = "Alternative image source 3";
        $o = new wpdreamsCustomSelect($option_name, $option_desc, array(
            'selects'=>wpdreams_setval_or_getoption($_so, 'image_sources', $_dk),
            'value'=>wpdreams_setval_or_getoption($_so, $option_name, $_dk)
        ));
        $params[$o->getName()] = $o->getData();
        ?>
    </div>
    <div class="item">
        <?php
        $option_name = "image_source5";
        $option_desc = "Alternative image source 4";
        $o = new wpdreamsCustomSelect($option_name, $option_desc, array(
            'selects'=>wpdreams_setval_or_getoption($_so, 'image_sources', $_dk),
            'value'=>wpdreams_setval_or_getoption($_so, $option_name, $_dk)
        ));
        $params[$o->getName()] = $o->getData();
        ?>
    </div>
    <div class="item">
        <?php
        $option_name = "image_default";
        $option_desc = "Default image url";
        $o = new wpdreamsUpload($option_name, $option_desc,
            wpdreams_setval_or_getoption($_so, $option_name, $_dk));
        $params[$o->getName()] = $o->getData();
        ?>
    </div>
    <div class="item">
        <?php
        $option_name = "image_custom_field";
        $option_desc = "Custom field containing the image";
        $o = new wpdreamsText($option_name, $option_desc,
            wpdreams_setval_or_getoption($_so, $option_name, $_dk));
        $params[$o->getName()] = $o->getData();
        ?>
    </div>
</fieldset>

<div class="item">
  <input type="hidden" name='rpl_submit' value=1 />
  <input name="submit_rpl" type="submit" value="Save all tabs!" />
</div>