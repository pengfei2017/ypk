<?php

namespace Ypk\Models;

class StoreNavigation extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $sn_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $sn_title;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $sn_store_id;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $sn_content;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $sn_sort;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $sn_if_show;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $sn_add_time;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $sn_url;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $sn_new_open;

    /**
     * Method to set the value of field sn_id
     *
     * @param integer $sn_id
     * @return $this
     */
    public function setSnId($sn_id)
    {
        $this->sn_id = $sn_id;

        return $this;
    }

    /**
     * Method to set the value of field sn_title
     *
     * @param string $sn_title
     * @return $this
     */
    public function setSnTitle($sn_title)
    {
        $this->sn_title = $sn_title;

        return $this;
    }

    /**
     * Method to set the value of field sn_store_id
     *
     * @param integer $sn_store_id
     * @return $this
     */
    public function setSnStoreId($sn_store_id)
    {
        $this->sn_store_id = $sn_store_id;

        return $this;
    }

    /**
     * Method to set the value of field sn_content
     *
     * @param string $sn_content
     * @return $this
     */
    public function setSnContent($sn_content)
    {
        $this->sn_content = $sn_content;

        return $this;
    }

    /**
     * Method to set the value of field sn_sort
     *
     * @param integer $sn_sort
     * @return $this
     */
    public function setSnSort($sn_sort)
    {
        $this->sn_sort = $sn_sort;

        return $this;
    }

    /**
     * Method to set the value of field sn_if_show
     *
     * @param integer $sn_if_show
     * @return $this
     */
    public function setSnIfShow($sn_if_show)
    {
        $this->sn_if_show = $sn_if_show;

        return $this;
    }

    /**
     * Method to set the value of field sn_add_time
     *
     * @param integer $sn_add_time
     * @return $this
     */
    public function setSnAddTime($sn_add_time)
    {
        $this->sn_add_time = $sn_add_time;

        return $this;
    }

    /**
     * Method to set the value of field sn_url
     *
     * @param string $sn_url
     * @return $this
     */
    public function setSnUrl($sn_url)
    {
        $this->sn_url = $sn_url;

        return $this;
    }

    /**
     * Method to set the value of field sn_new_open
     *
     * @param integer $sn_new_open
     * @return $this
     */
    public function setSnNewOpen($sn_new_open)
    {
        $this->sn_new_open = $sn_new_open;

        return $this;
    }

    /**
     * Returns the value of field sn_id
     *
     * @return integer
     */
    public function getSnId()
    {
        return $this->sn_id;
    }

    /**
     * Returns the value of field sn_title
     *
     * @return string
     */
    public function getSnTitle()
    {
        return $this->sn_title;
    }

    /**
     * Returns the value of field sn_store_id
     *
     * @return integer
     */
    public function getSnStoreId()
    {
        return $this->sn_store_id;
    }

    /**
     * Returns the value of field sn_content
     *
     * @return string
     */
    public function getSnContent()
    {
        return $this->sn_content;
    }

    /**
     * Returns the value of field sn_sort
     *
     * @return integer
     */
    public function getSnSort()
    {
        return $this->sn_sort;
    }

    /**
     * Returns the value of field sn_if_show
     *
     * @return integer
     */
    public function getSnIfShow()
    {
        return $this->sn_if_show;
    }

    /**
     * Returns the value of field sn_add_time
     *
     * @return integer
     */
    public function getSnAddTime()
    {
        return $this->sn_add_time;
    }

    /**
     * Returns the value of field sn_url
     *
     * @return string
     */
    public function getSnUrl()
    {
        return $this->sn_url;
    }

    /**
     * Returns the value of field sn_new_open
     *
     * @return integer
     */
    public function getSnNewOpen()
    {
        return $this->sn_new_open;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'store_navigation';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreNavigation[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreNavigation
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
