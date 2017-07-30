<?php

namespace Ypk\Models;

class Inform extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $inform_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $inform_member_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $inform_member_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $inform_goods_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $inform_goods_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $inform_subject_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $inform_subject_content;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $inform_content;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $inform_pic1;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $inform_pic2;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $inform_pic3;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $inform_datetime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $inform_store_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $inform_state;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $inform_handle_type;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $inform_handle_message;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $inform_handle_datetime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $inform_handle_member_id;

    /**
     *
     * @var string
     * @Column(type="string", length=150, nullable=true)
     */
    protected $inform_goods_image;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $inform_store_name;

    /**
     * Method to set the value of field inform_id
     *
     * @param integer $inform_id
     * @return $this
     */
    public function setInformId($inform_id)
    {
        $this->inform_id = $inform_id;

        return $this;
    }

    /**
     * Method to set the value of field inform_member_id
     *
     * @param integer $inform_member_id
     * @return $this
     */
    public function setInformMemberId($inform_member_id)
    {
        $this->inform_member_id = $inform_member_id;

        return $this;
    }

    /**
     * Method to set the value of field inform_member_name
     *
     * @param string $inform_member_name
     * @return $this
     */
    public function setInformMemberName($inform_member_name)
    {
        $this->inform_member_name = $inform_member_name;

        return $this;
    }

    /**
     * Method to set the value of field inform_goods_id
     *
     * @param integer $inform_goods_id
     * @return $this
     */
    public function setInformGoodsId($inform_goods_id)
    {
        $this->inform_goods_id = $inform_goods_id;

        return $this;
    }

    /**
     * Method to set the value of field inform_goods_name
     *
     * @param string $inform_goods_name
     * @return $this
     */
    public function setInformGoodsName($inform_goods_name)
    {
        $this->inform_goods_name = $inform_goods_name;

        return $this;
    }

    /**
     * Method to set the value of field inform_subject_id
     *
     * @param integer $inform_subject_id
     * @return $this
     */
    public function setInformSubjectId($inform_subject_id)
    {
        $this->inform_subject_id = $inform_subject_id;

        return $this;
    }

    /**
     * Method to set the value of field inform_subject_content
     *
     * @param string $inform_subject_content
     * @return $this
     */
    public function setInformSubjectContent($inform_subject_content)
    {
        $this->inform_subject_content = $inform_subject_content;

        return $this;
    }

    /**
     * Method to set the value of field inform_content
     *
     * @param string $inform_content
     * @return $this
     */
    public function setInformContent($inform_content)
    {
        $this->inform_content = $inform_content;

        return $this;
    }

    /**
     * Method to set the value of field inform_pic1
     *
     * @param string $inform_pic1
     * @return $this
     */
    public function setInformPic1($inform_pic1)
    {
        $this->inform_pic1 = $inform_pic1;

        return $this;
    }

    /**
     * Method to set the value of field inform_pic2
     *
     * @param string $inform_pic2
     * @return $this
     */
    public function setInformPic2($inform_pic2)
    {
        $this->inform_pic2 = $inform_pic2;

        return $this;
    }

    /**
     * Method to set the value of field inform_pic3
     *
     * @param string $inform_pic3
     * @return $this
     */
    public function setInformPic3($inform_pic3)
    {
        $this->inform_pic3 = $inform_pic3;

        return $this;
    }

    /**
     * Method to set the value of field inform_datetime
     *
     * @param integer $inform_datetime
     * @return $this
     */
    public function setInformDatetime($inform_datetime)
    {
        $this->inform_datetime = $inform_datetime;

        return $this;
    }

    /**
     * Method to set the value of field inform_store_id
     *
     * @param integer $inform_store_id
     * @return $this
     */
    public function setInformStoreId($inform_store_id)
    {
        $this->inform_store_id = $inform_store_id;

        return $this;
    }

    /**
     * Method to set the value of field inform_state
     *
     * @param integer $inform_state
     * @return $this
     */
    public function setInformState($inform_state)
    {
        $this->inform_state = $inform_state;

        return $this;
    }

    /**
     * Method to set the value of field inform_handle_type
     *
     * @param integer $inform_handle_type
     * @return $this
     */
    public function setInformHandleType($inform_handle_type)
    {
        $this->inform_handle_type = $inform_handle_type;

        return $this;
    }

    /**
     * Method to set the value of field inform_handle_message
     *
     * @param string $inform_handle_message
     * @return $this
     */
    public function setInformHandleMessage($inform_handle_message)
    {
        $this->inform_handle_message = $inform_handle_message;

        return $this;
    }

    /**
     * Method to set the value of field inform_handle_datetime
     *
     * @param integer $inform_handle_datetime
     * @return $this
     */
    public function setInformHandleDatetime($inform_handle_datetime)
    {
        $this->inform_handle_datetime = $inform_handle_datetime;

        return $this;
    }

    /**
     * Method to set the value of field inform_handle_member_id
     *
     * @param integer $inform_handle_member_id
     * @return $this
     */
    public function setInformHandleMemberId($inform_handle_member_id)
    {
        $this->inform_handle_member_id = $inform_handle_member_id;

        return $this;
    }

    /**
     * Method to set the value of field inform_goods_image
     *
     * @param string $inform_goods_image
     * @return $this
     */
    public function setInformGoodsImage($inform_goods_image)
    {
        $this->inform_goods_image = $inform_goods_image;

        return $this;
    }

    /**
     * Method to set the value of field inform_store_name
     *
     * @param string $inform_store_name
     * @return $this
     */
    public function setInformStoreName($inform_store_name)
    {
        $this->inform_store_name = $inform_store_name;

        return $this;
    }

    /**
     * Returns the value of field inform_id
     *
     * @return integer
     */
    public function getInformId()
    {
        return $this->inform_id;
    }

    /**
     * Returns the value of field inform_member_id
     *
     * @return integer
     */
    public function getInformMemberId()
    {
        return $this->inform_member_id;
    }

    /**
     * Returns the value of field inform_member_name
     *
     * @return string
     */
    public function getInformMemberName()
    {
        return $this->inform_member_name;
    }

    /**
     * Returns the value of field inform_goods_id
     *
     * @return integer
     */
    public function getInformGoodsId()
    {
        return $this->inform_goods_id;
    }

    /**
     * Returns the value of field inform_goods_name
     *
     * @return string
     */
    public function getInformGoodsName()
    {
        return $this->inform_goods_name;
    }

    /**
     * Returns the value of field inform_subject_id
     *
     * @return integer
     */
    public function getInformSubjectId()
    {
        return $this->inform_subject_id;
    }

    /**
     * Returns the value of field inform_subject_content
     *
     * @return string
     */
    public function getInformSubjectContent()
    {
        return $this->inform_subject_content;
    }

    /**
     * Returns the value of field inform_content
     *
     * @return string
     */
    public function getInformContent()
    {
        return $this->inform_content;
    }

    /**
     * Returns the value of field inform_pic1
     *
     * @return string
     */
    public function getInformPic1()
    {
        return $this->inform_pic1;
    }

    /**
     * Returns the value of field inform_pic2
     *
     * @return string
     */
    public function getInformPic2()
    {
        return $this->inform_pic2;
    }

    /**
     * Returns the value of field inform_pic3
     *
     * @return string
     */
    public function getInformPic3()
    {
        return $this->inform_pic3;
    }

    /**
     * Returns the value of field inform_datetime
     *
     * @return integer
     */
    public function getInformDatetime()
    {
        return $this->inform_datetime;
    }

    /**
     * Returns the value of field inform_store_id
     *
     * @return integer
     */
    public function getInformStoreId()
    {
        return $this->inform_store_id;
    }

    /**
     * Returns the value of field inform_state
     *
     * @return integer
     */
    public function getInformState()
    {
        return $this->inform_state;
    }

    /**
     * Returns the value of field inform_handle_type
     *
     * @return integer
     */
    public function getInformHandleType()
    {
        return $this->inform_handle_type;
    }

    /**
     * Returns the value of field inform_handle_message
     *
     * @return string
     */
    public function getInformHandleMessage()
    {
        return $this->inform_handle_message;
    }

    /**
     * Returns the value of field inform_handle_datetime
     *
     * @return integer
     */
    public function getInformHandleDatetime()
    {
        return $this->inform_handle_datetime;
    }

    /**
     * Returns the value of field inform_handle_member_id
     *
     * @return integer
     */
    public function getInformHandleMemberId()
    {
        return $this->inform_handle_member_id;
    }

    /**
     * Returns the value of field inform_goods_image
     *
     * @return string
     */
    public function getInformGoodsImage()
    {
        return $this->inform_goods_image;
    }

    /**
     * Returns the value of field inform_store_name
     *
     * @return string
     */
    public function getInformStoreName()
    {
        return $this->inform_store_name;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'inform';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Inform[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Inform
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
