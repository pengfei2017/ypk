<?php

namespace Ypk\Models;

class ContractLog extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $log_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $log_storeid;

    /**
     *
     * @var string
     * @Column(type="string", length=500, nullable=false)
     */
    protected $log_storename;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $log_itemid;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $log_itemname;

    /**
     *
     * @var string
     * @Column(type="string", length=1000, nullable=false)
     */
    protected $log_msg;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $log_addtime;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $log_role;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $log_userid;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=false)
     */
    protected $log_username;

    /**
     * Method to set the value of field log_id
     *
     * @param integer $log_id
     * @return $this
     */
    public function setLogId($log_id)
    {
        $this->log_id = $log_id;

        return $this;
    }

    /**
     * Method to set the value of field log_storeid
     *
     * @param integer $log_storeid
     * @return $this
     */
    public function setLogStoreid($log_storeid)
    {
        $this->log_storeid = $log_storeid;

        return $this;
    }

    /**
     * Method to set the value of field log_storename
     *
     * @param string $log_storename
     * @return $this
     */
    public function setLogStorename($log_storename)
    {
        $this->log_storename = $log_storename;

        return $this;
    }

    /**
     * Method to set the value of field log_itemid
     *
     * @param integer $log_itemid
     * @return $this
     */
    public function setLogItemid($log_itemid)
    {
        $this->log_itemid = $log_itemid;

        return $this;
    }

    /**
     * Method to set the value of field log_itemname
     *
     * @param string $log_itemname
     * @return $this
     */
    public function setLogItemname($log_itemname)
    {
        $this->log_itemname = $log_itemname;

        return $this;
    }

    /**
     * Method to set the value of field log_msg
     *
     * @param string $log_msg
     * @return $this
     */
    public function setLogMsg($log_msg)
    {
        $this->log_msg = $log_msg;

        return $this;
    }

    /**
     * Method to set the value of field log_addtime
     *
     * @param integer $log_addtime
     * @return $this
     */
    public function setLogAddtime($log_addtime)
    {
        $this->log_addtime = $log_addtime;

        return $this;
    }

    /**
     * Method to set the value of field log_role
     *
     * @param string $log_role
     * @return $this
     */
    public function setLogRole($log_role)
    {
        $this->log_role = $log_role;

        return $this;
    }

    /**
     * Method to set the value of field log_userid
     *
     * @param integer $log_userid
     * @return $this
     */
    public function setLogUserid($log_userid)
    {
        $this->log_userid = $log_userid;

        return $this;
    }

    /**
     * Method to set the value of field log_username
     *
     * @param string $log_username
     * @return $this
     */
    public function setLogUsername($log_username)
    {
        $this->log_username = $log_username;

        return $this;
    }

    /**
     * Returns the value of field log_id
     *
     * @return integer
     */
    public function getLogId()
    {
        return $this->log_id;
    }

    /**
     * Returns the value of field log_storeid
     *
     * @return integer
     */
    public function getLogStoreid()
    {
        return $this->log_storeid;
    }

    /**
     * Returns the value of field log_storename
     *
     * @return string
     */
    public function getLogStorename()
    {
        return $this->log_storename;
    }

    /**
     * Returns the value of field log_itemid
     *
     * @return integer
     */
    public function getLogItemid()
    {
        return $this->log_itemid;
    }

    /**
     * Returns the value of field log_itemname
     *
     * @return string
     */
    public function getLogItemname()
    {
        return $this->log_itemname;
    }

    /**
     * Returns the value of field log_msg
     *
     * @return string
     */
    public function getLogMsg()
    {
        return $this->log_msg;
    }

    /**
     * Returns the value of field log_addtime
     *
     * @return integer
     */
    public function getLogAddtime()
    {
        return $this->log_addtime;
    }

    /**
     * Returns the value of field log_role
     *
     * @return string
     */
    public function getLogRole()
    {
        return $this->log_role;
    }

    /**
     * Returns the value of field log_userid
     *
     * @return integer
     */
    public function getLogUserid()
    {
        return $this->log_userid;
    }

    /**
     * Returns the value of field log_username
     *
     * @return string
     */
    public function getLogUsername()
    {
        return $this->log_username;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'contract_log';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ContractLog[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ContractLog
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
