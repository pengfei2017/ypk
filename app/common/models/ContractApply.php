<?php

namespace Ypk\Models;

class ContractApply extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $cta_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $cta_itemid;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $cta_storeid;

    /**
     *
     * @var string
     * @Column(type="string", length=500, nullable=false)
     */
    protected $cta_storename;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $cta_addtime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $cta_auditstate;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    protected $cta_cost;

    /**
     *
     * @var string
     * @Column(type="string", length=500, nullable=true)
     */
    protected $cta_costimg;

    /**
     * Method to set the value of field cta_id
     *
     * @param integer $cta_id
     * @return $this
     */
    public function setCtaId($cta_id)
    {
        $this->cta_id = $cta_id;

        return $this;
    }

    /**
     * Method to set the value of field cta_itemid
     *
     * @param integer $cta_itemid
     * @return $this
     */
    public function setCtaItemid($cta_itemid)
    {
        $this->cta_itemid = $cta_itemid;

        return $this;
    }

    /**
     * Method to set the value of field cta_storeid
     *
     * @param integer $cta_storeid
     * @return $this
     */
    public function setCtaStoreid($cta_storeid)
    {
        $this->cta_storeid = $cta_storeid;

        return $this;
    }

    /**
     * Method to set the value of field cta_storename
     *
     * @param string $cta_storename
     * @return $this
     */
    public function setCtaStorename($cta_storename)
    {
        $this->cta_storename = $cta_storename;

        return $this;
    }

    /**
     * Method to set the value of field cta_addtime
     *
     * @param integer $cta_addtime
     * @return $this
     */
    public function setCtaAddtime($cta_addtime)
    {
        $this->cta_addtime = $cta_addtime;

        return $this;
    }

    /**
     * Method to set the value of field cta_auditstate
     *
     * @param integer $cta_auditstate
     * @return $this
     */
    public function setCtaAuditstate($cta_auditstate)
    {
        $this->cta_auditstate = $cta_auditstate;

        return $this;
    }

    /**
     * Method to set the value of field cta_cost
     *
     * @param double $cta_cost
     * @return $this
     */
    public function setCtaCost($cta_cost)
    {
        $this->cta_cost = $cta_cost;

        return $this;
    }

    /**
     * Method to set the value of field cta_costimg
     *
     * @param string $cta_costimg
     * @return $this
     */
    public function setCtaCostimg($cta_costimg)
    {
        $this->cta_costimg = $cta_costimg;

        return $this;
    }

    /**
     * Returns the value of field cta_id
     *
     * @return integer
     */
    public function getCtaId()
    {
        return $this->cta_id;
    }

    /**
     * Returns the value of field cta_itemid
     *
     * @return integer
     */
    public function getCtaItemid()
    {
        return $this->cta_itemid;
    }

    /**
     * Returns the value of field cta_storeid
     *
     * @return integer
     */
    public function getCtaStoreid()
    {
        return $this->cta_storeid;
    }

    /**
     * Returns the value of field cta_storename
     *
     * @return string
     */
    public function getCtaStorename()
    {
        return $this->cta_storename;
    }

    /**
     * Returns the value of field cta_addtime
     *
     * @return integer
     */
    public function getCtaAddtime()
    {
        return $this->cta_addtime;
    }

    /**
     * Returns the value of field cta_auditstate
     *
     * @return integer
     */
    public function getCtaAuditstate()
    {
        return $this->cta_auditstate;
    }

    /**
     * Returns the value of field cta_cost
     *
     * @return double
     */
    public function getCtaCost()
    {
        return $this->cta_cost;
    }

    /**
     * Returns the value of field cta_costimg
     *
     * @return string
     */
    public function getCtaCostimg()
    {
        return $this->cta_costimg;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'contract_apply';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ContractApply[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ContractApply
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
