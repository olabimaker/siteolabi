<div class="item">
    <?php
    $option_name = "return_posts";
    $option_desc = "Return posts?";
    $o = new wpdreamsYesNo($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk));
    $params[$o->getName()] = $o->getData();
    ?>
</div>
<div class="item">
    <?php
    $option_name = "return_pages";
    $option_desc = "Return pages?";
    $o = new wpdreamsYesNo($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk));
    $params[$o->getName()] = $o->getData();
    ?>
</div>
<div class="item">
    <?php
    $option_name = "return_customposttypes";
    $option_desc = "Return custom post types?";
    $o = new wpdreamsCustomPostTypes($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk));
    $params[$o->getName()] = $o->getData();
    ?>
</div>


<fieldset>
    <legend>Advanced options</legend>
    <div class="item">
        <?php
        $option_name = "show_content";
        $option_desc = "Show content";
        $o = new wpdreamsCustomSelect($option_name, $option_desc,
            array('selects' => wpdreams_setval_or_getoption($_so, $option_name . '_def', $_dk),
                'value' => wpdreams_setval_or_getoption($_so, $option_name, $_dk))
        );
        $params[$o->getName()] = $o->getData();
        ?>
    </div>
    <div class="item">
        <?php
        $option_name = "content_max_length";
        $option_desc = "Content max length (characters)";
        $o = new wpdreamsTextSmall($option_name, $option_desc,
            wpdreams_setval_or_getoption($_so, $option_name, $_dk));
        $params[$o->getName()] = $o->getData();
        ?>
    </div>
    <div class="item">
        <?php
        $option_name = "show_date";
        $option_desc = "Show the date?";
        $o = new wpdreamsYesNo($option_name, $option_desc,
            wpdreams_setval_or_getoption($_so, $option_name, $_dk));
        $params[$o->getName()] = $o->getData();
        ?>
    </div>
    <div class="item">
        <?php
        $option_name = "date_format";
        $option_desc = "Date format";
        $o = new wpdreamsText($option_name, $option_desc,
            wpdreams_setval_or_getoption($_so, $option_name, $_dk));
        $params[$o->getName()] = $o->getData();
        ?>
        <p class='descMsg'>Default <b>Y-m-d H:i:s</b></p>
    </div>
    <div class="item">
        <?php
        $option_name = "show_author";
        $option_desc = "Show the author?";
        $o = new wpdreamsYesNo($option_name, $option_desc,
            wpdreams_setval_or_getoption($_so, $option_name, $_dk));
        $params[$o->getName()] = $o->getData();
        ?>
    </div>
</fieldset>

<div class="item">
    <input type="hidden" name='rpl_submit' value=1 />
    <input name="submit_rpl" type="submit" value="Save all tabs!" />
</div>