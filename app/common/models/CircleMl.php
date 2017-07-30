<?php

namespace Ypk\Models;

class CircleMl extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $circle_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $mlref_id;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $ml_1;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $ml_2;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $ml_3;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $ml_4;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $ml_5;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $ml_6;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $ml_7;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $ml_8;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $ml_9;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $ml_10;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $ml_11;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $ml_12;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $ml_13;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $ml_14;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $ml_15;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $ml_16;

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
     * Method to set the value of field mlref_id
     *
     * @param integer $mlref_id
     * @return $this
     */
    public function setMlrefId($mlref_id)
    {
        $this->mlref_id = $mlref_id;

        return $this;
    }

    /**
     * Method to set the value of field ml_1
     *
     * @param string $ml_1
     * @return $this
     */
    public function setMl1($ml_1)
    {
        $this->ml_1 = $ml_1;

        return $this;
    }

    /**
     * Method to set the value of field ml_2
     *
     * @param string $ml_2
     * @return $this
     */
    public function setMl2($ml_2)
    {
        $this->ml_2 = $ml_2;

        return $this;
    }

    /**
     * Method to set the value of field ml_3
     *
     * @param string $ml_3
     * @return $this
     */
    public function setMl3($ml_3)
    {
        $this->ml_3 = $ml_3;

        return $this;
    }

    /**
     * Method to set the value of field ml_4
     *
     * @param string $ml_4
     * @return $this
     */
    public function setMl4($ml_4)
    {
        $this->ml_4 = $ml_4;

        return $this;
    }

    /**
     * Method to set the value of field ml_5
     *
     * @param string $ml_5
     * @return $this
     */
    public function setMl5($ml_5)
    {
        $this->ml_5 = $ml_5;

        return $this;
    }

    /**
     * Method to set the value of field ml_6
     *
     * @param string $ml_6
     * @return $this
     */
    public function setMl6($ml_6)
    {
        $this->ml_6 = $ml_6;

        return $this;
    }

    /**
     * Method to set the value of field ml_7
     *
     * @param string $ml_7
     * @return $this
     */
    public function setMl7($ml_7)
    {
        $this->ml_7 = $ml_7;

        return $this;
    }

    /**
     * Method to set the value of field ml_8
     *
     * @param string $ml_8
     * @return $this
     */
    public function setMl8($ml_8)
    {
        $this->ml_8 = $ml_8;

        return $this;
    }

    /**
     * Method to set the value of field ml_9
     *
     * @param string $ml_9
     * @return $this
     */
    public function setMl9($ml_9)
    {
        $this->ml_9 = $ml_9;

        return $this;
    }

    /**
     * Method to set the value of field ml_10
     *
     * @param string $ml_10
     * @return $this
     */
    public function setMl10($ml_10)
    {
        $this->ml_10 = $ml_10;

        return $this;
    }

    /**
     * Method to set the value of field ml_11
     *
     * @param string $ml_11
     * @return $this
     */
    public function setMl11($ml_11)
    {
        $this->ml_11 = $ml_11;

        return $this;
    }

    /**
     * Method to set the value of field ml_12
     *
     * @param string $ml_12
     * @return $this
     */
    public function setMl12($ml_12)
    {
        $this->ml_12 = $ml_12;

        return $this;
    }

    /**
     * Method to set the value of field ml_13
     *
     * @param string $ml_13
     * @return $this
     */
    public function setMl13($ml_13)
    {
        $this->ml_13 = $ml_13;

        return $this;
    }

    /**
     * Method to set the value of field ml_14
     *
     * @param string $ml_14
     * @return $this
     */
    public function setMl14($ml_14)
    {
        $this->ml_14 = $ml_14;

        return $this;
    }

    /**
     * Method to set the value of field ml_15
     *
     * @param string $ml_15
     * @return $this
     */
    public function setMl15($ml_15)
    {
        $this->ml_15 = $ml_15;

        return $this;
    }

    /**
     * Method to set the value of field ml_16
     *
     * @param string $ml_16
     * @return $this
     */
    public function setMl16($ml_16)
    {
        $this->ml_16 = $ml_16;

        return $this;
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
     * Returns the value of field mlref_id
     *
     * @return integer
     */
    public function getMlrefId()
    {
        return $this->mlref_id;
    }

    /**
     * Returns the value of field ml_1
     *
     * @return string
     */
    public function getMl1()
    {
        return $this->ml_1;
    }

    /**
     * Returns the value of field ml_2
     *
     * @return string
     */
    public function getMl2()
    {
        return $this->ml_2;
    }

    /**
     * Returns the value of field ml_3
     *
     * @return string
     */
    public function getMl3()
    {
        return $this->ml_3;
    }

    /**
     * Returns the value of field ml_4
     *
     * @return string
     */
    public function getMl4()
    {
        return $this->ml_4;
    }

    /**
     * Returns the value of field ml_5
     *
     * @return string
     */
    public function getMl5()
    {
        return $this->ml_5;
    }

    /**
     * Returns the value of field ml_6
     *
     * @return string
     */
    public function getMl6()
    {
        return $this->ml_6;
    }

    /**
     * Returns the value of field ml_7
     *
     * @return string
     */
    public function getMl7()
    {
        return $this->ml_7;
    }

    /**
     * Returns the value of field ml_8
     *
     * @return string
     */
    public function getMl8()
    {
        return $this->ml_8;
    }

    /**
     * Returns the value of field ml_9
     *
     * @return string
     */
    public function getMl9()
    {
        return $this->ml_9;
    }

    /**
     * Returns the value of field ml_10
     *
     * @return string
     */
    public function getMl10()
    {
        return $this->ml_10;
    }

    /**
     * Returns the value of field ml_11
     *
     * @return string
     */
    public function getMl11()
    {
        return $this->ml_11;
    }

    /**
     * Returns the value of field ml_12
     *
     * @return string
     */
    public function getMl12()
    {
        return $this->ml_12;
    }

    /**
     * Returns the value of field ml_13
     *
     * @return string
     */
    public function getMl13()
    {
        return $this->ml_13;
    }

    /**
     * Returns the value of field ml_14
     *
     * @return string
     */
    public function getMl14()
    {
        return $this->ml_14;
    }

    /**
     * Returns the value of field ml_15
     *
     * @return string
     */
    public function getMl15()
    {
        return $this->ml_15;
    }

    /**
     * Returns the value of field ml_16
     *
     * @return string
     */
    public function getMl16()
    {
        return $this->ml_16;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'circle_ml';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CircleMl[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CircleMl
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
