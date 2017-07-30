<?php

namespace Ypk\Models;

class Invoice extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $inv_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $member_id;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $inv_state;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $inv_title;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=true)
     */
    protected $inv_content;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $inv_company;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $inv_code;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $inv_reg_addr;

    /**
     *
     * @var string
     * @Column(type="string", length=30, nullable=true)
     */
    protected $inv_reg_phone;

    /**
     *
     * @var string
     * @Column(type="string", length=30, nullable=true)
     */
    protected $inv_reg_bname;

    /**
     *
     * @var string
     * @Column(type="string", length=30, nullable=true)
     */
    protected $inv_reg_baccount;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=true)
     */
    protected $inv_rec_name;

    /**
     *
     * @var string
     * @Column(type="string", length=15, nullable=true)
     */
    protected $inv_rec_mobphone;

    /**
     *
     * @var string
     * @Column(type="string", length=30, nullable=true)
     */
    protected $inv_rec_province;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $inv_goto_addr;

    /**
     * Method to set the value of field inv_id
     *
     * @param integer $inv_id
     * @return $this
     */
    public function setInvId($inv_id)
    {
        $this->inv_id = $inv_id;

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
     * Method to set the value of field inv_state
     *
     * @param string $inv_state
     * @return $this
     */
    public function setInvState($inv_state)
    {
        $this->inv_state = $inv_state;

        return $this;
    }

    /**
     * Method to set the value of field inv_title
     *
     * @param string $inv_title
     * @return $this
     */
    public function setInvTitle($inv_title)
    {
        $this->inv_title = $inv_title;

        return $this;
    }

    /**
     * Method to set the value of field inv_content
     *
     * @param string $inv_content
     * @return $this
     */
    public function setInvContent($inv_content)
    {
        $this->inv_content = $inv_content;

        return $this;
    }

    /**
     * Method to set the value of field inv_company
     *
     * @param string $inv_company
     * @return $this
     */
    public function setInvCompany($inv_company)
    {
        $this->inv_company = $inv_company;

        return $this;
    }

    /**
     * Method to set the value of field inv_code
     *
     * @param string $inv_code
     * @return $this
     */
    public function setInvCode($inv_code)
    {
        $this->inv_code = $inv_code;

        return $this;
    }

    /**
     * Method to set the value of field inv_reg_addr
     *
     * @param string $inv_reg_addr
     * @return $this
     */
    public function setInvRegAddr($inv_reg_addr)
    {
        $this->inv_reg_addr = $inv_reg_addr;

        return $this;
    }

    /**
     * Method to set the value of field inv_reg_phone
     *
     * @param string $inv_reg_phone
     * @return $this
     */
    public function setInvRegPhone($inv_reg_phone)
    {
        $this->inv_reg_phone = $inv_reg_phone;

        return $this;
    }

    /**
     * Method to set the value of field inv_reg_bname
     *
     * @param string $inv_reg_bname
     * @return $this
     */
    public function setInvRegBname($inv_reg_bname)
    {
        $this->inv_reg_bname = $inv_reg_bname;

        return $this;
    }

    /**
     * Method to set the value of field inv_reg_baccount
     *
     * @param string $inv_reg_baccount
     * @return $this
     */
    public function setInvRegBaccount($inv_reg_baccount)
    {
        $this->inv_reg_baccount = $inv_reg_baccount;

        return $this;
    }

    /**
     * Method to set the value of field inv_rec_name
     *
     * @param string $inv_rec_name
     * @return $this
     */
    public function setInvRecName($inv_rec_name)
    {
        $this->inv_rec_name = $inv_rec_name;

        return $this;
    }

    /**
     * Method to set the value of field inv_rec_mobphone
     *
     * @param string $inv_rec_mobphone
     * @return $this
     */
    public function setInvRecMobphone($inv_rec_mobphone)
    {
        $this->inv_rec_mobphone = $inv_rec_mobphone;

        return $this;
    }

    /**
     * Method to set the value of field inv_rec_province
     *
     * @param string $inv_rec_province
     * @return $this
     */
    public function setInvRecProvince($inv_rec_province)
    {
        $this->inv_rec_province = $inv_rec_province;

        return $this;
    }

    /**
     * Method to set the value of field inv_goto_addr
     *
     * @param string $inv_goto_addr
     * @return $this
     */
    public function setInvGotoAddr($inv_goto_addr)
    {
        $this->inv_goto_addr = $inv_goto_addr;

        return $this;
    }

    /**
     * Returns the value of field inv_id
     *
     * @return integer
     */
    public function getInvId()
    {
        return $this->inv_id;
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
     * Returns the value of field inv_state
     *
     * @return string
     */
    public function getInvState()
    {
        return $this->inv_state;
    }

    /**
     * Returns the value of field inv_title
     *
     * @return string
     */
    public function getInvTitle()
    {
        return $this->inv_title;
    }

    /**
     * Returns the value of field inv_content
     *
     * @return string
     */
    public function getInvContent()
    {
        return $this->inv_content;
    }

    /**
     * Returns the value of field inv_company
     *
     * @return string
     */
    public function getInvCompany()
    {
        return $this->inv_company;
    }

    /**
     * Returns the value of field inv_code
     *
     * @return string
     */
    public function getInvCode()
    {
        return $this->inv_code;
    }

    /**
     * Returns the value of field inv_reg_addr
     *
     * @return string
     */
    public function getInvRegAddr()
    {
        return $this->inv_reg_addr;
    }

    /**
     * Returns the value of field inv_reg_phone
     *
     * @return string
     */
    public function getInvRegPhone()
    {
        return $this->inv_reg_phone;
    }

    /**
     * Returns the value of field inv_reg_bname
     *
     * @return string
     */
    public function getInvRegBname()
    {
        return $this->inv_reg_bname;
    }

    /**
     * Returns the value of field inv_reg_baccount
     *
     * @return string
     */
    public function getInvRegBaccount()
    {
        return $this->inv_reg_baccount;
    }

    /**
     * Returns the value of field inv_rec_name
     *
     * @return string
     */
    public function getInvRecName()
    {
        return $this->inv_rec_name;
    }

    /**
     * Returns the value of field inv_rec_mobphone
     *
     * @return string
     */
    public function getInvRecMobphone()
    {
        return $this->inv_rec_mobphone;
    }

    /**
     * Returns the value of field inv_rec_province
     *
     * @return string
     */
    public function getInvRecProvince()
    {
        return $this->inv_rec_province;
    }

    /**
     * Returns the value of field inv_goto_addr
     *
     * @return string
     */
    public function getInvGotoAddr()
    {
        return $this->inv_goto_addr;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'invoice';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Invoice[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Invoice
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
