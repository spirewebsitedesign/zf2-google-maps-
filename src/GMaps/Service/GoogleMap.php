<?php

namespace GMaps\Service;

/**
 * GMaps\Service\GoogleMap
 *
 * Zend Framework2 Google Map Class  (Google Maps API v3)
 *
 * An open source application development framework for PHP 5.1.6 or newer
 * 
 * This class enables the creation of google maps
 *
 * @package		Zend Framework 2
 * @author		Ramkumar 
 */
 
class GoogleMap {

    var $api_key = '';
    var $sensor = 'false';
    var $div_id = '';
    var $div_class = '';
    var $zoom = 10;
    var $lat = -300;
    var $lon = 300;
    var $markers;
    var $height = "100px";
    var $width = "100px";
    var $animation = '';
    var $icon = '';

    public function __construct($api_key = "") {
        $this->api_key = $api_key;
        $this->markers = array();
    }

    // --------------------------------------------------------------------

    /**
     * Initialize the user preferences
     *
     * Accepts an associative array as input, containing display preferences
     *
     * @access	public
     * @param	array	config preferences
     * @return	void
     */
    function initialize($config = array()) {
        foreach ($config as $key => $val) {
            if (isset($this->$key)) {
                $this->$key = $val;
            }
        }
    }

    // --------------------------------------------------------------------

    /**
     * Generate the google map
     *
     * @access	public
     * @return	string
     */
    function generate() {

        $out = '';

        $out .= '	<div id="' . $this->div_id . '" class="' . $this->div_class . '" style="height:' . $this->height . ';width:' . $this->width . ';"></div>';

        $out .= '	<script type="text/javascript" src="//maps.googleapis.com/maps/api/js';

        if($this->api_key) $out.= '?key=' . $this->api_key . '&sensor=' . $this->sensor . '"></script>';

        else $out.= '?sensor=' . $this->sensor . '"></script>';

        $out .= '	<script type="text/javascript"> 

    	                var infoWindow =  new google.maps.InfoWindow({size: new google.maps.Size(150,50)});

						function doAnimation() 
						{
							if (marker.getAnimation() != null) 
							{
								marker.setAnimation(null); 
							} 
							else 
							{
								marker.setAnimation(google.maps.Animation.' . $this->animation . ');
							}
						}
		
    					function initialize() 
    					{
    						
    						var myOptions = {
    							center: new google.maps.LatLng(' . $this->lat . ',' . $this->lon . '), 
    							Zoom:' . $this->zoom . ', 
    							mapTypeId: google.maps.MapTypeId.ROADMAP 
							};';


        $out .= '			var map = new google.maps.Map(document.getElementById("' . $this->div_id . '"), myOptions);';

        $i = 0;
        foreach ($this->markers as $marker) {
            $out .="var marker" . $i . " = new google.maps.Marker({
                                                position: new google.maps.LatLng(" . $marker->getLatLng() . "),
                                                map: map,";
            if ($this->animation != '') {
                $out .="animation: google.maps.Animation." . $this->animation . ",";
            }
            if ($marker->getIcon() != '') {
                $out .="icon:'" . $marker->getIcon() . "',";
            }
            $out .="title:'" . $marker->getTitle() . "'});";
            if ($marker->getInfoWindow()) {
                $out .="google.maps.event.addListener(marker" . $i . ", 'click',  function() {
	                        infoWindow.setContent('". $marker->getInfoWindow() . "');
	                        infoWindow.open(map,marker" . $i . ");
                        });";
            }

            $i++;
        }

        $out .= '		} 
						
						initialize();
					
					</script>';

        return $out;
    }

}