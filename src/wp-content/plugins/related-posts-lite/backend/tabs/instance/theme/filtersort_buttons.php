<section class="ac-container">
    <div>
        <input id="ac-0" name="accordion-0" type="checkbox"/>
        <label for="ac-0">Caption options</label>
        <article class="ac-auto">
            <div class="item">
                <?php
                $option_name = "sort_caption_font";
                $option_desc = "Sort caption font";
                $o = new wpdreamsFontComplete($option_name, $option_desc,
                    wpdreams_setval_or_getoption($_so, $option_name, $_dk)
                );
                $params[$o->getName()] = $o->getData();
                ?>
            </div>
            <div class="item">
                <?php
                $option_name = "filter_caption_font";
                $option_desc = "Filter caption font";
                $o = new wpdreamsFontComplete($option_name, $option_desc,
                    wpdreams_setval_or_getoption($_so, $option_name, $_dk)
                );
                $params[$o->getName()] = $o->getData();
                ?>
            </div>
        </article>
    </div>
    <div>
        <input id="ac-1" name="accordion-1" type="checkbox"/>
        <label for="ac-1">Filter Button Options</label>
        <article class="ac-auto">
            <div class="item">
                <?php
                $option_name = "filter_button_padding";
                $option_desc = "Sort buttons padding";
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
                $option_name = "filter_button_background";
                $option_desc = "Sort buttons background gradient";
                $o = new wpdreamsGradient($option_name, $option_desc,
                    wpdreams_setval_or_getoption($_so, $option_name, $_dk)
                );
                $params[$o->getName()] = $o->getData();
                ?>
            </div>
            <div class="item">
                <?php
                $option_name = "filter_button_border";
                $option_desc = "Sort buttons border";
                $o = new wpdreamsBorder($option_name, $option_desc,
                    wpdreams_setval_or_getoption($_so, $option_name, $_dk)
                );
                $params[$o->getName()] = $o->getData();
                ?>
            </div>
            <div class="item">
                <?php
                $option_name = "filter_button_shadow";
                $option_desc = "Sort buttons box shadow";
                $o = new wpdreamsBoxShadow($option_name, $option_desc,
                    wpdreams_setval_or_getoption($_so, $option_name, $_dk)
                );
                $params[$o->getName()] = $o->getData();
                ?>
            </div>
            <div class="item">
                <?php
                $option_name = "filter_button_font";
                $option_desc = "Sort buttons text Font";
                $o = new wpdreamsFontComplete($option_name, $option_desc,
                    wpdreams_setval_or_getoption($_so, $option_name, $_dk)
                );
                $params[$o->getName()] = $o->getData();
                ?>
            </div>
        </article>
    </div>
    <div>
        <input id="ac-2" name="accordion-2" type="checkbox"/>
        <label for="ac-2">Filter Dropdown Options</label>
        <article class="ac-auto">
            <div class="item">
                <?php
                $option_name = "filter_dropdown_background";
                $option_desc = "Filter dropdown background color";
                $o = new wpdreamsColorPicker($option_name, $option_desc,
                    wpdreams_setval_or_getoption($_so, $option_name, $_dk)
                );
                $params[$o->getName()] = $o->getData();
                ?>
            </div>
            <div class="item">
                <?php
                $option_name = "filter_dropdown_shadow";
                $option_desc = "Filter dropdown box shadow";
                $o = new wpdreamsBoxShadow($option_name, $option_desc,
                    wpdreams_setval_or_getoption($_so, $option_name, $_dk)
                );
                $params[$o->getName()] = $o->getData();
                ?>
            </div>
            <div class="item">
                <?php
                $option_name = "filter_dropdown_button_background";
                $option_desc = "Filter dropdown buttons background gradient";
                $o = new wpdreamsGradient($option_name, $option_desc,
                    wpdreams_setval_or_getoption($_so, $option_name, $_dk)
                );
                $params[$o->getName()] = $o->getData();
                ?>
            </div>
            <div class="item">
                <?php
                $option_name = "filter_dropdown_button_border";
                $option_desc = "Filter dropdown buttons border";
                $o = new wpdreamsBorder($option_name, $option_desc,
                    wpdreams_setval_or_getoption($_so, $option_name, $_dk)
                );
                $params[$o->getName()] = $o->getData();
                ?>
            </div>
            <div class="item">
                <?php
                $option_name = "filter_dropdown_button_shadow";
                $option_desc = "Filter dropdown buttons box shadow";
                $o = new wpdreamsBoxShadow($option_name, $option_desc,
                    wpdreams_setval_or_getoption($_so, $option_name, $_dk)
                );
                $params[$o->getName()] = $o->getData();
                ?>
            </div>
            <div class="item">
                <?php
                $option_name = "filter_dropdown_button_font";
                $option_desc = "Filter dropdown buttons text Font";
                $o = new wpdreamsFontComplete($option_name, $option_desc,
                    wpdreams_setval_or_getoption($_so, $option_name, $_dk)
                );
                $params[$o->getName()] = $o->getData();
                ?>
            </div>
        </article>
    </div>
    <div>
        <input id="ac-3" name="accordion-3" type="checkbox"/>
        <label for="ac-3">Sort Button Options</label>
        <article class="ac-auto">
            <div class="item">
                <?php
                $option_name = "sort_button_padding";
                $option_desc = "Sort buttons padding";
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
                $option_name = "sort_button_background";
                $option_desc = "Sort buttons background gradient";
                $o = new wpdreamsGradient($option_name, $option_desc,
                    wpdreams_setval_or_getoption($_so, $option_name, $_dk)
                );
                $params[$o->getName()] = $o->getData();
                ?>
            </div>
            <div class="item">
                <?php
                $option_name = "sort_button_border";
                $option_desc = "Sort buttons border";
                $o = new wpdreamsBorder($option_name, $option_desc,
                    wpdreams_setval_or_getoption($_so, $option_name, $_dk)
                );
                $params[$o->getName()] = $o->getData();
                ?>
            </div>
            <div class="item">
                <?php
                $option_name = "sort_button_shadow";
                $option_desc = "Sort buttons box shadow";
                $o = new wpdreamsBoxShadow($option_name, $option_desc,
                    wpdreams_setval_or_getoption($_so, $option_name, $_dk)
                );
                $params[$o->getName()] = $o->getData();
                ?>
            </div>
            <div class="item">
                <?php
                $option_name = "sort_button_arrow_show";
                $option_desc = "Show the arrow?";
                $o = new wpdreamsYesNo($option_name, $option_desc,
                    wpdreams_setval_or_getoption($_so, $option_name, $_dk)
                );
                $params[$o->getName()] = $o->getData();
                ?>
            </div>
            <div class="item">
                <?php
                $option_name = "sort_button_arrow_color";
                $option_desc = "Arrow color";
                $o = new wpdreamsColorPicker($option_name, $option_desc,
                    wpdreams_setval_or_getoption($_so, $option_name, $_dk)
                );
                $params[$o->getName()] = $o->getData();
                ?>
            </div>
            <div class="item">
                <?php
                $option_name = "sort_button_arrow_bg_color";
                $option_desc = "Arrow background color";
                $o = new wpdreamsColorPicker($option_name, $option_desc,
                    wpdreams_setval_or_getoption($_so, $option_name, $_dk)
                );
                $params[$o->getName()] = $o->getData();
                ?>
            </div>
            <div class="item">
                <?php
                $option_name = "sort_button_arrow_bg_shadow";
                $option_desc = "Arrow background shadow";
                $o = new wpdreamsBoxShadow($option_name, $option_desc,
                    wpdreams_setval_or_getoption($_so, $option_name, $_dk)
                );
                $params[$o->getName()] = $o->getData();
                ?>
            </div>
            <div class="item">
                <?php
                $option_name = "sort_button_font";
                $option_desc = "Sort buttons text Font";
                $o = new wpdreamsFontComplete($option_name, $option_desc,
                    wpdreams_setval_or_getoption($_so, $option_name, $_dk)
                );
                $params[$o->getName()] = $o->getData();
                ?>
            </div>
        </article>
    </div>
</section>