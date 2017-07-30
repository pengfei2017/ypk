<?php

namespace Ypk\Models;

class MemberMsgSetting extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     * @Primary
     * @Column(type="string", length=50, nullable=false)
     */
    protected $mmt_code;

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $member_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $is_receive;

    /**
     * Method to set the value of field mmt_code
     *
     * @param string $mmt_code
     * @return $this
     */
    public function setMmtCode($mmt_code)
    {
        $this->mmt_code = $mmt_code;

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
     * Method to set the value of field is_receive
     *
     * @param integer $is_receive
     * @return $this
     */
    public function setIsReceive($is_receive)
    {
        $this->is_receive = $is_receive;

        return $this;
    }

    /**
     * Returns the value of field mmt_code
     *
     * @return string
     */
    public function getMmtCode()
    {
        return $this->mmt_code;
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
     * Returns the value of field is_receive
     *
     * @return integer
     */
    public function getIsReceive()
    {
        return $this->is_receive;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'member_msg_setting';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MemberMsgSetting[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MemberMsgSetting
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
