<?php

namespace Ypk\Models;

class CircleExptheme extends \Phalcon\Mvc\Model
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
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $et_exp;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $et_time;

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
     * Method to set the value of field et_exp
     *
     * @param integer $et_exp
     * @return $this
     */
    public function setEtExp($et_exp)
    {
        $this->et_exp = $et_exp;

        return $this;
    }

    /**
     * Method to set the value of field et_time
     *
     * @param string $et_time
     * @return $this
     */
    public function setEtTime($et_time)
    {
        $this->et_time = $et_time;

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
     * Returns the value of field et_exp
     *
     * @return integer
     */
    public function getEtExp()
    {
        return $this->et_exp;
    }

    /**
     * Returns the value of field et_time
     *
     * @return string
     */
    public function getEtTime()
    {
        return $this->et_time;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'circle_exptheme';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CircleExptheme[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CircleExptheme
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
