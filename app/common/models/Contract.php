<?php

namespace Ypk\Models;

class Contract extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $ct_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $ct_storeid;

    /**
     *
     * @var string
     * @Column(type="string", length=500, nullable=false)
     */
    protected $ct_storename;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $ct_itemid;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $ct_auditstate;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $ct_joinstate;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $ct_cost;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $ct_closestate;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $ct_quitstate;

    /**
     * Method to set the value of field ct_id
     *
     * @param integer $ct_id
     * @return $this
     */
    public function setCtId($ct_id)
    {
        $this->ct_id = $ct_id;

        return $this;
    }

    /**
     * Method to set the value of field ct_storeid
     *
     * @param integer $ct_storeid
     * @return $this
     */
    public function setCtStoreid($ct_storeid)
    {
        $this->ct_storeid = $ct_storeid;

        return $this;
    }

    /**
     * Method to set the value of field ct_storename
     *
     * @param string $ct_storename
     * @return $this
     */
    public function setCtStorename($ct_storename)
    {
        $this->ct_storename = $ct_storename;

        return $this;
    }

    /**
     * Method to set the value of field ct_itemid
     *
     * @param integer $ct_itemid
     * @return $this
     */
    public function setCtItemid($ct_itemid)
    {
        $this->ct_itemid = $ct_itemid;

        return $this;
    }

    /**
     * Method to set the value of field ct_auditstate
     *
     * @param integer $ct_auditstate
     * @return $this
     */
    public function setCtAuditstate($ct_auditstate)
    {
        $this->ct_auditstate = $ct_auditstate;

        return $this;
    }

    /**
     * Method to set the value of field ct_joinstate
     *
     * @param integer $ct_joinstate
     * @return $this
     */
    public function setCtJoinstate($ct_joinstate)
    {
        $this->ct_joinstate = $ct_joinstate;

        return $this;
    }

    /**
     * Method to set the value of field ct_cost
     *
     * @param double $ct_cost
     * @return $this
     */
    public function setCtCost($ct_cost)
    {
        $this->ct_cost = $ct_cost;

        return $this;
    }

    /**
     * Method to set the value of field ct_closestate
     *
     * @param integer $ct_closestate
     * @return $this
     */
    public function setCtClosestate($ct_closestate)
    {
        $this->ct_closestate = $ct_closestate;

        return $this;
    }

    /**
     * Method to set the value of field ct_quitstate
     *
     * @param integer $ct_quitstate
     * @return $this
     */
    public function setCtQuitstate($ct_quitstate)
    {
        $this->ct_quitstate = $ct_quitstate;

        return $this;
    }

    /**
     * Returns the value of field ct_id
     *
     * @return integer
     */
    public function getCtId()
    {
        return $this->ct_id;
    }

    /**
     * Returns the value of field ct_storeid
     *
     * @return integer
     */
    public function getCtStoreid()
    {
        return $this->ct_storeid;
    }

    /**
     * Returns the value of field ct_storename
     *
     * @return string
     */
    public function getCtStorename()
    {
        return $this->ct_storename;
    }

    /**
     * Returns the value of field ct_itemid
     *
     * @return integer
     */
    public function getCtItemid()
    {
        return $this->ct_itemid;
    }

    /**
     * Returns the value of field ct_auditstate
     *
     * @return integer
     */
    public function getCtAuditstate()
    {
        return $this->ct_auditstate;
    }

    /**
     * Returns the value of field ct_joinstate
     *
     * @return integer
     */
    public function getCtJoinstate()
    {
        return $this->ct_joinstate;
    }

    /**
     * Returns the value of field ct_cost
     *
     * @return double
     */
    public function getCtCost()
    {
        return $this->ct_cost;
    }

    /**
     * Returns the value of field ct_closestate
     *
     * @return integer
     */
    public function getCtClosestate()
    {
        return $this->ct_closestate;
    }

    /**
     * Returns the value of field ct_quitstate
     *
     * @return integer
     */
    public function getCtQuitstate()
    {
        return $this->ct_quitstate;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'contract';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Contract[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Contract
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
