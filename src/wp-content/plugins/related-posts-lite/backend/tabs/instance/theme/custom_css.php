<p class='infoMsg'>
  This css will be added before the plugin as inline CSS so it has a precedence
  over plugin CSS. (you can override existing rules)
</p>
<div class="item">
  <?php
  $option_name = "custom_css";
  $option_desc = "Custom CSS";
  $o = new wpdreamsTextarea($option_name, $option_desc, 
       wpdreams_setval_or_getoption($_so, $option_name, $_dk));
  $params[$o->getName()] = $o->getData();
  ?>
</div>
<div class="item">
    <?php
    $option_name = "custom_css_special";
    $option_desc = "Advanced Custom CSS";
    $o = new wpdreamsTextareaIsParam($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk));
    $params[$o->getName()] = $o->getData();
    ?>
    <p class="descMsg">This is a DEV purpose option. Values from this box are <strong>erased</strong> when swithcing the template! Use the box above for custom CSS instead.</p>
</div>
<div class="item">
    <?php
    $option_name = "custom_css_selector";
    $option_desc = "";
    $val = get_option($_dk);
    $val = $val[$option_name];
    $o = new wpdreamsHidden($option_name, $option_desc,$val);
    $params[$o->getName()] = $o->getData();
    ?>
</div>