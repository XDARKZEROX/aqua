<?php //please do not modify form and input name or id attributes, doing so may result in braking locator.js component ?>
<?php echo Form::open(array('role' => 'form', 'id' => 'loc-form'), array('latitude' => null, 'longitude' => null, 'iso2' => Model_Setting::getValueByKey('default_country'))); ?>
    <div class="input-group">
        <input type="input" name="location" id="form_location" class="form-control" placeholder="Introduce aqui tu ubicacion"
               autofocus="autofocus"/>
    <span class="input-group-btn">
        <button class="btn btn-default search-btn" type="submit" style="border-right:none;"><i class="fa fa-search"></i>
        </button>
        <button class="btn btn-default loc-btn" type="button"><i class="fa fa-crosshairs"></i><span
                style="display:none;"> Obtaining Location</span></button>
    </span>
    </div>
    <!-- multiple geocode result drop down -->
    <div class="dropdown location-dropdown">
        <a role="button" class="hide dropdown-toggle" data-toggle="dropdown"></a>
        <ul class="dropdown-menu" role="menu" aria-labelledby="dlabel">
        </ul>
    </div>
    <input type="hidden" name="cats" id="form_cats" value="" autocomplete="off">
<?php echo Form::close(); ?>