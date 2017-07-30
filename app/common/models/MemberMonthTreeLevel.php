<?php

namespace Ypk\Models;

class MemberMonthTreeLevel extends \Phalcon\Mvc\Model
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
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $member_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $member_tree_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $member_month_level;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $store_tree_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $store_month_level;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $month_tree_level_type;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $add_month;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $add_jidu;

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
     * Method to set the value of field member_tree_id
     *
     * @param integer $member_tree_id
     * @return $this
     */
    public function setMemberTreeId($member_tree_id)
    {
        $this->member_tree_id = $member_tree_id;

        return $this;
    }

    /**
     * Method to set the value of field member_month_level
     *
     * @param integer $member_month_level
     * @return $this
     */
    public function setMemberMonthLevel($member_month_level)
    {
        $this->member_month_level = $member_month_level;

        return $this;
    }

    /**
     * Method to set the value of field store_tree_id
     *
     * @param integer $store_tree_id
     * @return $this
     */
    public function setStoreTreeId($store_tree_id)
    {
        $this->store_tree_id = $store_tree_id;

        return $this;
    }

    /**
     * Method to set the value of field store_month_level
     *
     * @param integer $store_month_level
     * @return $this
     */
    public function setStoreMonthLevel($store_month_level)
    {
        $this->store_month_level = $store_month_level;

        return $this;
    }

    /**
     * Method to set the value of field month_tree_level_type
     *
     * @param integer $month_tree_level_type
     * @return $this
     */
    public function setMonthTreeLevelType($month_tree_level_type)
    {
        $this->month_tree_level_type = $month_tree_level_type;

        return $this;
    }

    /**
     * Method to set the value of field add_month
     *
     * @param integer $add_month
     * @return $this
     */
    public function setAddMonth($add_month)
    {
        $this->add_month = $add_month;

        return $this;
    }

    /**
     * Method to set the value of field add_jidu
     *
     * @param integer $add_jidu
     * @return $this
     */
    public function setAddJidu($add_jidu)
    {
        $this->add_jidu = $add_jidu;

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
     * Returns the value of field member_id
     *
     * @return integer
     */
    public function getMemberId()
    {
        return $this->member_id;
    }

    /**
     * Returns the value of field member_tree_id
     *
     * @return integer
     */
    public function getMemberTreeId()
    {
        return $this->member_tree_id;
    }

    /**
     * Returns the value of field member_month_level
     *
     * @return integer
     */
    public function getMemberMonthLevel()
    {
        return $this->member_month_level;
    }

    /**
     * Returns the value of field store_tree_id
     *
     * @return integer
     */
    public function getStoreTreeId()
    {
        return $this->store_tree_id;
    }

    /**
     * Returns the value of field store_month_level
     *
     * @return integer
     */
    public function getStoreMonthLevel()
    {
        return $this->store_month_level;
    }

    /**
     * Returns the value of field month_tree_level_type
     *
     * @return integer
     */
    public function getMonthTreeLevelType()
    {
        return $this->month_tree_level_type;
    }

    /**
     * Returns the value of field add_month
     *
     * @return integer
     */
    public function getAddMonth()
    {
        return $this->add_month;
    }

    /**
     * Returns the value of field add_jidu
     *
     * @return integer
     */
    public function getAddJidu()
    {
        return $this->add_jidu;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'member_month_tree_level';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MemberMonthTreeLevel[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MemberMonthTreeLevel
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
