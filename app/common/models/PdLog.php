<?php

namespace Ypk\Models;

class PdLog extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $lg_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $lg_member_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $lg_member_name;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $lg_admin_name;

    /**
     *
     * @var string
     * @Column(type="string", length=15, nullable=false)
     */
    protected $lg_type;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $lg_av_amount;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $lg_freeze_amount;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $lg_add_time;

    /**
     *
     * @var string
     * @Column(type="string", length=150, nullable=true)
     */
    protected $lg_desc;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $lg_invite_member_id;

    /**
     * Method to set the value of field lg_id
     *
     * @param integer $lg_id
     * @return $this
     */
    public function setLgId($lg_id)
    {
        $this->lg_id = $lg_id;

        return $this;
    }

    /**
     * Method to set the value of field lg_member_id
     *
     * @param integer $lg_member_id
     * @return $this
     */
    public function setLgMemberId($lg_member_id)
    {
        $this->lg_member_id = $lg_member_id;

        return $this;
    }

    /**
     * Method to set the value of field lg_member_name
     *
     * @param string $lg_member_name
     * @return $this
     */
    public function setLgMemberName($lg_member_name)
    {
        $this->lg_member_name = $lg_member_name;

        return $this;
    }

    /**
     * Method to set the value of field lg_admin_name
     *
     * @param string $lg_admin_name
     * @return $this
     */
    public function setLgAdminName($lg_admin_name)
    {
        $this->lg_admin_name = $lg_admin_name;

        return $this;
    }

    /**
     * Method to set the value of field lg_type
     *
     * @param string $lg_type
     * @return $this
     */
    public function setLgType($lg_type)
    {
        $this->lg_type = $lg_type;

        return $this;
    }

    /**
     * Method to set the value of field lg_av_amount
     *
     * @param double $lg_av_amount
     * @return $this
     */
    public function setLgAvAmount($lg_av_amount)
    {
        $this->lg_av_amount = $lg_av_amount;

        return $this;
    }

    /**
     * Method to set the value of field lg_freeze_amount
     *
     * @param double $lg_freeze_amount
     * @return $this
     */
    public function setLgFreezeAmount($lg_freeze_amount)
    {
        $this->lg_freeze_amount = $lg_freeze_amount;

        return $this;
    }

    /**
     * Method to set the value of field lg_add_time
     *
     * @param integer $lg_add_time
     * @return $this
     */
    public function setLgAddTime($lg_add_time)
    {
        $this->lg_add_time = $lg_add_time;

        return $this;
    }

    /**
     * Method to set the value of field lg_desc
     *
     * @param string $lg_desc
     * @return $this
     */
    public function setLgDesc($lg_desc)
    {
        $this->lg_desc = $lg_desc;

        return $this;
    }

    /**
     * Method to set the value of field lg_invite_member_id
     *
     * @param integer $lg_invite_member_id
     * @return $this
     */
    public function setLgInviteMemberId($lg_invite_member_id)
    {
        $this->lg_invite_member_id = $lg_invite_member_id;

        return $this;
    }

    /**
     * Returns the value of field lg_id
     *
     * @return integer
     */
    public function getLgId()
    {
        return $this->lg_id;
    }

    /**
     * Returns the value of field lg_member_id
     *
     * @return integer
     */
    public function getLgMemberId()
    {
        return $this->lg_member_id;
    }

    /**
     * Returns the value of field lg_member_name
     *
     * @return string
     */
    public function getLgMemberName()
    {
        return $this->lg_member_name;
    }

    /**
     * Returns the value of field lg_admin_name
     *
     * @return string
     */
    public function getLgAdminName()
    {
        return $this->lg_admin_name;
    }

    /**
     * Returns the value of field lg_type
     *
     * @return string
     */
    public function getLgType()
    {
        return $this->lg_type;
    }

    /**
     * Returns the value of field lg_av_amount
     *
     * @return double
     */
    public function getLgAvAmount()
    {
        return $this->lg_av_amount;
    }

    /**
     * Returns the value of field lg_freeze_amount
     *
     * @return double
     */
    public function getLgFreezeAmount()
    {
        return $this->lg_freeze_amount;
    }

    /**
     * Returns the value of field lg_add_time
     *
     * @return integer
     */
    public function getLgAddTime()
    {
        return $this->lg_add_time;
    }

    /**
     * Returns the value of field lg_desc
     *
     * @return string
     */
    public function getLgDesc()
    {
        return $this->lg_desc;
    }

    /**
     * Returns the value of field lg_invite_member_id
     *
     * @return integer
     */
    public function getLgInviteMemberId()
    {
        return $this->lg_invite_member_id;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'pd_log';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return PdLog[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return PdLog
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
