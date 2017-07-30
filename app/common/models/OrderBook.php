<?php

namespace Ypk\Models;

class OrderBook extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $book_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $book_order_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=true)
     */
    protected $book_step;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    protected $book_amount;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    protected $book_pd_amount;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    protected $book_rcb_amount;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=true)
     */
    protected $book_pay_name;

    /**
     *
     * @var string
     * @Column(type="string", length=40, nullable=true)
     */
    protected $book_trade_no;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $book_pay_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $book_end_time;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=true)
     */
    protected $book_buyer_phone;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    protected $book_deposit_amount;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=true)
     */
    protected $book_pay_notice;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    protected $book_real_pay;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $book_cancel_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $book_store_id;

    /**
     * Method to set the value of field book_id
     *
     * @param integer $book_id
     * @return $this
     */
    public function setBookId($book_id)
    {
        $this->book_id = $book_id;

        return $this;
    }

    /**
     * Method to set the value of field book_order_id
     *
     * @param integer $book_order_id
     * @return $this
     */
    public function setBookOrderId($book_order_id)
    {
        $this->book_order_id = $book_order_id;

        return $this;
    }

    /**
     * Method to set the value of field book_step
     *
     * @param integer $book_step
     * @return $this
     */
    public function setBookStep($book_step)
    {
        $this->book_step = $book_step;

        return $this;
    }

    /**
     * Method to set the value of field book_amount
     *
     * @param double $book_amount
     * @return $this
     */
    public function setBookAmount($book_amount)
    {
        $this->book_amount = $book_amount;

        return $this;
    }

    /**
     * Method to set the value of field book_pd_amount
     *
     * @param double $book_pd_amount
     * @return $this
     */
    public function setBookPdAmount($book_pd_amount)
    {
        $this->book_pd_amount = $book_pd_amount;

        return $this;
    }

    /**
     * Method to set the value of field book_rcb_amount
     *
     * @param double $book_rcb_amount
     * @return $this
     */
    public function setBookRcbAmount($book_rcb_amount)
    {
        $this->book_rcb_amount = $book_rcb_amount;

        return $this;
    }

    /**
     * Method to set the value of field book_pay_name
     *
     * @param string $book_pay_name
     * @return $this
     */
    public function setBookPayName($book_pay_name)
    {
        $this->book_pay_name = $book_pay_name;

        return $this;
    }

    /**
     * Method to set the value of field book_trade_no
     *
     * @param string $book_trade_no
     * @return $this
     */
    public function setBookTradeNo($book_trade_no)
    {
        $this->book_trade_no = $book_trade_no;

        return $this;
    }

    /**
     * Method to set the value of field book_pay_time
     *
     * @param integer $book_pay_time
     * @return $this
     */
    public function setBookPayTime($book_pay_time)
    {
        $this->book_pay_time = $book_pay_time;

        return $this;
    }

    /**
     * Method to set the value of field book_end_time
     *
     * @param integer $book_end_time
     * @return $this
     */
    public function setBookEndTime($book_end_time)
    {
        $this->book_end_time = $book_end_time;

        return $this;
    }

    /**
     * Method to set the value of field book_buyer_phone
     *
     * @param string $book_buyer_phone
     * @return $this
     */
    public function setBookBuyerPhone($book_buyer_phone)
    {
        $this->book_buyer_phone = $book_buyer_phone;

        return $this;
    }

    /**
     * Method to set the value of field book_deposit_amount
     *
     * @param double $book_deposit_amount
     * @return $this
     */
    public function setBookDepositAmount($book_deposit_amount)
    {
        $this->book_deposit_amount = $book_deposit_amount;

        return $this;
    }

    /**
     * Method to set the value of field book_pay_notice
     *
     * @param integer $book_pay_notice
     * @return $this
     */
    public function setBookPayNotice($book_pay_notice)
    {
        $this->book_pay_notice = $book_pay_notice;

        return $this;
    }

    /**
     * Method to set the value of field book_real_pay
     *
     * @param double $book_real_pay
     * @return $this
     */
    public function setBookRealPay($book_real_pay)
    {
        $this->book_real_pay = $book_real_pay;

        return $this;
    }

    /**
     * Method to set the value of field book_cancel_time
     *
     * @param integer $book_cancel_time
     * @return $this
     */
    public function setBookCancelTime($book_cancel_time)
    {
        $this->book_cancel_time = $book_cancel_time;

        return $this;
    }

    /**
     * Method to set the value of field book_store_id
     *
     * @param integer $book_store_id
     * @return $this
     */
    public function setBookStoreId($book_store_id)
    {
        $this->book_store_id = $book_store_id;

        return $this;
    }

    /**
     * Returns the value of field book_id
     *
     * @return integer
     */
    public function getBookId()
    {
        return $this->book_id;
    }

    /**
     * Returns the value of field book_order_id
     *
     * @return integer
     */
    public function getBookOrderId()
    {
        return $this->book_order_id;
    }

    /**
     * Returns the value of field book_step
     *
     * @return integer
     */
    public function getBookStep()
    {
        return $this->book_step;
    }

    /**
     * Returns the value of field book_amount
     *
     * @return double
     */
    public function getBookAmount()
    {
        return $this->book_amount;
    }

    /**
     * Returns the value of field book_pd_amount
     *
     * @return double
     */
    public function getBookPdAmount()
    {
        return $this->book_pd_amount;
    }

    /**
     * Returns the value of field book_rcb_amount
     *
     * @return double
     */
    public function getBookRcbAmount()
    {
        return $this->book_rcb_amount;
    }

    /**
     * Returns the value of field book_pay_name
     *
     * @return string
     */
    public function getBookPayName()
    {
        return $this->book_pay_name;
    }

    /**
     * Returns the value of field book_trade_no
     *
     * @return string
     */
    public function getBookTradeNo()
    {
        return $this->book_trade_no;
    }

    /**
     * Returns the value of field book_pay_time
     *
     * @return integer
     */
    public function getBookPayTime()
    {
        return $this->book_pay_time;
    }

    /**
     * Returns the value of field book_end_time
     *
     * @return integer
     */
    public function getBookEndTime()
    {
        return $this->book_end_time;
    }

    /**
     * Returns the value of field book_buyer_phone
     *
     * @return string
     */
    public function getBookBuyerPhone()
    {
        return $this->book_buyer_phone;
    }

    /**
     * Returns the value of field book_deposit_amount
     *
     * @return double
     */
    public function getBookDepositAmount()
    {
        return $this->book_deposit_amount;
    }

    /**
     * Returns the value of field book_pay_notice
     *
     * @return integer
     */
    public function getBookPayNotice()
    {
        return $this->book_pay_notice;
    }

    /**
     * Returns the value of field book_real_pay
     *
     * @return double
     */
    public function getBookRealPay()
    {
        return $this->book_real_pay;
    }

    /**
     * Returns the value of field book_cancel_time
     *
     * @return integer
     */
    public function getBookCancelTime()
    {
        return $this->book_cancel_time;
    }

    /**
     * Returns the value of field book_store_id
     *
     * @return integer
     */
    public function getBookStoreId()
    {
        return $this->book_store_id;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'order_book';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return OrderBook[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return OrderBook
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
