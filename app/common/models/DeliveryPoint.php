<?php

namespace Ypk\Models;

class DeliveryPoint extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $dlyp_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $dlyp_name;

    /**
     *
     * @var string
     * @Column(type="string", length=32, nullable=false)
     */
    protected $dlyp_passwd;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=false)
     */
    protected $dlyp_truename;

    /**
     *
     * @var string
     * @Column(type="string", length=11, nullable=true)
     */
    protected $dlyp_mobile;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=true)
     */
    protected $dlyp_telephony;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=false)
     */
    protected $dlyp_address_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $dlyp_area_1;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $dlyp_area_2;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $dlyp_area_3;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $dlyp_area_4;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $dlyp_area;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $dlyp_area_info;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $dlyp_address;

    /**
     *
     * @var string
     * @Column(type="string", length=18, nullable=false)
     */
    protected $dlyp_idcard;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $dlyp_idcard_image;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $dlyp_addtime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $dlyp_state;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $dlyp_fail_reason;

    /**
     * Method to set the value of field dlyp_id
     *
     * @param integer $dlyp_id
     * @return $this
     */
    public function setDlypId($dlyp_id)
    {
        $this->dlyp_id = $dlyp_id;

        return $this;
    }

    /**
     * Method to set the value of field dlyp_name
     *
     * @param string $dlyp_name
     * @return $this
     */
    public function setDlypName($dlyp_name)
    {
        $this->dlyp_name = $dlyp_name;

        return $this;
    }

    /**
     * Method to set the value of field dlyp_passwd
     *
     * @param string $dlyp_passwd
     * @return $this
     */
    public function setDlypPasswd($dlyp_passwd)
    {
        $this->dlyp_passwd = $dlyp_passwd;

        return $this;
    }

    /**
     * Method to set the value of field dlyp_truename
     *
     * @param string $dlyp_truename
     * @return $this
     */
    public function setDlypTruename($dlyp_truename)
    {
        $this->dlyp_truename = $dlyp_truename;

        return $this;
    }

    /**
     * Method to set the value of field dlyp_mobile
     *
     * @param string $dlyp_mobile
     * @return $this
     */
    public function setDlypMobile($dlyp_mobile)
    {
        $this->dlyp_mobile = $dlyp_mobile;

        return $this;
    }

    /**
     * Method to set the value of field dlyp_telephony
     *
     * @param string $dlyp_telephony
     * @return $this
     */
    public function setDlypTelephony($dlyp_telephony)
    {
        $this->dlyp_telephony = $dlyp_telephony;

        return $this;
    }

    /**
     * Method to set the value of field dlyp_address_name
     *
     * @param string $dlyp_address_name
     * @return $this
     */
    public function setDlypAddressName($dlyp_address_name)
    {
        $this->dlyp_address_name = $dlyp_address_name;

        return $this;
    }

    /**
     * Method to set the value of field dlyp_area_1
     *
     * @param integer $dlyp_area_1
     * @return $this
     */
    public function setDlypArea1($dlyp_area_1)
    {
        $this->dlyp_area_1 = $dlyp_area_1;

        return $this;
    }

    /**
     * Method to set the value of field dlyp_area_2
     *
     * @param integer $dlyp_area_2
     * @return $this
     */
    public function setDlypArea2($dlyp_area_2)
    {
        $this->dlyp_area_2 = $dlyp_area_2;

        return $this;
    }

    /**
     * Method to set the value of field dlyp_area_3
     *
     * @param integer $dlyp_area_3
     * @return $this
     */
    public function setDlypArea3($dlyp_area_3)
    {
        $this->dlyp_area_3 = $dlyp_area_3;

        return $this;
    }

    /**
     * Method to set the value of field dlyp_area_4
     *
     * @param integer $dlyp_area_4
     * @return $this
     */
    public function setDlypArea4($dlyp_area_4)
    {
        $this->dlyp_area_4 = $dlyp_area_4;

        return $this;
    }

    /**
     * Method to set the value of field dlyp_area
     *
     * @param integer $dlyp_area
     * @return $this
     */
    public function setDlypArea($dlyp_area)
    {
        $this->dlyp_area = $dlyp_area;

        return $this;
    }

    /**
     * Method to set the value of field dlyp_area_info
     *
     * @param string $dlyp_area_info
     * @return $this
     */
    public function setDlypAreaInfo($dlyp_area_info)
    {
        $this->dlyp_area_info = $dlyp_area_info;

        return $this;
    }

    /**
     * Method to set the value of field dlyp_address
     *
     * @param string $dlyp_address
     * @return $this
     */
    public function setDlypAddress($dlyp_address)
    {
        $this->dlyp_address = $dlyp_address;

        return $this;
    }

    /**
     * Method to set the value of field dlyp_idcard
     *
     * @param string $dlyp_idcard
     * @return $this
     */
    public function setDlypIdcard($dlyp_idcard)
    {
        $this->dlyp_idcard = $dlyp_idcard;

        return $this;
    }

    /**
     * Method to set the value of field dlyp_idcard_image
     *
     * @param string $dlyp_idcard_image
     * @return $this
     */
    public function setDlypIdcardImage($dlyp_idcard_image)
    {
        $this->dlyp_idcard_image = $dlyp_idcard_image;

        return $this;
    }

    /**
     * Method to set the value of field dlyp_addtime
     *
     * @param integer $dlyp_addtime
     * @return $this
     */
    public function setDlypAddtime($dlyp_addtime)
    {
        $this->dlyp_addtime = $dlyp_addtime;

        return $this;
    }

    /**
     * Method to set the value of field dlyp_state
     *
     * @param integer $dlyp_state
     * @return $this
     */
    public function setDlypState($dlyp_state)
    {
        $this->dlyp_state = $dlyp_state;

        return $this;
    }

    /**
     * Method to set the value of field dlyp_fail_reason
     *
     * @param string $dlyp_fail_reason
     * @return $this
     */
    public function setDlypFailReason($dlyp_fail_reason)
    {
        $this->dlyp_fail_reason = $dlyp_fail_reason;

        return $this;
    }

    /**
     * Returns the value of field dlyp_id
     *
     * @return integer
     */
    public function getDlypId()
    {
        return $this->dlyp_id;
    }

    /**
     * Returns the value of field dlyp_name
     *
     * @return string
     */
    public function getDlypName()
    {
        return $this->dlyp_name;
    }

    /**
     * Returns the value of field dlyp_passwd
     *
     * @return string
     */
    public function getDlypPasswd()
    {
        return $this->dlyp_passwd;
    }

    /**
     * Returns the value of field dlyp_truename
     *
     * @return string
     */
    public function getDlypTruename()
    {
        return $this->dlyp_truename;
    }

    /**
     * Returns the value of field dlyp_mobile
     *
     * @return string
     */
    public function getDlypMobile()
    {
        return $this->dlyp_mobile;
    }

    /**
     * Returns the value of field dlyp_telephony
     *
     * @return string
     */
    public function getDlypTelephony()
    {
        return $this->dlyp_telephony;
    }

    /**
     * Returns the value of field dlyp_address_name
     *
     * @return string
     */
    public function getDlypAddressName()
    {
        return $this->dlyp_address_name;
    }

    /**
     * Returns the value of field dlyp_area_1
     *
     * @return integer
     */
    public function getDlypArea1()
    {
        return $this->dlyp_area_1;
    }

    /**
     * Returns the value of field dlyp_area_2
     *
     * @return integer
     */
    public function getDlypArea2()
    {
        return $this->dlyp_area_2;
    }

    /**
     * Returns the value of field dlyp_area_3
     *
     * @return integer
     */
    public function getDlypArea3()
    {
        return $this->dlyp_area_3;
    }

    /**
     * Returns the value of field dlyp_area_4
     *
     * @return integer
     */
    public function getDlypArea4()
    {
        return $this->dlyp_area_4;
    }

    /**
     * Returns the value of field dlyp_area
     *
     * @return integer
     */
    public function getDlypArea()
    {
        return $this->dlyp_area;
    }

    /**
     * Returns the value of field dlyp_area_info
     *
     * @return string
     */
    public function getDlypAreaInfo()
    {
        return $this->dlyp_area_info;
    }

    /**
     * Returns the value of field dlyp_address
     *
     * @return string
     */
    public function getDlypAddress()
    {
        return $this->dlyp_address;
    }

    /**
     * Returns the value of field dlyp_idcard
     *
     * @return string
     */
    public function getDlypIdcard()
    {
        return $this->dlyp_idcard;
    }

    /**
     * Returns the value of field dlyp_idcard_image
     *
     * @return string
     */
    public function getDlypIdcardImage()
    {
        return $this->dlyp_idcard_image;
    }

    /**
     * Returns the value of field dlyp_addtime
     *
     * @return integer
     */
    public function getDlypAddtime()
    {
        return $this->dlyp_addtime;
    }

    /**
     * Returns the value of field dlyp_state
     *
     * @return integer
     */
    public function getDlypState()
    {
        return $this->dlyp_state;
    }

    /**
     * Returns the value of field dlyp_fail_reason
     *
     * @return string
     */
    public function getDlypFailReason()
    {
        return $this->dlyp_fail_reason;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'delivery_point';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return DeliveryPoint[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return DeliveryPoint
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
