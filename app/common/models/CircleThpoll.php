<?php

namespace Ypk\Models;

class CircleThpoll extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $theme_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $poll_multiple;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $poll_startime;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $poll_endtime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $poll_days;

    /**
     *
     * @var integer
     * @Column(type="integer", length=8, nullable=false)
     */
    protected $poll_voters;

    /**
     * Method to set the value of field theme_id
     *
     * @param integer $theme_id
     * @return $this
     */
    public function setThemeId($theme_id)
    {
        $this->theme_id = $theme_id;

        return $this;
    }

    /**
     * Method to set the value of field poll_multiple
     *
     * @param integer $poll_multiple
     * @return $this
     */
    public function setPollMultiple($poll_multiple)
    {
        $this->poll_multiple = $poll_multiple;

        return $this;
    }

    /**
     * Method to set the value of field poll_startime
     *
     * @param string $poll_startime
     * @return $this
     */
    public function setPollStartime($poll_startime)
    {
        $this->poll_startime = $poll_startime;

        return $this;
    }

    /**
     * Method to set the value of field poll_endtime
     *
     * @param string $poll_endtime
     * @return $this
     */
    public function setPollEndtime($poll_endtime)
    {
        $this->poll_endtime = $poll_endtime;

        return $this;
    }

    /**
     * Method to set the value of field poll_days
     *
     * @param integer $poll_days
     * @return $this
     */
    public function setPollDays($poll_days)
    {
        $this->poll_days = $poll_days;

        return $this;
    }

    /**
     * Method to set the value of field poll_voters
     *
     * @param integer $poll_voters
     * @return $this
     */
    public function setPollVoters($poll_voters)
    {
        $this->poll_voters = $poll_voters;

        return $this;
    }

    /**
     * Returns the value of field theme_id
     *
     * @return integer
     */
    public function getThemeId()
    {
        return $this->theme_id;
    }

    /**
     * Returns the value of field poll_multiple
     *
     * @return integer
     */
    public function getPollMultiple()
    {
        return $this->poll_multiple;
    }

    /**
     * Returns the value of field poll_startime
     *
     * @return string
     */
    public function getPollStartime()
    {
        return $this->poll_startime;
    }

    /**
     * Returns the value of field poll_endtime
     *
     * @return string
     */
    public function getPollEndtime()
    {
        return $this->poll_endtime;
    }

    /**
     * Returns the value of field poll_days
     *
     * @return integer
     */
    public function getPollDays()
    {
        return $this->poll_days;
    }

    /**
     * Returns the value of field poll_voters
     *
     * @return integer
     */
    public function getPollVoters()
    {
        return $this->poll_voters;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'circle_thpoll';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CircleThpoll[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CircleThpoll
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
