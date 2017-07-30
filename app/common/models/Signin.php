<?php

namespace Ypk\Models;

class Signin extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $sl_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $sl_memberid;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $sl_membername;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $sl_addtime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $sl_points;

    /**
     * Method to set the value of field sl_id
     *
     * @param integer $sl_id
     * @return $this
     */
    public function setSlId($sl_id)
    {
        $this->sl_id = $sl_id;

        return $this;
    }

    /**
     * Method to set the value of field sl_memberid
     *
     * @param integer $sl_memberid
     * @return $this
     */
    public function setSlMemberid($sl_memberid)
    {
        $this->sl_memberid = $sl_memberid;

        return $this;
    }

    /**
     * Method to set the value of field sl_membername
     *
     * @param string $sl_membername
     * @return $this
     */
    public function setSlMembername($sl_membername)
    {
        $this->sl_membername = $sl_membername;

        return $this;
    }

    /**
     * Method to set the value of field sl_addtime
     *
     * @param integer $sl_addtime
     * @return $this
     */
    public function setSlAddtime($sl_addtime)
    {
        $this->sl_addtime = $sl_addtime;

        return $this;
    }

    /**
     * Method to set the value of field sl_points
     *
     * @param integer $sl_points
     * @return $this
     */
    public function setSlPoints($sl_points)
    {
        $this->sl_points = $sl_points;

        return $this;
    }

    /**
     * Returns the value of field sl_id
     *
     * @return integer
     */
    public function getSlId()
    {
        return $this->sl_id;
    }

    /**
     * Returns the value of field sl_memberid
     *
     * @return integer
     */
    public function getSlMemberid()
    {
        return $this->sl_memberid;
    }

    /**
     * Returns the value of field sl_membername
     *
     * @return string
     */
    public function getSlMembername()
    {
        return $this->sl_membername;
    }

    /**
     * Returns the value of field sl_addtime
     *
     * @return integer
     */
    public function getSlAddtime()
    {
        return $this->sl_addtime;
    }

    /**
     * Returns the value of field sl_points
     *
     * @return integer
     */
    public function getSlPoints()
    {
        return $this->sl_points;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'signin';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Signin[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Signin
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
