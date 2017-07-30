<?php

namespace Ypk\Models;

class ContractCostlog extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $clog_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $clog_itemid;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $clog_itemname;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $clog_storeid;

    /**
     *
     * @var string
     * @Column(type="string", length=500, nullable=false)
     */
    protected $clog_storename;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $clog_adminid;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=true)
     */
    protected $clog_adminname;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $clog_price;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $clog_addtime;

    /**
     *
     * @var string
     * @Column(type="string", length=2000, nullable=false)
     */
    protected $clog_desc;

    /**
     * Method to set the value of field clog_id
     *
     * @param integer $clog_id
     * @return $this
     */
    public function setClogId($clog_id)
    {
        $this->clog_id = $clog_id;

        return $this;
    }

    /**
     * Method to set the value of field clog_itemid
     *
     * @param integer $clog_itemid
     * @return $this
     */
    public function setClogItemid($clog_itemid)
    {
        $this->clog_itemid = $clog_itemid;

        return $this;
    }

    /**
     * Method to set the value of field clog_itemname
     *
     * @param string $clog_itemname
     * @return $this
     */
    public function setClogItemname($clog_itemname)
    {
        $this->clog_itemname = $clog_itemname;

        return $this;
    }

    /**
     * Method to set the value of field clog_storeid
     *
     * @param integer $clog_storeid
     * @return $this
     */
    public function setClogStoreid($clog_storeid)
    {
        $this->clog_storeid = $clog_storeid;

        return $this;
    }

    /**
     * Method to set the value of field clog_storename
     *
     * @param string $clog_storename
     * @return $this
     */
    public function setClogStorename($clog_storename)
    {
        $this->clog_storename = $clog_storename;

        return $this;
    }

    /**
     * Method to set the value of field clog_adminid
     *
     * @param integer $clog_adminid
     * @return $this
     */
    public function setClogAdminid($clog_adminid)
    {
        $this->clog_adminid = $clog_adminid;

        return $this;
    }

    /**
     * Method to set the value of field clog_adminname
     *
     * @param string $clog_adminname
     * @return $this
     */
    public function setClogAdminname($clog_adminname)
    {
        $this->clog_adminname = $clog_adminname;

        return $this;
    }

    /**
     * Method to set the value of field clog_price
     *
     * @param double $clog_price
     * @return $this
     */
    public function setClogPrice($clog_price)
    {
        $this->clog_price = $clog_price;

        return $this;
    }

    /**
     * Method to set the value of field clog_addtime
     *
     * @param integer $clog_addtime
     * @return $this
     */
    public function setClogAddtime($clog_addtime)
    {
        $this->clog_addtime = $clog_addtime;

        return $this;
    }

    /**
     * Method to set the value of field clog_desc
     *
     * @param string $clog_desc
     * @return $this
     */
    public function setClogDesc($clog_desc)
    {
        $this->clog_desc = $clog_desc;

        return $this;
    }

    /**
     * Returns the value of field clog_id
     *
     * @return integer
     */
    public function getClogId()
    {
        return $this->clog_id;
    }

    /**
     * Returns the value of field clog_itemid
     *
     * @return integer
     */
    public function getClogItemid()
    {
        return $this->clog_itemid;
    }

    /**
     * Returns the value of field clog_itemname
     *
     * @return string
     */
    public function getClogItemname()
    {
        return $this->clog_itemname;
    }

    /**
     * Returns the value of field clog_storeid
     *
     * @return integer
     */
    public function getClogStoreid()
    {
        return $this->clog_storeid;
    }

    /**
     * Returns the value of field clog_storename
     *
     * @return string
     */
    public function getClogStorename()
    {
        return $this->clog_storename;
    }

    /**
     * Returns the value of field clog_adminid
     *
     * @return integer
     */
    public function getClogAdminid()
    {
        return $this->clog_adminid;
    }

    /**
     * Returns the value of field clog_adminname
     *
     * @return string
     */
    public function getClogAdminname()
    {
        return $this->clog_adminname;
    }

    /**
     * Returns the value of field clog_price
     *
     * @return double
     */
    public function getClogPrice()
    {
        return $this->clog_price;
    }

    /**
     * Returns the value of field clog_addtime
     *
     * @return integer
     */
    public function getClogAddtime()
    {
        return $this->clog_addtime;
    }

    /**
     * Returns the value of field clog_desc
     *
     * @return string
     */
    public function getClogDesc()
    {
        return $this->clog_desc;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'contract_costlog';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ContractCostlog[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ContractCostlog
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
