<?php

namespace Ypk\Models;

class MicroMemberInfo extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $member_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $visit_count;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $personal_count;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $goods_count;

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
     * Method to set the value of field visit_count
     *
     * @param integer $visit_count
     * @return $this
     */
    public function setVisitCount($visit_count)
    {
        $this->visit_count = $visit_count;

        return $this;
    }

    /**
     * Method to set the value of field personal_count
     *
     * @param integer $personal_count
     * @return $this
     */
    public function setPersonalCount($personal_count)
    {
        $this->personal_count = $personal_count;

        return $this;
    }

    /**
     * Method to set the value of field goods_count
     *
     * @param integer $goods_count
     * @return $this
     */
    public function setGoodsCount($goods_count)
    {
        $this->goods_count = $goods_count;

        return $this;
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
     * Returns the value of field visit_count
     *
     * @return integer
     */
    public function getVisitCount()
    {
        return $this->visit_count;
    }

    /**
     * Returns the value of field personal_count
     *
     * @return integer
     */
    public function getPersonalCount()
    {
        return $this->personal_count;
    }

    /**
     * Returns the value of field goods_count
     *
     * @return integer
     */
    public function getGoodsCount()
    {
        return $this->goods_count;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'micro_member_info';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MicroMemberInfo[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MicroMemberInfo
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
