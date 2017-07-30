<?php

namespace Ypk\Models;

class ContractQuitapply extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $ctq_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $ctq_itemid;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=false)
     */
    protected $ctq_itemname;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $ctq_storeid;

    /**
     *
     * @var string
     * @Column(type="string", length=500, nullable=false)
     */
    protected $ctq_storename;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $ctq_addtime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $ctq_auditstate;

    /**
     * Method to set the value of field ctq_id
     *
     * @param integer $ctq_id
     * @return $this
     */
    public function setCtqId($ctq_id)
    {
        $this->ctq_id = $ctq_id;

        return $this;
    }

    /**
     * Method to set the value of field ctq_itemid
     *
     * @param integer $ctq_itemid
     * @return $this
     */
    public function setCtqItemid($ctq_itemid)
    {
        $this->ctq_itemid = $ctq_itemid;

        return $this;
    }

    /**
     * Method to set the value of field ctq_itemname
     *
     * @param string $ctq_itemname
     * @return $this
     */
    public function setCtqItemname($ctq_itemname)
    {
        $this->ctq_itemname = $ctq_itemname;

        return $this;
    }

    /**
     * Method to set the value of field ctq_storeid
     *
     * @param integer $ctq_storeid
     * @return $this
     */
    public function setCtqStoreid($ctq_storeid)
    {
        $this->ctq_storeid = $ctq_storeid;

        return $this;
    }

    /**
     * Method to set the value of field ctq_storename
     *
     * @param string $ctq_storename
     * @return $this
     */
    public function setCtqStorename($ctq_storename)
    {
        $this->ctq_storename = $ctq_storename;

        return $this;
    }

    /**
     * Method to set the value of field ctq_addtime
     *
     * @param integer $ctq_addtime
     * @return $this
     */
    public function setCtqAddtime($ctq_addtime)
    {
        $this->ctq_addtime = $ctq_addtime;

        return $this;
    }

    /**
     * Method to set the value of field ctq_auditstate
     *
     * @param integer $ctq_auditstate
     * @return $this
     */
    public function setCtqAuditstate($ctq_auditstate)
    {
        $this->ctq_auditstate = $ctq_auditstate;

        return $this;
    }

    /**
     * Returns the value of field ctq_id
     *
     * @return integer
     */
    public function getCtqId()
    {
        return $this->ctq_id;
    }

    /**
     * Returns the value of field ctq_itemid
     *
     * @return integer
     */
    public function getCtqItemid()
    {
        return $this->ctq_itemid;
    }

    /**
     * Returns the value of field ctq_itemname
     *
     * @return string
     */
    public function getCtqItemname()
    {
        return $this->ctq_itemname;
    }

    /**
     * Returns the value of field ctq_storeid
     *
     * @return integer
     */
    public function getCtqStoreid()
    {
        return $this->ctq_storeid;
    }

    /**
     * Returns the value of field ctq_storename
     *
     * @return string
     */
    public function getCtqStorename()
    {
        return $this->ctq_storename;
    }

    /**
     * Returns the value of field ctq_addtime
     *
     * @return integer
     */
    public function getCtqAddtime()
    {
        return $this->ctq_addtime;
    }

    /**
     * Returns the value of field ctq_auditstate
     *
     * @return integer
     */
    public function getCtqAuditstate()
    {
        return $this->ctq_auditstate;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'contract_quitapply';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ContractQuitapply[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ContractQuitapply
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
