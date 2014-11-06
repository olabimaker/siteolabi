<div class="item">
    <?php
    $option_name = "transitioning_type";
    $option_desc = "Animation type";
    $o = new wpdreamsCustomSelect($option_name, $option_desc,
        array('selects' => wpdreams_setval_or_getoption($_so, $option_name . '_def', $_dk),
            'value' => wpdreams_setval_or_getoption($_so, $option_name, $_dk))
    );
    $params[$o->getName()] = $o->getData();
    ?>
</div>
<div class="item">
    <?php
    $option_name = "transitioning_image_position";
    $option_desc = "Image position";
    $o = new wpdreamsCustomSelect($option_name, $option_desc,
        array('selects' => wpdreams_setval_or_getoption($_so, $option_name . '_def', $_dk),
            'value' => wpdreams_setval_or_getoption($_so, $option_name, $_dk))
    );
    $params[$o->getName()] = $o->getData();
    ?>
</div>
<div class="item">
    <?php
    $option_name = "transitioning_image_margin";
    $option_desc = "Image margin";
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
    $option_name = "transitioning_height";
    $option_desc = "Container height";
    $o = new wpdreamsTextSmall($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk)
    );
    $params[$o->getName()] = $o->getData();
    ?>
    <p class='descMsg'>Preferably in px. Default value: <b>200px</b></p>
</div>
<div class="item">
    <?php
    $option_name = "transitioning_item_background";
    $option_desc = "Item background gradient";
    $o = new wpdreamsGradient($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk)
    );
    $params[$o->getName()] = $o->getData();
    ?>
</div>
<div class="item">
    <?php
    $option_name = "transitioning_item_border";
    $option_desc = "Item border";
    $o = new wpdreamsBorder($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk)
    );
    $params[$o->getName()] = $o->getData();
    ?>
</div>
<div class="item">
    <?php
    $option_name = "transitioning_item_shadow";
    $option_desc = "Item shadow";
    $o = new wpdreamsBoxShadow($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk)
    );
    $params[$o->getName()] = $o->getData();
    ?>
</div>