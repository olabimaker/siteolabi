<?php
/**
 * Advanced options panel for rpp_instance.php
 * 
 * Usage: include(tabs/instance_advanced_options.php);  
 */ 
?>


<fieldset>
    <legend>Autoplay Options</legend>
    <div class="item">
        <?php
        $option_name = "autoplay";
        $option_desc = "Enable autoplay?";
        $o = new wpdreamsYesNo($option_name, $option_desc,
            wpdreams_setval_or_getoption($_so, $option_name, $_dk));
        $params[$o->getName()] = $o->getData();
        ?>
    </div>
    <div class="item">
        <?php
        $option_name = "autoplay_show_indicator";
        $option_desc = "Show the autoplay indicator?";
        $o = new wpdreamsYesNo($option_name, $option_desc,
            wpdreams_setval_or_getoption($_so, $option_name, $_dk));
        $params[$o->getName()] = $o->getData();
        ?>
    </div>
    <div class="item">
        <?php
        $option_name = "autoplay_time";
        $option_desc = "Autoplay interval (ms)";
        $o = new wpdreamsTextSmall($option_name, $option_desc,
            wpdreams_setval_or_getoption($_so, $option_name, $_dk));
        $params[$o->getName()] = $o->getData();
        ?>
        <p class='descMsg'>The default is 6000 milliseconds.</p>
    </div>
</fieldset>


<div class="item">
  <p class='infoMsg'>
  By excluding one or more categories, the content (posts/custom post types) form those 
  terms won't show on the frontend.  
  </p>
  <?php
    $option_name = "exclude_categories";
    $option_desc = "Exclude categories";
    $o = new wpdreamsCategories($option_name, $option_desc, 
             wpdreams_setval_or_getoption($_so, $option_name, $_dk));
    $params[$o->getName()] = $o->getData();
    $params['selected-'.$o->getName()] = $o->getSelected();
  ?>
</div>


<div class="item">
  <?php
    $option_name = "exclude_by_id";
    $option_desc = "Exclude posts by ID";
    $o = new wpdreamsTextarea($option_name, $option_desc, 
             wpdreams_setval_or_getoption($_so, $option_name, $_dk));
    $params[$o->getName()] = $o->getData();
  ?>
  <p class='descMsg'>Separated by comma, example: 1, 2, 13, 24, 100</p>
</div>

<div class="item">
    <input type="hidden" name='rpl_submit' value=1 />
    <input name="submit_rpl" type="submit" value="Save all tabs!" />
</div>