<div class="item">
    <?php
    $option_name = "title_on_image";
    $option_desc = "Show the title on the bottom of the image";
    $o = new wpdreamsYesNo($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk)
    );
    $params[$o->getName()] = $o->getData();
    ?>
</div>
<div class="item">
    <?php
    $option_name = "title_background_color";
    $option_desc = "Title background color";
    $o = new wpdreamsColorPicker($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk)
    );
    $params[$o->getName()] = $o->getData();
    ?>
</div>
<div class="item">
    <?php
    $option_name = "title_font";
    $option_desc = "Title link Font";
    $o = new wpdreamsFontComplete($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk)
    );
    $params[$o->getName()] = $o->getData();
    ?>
</div>
<div class="item">
    <?php
    $option_name = "title_font_color_hover";
    $option_desc = "Hover title link color";
    $o = new wpdreamsColorPicker($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk)
    );
    $params[$o->getName()] = $o->getData();
    ?>
</div>
<div class="item">
    <?php
    $option_name = "title_font_color_active";
    $option_desc = "Active title link color";
    $o = new wpdreamsColorPicker($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk)
    );
    $params[$o->getName()] = $o->getData();
    ?>
</div>
<div class="item">
    <?php
    $option_name = "item_area_clickable";
    $option_desc = "Make the whole item area a link?";
    $o = new wpdreamsYesNo($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk)
    );
    $params[$o->getName()] = $o->getData();
    ?>
    <p  class="descMsg">If set to no, then only the title will link to the actual post.</p>
</div>
<div class="item">
    <?php
    $option_name = "content_font";
    $option_desc = "Content text Font";
    $o = new wpdreamsFontComplete($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk)
    );
    $params[$o->getName()] = $o->getData();
    ?>
</div>
<div class="item">
    <?php
    $option_name = "date_font";
    $option_desc = "Date text Font";
    $o = new wpdreamsFontComplete($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk)
    );
    $params[$o->getName()] = $o->getData();
    ?>
</div>
<div class="item">
    <?php
    $option_name = "author_font";
    $option_desc = "Author text Font";
    $o = new wpdreamsFontComplete($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk)
    );
    $params[$o->getName()] = $o->getData();
    ?>
</div>