<?php

namespace Ypk\Models;

class CircleMlref extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $mlref_id;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $mlref_name;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $mlref_addtime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $mlref_status;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $mlref_1;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $mlref_2;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $mlref_3;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $mlref_4;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $mlref_5;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $mlref_6;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $mlref_7;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $mlref_8;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $mlref_9;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $mlref_10;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $mlref_11;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $mlref_12;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $mlref_13;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $mlref_14;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $mlref_15;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $mlref_16;

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
     * Method to set the value of field mlref_name
     *
     * @param string $mlref_name
     * @return $this
     */
    public function setMlrefName($mlref_name)
    {
        $this->mlref_name = $mlref_name;

        return $this;
    }

    /**
     * Method to set the value of field mlref_addtime
     *
     * @param string $mlref_addtime
     * @return $this
     */
    public function setMlrefAddtime($mlref_addtime)
    {
        $this->mlref_addtime = $mlref_addtime;

        return $this;
    }

    /**
     * Method to set the value of field mlref_status
     *
     * @param integer $mlref_status
     * @return $this
     */
    public function setMlrefStatus($mlref_status)
    {
        $this->mlref_status = $mlref_status;

        return $this;
    }

    /**
     * Method to set the value of field mlref_1
     *
     * @param string $mlref_1
     * @return $this
     */
    public function setMlref1($mlref_1)
    {
        $this->mlref_1 = $mlref_1;

        return $this;
    }

    /**
     * Method to set the value of field mlref_2
     *
     * @param string $mlref_2
     * @return $this
     */
    public function setMlref2($mlref_2)
    {
        $this->mlref_2 = $mlref_2;

        return $this;
    }

    /**
     * Method to set the value of field mlref_3
     *
     * @param string $mlref_3
     * @return $this
     */
    public function setMlref3($mlref_3)
    {
        $this->mlref_3 = $mlref_3;

        return $this;
    }

    /**
     * Method to set the value of field mlref_4
     *
     * @param string $mlref_4
     * @return $this
     */
    public function setMlref4($mlref_4)
    {
        $this->mlref_4 = $mlref_4;

        return $this;
    }

    /**
     * Method to set the value of field mlref_5
     *
     * @param string $mlref_5
     * @return $this
     */
    public function setMlref5($mlref_5)
    {
        $this->mlref_5 = $mlref_5;

        return $this;
    }

    /**
     * Method to set the value of field mlref_6
     *
     * @param string $mlref_6
     * @return $this
     */
    public function setMlref6($mlref_6)
    {
        $this->mlref_6 = $mlref_6;

        return $this;
    }

    /**
     * Method to set the value of field mlref_7
     *
     * @param string $mlref_7
     * @return $this
     */
    public function setMlref7($mlref_7)
    {
        $this->mlref_7 = $mlref_7;

        return $this;
    }

    /**
     * Method to set the value of field mlref_8
     *
     * @param string $mlref_8
     * @return $this
     */
    public function setMlref8($mlref_8)
    {
        $this->mlref_8 = $mlref_8;

        return $this;
    }

    /**
     * Method to set the value of field mlref_9
     *
     * @param string $mlref_9
     * @return $this
     */
    public function setMlref9($mlref_9)
    {
        $this->mlref_9 = $mlref_9;

        return $this;
    }

    /**
     * Method to set the value of field mlref_10
     *
     * @param string $mlref_10
     * @return $this
     */
    public function setMlref10($mlref_10)
    {
        $this->mlref_10 = $mlref_10;

        return $this;
    }

    /**
     * Method to set the value of field mlref_11
     *
     * @param string $mlref_11
     * @return $this
     */
    public function setMlref11($mlref_11)
    {
        $this->mlref_11 = $mlref_11;

        return $this;
    }

    /**
     * Method to set the value of field mlref_12
     *
     * @param string $mlref_12
     * @return $this
     */
    public function setMlref12($mlref_12)
    {
        $this->mlref_12 = $mlref_12;

        return $this;
    }

    /**
     * Method to set the value of field mlref_13
     *
     * @param string $mlref_13
     * @return $this
     */
    public function setMlref13($mlref_13)
    {
        $this->mlref_13 = $mlref_13;

        return $this;
    }

    /**
     * Method to set the value of field mlref_14
     *
     * @param string $mlref_14
     * @return $this
     */
    public function setMlref14($mlref_14)
    {
        $this->mlref_14 = $mlref_14;

        return $this;
    }

    /**
     * Method to set the value of field mlref_15
     *
     * @param string $mlref_15
     * @return $this
     */
    public function setMlref15($mlref_15)
    {
        $this->mlref_15 = $mlref_15;

        return $this;
    }

    /**
     * Method to set the value of field mlref_16
     *
     * @param string $mlref_16
     * @return $this
     */
    public function setMlref16($mlref_16)
    {
        $this->mlref_16 = $mlref_16;

        return $this;
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
     * Returns the value of field mlref_name
     *
     * @return string
     */
    public function getMlrefName()
    {
        return $this->mlref_name;
    }

    /**
     * Returns the value of field mlref_addtime
     *
     * @return string
     */
    public function getMlrefAddtime()
    {
        return $this->mlref_addtime;
    }

    /**
     * Returns the value of field mlref_status
     *
     * @return integer
     */
    public function getMlrefStatus()
    {
        return $this->mlref_status;
    }

    /**
     * Returns the value of field mlref_1
     *
     * @return string
     */
    public function getMlref1()
    {
        return $this->mlref_1;
    }

    /**
     * Returns the value of field mlref_2
     *
     * @return string
     */
    public function getMlref2()
    {
        return $this->mlref_2;
    }

    /**
     * Returns the value of field mlref_3
     *
     * @return string
     */
    public function getMlref3()
    {
        return $this->mlref_3;
    }

    /**
     * Returns the value of field mlref_4
     *
     * @return string
     */
    public function getMlref4()
    {
        return $this->mlref_4;
    }

    /**
     * Returns the value of field mlref_5
     *
     * @return string
     */
    public function getMlref5()
    {
        return $this->mlref_5;
    }

    /**
     * Returns the value of field mlref_6
     *
     * @return string
     */
    public function getMlref6()
    {
        return $this->mlref_6;
    }

    /**
     * Returns the value of field mlref_7
     *
     * @return string
     */
    public function getMlref7()
    {
        return $this->mlref_7;
    }

    /**
     * Returns the value of field mlref_8
     *
     * @return string
     */
    public function getMlref8()
    {
        return $this->mlref_8;
    }

    /**
     * Returns the value of field mlref_9
     *
     * @return string
     */
    public function getMlref9()
    {
        return $this->mlref_9;
    }

    /**
     * Returns the value of field mlref_10
     *
     * @return string
     */
    public function getMlref10()
    {
        return $this->mlref_10;
    }

    /**
     * Returns the value of field mlref_11
     *
     * @return string
     */
    public function getMlref11()
    {
        return $this->mlref_11;
    }

    /**
     * Returns the value of field mlref_12
     *
     * @return string
     */
    public function getMlref12()
    {
        return $this->mlref_12;
    }

    /**
     * Returns the value of field mlref_13
     *
     * @return string
     */
    public function getMlref13()
    {
        return $this->mlref_13;
    }

    /**
     * Returns the value of field mlref_14
     *
     * @return string
     */
    public function getMlref14()
    {
        return $this->mlref_14;
    }

    /**
     * Returns the value of field mlref_15
     *
     * @return string
     */
    public function getMlref15()
    {
        return $this->mlref_15;
    }

    /**
     * Returns the value of field mlref_16
     *
     * @return string
     */
    public function getMlref16()
    {
        return $this->mlref_16;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'circle_mlref';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CircleMlref[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CircleMlref
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
