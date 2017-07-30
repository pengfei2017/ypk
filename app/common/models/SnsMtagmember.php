<?php

namespace Ypk\Models;

class SnsMtagmember extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $mtag_id;

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
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $recommend;

    /**
     * Method to set the value of field mtag_id
     *
     * @param integer $mtag_id
     * @return $this
     */
    public function setMtagId($mtag_id)
    {
        $this->mtag_id = $mtag_id;

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
     * Method to set the value of field recommend
     *
     * @param integer $recommend
     * @return $this
     */
    public function setRecommend($recommend)
    {
        $this->recommend = $recommend;

        return $this;
    }

    /**
     * Returns the value of field mtag_id
     *
     * @return integer
     */
    public function getMtagId()
    {
        return $this->mtag_id;
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
     * Returns the value of field recommend
     *
     * @return integer
     */
    public function getRecommend()
    {
        return $this->recommend;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'sns_mtagmember';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return SnsMtagmember[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return SnsMtagmember
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
