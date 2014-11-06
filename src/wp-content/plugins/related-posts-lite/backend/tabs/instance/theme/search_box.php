<div class="item">
    <?php
    $option_name = "search_box_height";
    $option_desc = "Search box height";
    $o = new wpdreamsTextSmall($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk));
    $params[$o->getName()] = $o->getData();
    ?>
    <p class='descMsg'>Leave <strong>auto</strong> for best layout. Otherwise use with units, ex.: 200px or 50%</p>
</div>

<div class="item">
    <?php
    $option_name = "search_box_margin";
    $option_desc = "Search box margin";
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
    $option_name = "search_box_padding";
    $option_desc = "Search box padding";
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
    $option_name = "search_box_background";
    $option_desc = "Search box background gradient";
    $o = new wpdreamsGradient($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk)
    );
    $params[$o->getName()] = $o->getData();
    ?>
</div>

<div class="item">
    <?php
    $option_name = "search_box_border";
    $option_desc = "Search box border";
    $o = new wpdreamsBorder($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk)
    );
    $params[$o->getName()] = $o->getData();
    ?>
</div>
<div class="item">
    <?php
    $option_name = "search_box_shadow";
    $option_desc = "Search box shadow";
    $o = new wpdreamsBoxShadow($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk)
    );
    $params[$o->getName()] = $o->getData();
    ?>
</div>
<div class="item">
    <?php
    $option_name = "search_box_font";
    $option_desc = "Search box text Font";
    $o = new wpdreamsFontComplete($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk)
    );
    $params[$o->getName()] = $o->getData();
    ?>
</div>

<div class="item">
    <?php
    $option_name = "search_box_def_font";
    $option_desc = "Search box default text Font";
    $o = new wpdreamsFontComplete($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk)
    );
    $params[$o->getName()] = $o->getData();
    ?>
</div>
<div class="item">
    <?php
    $option_name = "search_box_image";
    $option_desc = "Magnifier icon";
    $o = new wpdreamsImageRadio($option_name, $option_desc, array(
            'images'  => wpdreams_setval_or_getoption($_so, $option_name.'_selects', $_dk),
            'value'=> wpdreams_setval_or_getoption($_so, $option_name, $_dk)
        )
    );
    $params[$o->getName()] = $o->getData();
    ?>
    <p class='descMsg'>Retina ready, colorizable svg magnifier icons.</p>
</div>
<div class="item">
    <?php
    $option_name = "search_box_magnifier_fill";
    $option_desc = "Magnifier fill color";
    $o = new wpdreamsColorPicker($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk)
    );
    $params[$o->getName()] = $o->getData();
    ?>
    <p class='descMsg'>Won't apply to uploaded magnifiers!</p>
</div>
<div class="item">
    <?php
    $option_name = "search_box_image_upload";
    $option_desc = "Custom magnifier icon";
    $o = new wpdreamsUpload($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk)
    );
    $params[$o->getName()] = $o->getData();
    ?>
    <p class='descMsg'>Best resolution is 16x16 pixels.</p>
</div>