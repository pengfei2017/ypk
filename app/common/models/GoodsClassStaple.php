<?php

namespace Ypk\Models;

class GoodsClassStaple extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $staple_id;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $staple_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $gc_id_1;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $gc_id_2;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $gc_id_3;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $type_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $member_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $counter;

    /**
     * Method to set the value of field staple_id
     *
     * @param integer $staple_id
     * @return $this
     */
    public function setStapleId($staple_id)
    {
        $this->staple_id = $staple_id;

        return $this;
    }

    /**
     * Method to set the value of field staple_name
     *
     * @param string $staple_name
     * @return $this
     */
    public function setStapleName($staple_name)
    {
        $this->staple_name = $staple_name;

        return $this;
    }

    /**
     * Method to set the value of field gc_id_1
     *
     * @param integer $gc_id_1
     * @return $this
     */
    public function setGcId1($gc_id_1)
    {
        $this->gc_id_1 = $gc_id_1;

        return $this;
    }

    /**
     * Method to set the value of field gc_id_2
     *
     * @param integer $gc_id_2
     * @return $this
     */
    public function setGcId2($gc_id_2)
    {
        $this->gc_id_2 = $gc_id_2;

        return $this;
    }

    /**
     * Method to set the value of field gc_id_3
     *
     * @param integer $gc_id_3
     * @return $this
     */
    public function setGcId3($gc_id_3)
    {
        $this->gc_id_3 = $gc_id_3;

        return $this;
    }

    /**
     * Method to set the value of field type_id
     *
     * @param integer $type_id
     * @return $this
     */
    public function setTypeId($type_id)
    {
        $this->type_id = $type_id;

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
     * Method to set the value of field counter
     *
     * @param integer $counter
     * @return $this
     */
    public function setCounter($counter)
    {
        $this->counter = $counter;

        return $this;
    }

    /**
     * Returns the value of field staple_id
     *
     * @return integer
     */
    public function getStapleId()
    {
        return $this->staple_id;
    }

    /**
     * Returns the value of field staple_name
     *
     * @return string
     */
    public function getStapleName()
    {
        return $this->staple_name;
    }

    /**
     * Returns the value of field gc_id_1
     *
     * @return integer
     */
    public function getGcId1()
    {
        return $this->gc_id_1;
    }

    /**
     * Returns the value of field gc_id_2
     *
     * @return integer
     */
    public function getGcId2()
    {
        return $this->gc_id_2;
    }

    /**
     * Returns the value of field gc_id_3
     *
     * @return integer
     */
    public function getGcId3()
    {
        return $this->gc_id_3;
    }

    /**
     * Returns the value of field type_id
     *
     * @return integer
     */
    public function getTypeId()
    {
        return $this->type_id;
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
     * Returns the value of field counter
     *
     * @return integer
     */
    public function getCounter()
    {
        return $this->counter;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'goods_class_staple';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return GoodsClassStaple[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return GoodsClassStaple
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
