<?php

namespace Ypk\Models;

class StoreMsg extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $sm_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $smt_code;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $store_id;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $sm_content;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $sm_addtime;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $sm_readids;

    /**
     * Method to set the value of field sm_id
     *
     * @param integer $sm_id
     * @return $this
     */
    public function setSmId($sm_id)
    {
        $this->sm_id = $sm_id;

        return $this;
    }

    /**
     * Method to set the value of field smt_code
     *
     * @param string $smt_code
     * @return $this
     */
    public function setSmtCode($smt_code)
    {
        $this->smt_code = $smt_code;

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
     * Method to set the value of field sm_content
     *
     * @param string $sm_content
     * @return $this
     */
    public function setSmContent($sm_content)
    {
        $this->sm_content = $sm_content;

        return $this;
    }

    /**
     * Method to set the value of field sm_addtime
     *
     * @param integer $sm_addtime
     * @return $this
     */
    public function setSmAddtime($sm_addtime)
    {
        $this->sm_addtime = $sm_addtime;

        return $this;
    }

    /**
     * Method to set the value of field sm_readids
     *
     * @param string $sm_readids
     * @return $this
     */
    public function setSmReadids($sm_readids)
    {
        $this->sm_readids = $sm_readids;

        return $this;
    }

    /**
     * Returns the value of field sm_id
     *
     * @return integer
     */
    public function getSmId()
    {
        return $this->sm_id;
    }

    /**
     * Returns the value of field smt_code
     *
     * @return string
     */
    public function getSmtCode()
    {
        return $this->smt_code;
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
     * Returns the value of field sm_content
     *
     * @return string
     */
    public function getSmContent()
    {
        return $this->sm_content;
    }

    /**
     * Returns the value of field sm_addtime
     *
     * @return integer
     */
    public function getSmAddtime()
    {
        return $this->sm_addtime;
    }

    /**
     * Returns the value of field sm_readids
     *
     * @return string
     */
    public function getSmReadids()
    {
        return $this->sm_readids;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'store_msg';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreMsg[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreMsg
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
