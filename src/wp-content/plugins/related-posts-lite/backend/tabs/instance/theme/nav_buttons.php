<div class="item">
    <?php
    $option_name = "nav_buttons_background";
    $option_desc = "Navigation button background gradient";
    $o = new wpdreamsGradient($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk)
    );
    $params[$o->getName()] = $o->getData();
    ?>
</div>
<div class="item">
    <?php
    $option_name = "autoplay_indicator_color";
    $option_desc = "Autoplay Indicator Color";
    $o = new wpdreamsColorPicker($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk)
    );
    $params[$o->getName()] = $o->getData();
    ?>
</div>
<div class="item">
    <?php
    $option_name = "nav_buttons_border";
    $option_desc = "Navigation button box border";
    $o = new wpdreamsBorder($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk)
    );
    $params[$o->getName()] = $o->getData();
    ?>
</div>

<div class="item">
    <?php
    $option_name = "nav_buttons_shadow";
    $option_desc = "Navigation button box shadow";
    $o = new wpdreamsBoxShadow($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk)
    );
    $params[$o->getName()] = $o->getData();
    ?>
</div>

<div class="item">
    <?php
    $option_name = "nav_buttons_arrow_image";
    $option_desc = "Arrows icon";
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
    $option_name = "nav_buttons_arrow_fill";
    $option_desc = "Arrows icon fill color";
    $o = new wpdreamsColorPicker($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk)
    );
    $params[$o->getName()] = $o->getData();
    ?>
    <p class='descMsg'>Won't apply to uploaded magnifiers!</p>
</div>

<div class="item">
    <?php
    $option_name = "nav_buttons_arrow_upload";
    $option_desc = "Custom arrows icon";
    $o = new wpdreamsUpload($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk)
    );
    $params[$o->getName()] = $o->getData();
    ?>
    <p class='descMsg'>Best resolution is 18x18 pixels.</p>
</div>

<div class="item">
    <?php
    $option_name = "nav_buttons_magn_image";
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
    $option_name = "nav_buttons_magn_fill";
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
    $option_name = "nav_buttons_magn_active_fill";
    $option_desc = "Magnifier:active fill color";
    $o = new wpdreamsColorPicker($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk)
    );
    $params[$o->getName()] = $o->getData();
    ?>
    <p class='descMsg'>Won't apply to uploaded magnifiers!</p>
</div>
<div class="item">
    <?php
    $option_name = "nav_buttons_magn_upload";
    $option_desc = "Custom magnifier icon";
    $o = new wpdreamsUpload($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk)
    );
    $params[$o->getName()] = $o->getData();
    ?>
    <p class='descMsg'>Best resolution is 18x18 pixels.</p>
</div>

<div class="item">
    <?php
    $option_name = "nav_buttons_list_image";
    $option_desc = "List icon";
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
    $option_name = "nav_buttons_list_fill";
    $option_desc = "List fill color";
    $o = new wpdreamsColorPicker($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk)
    );
    $params[$o->getName()] = $o->getData();
    ?>
    <p class='descMsg'>Won't apply to uploaded magnifiers!</p>
</div>
<div class="item">
    <?php
    $option_name = "nav_buttons_list_active_fill";
    $option_desc = "List icon:active fill color";
    $o = new wpdreamsColorPicker($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk)
    );
    $params[$o->getName()] = $o->getData();
    ?>
    <p class='descMsg'>Won't apply to uploaded icons!</p>
</div>
<div class="item">
    <?php
    $option_name = "nav_buttons_list_upload";
    $option_desc = "Custom list icon";
    $o = new wpdreamsUpload($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk)
    );
    $params[$o->getName()] = $o->getData();
    ?>
    <p class='descMsg'>Best resolution is 18x18 pixels.</p>
</div>