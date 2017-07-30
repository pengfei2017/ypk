<?php

namespace Ypk\Models;

class Rechargecard extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $sn;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $denomination;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=true)
     */
    protected $batchflag;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $admin_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $tscreated;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $tsused;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $state;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $member_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $member_name;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field sn
     *
     * @param string $sn
     * @return $this
     */
    public function setSn($sn)
    {
        $this->sn = $sn;

        return $this;
    }

    /**
     * Method to set the value of field denomination
     *
     * @param double $denomination
     * @return $this
     */
    public function setDenomination($denomination)
    {
        $this->denomination = $denomination;

        return $this;
    }

    /**
     * Method to set the value of field batchflag
     *
     * @param string $batchflag
     * @return $this
     */
    public function setBatchflag($batchflag)
    {
        $this->batchflag = $batchflag;

        return $this;
    }

    /**
     * Method to set the value of field admin_name
     *
     * @param string $admin_name
     * @return $this
     */
    public function setAdminName($admin_name)
    {
        $this->admin_name = $admin_name;

        return $this;
    }

    /**
     * Method to set the value of field tscreated
     *
     * @param integer $tscreated
     * @return $this
     */
    public function setTscreated($tscreated)
    {
        $this->tscreated = $tscreated;

        return $this;
    }

    /**
     * Method to set the value of field tsused
     *
     * @param integer $tsused
     * @return $this
     */
    public function setTsused($tsused)
    {
        $this->tsused = $tsused;

        return $this;
    }

    /**
     * Method to set the value of field state
     *
     * @param integer $state
     * @return $this
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Method to set the value of field member_id
     *
     * @param integer $member_id
     * @return $this
     */
    public function setMemberId($member_id)
    {
        $this->member_id = $member_id;

        return $this;
    }

    /**
     * Method to set the value of field member_name
     *
     * @param string $member_name
     * @return $this
     */
    public function setMemberName($member_name)
    {
        $this->member_name = $member_name;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field sn
     *
     * @return string
     */
    public function getSn()
    {
        return $this->sn;
    }

    /**
     * Returns the value of field denomination
     *
     * @return double
     */
    public function getDenomination()
    {
        return $this->denomination;
    }

    /**
     * Returns the value of field batchflag
     *
     * @return string
     */
    public function getBatchflag()
    {
        return $this->batchflag;
    }

    /**
     * Returns the value of field admin_name
     *
     * @return string
     */
    public function getAdminName()
    {
        return $this->admin_name;
    }

    /**
     * Returns the value of field tscreated
     *
     * @return integer
     */
    public function getTscreated()
    {
        return $this->tscreated;
    }

    /**
     * Returns the value of field tsused
     *
     * @return integer
     */
    public function getTsused()
    {
        return $this->tsused;
    }

    /**
     * Returns the value of field state
     *
     * @return integer
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Returns the value of field member_id
     *
     * @return integer
     */
    public function getMemberId()
    {
        return $this->member_id;
    }

    /**
     * Returns the value of field member_name
     *
     * @return string
     */
    public function getMemberName()
    {
        return $this->member_name;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'rechargecard';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Rechargecard[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Rechargecard
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
