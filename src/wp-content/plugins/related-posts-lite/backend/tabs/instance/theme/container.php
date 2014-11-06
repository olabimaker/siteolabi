<div class="item">
  <?php
  $option_name = "container_width";
  $option_desc = "Container width";
  $o = new wpdreamsTextSmall($option_name, $option_desc, 
       wpdreams_setval_or_getoption($_so, $option_name, $_dk));
  $params[$o->getName()] = $o->getData();
  ?>
  <p class='descMsg'>Leave 0 for responsive. Otherwise use with units, ex.: 200px or 50%</p>
</div>

<div class="item">
  <?php
  $option_name = "container_margin";
  $option_desc = "Container margin";
  $option_expl = "Include the unit as well, example: 10px or 1em or 90%";
  $o = new wpdreamsFour($option_name, $option_desc,
         array(
           "desc" => $option_expl,
           "value" => wpdreams_setval_or_getoption($_so, $option_name, $_dk)
         ) 
       );
  $params[$o->getName()] = $o->getData();
  ?>
</div>

<div class="item">
  <?php
  $option_name = "container_padding";
  $option_desc = "Container padding";
  $option_expl = "Include the unit as well, example: 10px or 1em or 90%";
  $o = new wpdreamsFour($option_name, $option_desc,
         array(
           "desc" => $option_expl,
           "value" => wpdreams_setval_or_getoption($_so, $option_name, $_dk)
         ) 
       );
  $params[$o->getName()] = $o->getData();
  ?>
</div>

<div class="item">
    <?php
    $option_name = "container_background";
    $option_desc = "Container background gradient";
    $o = new wpdreamsGradient($option_name, $option_desc,
         wpdreams_setval_or_getoption($_so, $option_name, $_dk)
    );
    $params[$o->getName()] = $o->getData();
    ?>
</div>

<div class="item">
    <?php
    $option_name = "container_border";
    $option_desc = "Container border";
    $o = new wpdreamsBorder($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk)
    );
    $params[$o->getName()] = $o->getData();
    ?>
</div>
<div class="item">
    <?php
    $option_name = "container_shadow";
    $option_desc = "Container shadow";
    $o = new wpdreamsBoxShadow($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk)
    );
    $params[$o->getName()] = $o->getData();
    ?>
</div>
<div class="item">
    <?php
    $option_name = "container_font";
    $option_desc = "Container title text Font";
    $o = new wpdreamsFontComplete($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk)
    );
    $params[$o->getName()] = $o->getData();
    ?>
    <div class="clear"></div>
</div>

<div class="item">
    <?php
    $option_name = "container_title_margin";
    $option_desc = "Container title margin";
    $option_expl = "Include the unit as well, example: 10px or 1em or 90%";
    $o = new wpdreamsFour($option_name, $option_desc,
        array(
            "desc" => $option_expl,
            "value" => wpdreams_setval_or_getoption($_so, $option_name, $_dk)
        )
    );
    $params[$o->getName()] = $o->getData();
    ?>
</div>