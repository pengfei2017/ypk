<?php

namespace Ypk\Models;

class PointsLog extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $pl_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $pl_memberid;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $pl_membername;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $pl_adminid;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $pl_adminname;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $pl_points;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $pl_addtime;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $pl_desc;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $tree_type;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $pl_stage;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $order_id;

    /**
     * @return int
     */
    public function getOrderId()
    {
        return $this->order_id;
    }

    /**
     * @param int $order_id
     */
    public function setOrderId($order_id)
    {
        $this->order_id = $order_id;
    }

    /**
     * Method to set the value of field pl_id
     *
     * @param integer $pl_id
     * @return $this
     */
    public function setPlId($pl_id)
    {
        $this->pl_id = $pl_id;

        return $this;
    }

    /**
     * Method to set the value of field pl_memberid
     *
     * @param integer $pl_memberid
     * @return $this
     */
    public function setPlMemberid($pl_memberid)
    {
        $this->pl_memberid = $pl_memberid;

        return $this;
    }

    /**
     * Method to set the value of field pl_membername
     *
     * @param string $pl_membername
     * @return $this
     */
    public function setPlMembername($pl_membername)
    {
        $this->pl_membername = $pl_membername;

        return $this;
    }

    /**
     * Method to set the value of field pl_adminid
     *
     * @param integer $pl_adminid
     * @return $this
     */
    public function setPlAdminid($pl_adminid)
    {
        $this->pl_adminid = $pl_adminid;

        return $this;
    }

    /**
     * Method to set the value of field pl_adminname
     *
     * @param string $pl_adminname
     * @return $this
     */
    public function setPlAdminname($pl_adminname)
    {
        $this->pl_adminname = $pl_adminname;

        return $this;
    }

    /**
     * Method to set the value of field pl_points
     *
     * @param integer $pl_points
     * @return $this
     */
    public function setPlPoints($pl_points)
    {
        $this->pl_points = $pl_points;

        return $this;
    }

    /**
     * Method to set the value of field pl_addtime
     *
     * @param integer $pl_addtime
     * @return $this
     */
    public function setPlAddtime($pl_addtime)
    {
        $this->pl_addtime = $pl_addtime;

        return $this;
    }

    /**
     * Method to set the value of field pl_desc
     *
     * @param string $pl_desc
     * @return $this
     */
    public function setPlDesc($pl_desc)
    {
        $this->pl_desc = $pl_desc;

        return $this;
    }

    /**
     * Method to set the value of field tree_type
     *
     * @param integer $tree_type
     * @return $this
     */
    public function setTreeType($tree_type)
    {
        $this->tree_type = $tree_type;

        return $this;
    }

    /**
     * Method to set the value of field pl_stage
     *
     * @param string $pl_stage
     * @return $this
     */
    public function setPlStage($pl_stage)
    {
        $this->pl_stage = $pl_stage;

        return $this;
    }

    /**
     * Returns the value of field pl_id
     *
     * @return integer
     */
    public function getPlId()
    {
        return $this->pl_id;
    }

    /**
     * Returns the value of field pl_memberid
     *
     * @return integer
     */
    public function getPlMemberid()
    {
        return $this->pl_memberid;
    }

    /**
     * Returns the value of field pl_membername
     *
     * @return string
     */
    public function getPlMembername()
    {
        return $this->pl_membername;
    }

    /**
     * Returns the value of field pl_adminid
     *
     * @return integer
     */
    public function getPlAdminid()
    {
        return $this->pl_adminid;
    }

    /**
     * Returns the value of field pl_adminname
     *
     * @return string
     */
    public function getPlAdminname()
    {
        return $this->pl_adminname;
    }

    /**
     * Returns the value of field pl_points
     *
     * @return integer
     */
    public function getPlPoints()
    {
        return $this->pl_points;
    }

    /**
     * Returns the value of field pl_addtime
     *
     * @return integer
     */
    public function getPlAddtime()
    {
        return $this->pl_addtime;
    }

    /**
     * Returns the value of field pl_desc
     *
     * @return string
     */
    public function getPlDesc()
    {
        return $this->pl_desc;
    }

    /**
     * Returns the value of field tree_type
     *
     * @return integer
     */
    public function getTreeType()
    {
        return $this->tree_type;
    }

    /**
     * Returns the value of field pl_stage
     *
     * @return string
     */
    public function getPlStage()
    {
        return $this->pl_stage;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'points_log';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return PointsLog[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return PointsLog
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
