<?php

namespace Ypk\Models;

class CircleThpollvoter extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $theme_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $member_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $member_name;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $pollvo_options;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $pollvo_time;

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
     * Method to set the value of field pollvo_options
     *
     * @param string $pollvo_options
     * @return $this
     */
    public function setPollvoOptions($pollvo_options)
    {
        $this->pollvo_options = $pollvo_options;

        return $this;
    }

    /**
     * Method to set the value of field pollvo_time
     *
     * @param string $pollvo_time
     * @return $this
     */
    public function setPollvoTime($pollvo_time)
    {
        $this->pollvo_time = $pollvo_time;

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
     * Returns the value of field pollvo_options
     *
     * @return string
     */
    public function getPollvoOptions()
    {
        return $this->pollvo_options;
    }

    /**
     * Returns the value of field pollvo_time
     *
     * @return string
     */
    public function getPollvoTime()
    {
        return $this->pollvo_time;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'circle_thpollvoter';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CircleThpollvoter[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CircleThpollvoter
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
