<?php

namespace Ypk\Models;

class Adv extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=8, nullable=false)
     */
    protected $adv_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=8, nullable=false)
     */
    protected $ap_id;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $adv_title;

    /**
     *
     * @var string
     * @Column(type="string", length=1000, nullable=false)
     */
    protected $adv_content;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $adv_start_date;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $adv_end_date;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $slide_sort;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $member_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $member_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $click_num;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $is_allow;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $buy_style;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $goldpay;

    /**
     * Method to set the value of field adv_id
     *
     * @param integer $adv_id
     * @return $this
     */
    public function setAdvId($adv_id)
    {
        $this->adv_id = $adv_id;

        return $this;
    }

    /**
     * Method to set the value of field ap_id
     *
     * @param integer $ap_id
     * @return $this
     */
    public function setApId($ap_id)
    {
        $this->ap_id = $ap_id;

        return $this;
    }

    /**
     * Method to set the value of field adv_title
     *
     * @param string $adv_title
     * @return $this
     */
    public function setAdvTitle($adv_title)
    {
        $this->adv_title = $adv_title;

        return $this;
    }

    /**
     * Method to set the value of field adv_content
     *
     * @param string $adv_content
     * @return $this
     */
    public function setAdvContent($adv_content)
    {
        $this->adv_content = $adv_content;

        return $this;
    }

    /**
     * Method to set the value of field adv_start_date
     *
     * @param integer $adv_start_date
     * @return $this
     */
    public function setAdvStartDate($adv_start_date)
    {
        $this->adv_start_date = $adv_start_date;

        return $this;
    }

    /**
     * Method to set the value of field adv_end_date
     *
     * @param integer $adv_end_date
     * @return $this
     */
    public function setAdvEndDate($adv_end_date)
    {
        $this->adv_end_date = $adv_end_date;

        return $this;
    }

    /**
     * Method to set the value of field slide_sort
     *
     * @param integer $slide_sort
     * @return $this
     */
    public function setSlideSort($slide_sort)
    {
        $this->slide_sort = $slide_sort;

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
     * Method to set the value of field member_name
     *
     * @param string $member_name
     * @return $this
     */
    public function setMemberName($member_name)
    {
        $this->member_name = $member_name;

        return $this;
    }

    /**
     * Method to set the value of field click_num
     *
     * @param integer $click_num
     * @return $this
     */
    public function setClickNum($click_num)
    {
        $this->click_num = $click_num;

        return $this;
    }

    /**
     * Method to set the value of field is_allow
     *
     * @param integer $is_allow
     * @return $this
     */
    public function setIsAllow($is_allow)
    {
        $this->is_allow = $is_allow;

        return $this;
    }

    /**
     * Method to set the value of field buy_style
     *
     * @param string $buy_style
     * @return $this
     */
    public function setBuyStyle($buy_style)
    {
        $this->buy_style = $buy_style;

        return $this;
    }

    /**
     * Method to set the value of field goldpay
     *
     * @param integer $goldpay
     * @return $this
     */
    public function setGoldpay($goldpay)
    {
        $this->goldpay = $goldpay;

        return $this;
    }

    /**
     * Returns the value of field adv_id
     *
     * @return integer
     */
    public function getAdvId()
    {
        return $this->adv_id;
    }

    /**
     * Returns the value of field ap_id
     *
     * @return integer
     */
    public function getApId()
    {
        return $this->ap_id;
    }

    /**
     * Returns the value of field adv_title
     *
     * @return string
     */
    public function getAdvTitle()
    {
        return $this->adv_title;
    }

    /**
     * Returns the value of field adv_content
     *
     * @return string
     */
    public function getAdvContent()
    {
        return $this->adv_content;
    }

    /**
     * Returns the value of field adv_start_date
     *
     * @return integer
     */
    public function getAdvStartDate()
    {
        return $this->adv_start_date;
    }

    /**
     * Returns the value of field adv_end_date
     *
     * @return integer
     */
    public function getAdvEndDate()
    {
        return $this->adv_end_date;
    }

    /**
     * Returns the value of field slide_sort
     *
     * @return integer
     */
    public function getSlideSort()
    {
        return $this->slide_sort;
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
     * Returns the value of field member_name
     *
     * @return string
     */
    public function getMemberName()
    {
        return $this->member_name;
    }

    /**
     * Returns the value of field click_num
     *
     * @return integer
     */
    public function getClickNum()
    {
        return $this->click_num;
    }

    /**
     * Returns the value of field is_allow
     *
     * @return integer
     */
    public function getIsAllow()
    {
        return $this->is_allow;
    }

    /**
     * Returns the value of field buy_style
     *
     * @return string
     */
    public function getBuyStyle()
    {
        return $this->buy_style;
    }

    /**
     * Returns the value of field goldpay
     *
     * @return integer
     */
    public function getGoldpay()
    {
        return $this->goldpay;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'adv';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Adv[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Adv
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
