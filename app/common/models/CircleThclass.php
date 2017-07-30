<?php

namespace Ypk\Models;

class CircleThclass extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $thclass_id;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=false)
     */
    protected $thclass_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $thclass_status;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $is_moderator;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $thclass_sort;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $circle_id;

    /**
     * Method to set the value of field thclass_id
     *
     * @param integer $thclass_id
     * @return $this
     */
    public function setThclassId($thclass_id)
    {
        $this->thclass_id = $thclass_id;

        return $this;
    }

    /**
     * Method to set the value of field thclass_name
     *
     * @param string $thclass_name
     * @return $this
     */
    public function setThclassName($thclass_name)
    {
        $this->thclass_name = $thclass_name;

        return $this;
    }

    /**
     * Method to set the value of field thclass_status
     *
     * @param integer $thclass_status
     * @return $this
     */
    public function setThclassStatus($thclass_status)
    {
        $this->thclass_status = $thclass_status;

        return $this;
    }

    /**
     * Method to set the value of field is_moderator
     *
     * @param integer $is_moderator
     * @return $this
     */
    public function setIsModerator($is_moderator)
    {
        $this->is_moderator = $is_moderator;

        return $this;
    }

    /**
     * Method to set the value of field thclass_sort
     *
     * @param integer $thclass_sort
     * @return $this
     */
    public function setThclassSort($thclass_sort)
    {
        $this->thclass_sort = $thclass_sort;

        return $this;
    }

    /**
     * Method to set the value of field circle_id
     *
     * @param integer $circle_id
     * @return $this
     */
    public function setCircleId($circle_id)
    {
        $this->circle_id = $circle_id;

        return $this;
    }

    /**
     * Returns the value of field thclass_id
     *
     * @return integer
     */
    public function getThclassId()
    {
        return $this->thclass_id;
    }

    /**
     * Returns the value of field thclass_name
     *
     * @return string
     */
    public function getThclassName()
    {
        return $this->thclass_name;
    }

    /**
     * Returns the value of field thclass_status
     *
     * @return integer
     */
    public function getThclassStatus()
    {
        return $this->thclass_status;
    }

    /**
     * Returns the value of field is_moderator
     *
     * @return integer
     */
    public function getIsModerator()
    {
        return $this->is_moderator;
    }

    /**
     * Returns the value of field thclass_sort
     *
     * @return integer
     */
    public function getThclassSort()
    {
        return $this->thclass_sort;
    }

    /**
     * Returns the value of field circle_id
     *
     * @return integer
     */
    public function getCircleId()
    {
        return $this->circle_id;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'circle_thclass';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CircleThclass[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CircleThclass
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
