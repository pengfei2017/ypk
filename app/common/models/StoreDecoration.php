<?php

namespace Ypk\Models;

class StoreDecoration extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $decoration_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $decoration_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $store_id;

    /**
     *
     * @var string
     * @Column(type="string", length=500, nullable=true)
     */
    protected $decoration_setting;

    /**
     *
     * @var string
     * @Column(type="string", length=5000, nullable=true)
     */
    protected $decoration_nav;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $decoration_banner;

    /**
     * Method to set the value of field decoration_id
     *
     * @param integer $decoration_id
     * @return $this
     */
    public function setDecorationId($decoration_id)
    {
        $this->decoration_id = $decoration_id;

        return $this;
    }

    /**
     * Method to set the value of field decoration_name
     *
     * @param string $decoration_name
     * @return $this
     */
    public function setDecorationName($decoration_name)
    {
        $this->decoration_name = $decoration_name;

        return $this;
    }

    /**
     * Method to set the value of field store_id
     *
     * @param integer $store_id
     * @return $this
     */
    public function setStoreId($store_id)
    {
        $this->store_id = $store_id;

        return $this;
    }

    /**
     * Method to set the value of field decoration_setting
     *
     * @param string $decoration_setting
     * @return $this
     */
    public function setDecorationSetting($decoration_setting)
    {
        $this->decoration_setting = $decoration_setting;

        return $this;
    }

    /**
     * Method to set the value of field decoration_nav
     *
     * @param string $decoration_nav
     * @return $this
     */
    public function setDecorationNav($decoration_nav)
    {
        $this->decoration_nav = $decoration_nav;

        return $this;
    }

    /**
     * Method to set the value of field decoration_banner
     *
     * @param string $decoration_banner
     * @return $this
     */
    public function setDecorationBanner($decoration_banner)
    {
        $this->decoration_banner = $decoration_banner;

        return $this;
    }

    /**
     * Returns the value of field decoration_id
     *
     * @return integer
     */
    public function getDecorationId()
    {
        return $this->decoration_id;
    }

    /**
     * Returns the value of field decoration_name
     *
     * @return string
     */
    public function getDecorationName()
    {
        return $this->decoration_name;
    }

    /**
     * Returns the value of field store_id
     *
     * @return integer
     */
    public function getStoreId()
    {
        return $this->store_id;
    }

    /**
     * Returns the value of field decoration_setting
     *
     * @return string
     */
    public function getDecorationSetting()
    {
        return $this->decoration_setting;
    }

    /**
     * Returns the value of field decoration_nav
     *
     * @return string
     */
    public function getDecorationNav()
    {
        return $this->decoration_nav;
    }

    /**
     * Returns the value of field decoration_banner
     *
     * @return string
     */
    public function getDecorationBanner()
    {
        return $this->decoration_banner;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'store_decoration';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreDecoration[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreDecoration
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
