<?php

namespace Ypk\Models;

class ExppointsLog extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $exp_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $exp_memberid;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $exp_membername;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $exp_points;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $exp_addtime;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $exp_desc;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $exp_stage;

    /**
     * Method to set the value of field exp_id
     *
     * @param integer $exp_id
     * @return $this
     */
    public function setExpId($exp_id)
    {
        $this->exp_id = $exp_id;

        return $this;
    }

    /**
     * Method to set the value of field exp_memberid
     *
     * @param integer $exp_memberid
     * @return $this
     */
    public function setExpMemberid($exp_memberid)
    {
        $this->exp_memberid = $exp_memberid;

        return $this;
    }

    /**
     * Method to set the value of field exp_membername
     *
     * @param string $exp_membername
     * @return $this
     */
    public function setExpMembername($exp_membername)
    {
        $this->exp_membername = $exp_membername;

        return $this;
    }

    /**
     * Method to set the value of field exp_points
     *
     * @param integer $exp_points
     * @return $this
     */
    public function setExpPoints($exp_points)
    {
        $this->exp_points = $exp_points;

        return $this;
    }

    /**
     * Method to set the value of field exp_addtime
     *
     * @param integer $exp_addtime
     * @return $this
     */
    public function setExpAddtime($exp_addtime)
    {
        $this->exp_addtime = $exp_addtime;

        return $this;
    }

    /**
     * Method to set the value of field exp_desc
     *
     * @param string $exp_desc
     * @return $this
     */
    public function setExpDesc($exp_desc)
    {
        $this->exp_desc = $exp_desc;

        return $this;
    }

    /**
     * Method to set the value of field exp_stage
     *
     * @param string $exp_stage
     * @return $this
     */
    public function setExpStage($exp_stage)
    {
        $this->exp_stage = $exp_stage;

        return $this;
    }

    /**
     * Returns the value of field exp_id
     *
     * @return integer
     */
    public function getExpId()
    {
        return $this->exp_id;
    }

    /**
     * Returns the value of field exp_memberid
     *
     * @return integer
     */
    public function getExpMemberid()
    {
        return $this->exp_memberid;
    }

    /**
     * Returns the value of field exp_membername
     *
     * @return string
     */
    public function getExpMembername()
    {
        return $this->exp_membername;
    }

    /**
     * Returns the value of field exp_points
     *
     * @return integer
     */
    public function getExpPoints()
    {
        return $this->exp_points;
    }

    /**
     * Returns the value of field exp_addtime
     *
     * @return integer
     */
    public function getExpAddtime()
    {
        return $this->exp_addtime;
    }

    /**
     * Returns the value of field exp_desc
     *
     * @return string
     */
    public function getExpDesc()
    {
        return $this->exp_desc;
    }

    /**
     * Returns the value of field exp_stage
     *
     * @return string
     */
    public function getExpStage()
    {
        return $this->exp_stage;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'exppoints_log';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ExppointsLog[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ExppointsLog
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
