<?php

namespace GMaps\Model;

/**
 * GMaps\Model\Marker
 *
 * Class to represent a Google Map Marker 
 * 
 * This class enables a Google Map Info Window and Icons for each Marker.
 *
 * @package		Zend Framework 2
 * @author		Arthur Dean 
 */
class Marker {
    protected $lat;
    protected $lng;
    protected $icon;
    protected $title;
    protected $infoWindow;

    public function getLatLng()
    {
        return "{$this->lat},{$this->lng}";
    }
    /**
     * @param mixed $icon
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

    /**
     * @return mixed
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @return $this
     * @param mixed $infoWindow
     */
    public function setInfoWindow($infoWindow)
    {
        $this->infoWindow = $infoWindow;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getInfoWindow()
    {
        return $this->infoWindow;
    }

    /**
     * @return $this
     * @param mixed $lat
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @return $this
     * @param mixed $lng
     */
    public function setLng($lng)
    {
        $this->lng = $lng;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * @return $this
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

}