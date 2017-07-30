<?php

namespace Ypk\Models;

class CmsPicture extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $picture_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $picture_title;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $picture_class_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $picture_author;

    /**
     *
     * @var string
     * @Column(type="string", length=140, nullable=true)
     */
    protected $picture_abstract;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $picture_image;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $picture_keyword;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $picture_publish_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $picture_click;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $picture_sort;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $picture_commend_flag;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $picture_comment_flag;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $picture_verify_admin;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $picture_verify_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $picture_state;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $picture_publisher_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $picture_publisher_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $picture_type;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $picture_attachment_path;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $picture_modify_time;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $picture_tag;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $picture_comment_count;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $picture_title_short;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    protected $picture_image_count;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $picture_share_count;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $picture_verify_reason;

    /**
     * Method to set the value of field picture_id
     *
     * @param integer $picture_id
     * @return $this
     */
    public function setPictureId($picture_id)
    {
        $this->picture_id = $picture_id;

        return $this;
    }

    /**
     * Method to set the value of field picture_title
     *
     * @param string $picture_title
     * @return $this
     */
    public function setPictureTitle($picture_title)
    {
        $this->picture_title = $picture_title;

        return $this;
    }

    /**
     * Method to set the value of field picture_class_id
     *
     * @param integer $picture_class_id
     * @return $this
     */
    public function setPictureClassId($picture_class_id)
    {
        $this->picture_class_id = $picture_class_id;

        return $this;
    }

    /**
     * Method to set the value of field picture_author
     *
     * @param string $picture_author
     * @return $this
     */
    public function setPictureAuthor($picture_author)
    {
        $this->picture_author = $picture_author;

        return $this;
    }

    /**
     * Method to set the value of field picture_abstract
     *
     * @param string $picture_abstract
     * @return $this
     */
    public function setPictureAbstract($picture_abstract)
    {
        $this->picture_abstract = $picture_abstract;

        return $this;
    }

    /**
     * Method to set the value of field picture_image
     *
     * @param string $picture_image
     * @return $this
     */
    public function setPictureImage($picture_image)
    {
        $this->picture_image = $picture_image;

        return $this;
    }

    /**
     * Method to set the value of field picture_keyword
     *
     * @param string $picture_keyword
     * @return $this
     */
    public function setPictureKeyword($picture_keyword)
    {
        $this->picture_keyword = $picture_keyword;

        return $this;
    }

    /**
     * Method to set the value of field picture_publish_time
     *
     * @param integer $picture_publish_time
     * @return $this
     */
    public function setPicturePublishTime($picture_publish_time)
    {
        $this->picture_publish_time = $picture_publish_time;

        return $this;
    }

    /**
     * Method to set the value of field picture_click
     *
     * @param integer $picture_click
     * @return $this
     */
    public function setPictureClick($picture_click)
    {
        $this->picture_click = $picture_click;

        return $this;
    }

    /**
     * Method to set the value of field picture_sort
     *
     * @param integer $picture_sort
     * @return $this
     */
    public function setPictureSort($picture_sort)
    {
        $this->picture_sort = $picture_sort;

        return $this;
    }

    /**
     * Method to set the value of field picture_commend_flag
     *
     * @param integer $picture_commend_flag
     * @return $this
     */
    public function setPictureCommendFlag($picture_commend_flag)
    {
        $this->picture_commend_flag = $picture_commend_flag;

        return $this;
    }

    /**
     * Method to set the value of field picture_comment_flag
     *
     * @param integer $picture_comment_flag
     * @return $this
     */
    public function setPictureCommentFlag($picture_comment_flag)
    {
        $this->picture_comment_flag = $picture_comment_flag;

        return $this;
    }

    /**
     * Method to set the value of field picture_verify_admin
     *
     * @param string $picture_verify_admin
     * @return $this
     */
    public function setPictureVerifyAdmin($picture_verify_admin)
    {
        $this->picture_verify_admin = $picture_verify_admin;

        return $this;
    }

    /**
     * Method to set the value of field picture_verify_time
     *
     * @param integer $picture_verify_time
     * @return $this
     */
    public function setPictureVerifyTime($picture_verify_time)
    {
        $this->picture_verify_time = $picture_verify_time;

        return $this;
    }

    /**
     * Method to set the value of field picture_state
     *
     * @param integer $picture_state
     * @return $this
     */
    public function setPictureState($picture_state)
    {
        $this->picture_state = $picture_state;

        return $this;
    }

    /**
     * Method to set the value of field picture_publisher_name
     *
     * @param string $picture_publisher_name
     * @return $this
     */
    public function setPicturePublisherName($picture_publisher_name)
    {
        $this->picture_publisher_name = $picture_publisher_name;

        return $this;
    }

    /**
     * Method to set the value of field picture_publisher_id
     *
     * @param integer $picture_publisher_id
     * @return $this
     */
    public function setPicturePublisherId($picture_publisher_id)
    {
        $this->picture_publisher_id = $picture_publisher_id;

        return $this;
    }

    /**
     * Method to set the value of field picture_type
     *
     * @param integer $picture_type
     * @return $this
     */
    public function setPictureType($picture_type)
    {
        $this->picture_type = $picture_type;

        return $this;
    }

    /**
     * Method to set the value of field picture_attachment_path
     *
     * @param string $picture_attachment_path
     * @return $this
     */
    public function setPictureAttachmentPath($picture_attachment_path)
    {
        $this->picture_attachment_path = $picture_attachment_path;

        return $this;
    }

    /**
     * Method to set the value of field picture_modify_time
     *
     * @param integer $picture_modify_time
     * @return $this
     */
    public function setPictureModifyTime($picture_modify_time)
    {
        $this->picture_modify_time = $picture_modify_time;

        return $this;
    }

    /**
     * Method to set the value of field picture_tag
     *
     * @param string $picture_tag
     * @return $this
     */
    public function setPictureTag($picture_tag)
    {
        $this->picture_tag = $picture_tag;

        return $this;
    }

    /**
     * Method to set the value of field picture_comment_count
     *
     * @param integer $picture_comment_count
     * @return $this
     */
    public function setPictureCommentCount($picture_comment_count)
    {
        $this->picture_comment_count = $picture_comment_count;

        return $this;
    }

    /**
     * Method to set the value of field picture_title_short
     *
     * @param string $picture_title_short
     * @return $this
     */
    public function setPictureTitleShort($picture_title_short)
    {
        $this->picture_title_short = $picture_title_short;

        return $this;
    }

    /**
     * Method to set the value of field picture_image_count
     *
     * @param integer $picture_image_count
     * @return $this
     */
    public function setPictureImageCount($picture_image_count)
    {
        $this->picture_image_count = $picture_image_count;

        return $this;
    }

    /**
     * Method to set the value of field picture_share_count
     *
     * @param integer $picture_share_count
     * @return $this
     */
    public function setPictureShareCount($picture_share_count)
    {
        $this->picture_share_count = $picture_share_count;

        return $this;
    }

    /**
     * Method to set the value of field picture_verify_reason
     *
     * @param string $picture_verify_reason
     * @return $this
     */
    public function setPictureVerifyReason($picture_verify_reason)
    {
        $this->picture_verify_reason = $picture_verify_reason;

        return $this;
    }

    /**
     * Returns the value of field picture_id
     *
     * @return integer
     */
    public function getPictureId()
    {
        return $this->picture_id;
    }

    /**
     * Returns the value of field picture_title
     *
     * @return string
     */
    public function getPictureTitle()
    {
        return $this->picture_title;
    }

    /**
     * Returns the value of field picture_class_id
     *
     * @return integer
     */
    public function getPictureClassId()
    {
        return $this->picture_class_id;
    }

    /**
     * Returns the value of field picture_author
     *
     * @return string
     */
    public function getPictureAuthor()
    {
        return $this->picture_author;
    }

    /**
     * Returns the value of field picture_abstract
     *
     * @return string
     */
    public function getPictureAbstract()
    {
        return $this->picture_abstract;
    }

    /**
     * Returns the value of field picture_image
     *
     * @return string
     */
    public function getPictureImage()
    {
        return $this->picture_image;
    }

    /**
     * Returns the value of field picture_keyword
     *
     * @return string
     */
    public function getPictureKeyword()
    {
        return $this->picture_keyword;
    }

    /**
     * Returns the value of field picture_publish_time
     *
     * @return integer
     */
    public function getPicturePublishTime()
    {
        return $this->picture_publish_time;
    }

    /**
     * Returns the value of field picture_click
     *
     * @return integer
     */
    public function getPictureClick()
    {
        return $this->picture_click;
    }

    /**
     * Returns the value of field picture_sort
     *
     * @return integer
     */
    public function getPictureSort()
    {
        return $this->picture_sort;
    }

    /**
     * Returns the value of field picture_commend_flag
     *
     * @return integer
     */
    public function getPictureCommendFlag()
    {
        return $this->picture_commend_flag;
    }

    /**
     * Returns the value of field picture_comment_flag
     *
     * @return integer
     */
    public function getPictureCommentFlag()
    {
        return $this->picture_comment_flag;
    }

    /**
     * Returns the value of field picture_verify_admin
     *
     * @return string
     */
    public function getPictureVerifyAdmin()
    {
        return $this->picture_verify_admin;
    }

    /**
     * Returns the value of field picture_verify_time
     *
     * @return integer
     */
    public function getPictureVerifyTime()
    {
        return $this->picture_verify_time;
    }

    /**
     * Returns the value of field picture_state
     *
     * @return integer
     */
    public function getPictureState()
    {
        return $this->picture_state;
    }

    /**
     * Returns the value of field picture_publisher_name
     *
     * @return string
     */
    public function getPicturePublisherName()
    {
        return $this->picture_publisher_name;
    }

    /**
     * Returns the value of field picture_publisher_id
     *
     * @return integer
     */
    public function getPicturePublisherId()
    {
        return $this->picture_publisher_id;
    }

    /**
     * Returns the value of field picture_type
     *
     * @return integer
     */
    public function getPictureType()
    {
        return $this->picture_type;
    }

    /**
     * Returns the value of field picture_attachment_path
     *
     * @return string
     */
    public function getPictureAttachmentPath()
    {
        return $this->picture_attachment_path;
    }

    /**
     * Returns the value of field picture_modify_time
     *
     * @return integer
     */
    public function getPictureModifyTime()
    {
        return $this->picture_modify_time;
    }

    /**
     * Returns the value of field picture_tag
     *
     * @return string
     */
    public function getPictureTag()
    {
        return $this->picture_tag;
    }

    /**
     * Returns the value of field picture_comment_count
     *
     * @return integer
     */
    public function getPictureCommentCount()
    {
        return $this->picture_comment_count;
    }

    /**
     * Returns the value of field picture_title_short
     *
     * @return string
     */
    public function getPictureTitleShort()
    {
        return $this->picture_title_short;
    }

    /**
     * Returns the value of field picture_image_count
     *
     * @return integer
     */
    public function getPictureImageCount()
    {
        return $this->picture_image_count;
    }

    /**
     * Returns the value of field picture_share_count
     *
     * @return integer
     */
    public function getPictureShareCount()
    {
        return $this->picture_share_count;
    }

    /**
     * Returns the value of field picture_verify_reason
     *
     * @return string
     */
    public function getPictureVerifyReason()
    {
        return $this->picture_verify_reason;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'cms_picture';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CmsPicture[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CmsPicture
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
