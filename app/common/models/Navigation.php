<?php

namespace Ypk\Models;

class Navigation extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $nav_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $nav_type;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $nav_title;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $nav_url;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $nav_location;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $nav_new_open;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $nav_sort;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $item_id;

    /**
     * Method to set the value of field nav_id
     *
     * @param integer $nav_id
     * @return $this
     */
    public function setNavId($nav_id)
    {
        $this->nav_id = $nav_id;

        return $this;
    }

    /**
     * Method to set the value of field nav_type
     *
     * @param integer $nav_type
     * @return $this
     */
    public function setNavType($nav_type)
    {
        $this->nav_type = $nav_type;

        return $this;
    }

    /**
     * Method to set the value of field nav_title
     *
     * @param string $nav_title
     * @return $this
     */
    public function setNavTitle($nav_title)
    {
        $this->nav_title = $nav_title;

        return $this;
    }

    /**
     * Method to set the value of field nav_url
     *
     * @param string $nav_url
     * @return $this
     */
    public function setNavUrl($nav_url)
    {
        $this->nav_url = $nav_url;

        return $this;
    }

    /**
     * Method to set the value of field nav_location
     *
     * @param integer $nav_location
     * @return $this
     */
    public function setNavLocation($nav_location)
    {
        $this->nav_location = $nav_location;

        return $this;
    }

    /**
     * Method to set the value of field nav_new_open
     *
     * @param integer $nav_new_open
     * @return $this
     */
    public function setNavNewOpen($nav_new_open)
    {
        $this->nav_new_open = $nav_new_open;

        return $this;
    }

    /**
     * Method to set the value of field nav_sort
     *
     * @param integer $nav_sort
     * @return $this
     */
    public function setNavSort($nav_sort)
    {
        $this->nav_sort = $nav_sort;

        return $this;
    }

    /**
     * Method to set the value of field item_id
     *
     * @param integer $item_id
     * @return $this
     */
    public function setItemId($item_id)
    {
        $this->item_id = $item_id;

        return $this;
    }

    /**
     * Returns the value of field nav_id
     *
     * @return integer
     */
    public function getNavId()
    {
        return $this->nav_id;
    }

    /**
     * Returns the value of field nav_type
     *
     * @return integer
     */
    public function getNavType()
    {
        return $this->nav_type;
    }

    /**
     * Returns the value of field nav_title
     *
     * @return string
     */
    public function getNavTitle()
    {
        return $this->nav_title;
    }

    /**
     * Returns the value of field nav_url
     *
     * @return string
     */
    public function getNavUrl()
    {
        return $this->nav_url;
    }

    /**
     * Returns the value of field nav_location
     *
     * @return integer
     */
    public function getNavLocation()
    {
        return $this->nav_location;
    }

    /**
     * Returns the value of field nav_new_open
     *
     * @return integer
     */
    public function getNavNewOpen()
    {
        return $this->nav_new_open;
    }

    /**
     * Returns the value of field nav_sort
     *
     * @return integer
     */
    public function getNavSort()
    {
        return $this->nav_sort;
    }

    /**
     * Returns the value of field item_id
     *
     * @return integer
     */
    public function getItemId()
    {
        return $this->item_id;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'navigation';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Navigation[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Navigation
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
