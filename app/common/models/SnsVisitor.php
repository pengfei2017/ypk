<?php

namespace Ypk\Models;

class SnsVisitor extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $v_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $v_mid;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $v_mname;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $v_mavatar;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $v_ownermid;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $v_ownermname;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $v_ownermavatar;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $v_addtime;

    /**
     * Method to set the value of field v_id
     *
     * @param integer $v_id
     * @return $this
     */
    public function setVId($v_id)
    {
        $this->v_id = $v_id;

        return $this;
    }

    /**
     * Method to set the value of field v_mid
     *
     * @param integer $v_mid
     * @return $this
     */
    public function setVMid($v_mid)
    {
        $this->v_mid = $v_mid;

        return $this;
    }

    /**
     * Method to set the value of field v_mname
     *
     * @param string $v_mname
     * @return $this
     */
    public function setVMname($v_mname)
    {
        $this->v_mname = $v_mname;

        return $this;
    }

    /**
     * Method to set the value of field v_mavatar
     *
     * @param string $v_mavatar
     * @return $this
     */
    public function setVMavatar($v_mavatar)
    {
        $this->v_mavatar = $v_mavatar;

        return $this;
    }

    /**
     * Method to set the value of field v_ownermid
     *
     * @param integer $v_ownermid
     * @return $this
     */
    public function setVOwnermid($v_ownermid)
    {
        $this->v_ownermid = $v_ownermid;

        return $this;
    }

    /**
     * Method to set the value of field v_ownermname
     *
     * @param string $v_ownermname
     * @return $this
     */
    public function setVOwnermname($v_ownermname)
    {
        $this->v_ownermname = $v_ownermname;

        return $this;
    }

    /**
     * Method to set the value of field v_ownermavatar
     *
     * @param string $v_ownermavatar
     * @return $this
     */
    public function setVOwnermavatar($v_ownermavatar)
    {
        $this->v_ownermavatar = $v_ownermavatar;

        return $this;
    }

    /**
     * Method to set the value of field v_addtime
     *
     * @param integer $v_addtime
     * @return $this
     */
    public function setVAddtime($v_addtime)
    {
        $this->v_addtime = $v_addtime;

        return $this;
    }

    /**
     * Returns the value of field v_id
     *
     * @return integer
     */
    public function getVId()
    {
        return $this->v_id;
    }

    /**
     * Returns the value of field v_mid
     *
     * @return integer
     */
    public function getVMid()
    {
        return $this->v_mid;
    }

    /**
     * Returns the value of field v_mname
     *
     * @return string
     */
    public function getVMname()
    {
        return $this->v_mname;
    }

    /**
     * Returns the value of field v_mavatar
     *
     * @return string
     */
    public function getVMavatar()
    {
        return $this->v_mavatar;
    }

    /**
     * Returns the value of field v_ownermid
     *
     * @return integer
     */
    public function getVOwnermid()
    {
        return $this->v_ownermid;
    }

    /**
     * Returns the value of field v_ownermname
     *
     * @return string
     */
    public function getVOwnermname()
    {
        return $this->v_ownermname;
    }

    /**
     * Returns the value of field v_ownermavatar
     *
     * @return string
     */
    public function getVOwnermavatar()
    {
        return $this->v_ownermavatar;
    }

    /**
     * Returns the value of field v_addtime
     *
     * @return integer
     */
    public function getVAddtime()
    {
        return $this->v_addtime;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'sns_visitor';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return SnsVisitor[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return SnsVisitor
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
