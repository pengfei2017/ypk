<?php

namespace Ypk\Models;

class EvaluateStore extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $seval_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $seval_orderid;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $seval_orderno;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $seval_addtime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $seval_storeid;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $seval_storename;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $seval_memberid;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $seval_membername;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $seval_desccredit;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $seval_servicecredit;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $seval_deliverycredit;

    /**
     * Method to set the value of field seval_id
     *
     * @param integer $seval_id
     * @return $this
     */
    public function setSevalId($seval_id)
    {
        $this->seval_id = $seval_id;

        return $this;
    }

    /**
     * Method to set the value of field seval_orderid
     *
     * @param integer $seval_orderid
     * @return $this
     */
    public function setSevalOrderid($seval_orderid)
    {
        $this->seval_orderid = $seval_orderid;

        return $this;
    }

    /**
     * Method to set the value of field seval_orderno
     *
     * @param string $seval_orderno
     * @return $this
     */
    public function setSevalOrderno($seval_orderno)
    {
        $this->seval_orderno = $seval_orderno;

        return $this;
    }

    /**
     * Method to set the value of field seval_addtime
     *
     * @param integer $seval_addtime
     * @return $this
     */
    public function setSevalAddtime($seval_addtime)
    {
        $this->seval_addtime = $seval_addtime;

        return $this;
    }

    /**
     * Method to set the value of field seval_storeid
     *
     * @param integer $seval_storeid
     * @return $this
     */
    public function setSevalStoreid($seval_storeid)
    {
        $this->seval_storeid = $seval_storeid;

        return $this;
    }

    /**
     * Method to set the value of field seval_storename
     *
     * @param string $seval_storename
     * @return $this
     */
    public function setSevalStorename($seval_storename)
    {
        $this->seval_storename = $seval_storename;

        return $this;
    }

    /**
     * Method to set the value of field seval_memberid
     *
     * @param integer $seval_memberid
     * @return $this
     */
    public function setSevalMemberid($seval_memberid)
    {
        $this->seval_memberid = $seval_memberid;

        return $this;
    }

    /**
     * Method to set the value of field seval_membername
     *
     * @param string $seval_membername
     * @return $this
     */
    public function setSevalMembername($seval_membername)
    {
        $this->seval_membername = $seval_membername;

        return $this;
    }

    /**
     * Method to set the value of field seval_desccredit
     *
     * @param integer $seval_desccredit
     * @return $this
     */
    public function setSevalDesccredit($seval_desccredit)
    {
        $this->seval_desccredit = $seval_desccredit;

        return $this;
    }

    /**
     * Method to set the value of field seval_servicecredit
     *
     * @param integer $seval_servicecredit
     * @return $this
     */
    public function setSevalServicecredit($seval_servicecredit)
    {
        $this->seval_servicecredit = $seval_servicecredit;

        return $this;
    }

    /**
     * Method to set the value of field seval_deliverycredit
     *
     * @param integer $seval_deliverycredit
     * @return $this
     */
    public function setSevalDeliverycredit($seval_deliverycredit)
    {
        $this->seval_deliverycredit = $seval_deliverycredit;

        return $this;
    }

    /**
     * Returns the value of field seval_id
     *
     * @return integer
     */
    public function getSevalId()
    {
        return $this->seval_id;
    }

    /**
     * Returns the value of field seval_orderid
     *
     * @return integer
     */
    public function getSevalOrderid()
    {
        return $this->seval_orderid;
    }

    /**
     * Returns the value of field seval_orderno
     *
     * @return string
     */
    public function getSevalOrderno()
    {
        return $this->seval_orderno;
    }

    /**
     * Returns the value of field seval_addtime
     *
     * @return integer
     */
    public function getSevalAddtime()
    {
        return $this->seval_addtime;
    }

    /**
     * Returns the value of field seval_storeid
     *
     * @return integer
     */
    public function getSevalStoreid()
    {
        return $this->seval_storeid;
    }

    /**
     * Returns the value of field seval_storename
     *
     * @return string
     */
    public function getSevalStorename()
    {
        return $this->seval_storename;
    }

    /**
     * Returns the value of field seval_memberid
     *
     * @return integer
     */
    public function getSevalMemberid()
    {
        return $this->seval_memberid;
    }

    /**
     * Returns the value of field seval_membername
     *
     * @return string
     */
    public function getSevalMembername()
    {
        return $this->seval_membername;
    }

    /**
     * Returns the value of field seval_desccredit
     *
     * @return integer
     */
    public function getSevalDesccredit()
    {
        return $this->seval_desccredit;
    }

    /**
     * Returns the value of field seval_servicecredit
     *
     * @return integer
     */
    public function getSevalServicecredit()
    {
        return $this->seval_servicecredit;
    }

    /**
     * Returns the value of field seval_deliverycredit
     *
     * @return integer
     */
    public function getSevalDeliverycredit()
    {
        return $this->seval_deliverycredit;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'evaluate_store';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return EvaluateStore[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return EvaluateStore
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
