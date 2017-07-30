<?php

namespace Ypk\Models;

class Activity extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=9, nullable=false)
     */
    protected $activity_id;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $activity_title;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $activity_type;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $activity_banner;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $activity_style;

    /**
     *
     * @var string
     * @Column(type="string", length=1000, nullable=true)
     */
    protected $activity_desc;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $activity_start_date;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $activity_end_date;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $activity_sort;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $activity_state;

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
     * Method to set the value of field activity_title
     *
     * @param string $activity_title
     * @return $this
     */
    public function setActivityTitle($activity_title)
    {
        $this->activity_title = $activity_title;

        return $this;
    }

    /**
     * Method to set the value of field activity_type
     *
     * @param string $activity_type
     * @return $this
     */
    public function setActivityType($activity_type)
    {
        $this->activity_type = $activity_type;

        return $this;
    }

    /**
     * Method to set the value of field activity_banner
     *
     * @param string $activity_banner
     * @return $this
     */
    public function setActivityBanner($activity_banner)
    {
        $this->activity_banner = $activity_banner;

        return $this;
    }

    /**
     * Method to set the value of field activity_style
     *
     * @param string $activity_style
     * @return $this
     */
    public function setActivityStyle($activity_style)
    {
        $this->activity_style = $activity_style;

        return $this;
    }

    /**
     * Method to set the value of field activity_desc
     *
     * @param string $activity_desc
     * @return $this
     */
    public function setActivityDesc($activity_desc)
    {
        $this->activity_desc = $activity_desc;

        return $this;
    }

    /**
     * Method to set the value of field activity_start_date
     *
     * @param integer $activity_start_date
     * @return $this
     */
    public function setActivityStartDate($activity_start_date)
    {
        $this->activity_start_date = $activity_start_date;

        return $this;
    }

    /**
     * Method to set the value of field activity_end_date
     *
     * @param integer $activity_end_date
     * @return $this
     */
    public function setActivityEndDate($activity_end_date)
    {
        $this->activity_end_date = $activity_end_date;

        return $this;
    }

    /**
     * Method to set the value of field activity_sort
     *
     * @param integer $activity_sort
     * @return $this
     */
    public function setActivitySort($activity_sort)
    {
        $this->activity_sort = $activity_sort;

        return $this;
    }

    /**
     * Method to set the value of field activity_state
     *
     * @param integer $activity_state
     * @return $this
     */
    public function setActivityState($activity_state)
    {
        $this->activity_state = $activity_state;

        return $this;
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
     * Returns the value of field activity_title
     *
     * @return string
     */
    public function getActivityTitle()
    {
        return $this->activity_title;
    }

    /**
     * Returns the value of field activity_type
     *
     * @return string
     */
    public function getActivityType()
    {
        return $this->activity_type;
    }

    /**
     * Returns the value of field activity_banner
     *
     * @return string
     */
    public function getActivityBanner()
    {
        return $this->activity_banner;
    }

    /**
     * Returns the value of field activity_style
     *
     * @return string
     */
    public function getActivityStyle()
    {
        return $this->activity_style;
    }

    /**
     * Returns the value of field activity_desc
     *
     * @return string
     */
    public function getActivityDesc()
    {
        return $this->activity_desc;
    }

    /**
     * Returns the value of field activity_start_date
     *
     * @return integer
     */
    public function getActivityStartDate()
    {
        return $this->activity_start_date;
    }

    /**
     * Returns the value of field activity_end_date
     *
     * @return integer
     */
    public function getActivityEndDate()
    {
        return $this->activity_end_date;
    }

    /**
     * Returns the value of field activity_sort
     *
     * @return integer
     */
    public function getActivitySort()
    {
        return $this->activity_sort;
    }

    /**
     * Returns the value of field activity_state
     *
     * @return integer
     */
    public function getActivityState()
    {
        return $this->activity_state;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'activity';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Activity[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Activity
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
