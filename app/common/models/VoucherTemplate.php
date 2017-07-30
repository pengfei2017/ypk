<?php

namespace Ypk\Models;

class VoucherTemplate extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $voucher_t_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $voucher_t_title;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $voucher_t_desc;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $voucher_t_start_date;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $voucher_t_end_date;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $voucher_t_price;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $voucher_t_limit;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $voucher_t_store_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $voucher_t_storename;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $voucher_t_sc_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $voucher_t_creator_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $voucher_t_state;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $voucher_t_total;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $voucher_t_giveout;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $voucher_t_used;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $voucher_t_add_date;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $voucher_t_quotaid;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $voucher_t_points;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $voucher_t_eachlimit;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=true)
     */
    protected $voucher_t_styleimg;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=true)
     */
    protected $voucher_t_customimg;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $voucher_t_recommend;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $voucher_t_gettype;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $voucher_t_isbuild;

    /**
     *
     * @var integer
     * @Column(type="integer", length=2, nullable=false)
     */
    protected $voucher_t_mgradelimit;

    /**
     * Method to set the value of field voucher_t_id
     *
     * @param integer $voucher_t_id
     * @return $this
     */
    public function setVoucherTId($voucher_t_id)
    {
        $this->voucher_t_id = $voucher_t_id;

        return $this;
    }

    /**
     * Method to set the value of field voucher_t_title
     *
     * @param string $voucher_t_title
     * @return $this
     */
    public function setVoucherTTitle($voucher_t_title)
    {
        $this->voucher_t_title = $voucher_t_title;

        return $this;
    }

    /**
     * Method to set the value of field voucher_t_desc
     *
     * @param string $voucher_t_desc
     * @return $this
     */
    public function setVoucherTDesc($voucher_t_desc)
    {
        $this->voucher_t_desc = $voucher_t_desc;

        return $this;
    }

    /**
     * Method to set the value of field voucher_t_start_date
     *
     * @param integer $voucher_t_start_date
     * @return $this
     */
    public function setVoucherTStartDate($voucher_t_start_date)
    {
        $this->voucher_t_start_date = $voucher_t_start_date;

        return $this;
    }

    /**
     * Method to set the value of field voucher_t_end_date
     *
     * @param integer $voucher_t_end_date
     * @return $this
     */
    public function setVoucherTEndDate($voucher_t_end_date)
    {
        $this->voucher_t_end_date = $voucher_t_end_date;

        return $this;
    }

    /**
     * Method to set the value of field voucher_t_price
     *
     * @param integer $voucher_t_price
     * @return $this
     */
    public function setVoucherTPrice($voucher_t_price)
    {
        $this->voucher_t_price = $voucher_t_price;

        return $this;
    }

    /**
     * Method to set the value of field voucher_t_limit
     *
     * @param double $voucher_t_limit
     * @return $this
     */
    public function setVoucherTLimit($voucher_t_limit)
    {
        $this->voucher_t_limit = $voucher_t_limit;

        return $this;
    }

    /**
     * Method to set the value of field voucher_t_store_id
     *
     * @param integer $voucher_t_store_id
     * @return $this
     */
    public function setVoucherTStoreId($voucher_t_store_id)
    {
        $this->voucher_t_store_id = $voucher_t_store_id;

        return $this;
    }

    /**
     * Method to set the value of field voucher_t_storename
     *
     * @param string $voucher_t_storename
     * @return $this
     */
    public function setVoucherTStorename($voucher_t_storename)
    {
        $this->voucher_t_storename = $voucher_t_storename;

        return $this;
    }

    /**
     * Method to set the value of field voucher_t_sc_id
     *
     * @param integer $voucher_t_sc_id
     * @return $this
     */
    public function setVoucherTScId($voucher_t_sc_id)
    {
        $this->voucher_t_sc_id = $voucher_t_sc_id;

        return $this;
    }

    /**
     * Method to set the value of field voucher_t_creator_id
     *
     * @param integer $voucher_t_creator_id
     * @return $this
     */
    public function setVoucherTCreatorId($voucher_t_creator_id)
    {
        $this->voucher_t_creator_id = $voucher_t_creator_id;

        return $this;
    }

    /**
     * Method to set the value of field voucher_t_state
     *
     * @param integer $voucher_t_state
     * @return $this
     */
    public function setVoucherTState($voucher_t_state)
    {
        $this->voucher_t_state = $voucher_t_state;

        return $this;
    }

    /**
     * Method to set the value of field voucher_t_total
     *
     * @param integer $voucher_t_total
     * @return $this
     */
    public function setVoucherTTotal($voucher_t_total)
    {
        $this->voucher_t_total = $voucher_t_total;

        return $this;
    }

    /**
     * Method to set the value of field voucher_t_giveout
     *
     * @param integer $voucher_t_giveout
     * @return $this
     */
    public function setVoucherTGiveout($voucher_t_giveout)
    {
        $this->voucher_t_giveout = $voucher_t_giveout;

        return $this;
    }

    /**
     * Method to set the value of field voucher_t_used
     *
     * @param integer $voucher_t_used
     * @return $this
     */
    public function setVoucherTUsed($voucher_t_used)
    {
        $this->voucher_t_used = $voucher_t_used;

        return $this;
    }

    /**
     * Method to set the value of field voucher_t_add_date
     *
     * @param integer $voucher_t_add_date
     * @return $this
     */
    public function setVoucherTAddDate($voucher_t_add_date)
    {
        $this->voucher_t_add_date = $voucher_t_add_date;

        return $this;
    }

    /**
     * Method to set the value of field voucher_t_quotaid
     *
     * @param integer $voucher_t_quotaid
     * @return $this
     */
    public function setVoucherTQuotaid($voucher_t_quotaid)
    {
        $this->voucher_t_quotaid = $voucher_t_quotaid;

        return $this;
    }

    /**
     * Method to set the value of field voucher_t_points
     *
     * @param integer $voucher_t_points
     * @return $this
     */
    public function setVoucherTPoints($voucher_t_points)
    {
        $this->voucher_t_points = $voucher_t_points;

        return $this;
    }

    /**
     * Method to set the value of field voucher_t_eachlimit
     *
     * @param integer $voucher_t_eachlimit
     * @return $this
     */
    public function setVoucherTEachlimit($voucher_t_eachlimit)
    {
        $this->voucher_t_eachlimit = $voucher_t_eachlimit;

        return $this;
    }

    /**
     * Method to set the value of field voucher_t_styleimg
     *
     * @param string $voucher_t_styleimg
     * @return $this
     */
    public function setVoucherTStyleimg($voucher_t_styleimg)
    {
        $this->voucher_t_styleimg = $voucher_t_styleimg;

        return $this;
    }

    /**
     * Method to set the value of field voucher_t_customimg
     *
     * @param string $voucher_t_customimg
     * @return $this
     */
    public function setVoucherTCustomimg($voucher_t_customimg)
    {
        $this->voucher_t_customimg = $voucher_t_customimg;

        return $this;
    }

    /**
     * Method to set the value of field voucher_t_recommend
     *
     * @param integer $voucher_t_recommend
     * @return $this
     */
    public function setVoucherTRecommend($voucher_t_recommend)
    {
        $this->voucher_t_recommend = $voucher_t_recommend;

        return $this;
    }

    /**
     * Method to set the value of field voucher_t_gettype
     *
     * @param integer $voucher_t_gettype
     * @return $this
     */
    public function setVoucherTGettype($voucher_t_gettype)
    {
        $this->voucher_t_gettype = $voucher_t_gettype;

        return $this;
    }

    /**
     * Method to set the value of field voucher_t_isbuild
     *
     * @param integer $voucher_t_isbuild
     * @return $this
     */
    public function setVoucherTIsbuild($voucher_t_isbuild)
    {
        $this->voucher_t_isbuild = $voucher_t_isbuild;

        return $this;
    }

    /**
     * Method to set the value of field voucher_t_mgradelimit
     *
     * @param integer $voucher_t_mgradelimit
     * @return $this
     */
    public function setVoucherTMgradelimit($voucher_t_mgradelimit)
    {
        $this->voucher_t_mgradelimit = $voucher_t_mgradelimit;

        return $this;
    }

    /**
     * Returns the value of field voucher_t_id
     *
     * @return integer
     */
    public function getVoucherTId()
    {
        return $this->voucher_t_id;
    }

    /**
     * Returns the value of field voucher_t_title
     *
     * @return string
     */
    public function getVoucherTTitle()
    {
        return $this->voucher_t_title;
    }

    /**
     * Returns the value of field voucher_t_desc
     *
     * @return string
     */
    public function getVoucherTDesc()
    {
        return $this->voucher_t_desc;
    }

    /**
     * Returns the value of field voucher_t_start_date
     *
     * @return integer
     */
    public function getVoucherTStartDate()
    {
        return $this->voucher_t_start_date;
    }

    /**
     * Returns the value of field voucher_t_end_date
     *
     * @return integer
     */
    public function getVoucherTEndDate()
    {
        return $this->voucher_t_end_date;
    }

    /**
     * Returns the value of field voucher_t_price
     *
     * @return integer
     */
    public function getVoucherTPrice()
    {
        return $this->voucher_t_price;
    }

    /**
     * Returns the value of field voucher_t_limit
     *
     * @return double
     */
    public function getVoucherTLimit()
    {
        return $this->voucher_t_limit;
    }

    /**
     * Returns the value of field voucher_t_store_id
     *
     * @return integer
     */
    public function getVoucherTStoreId()
    {
        return $this->voucher_t_store_id;
    }

    /**
     * Returns the value of field voucher_t_storename
     *
     * @return string
     */
    public function getVoucherTStorename()
    {
        return $this->voucher_t_storename;
    }

    /**
     * Returns the value of field voucher_t_sc_id
     *
     * @return integer
     */
    public function getVoucherTScId()
    {
        return $this->voucher_t_sc_id;
    }

    /**
     * Returns the value of field voucher_t_creator_id
     *
     * @return integer
     */
    public function getVoucherTCreatorId()
    {
        return $this->voucher_t_creator_id;
    }

    /**
     * Returns the value of field voucher_t_state
     *
     * @return integer
     */
    public function getVoucherTState()
    {
        return $this->voucher_t_state;
    }

    /**
     * Returns the value of field voucher_t_total
     *
     * @return integer
     */
    public function getVoucherTTotal()
    {
        return $this->voucher_t_total;
    }

    /**
     * Returns the value of field voucher_t_giveout
     *
     * @return integer
     */
    public function getVoucherTGiveout()
    {
        return $this->voucher_t_giveout;
    }

    /**
     * Returns the value of field voucher_t_used
     *
     * @return integer
     */
    public function getVoucherTUsed()
    {
        return $this->voucher_t_used;
    }

    /**
     * Returns the value of field voucher_t_add_date
     *
     * @return integer
     */
    public function getVoucherTAddDate()
    {
        return $this->voucher_t_add_date;
    }

    /**
     * Returns the value of field voucher_t_quotaid
     *
     * @return integer
     */
    public function getVoucherTQuotaid()
    {
        return $this->voucher_t_quotaid;
    }

    /**
     * Returns the value of field voucher_t_points
     *
     * @return integer
     */
    public function getVoucherTPoints()
    {
        return $this->voucher_t_points;
    }

    /**
     * Returns the value of field voucher_t_eachlimit
     *
     * @return integer
     */
    public function getVoucherTEachlimit()
    {
        return $this->voucher_t_eachlimit;
    }

    /**
     * Returns the value of field voucher_t_styleimg
     *
     * @return string
     */
    public function getVoucherTStyleimg()
    {
        return $this->voucher_t_styleimg;
    }

    /**
     * Returns the value of field voucher_t_customimg
     *
     * @return string
     */
    public function getVoucherTCustomimg()
    {
        return $this->voucher_t_customimg;
    }

    /**
     * Returns the value of field voucher_t_recommend
     *
     * @return integer
     */
    public function getVoucherTRecommend()
    {
        return $this->voucher_t_recommend;
    }

    /**
     * Returns the value of field voucher_t_gettype
     *
     * @return integer
     */
    public function getVoucherTGettype()
    {
        return $this->voucher_t_gettype;
    }

    /**
     * Returns the value of field voucher_t_isbuild
     *
     * @return integer
     */
    public function getVoucherTIsbuild()
    {
        return $this->voucher_t_isbuild;
    }

    /**
     * Returns the value of field voucher_t_mgradelimit
     *
     * @return integer
     */
    public function getVoucherTMgradelimit()
    {
        return $this->voucher_t_mgradelimit;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'voucher_template';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return VoucherTemplate[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return VoucherTemplate
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
