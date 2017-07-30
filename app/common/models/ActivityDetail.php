<?php

namespace Ypk\Models;

class ActivityDetail extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=9, nullable=false)
     */
    protected $activity_detail_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=8, nullable=false)
     */
    protected $activity_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $item_id;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $item_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $store_id;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $store_name;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $activity_detail_state;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $activity_detail_sort;

    /**
     * Method to set the value of field activity_detail_id
     *
     * @param integer $activity_detail_id
     * @return $this
     */
    public function setActivityDetailId($activity_detail_id)
    {
        $this->activity_detail_id = $activity_detail_id;

        return $this;
    }

    /**
     * Method to set the value of field activity_id
     *
     * @param integer $activity_id
     * @return $this
     */
    public function setActivityId($activity_id)
    {
        $this->activity_id = $activity_id;

        return $this;
    }

    /**
     * Method to set the value of field item_id
     *
     * @param integer $item_id
     * @return $this
     */
    public function setItemId($item_id)
    {
        $this->item_id = $item_id;

        return $this;
    }

    /**
     * Method to set the value of field item_name
     *
     * @param string $item_name
     * @return $this
     */
    public function setItemName($item_name)
    {
        $this->item_name = $item_name;

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
     * Method to set the value of field store_name
     *
     * @param string $store_name
     * @return $this
     */
    public function setStoreName($store_name)
    {
        $this->store_name = $store_name;

        return $this;
    }

    /**
     * Method to set the value of field activity_detail_state
     *
     * @param string $activity_detail_state
     * @return $this
     */
    public function setActivityDetailState($activity_detail_state)
    {
        $this->activity_detail_state = $activity_detail_state;

        return $this;
    }

    /**
     * Method to set the value of field activity_detail_sort
     *
     * @param integer $activity_detail_sort
     * @return $this
     */
    public function setActivityDetailSort($activity_detail_sort)
    {
        $this->activity_detail_sort = $activity_detail_sort;

        return $this;
    }

    /**
     * Returns the value of field activity_detail_id
     *
     * @return integer
     */
    public function getActivityDetailId()
    {
        return $this->activity_detail_id;
    }

    /**
     * Returns the value of field activity_id
     *
     * @return integer
     */
    public function getActivityId()
    {
        return $this->activity_id;
    }

    /**
     * Returns the value of field item_id
     *
     * @return integer
     */
    public function getItemId()
    {
        return $this->item_id;
    }

    /**
     * Returns the value of field item_name
     *
     * @return string
     */
    public function getItemName()
    {
        return $this->item_name;
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
     * Returns the value of field store_name
     *
     * @return string
     */
    public function getStoreName()
    {
        return $this->store_name;
    }

    /**
     * Returns the value of field activity_detail_state
     *
     * @return string
     */
    public function getActivityDetailState()
    {
        return $this->activity_detail_state;
    }

    /**
     * Returns the value of field activity_detail_sort
     *
     * @return integer
     */
    public function getActivityDetailSort()
    {
        return $this->activity_detail_sort;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'activity_detail';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ActivityDetail[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ActivityDetail
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
