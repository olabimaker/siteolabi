<div class="item">
    <?php
    $option_name = "isotope_type";
    $option_desc = "Isotope type";
    $o = new wpdreamsCustomSelect($option_name, $option_desc,
        array('selects' => wpdreams_setval_or_getoption($_so, $option_name . '_def', $_dk),
            'value' => wpdreams_setval_or_getoption($_so, $option_name, $_dk))
    );
    $params[$o->getName()] = $o->getData();
    ?>
</div>
<div class="item">
    <?php
    $option_name = "isotope_item_width";
    $option_desc = "Item width (with 12px padding)";
    $o = new wpdreamsTextSmall($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk)
    );
    $params[$o->getName()] = $o->getData();
    ?>
</div>
<div class="item">
    <?php
    $option_name = "isotope_item_background";
    $option_desc = "Item background gradient";
    $o = new wpdreamsGradient($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk)
    );
    $params[$o->getName()] = $o->getData();
    ?>
</div>
<div class="item">
    <?php
    $option_name = "isotope_item_border";
    $option_desc = "Item border";
    $o = new wpdreamsBorder($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk)
    );
    $params[$o->getName()] = $o->getData();
    ?>
</div>
<div class="item">
    <?php
    $option_name = "isotope_item_shadow";
    $option_desc = "Item shadow";
    $o = new wpdreamsBoxShadow($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk)
    );
    $params[$o->getName()] = $o->getData();
    ?>
</div>
