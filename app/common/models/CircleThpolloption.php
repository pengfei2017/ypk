<?php

namespace Ypk\Models;

class CircleThpolloption extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $pollop_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $theme_id;

    /**
     *
     * @var string
     * @Column(type="string", length=80, nullable=false)
     */
    protected $pollop_option;

    /**
     *
     * @var integer
     * @Column(type="integer", length=8, nullable=false)
     */
    protected $pollop_votes;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $pollop_sort;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $pollop_votername;

    /**
     * Method to set the value of field pollop_id
     *
     * @param integer $pollop_id
     * @return $this
     */
    public function setPollopId($pollop_id)
    {
        $this->pollop_id = $pollop_id;

        return $this;
    }

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
     * Method to set the value of field pollop_option
     *
     * @param string $pollop_option
     * @return $this
     */
    public function setPollopOption($pollop_option)
    {
        $this->pollop_option = $pollop_option;

        return $this;
    }

    /**
     * Method to set the value of field pollop_votes
     *
     * @param integer $pollop_votes
     * @return $this
     */
    public function setPollopVotes($pollop_votes)
    {
        $this->pollop_votes = $pollop_votes;

        return $this;
    }

    /**
     * Method to set the value of field pollop_sort
     *
     * @param integer $pollop_sort
     * @return $this
     */
    public function setPollopSort($pollop_sort)
    {
        $this->pollop_sort = $pollop_sort;

        return $this;
    }

    /**
     * Method to set the value of field pollop_votername
     *
     * @param string $pollop_votername
     * @return $this
     */
    public function setPollopVotername($pollop_votername)
    {
        $this->pollop_votername = $pollop_votername;

        return $this;
    }

    /**
     * Returns the value of field pollop_id
     *
     * @return integer
     */
    public function getPollopId()
    {
        return $this->pollop_id;
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
     * Returns the value of field pollop_option
     *
     * @return string
     */
    public function getPollopOption()
    {
        return $this->pollop_option;
    }

    /**
     * Returns the value of field pollop_votes
     *
     * @return integer
     */
    public function getPollopVotes()
    {
        return $this->pollop_votes;
    }

    /**
     * Returns the value of field pollop_sort
     *
     * @return integer
     */
    public function getPollopSort()
    {
        return $this->pollop_sort;
    }

    /**
     * Returns the value of field pollop_votername
     *
     * @return string
     */
    public function getPollopVotername()
    {
        return $this->pollop_votername;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'circle_thpolloption';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CircleThpolloption[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CircleThpolloption
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
