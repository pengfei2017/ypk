<?php

namespace Ypk\Models;

class MemberUpdateTreeLevelLog extends \Phalcon\Mvc\Model
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
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $member_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $member_tree_level;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $update_type;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    protected $by_count;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $add_time;

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
     * Method to set the value of field member_tree_level
     *
     * @param integer $member_tree_level
     * @return $this
     */
    public function setMemberTreeLevel($member_tree_level)
    {
        $this->member_tree_level = $member_tree_level;

        return $this;
    }

    /**
     * Method to set the value of field update_type
     *
     * @param integer $update_type
     * @return $this
     */
    public function setUpdateType($update_type)
    {
        $this->update_type = $update_type;

        return $this;
    }

    /**
     * Method to set the value of field by_count
     *
     * @param double $by_count
     * @return $this
     */
    public function setByCount($by_count)
    {
        $this->by_count = $by_count;

        return $this;
    }

    /**
     * Method to set the value of field add_time
     *
     * @param integer $add_time
     * @return $this
     */
    public function setAddTime($add_time)
    {
        $this->add_time = $add_time;

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
     * Returns the value of field member_name
     *
     * @return string
     */
    public function getMemberName()
    {
        return $this->member_name;
    }

    /**
     * Returns the value of field member_tree_level
     *
     * @return integer
     */
    public function getMemberTreeLevel()
    {
        return $this->member_tree_level;
    }

    /**
     * Returns the value of field update_type
     *
     * @return integer
     */
    public function getUpdateType()
    {
        return $this->update_type;
    }

    /**
     * Returns the value of field by_count
     *
     * @return double
     */
    public function getByCount()
    {
        return $this->by_count;
    }

    /**
     * Returns the value of field add_time
     *
     * @return integer
     */
    public function getAddTime()
    {
        return $this->add_time;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'member_update_tree_level_log';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MemberUpdateTreeLevelLog[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MemberUpdateTreeLevelLog
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
