<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/4
 * Time: 23:05
 */

namespace Ypk\Models;


class MemberExtend  extends \Phalcon\Mvc\Model
{
    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $member_id;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=true)
     */
    protected $account_pay;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=true)
     */
    protected $account_wx;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=true)
     */
    protected $account_bank;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=true)
     */
    protected $bank_type;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=true)
     */
    protected $bank_class;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=true)
     */
    protected $bank_name;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=true)
     */
    protected $bank_address;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getMemberId()
    {
        return $this->member_id;
    }

    /**
     * @param int $member_id
     */
    public function setMemberId($member_id)
    {
        $this->member_id = $member_id;
    }

    /**
     * @return string
     */
    public function getAccountPay()
    {
        return $this->account_pay;
    }

    /**
     * @param string $account_pay
     */
    public function setAccountPay($account_pay)
    {
        $this->account_pay = $account_pay;
    }

    /**
     * @return string
     */
    public function getAccountWx()
    {
        return $this->account_wx;
    }

    /**
     * @param string $account_wx
     */
    public function setAccountWx($account_wx)
    {
        $this->account_wx = $account_wx;
    }

    /**
     * @return string
     */
    public function getAccountBank()
    {
        return $this->account_bank;
    }

    /**
     * @param string $account_bank
     */
    public function setAccountBank($account_bank)
    {
        $this->account_bank = $account_bank;
    }

    /**
     * @return string
     */
    public function getBankType()
    {
        return $this->bank_type;
    }

    /**
     * @param string $bank_type
     */
    public function setBankType($bank_type)
    {
        $this->bank_type = $bank_type;
    }

    /**
     * @return string
     */
    public function getBankClass()
    {
        return $this->bank_class;
    }

    /**
     * @param string $bank_class
     */
    public function setBankClass($bank_class)
    {
        $this->bank_class = $bank_class;
    }

    /**
     * @return string
     */
    public function getBankName()
    {
        return $this->bank_name;
    }

    /**
     * @param string $bank_name
     */
    public function setBankName($bank_name)
    {
        $this->bank_name = $bank_name;
    }

    /**
     * @return string
     */
    public function getBankAddress()
    {
        return $this->bank_address;
    }

    /**
     * @param string $bank_address
     */
    public function setBankAddress($bank_address)
    {
        $this->bank_address = $bank_address;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'member_extend';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MemberCommon[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MemberCommon
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }
}