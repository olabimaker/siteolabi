<fieldset>
  <legend>Content options</legend>
  <div class="item">
    <?php
    $option_name = "look_in_title";
    $option_desc = "Look in title?";
    $o = new wpdreamsYesNo($option_name, $option_desc, 
         wpdreams_setval_or_getoption($_so, $option_name, $_dk));
    $params[$o->getName()] = $o->getData();
    ?>
  </div>
  <div class="item">
    <?php
    $option_name = "look_in_content";
    $option_desc = "Look in content?";
    $o = new wpdreamsYesNo($option_name, $option_desc, 
         wpdreams_setval_or_getoption($_so, $option_name, $_dk));
    $params[$o->getName()] = $o->getData();
    ?>
  </div> 
  <div class="item">
    <?php
    $option_name = "look_in_excerpt";
    $option_desc = "Look in excerpt?";
    $o = new wpdreamsYesNo($option_name, $option_desc, 
         wpdreams_setval_or_getoption($_so, $option_name, $_dk));
    $params[$o->getName()] = $o->getData();
    ?>
  </div> 
  <div class="item">
    <?php
    $option_name = "look_in_customfields";
    $option_desc = "Look in custom fields?";
    $o = new wpdreamsCustomFields($option_name, $option_desc, 
             wpdreams_setval_or_getoption($_so, $option_name, $_dk));
    $params[$o->getName()] = $o->getData();
    $params['selected-'.$o->getName()] = $o->getSelected();
    ?>
  </div>
  <div class="item">
    <?php
    $option_name = "exclusive_lookup";
    $option_desc = "Keep each field exclusive?";
    $o = new wpdreamsYesNo($option_name, $option_desc, 
             wpdreams_setval_or_getoption($_so, $option_name, $_dk));
    $params[$o->getName()] = $o->getData();
    ?>
    <p class='descMsg'>Exclusive fields mean, that only the corresponding fields
    are compared. Title vs. title, content vs content etc...</p>
  </div>       
</fieldset>

<div class="item">
    <input type="hidden" name='rpl_submit' value=1 />
    <input name="submit_rpl" type="submit" value="Save all tabs!" />
</div>