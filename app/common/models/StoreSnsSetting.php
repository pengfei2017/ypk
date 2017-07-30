<?php

namespace Ypk\Models;

class StoreSnsSetting extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $sauto_storeid;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $sauto_new;

    /**
     *
     * @var string
     * @Column(type="string", length=150, nullable=true)
     */
    protected $sauto_newtitle;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $sauto_coupon;

    /**
     *
     * @var string
     * @Column(type="string", length=150, nullable=true)
     */
    protected $sauto_coupontitle;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $sauto_xianshi;

    /**
     *
     * @var string
     * @Column(type="string", length=150, nullable=true)
     */
    protected $sauto_xianshititle;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $sauto_mansong;

    /**
     *
     * @var string
     * @Column(type="string", length=150, nullable=true)
     */
    protected $sauto_mansongtitle;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $sauto_bundling;

    /**
     *
     * @var string
     * @Column(type="string", length=150, nullable=true)
     */
    protected $sauto_bundlingtitle;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $sauto_groupbuy;

    /**
     *
     * @var string
     * @Column(type="string", length=150, nullable=true)
     */
    protected $sauto_groupbuytitle;

    /**
     * Method to set the value of field sauto_storeid
     *
     * @param integer $sauto_storeid
     * @return $this
     */
    public function setSautoStoreid($sauto_storeid)
    {
        $this->sauto_storeid = $sauto_storeid;

        return $this;
    }

    /**
     * Method to set the value of field sauto_new
     *
     * @param integer $sauto_new
     * @return $this
     */
    public function setSautoNew($sauto_new)
    {
        $this->sauto_new = $sauto_new;

        return $this;
    }

    /**
     * Method to set the value of field sauto_newtitle
     *
     * @param string $sauto_newtitle
     * @return $this
     */
    public function setSautoNewtitle($sauto_newtitle)
    {
        $this->sauto_newtitle = $sauto_newtitle;

        return $this;
    }

    /**
     * Method to set the value of field sauto_coupon
     *
     * @param integer $sauto_coupon
     * @return $this
     */
    public function setSautoCoupon($sauto_coupon)
    {
        $this->sauto_coupon = $sauto_coupon;

        return $this;
    }

    /**
     * Method to set the value of field sauto_coupontitle
     *
     * @param string $sauto_coupontitle
     * @return $this
     */
    public function setSautoCoupontitle($sauto_coupontitle)
    {
        $this->sauto_coupontitle = $sauto_coupontitle;

        return $this;
    }

    /**
     * Method to set the value of field sauto_xianshi
     *
     * @param integer $sauto_xianshi
     * @return $this
     */
    public function setSautoXianshi($sauto_xianshi)
    {
        $this->sauto_xianshi = $sauto_xianshi;

        return $this;
    }

    /**
     * Method to set the value of field sauto_xianshititle
     *
     * @param string $sauto_xianshititle
     * @return $this
     */
    public function setSautoXianshititle($sauto_xianshititle)
    {
        $this->sauto_xianshititle = $sauto_xianshititle;

        return $this;
    }

    /**
     * Method to set the value of field sauto_mansong
     *
     * @param integer $sauto_mansong
     * @return $this
     */
    public function setSautoMansong($sauto_mansong)
    {
        $this->sauto_mansong = $sauto_mansong;

        return $this;
    }

    /**
     * Method to set the value of field sauto_mansongtitle
     *
     * @param string $sauto_mansongtitle
     * @return $this
     */
    public function setSautoMansongtitle($sauto_mansongtitle)
    {
        $this->sauto_mansongtitle = $sauto_mansongtitle;

        return $this;
    }

    /**
     * Method to set the value of field sauto_bundling
     *
     * @param integer $sauto_bundling
     * @return $this
     */
    public function setSautoBundling($sauto_bundling)
    {
        $this->sauto_bundling = $sauto_bundling;

        return $this;
    }

    /**
     * Method to set the value of field sauto_bundlingtitle
     *
     * @param string $sauto_bundlingtitle
     * @return $this
     */
    public function setSautoBundlingtitle($sauto_bundlingtitle)
    {
        $this->sauto_bundlingtitle = $sauto_bundlingtitle;

        return $this;
    }

    /**
     * Method to set the value of field sauto_groupbuy
     *
     * @param integer $sauto_groupbuy
     * @return $this
     */
    public function setSautoGroupbuy($sauto_groupbuy)
    {
        $this->sauto_groupbuy = $sauto_groupbuy;

        return $this;
    }

    /**
     * Method to set the value of field sauto_groupbuytitle
     *
     * @param string $sauto_groupbuytitle
     * @return $this
     */
    public function setSautoGroupbuytitle($sauto_groupbuytitle)
    {
        $this->sauto_groupbuytitle = $sauto_groupbuytitle;

        return $this;
    }

    /**
     * Returns the value of field sauto_storeid
     *
     * @return integer
     */
    public function getSautoStoreid()
    {
        return $this->sauto_storeid;
    }

    /**
     * Returns the value of field sauto_new
     *
     * @return integer
     */
    public function getSautoNew()
    {
        return $this->sauto_new;
    }

    /**
     * Returns the value of field sauto_newtitle
     *
     * @return string
     */
    public function getSautoNewtitle()
    {
        return $this->sauto_newtitle;
    }

    /**
     * Returns the value of field sauto_coupon
     *
     * @return integer
     */
    public function getSautoCoupon()
    {
        return $this->sauto_coupon;
    }

    /**
     * Returns the value of field sauto_coupontitle
     *
     * @return string
     */
    public function getSautoCoupontitle()
    {
        return $this->sauto_coupontitle;
    }

    /**
     * Returns the value of field sauto_xianshi
     *
     * @return integer
     */
    public function getSautoXianshi()
    {
        return $this->sauto_xianshi;
    }

    /**
     * Returns the value of field sauto_xianshititle
     *
     * @return string
     */
    public function getSautoXianshititle()
    {
        return $this->sauto_xianshititle;
    }

    /**
     * Returns the value of field sauto_mansong
     *
     * @return integer
     */
    public function getSautoMansong()
    {
        return $this->sauto_mansong;
    }

    /**
     * Returns the value of field sauto_mansongtitle
     *
     * @return string
     */
    public function getSautoMansongtitle()
    {
        return $this->sauto_mansongtitle;
    }

    /**
     * Returns the value of field sauto_bundling
     *
     * @return integer
     */
    public function getSautoBundling()
    {
        return $this->sauto_bundling;
    }

    /**
     * Returns the value of field sauto_bundlingtitle
     *
     * @return string
     */
    public function getSautoBundlingtitle()
    {
        return $this->sauto_bundlingtitle;
    }

    /**
     * Returns the value of field sauto_groupbuy
     *
     * @return integer
     */
    public function getSautoGroupbuy()
    {
        return $this->sauto_groupbuy;
    }

    /**
     * Returns the value of field sauto_groupbuytitle
     *
     * @return string
     */
    public function getSautoGroupbuytitle()
    {
        return $this->sauto_groupbuytitle;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'store_sns_setting';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreSnsSetting[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreSnsSetting
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
