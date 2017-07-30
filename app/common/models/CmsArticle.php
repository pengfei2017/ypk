<?php

namespace Ypk\Models;

class CmsArticle extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $article_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $article_title;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $article_class_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $article_origin;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $article_origin_address;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $article_author;

    /**
     *
     * @var string
     * @Column(type="string", length=140, nullable=true)
     */
    protected $article_abstract;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $article_content;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $article_image;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $article_keyword;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $article_link;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $article_goods;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $article_start_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $article_end_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $article_publish_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $article_click;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $article_sort;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $article_commend_flag;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $article_comment_flag;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $article_verify_admin;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $article_verify_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $article_state;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $article_publisher_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $article_publisher_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $article_type;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $article_attachment_path;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $article_image_all;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $article_modify_time;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $article_tag;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $article_comment_count;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $article_attitude_1;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $article_attitude_2;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $article_attitude_3;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $article_attitude_4;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $article_attitude_5;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $article_attitude_6;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $article_title_short;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $article_attitude_flag;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $article_commend_image_flag;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $article_share_count;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $article_verify_reason;

    /**
     * Method to set the value of field article_id
     *
     * @param integer $article_id
     * @return $this
     */
    public function setArticleId($article_id)
    {
        $this->article_id = $article_id;

        return $this;
    }

    /**
     * Method to set the value of field article_title
     *
     * @param string $article_title
     * @return $this
     */
    public function setArticleTitle($article_title)
    {
        $this->article_title = $article_title;

        return $this;
    }

    /**
     * Method to set the value of field article_class_id
     *
     * @param integer $article_class_id
     * @return $this
     */
    public function setArticleClassId($article_class_id)
    {
        $this->article_class_id = $article_class_id;

        return $this;
    }

    /**
     * Method to set the value of field article_origin
     *
     * @param string $article_origin
     * @return $this
     */
    public function setArticleOrigin($article_origin)
    {
        $this->article_origin = $article_origin;

        return $this;
    }

    /**
     * Method to set the value of field article_origin_address
     *
     * @param string $article_origin_address
     * @return $this
     */
    public function setArticleOriginAddress($article_origin_address)
    {
        $this->article_origin_address = $article_origin_address;

        return $this;
    }

    /**
     * Method to set the value of field article_author
     *
     * @param string $article_author
     * @return $this
     */
    public function setArticleAuthor($article_author)
    {
        $this->article_author = $article_author;

        return $this;
    }

    /**
     * Method to set the value of field article_abstract
     *
     * @param string $article_abstract
     * @return $this
     */
    public function setArticleAbstract($article_abstract)
    {
        $this->article_abstract = $article_abstract;

        return $this;
    }

    /**
     * Method to set the value of field article_content
     *
     * @param string $article_content
     * @return $this
     */
    public function setArticleContent($article_content)
    {
        $this->article_content = $article_content;

        return $this;
    }

    /**
     * Method to set the value of field article_image
     *
     * @param string $article_image
     * @return $this
     */
    public function setArticleImage($article_image)
    {
        $this->article_image = $article_image;

        return $this;
    }

    /**
     * Method to set the value of field article_keyword
     *
     * @param string $article_keyword
     * @return $this
     */
    public function setArticleKeyword($article_keyword)
    {
        $this->article_keyword = $article_keyword;

        return $this;
    }

    /**
     * Method to set the value of field article_link
     *
     * @param string $article_link
     * @return $this
     */
    public function setArticleLink($article_link)
    {
        $this->article_link = $article_link;

        return $this;
    }

    /**
     * Method to set the value of field article_goods
     *
     * @param string $article_goods
     * @return $this
     */
    public function setArticleGoods($article_goods)
    {
        $this->article_goods = $article_goods;

        return $this;
    }

    /**
     * Method to set the value of field article_start_time
     *
     * @param integer $article_start_time
     * @return $this
     */
    public function setArticleStartTime($article_start_time)
    {
        $this->article_start_time = $article_start_time;

        return $this;
    }

    /**
     * Method to set the value of field article_end_time
     *
     * @param integer $article_end_time
     * @return $this
     */
    public function setArticleEndTime($article_end_time)
    {
        $this->article_end_time = $article_end_time;

        return $this;
    }

    /**
     * Method to set the value of field article_publish_time
     *
     * @param integer $article_publish_time
     * @return $this
     */
    public function setArticlePublishTime($article_publish_time)
    {
        $this->article_publish_time = $article_publish_time;

        return $this;
    }

    /**
     * Method to set the value of field article_click
     *
     * @param integer $article_click
     * @return $this
     */
    public function setArticleClick($article_click)
    {
        $this->article_click = $article_click;

        return $this;
    }

    /**
     * Method to set the value of field article_sort
     *
     * @param integer $article_sort
     * @return $this
     */
    public function setArticleSort($article_sort)
    {
        $this->article_sort = $article_sort;

        return $this;
    }

    /**
     * Method to set the value of field article_commend_flag
     *
     * @param integer $article_commend_flag
     * @return $this
     */
    public function setArticleCommendFlag($article_commend_flag)
    {
        $this->article_commend_flag = $article_commend_flag;

        return $this;
    }

    /**
     * Method to set the value of field article_comment_flag
     *
     * @param integer $article_comment_flag
     * @return $this
     */
    public function setArticleCommentFlag($article_comment_flag)
    {
        $this->article_comment_flag = $article_comment_flag;

        return $this;
    }

    /**
     * Method to set the value of field article_verify_admin
     *
     * @param string $article_verify_admin
     * @return $this
     */
    public function setArticleVerifyAdmin($article_verify_admin)
    {
        $this->article_verify_admin = $article_verify_admin;

        return $this;
    }

    /**
     * Method to set the value of field article_verify_time
     *
     * @param integer $article_verify_time
     * @return $this
     */
    public function setArticleVerifyTime($article_verify_time)
    {
        $this->article_verify_time = $article_verify_time;

        return $this;
    }

    /**
     * Method to set the value of field article_state
     *
     * @param integer $article_state
     * @return $this
     */
    public function setArticleState($article_state)
    {
        $this->article_state = $article_state;

        return $this;
    }

    /**
     * Method to set the value of field article_publisher_name
     *
     * @param string $article_publisher_name
     * @return $this
     */
    public function setArticlePublisherName($article_publisher_name)
    {
        $this->article_publisher_name = $article_publisher_name;

        return $this;
    }

    /**
     * Method to set the value of field article_publisher_id
     *
     * @param integer $article_publisher_id
     * @return $this
     */
    public function setArticlePublisherId($article_publisher_id)
    {
        $this->article_publisher_id = $article_publisher_id;

        return $this;
    }

    /**
     * Method to set the value of field article_type
     *
     * @param integer $article_type
     * @return $this
     */
    public function setArticleType($article_type)
    {
        $this->article_type = $article_type;

        return $this;
    }

    /**
     * Method to set the value of field article_attachment_path
     *
     * @param string $article_attachment_path
     * @return $this
     */
    public function setArticleAttachmentPath($article_attachment_path)
    {
        $this->article_attachment_path = $article_attachment_path;

        return $this;
    }

    /**
     * Method to set the value of field article_image_all
     *
     * @param string $article_image_all
     * @return $this
     */
    public function setArticleImageAll($article_image_all)
    {
        $this->article_image_all = $article_image_all;

        return $this;
    }

    /**
     * Method to set the value of field article_modify_time
     *
     * @param integer $article_modify_time
     * @return $this
     */
    public function setArticleModifyTime($article_modify_time)
    {
        $this->article_modify_time = $article_modify_time;

        return $this;
    }

    /**
     * Method to set the value of field article_tag
     *
     * @param string $article_tag
     * @return $this
     */
    public function setArticleTag($article_tag)
    {
        $this->article_tag = $article_tag;

        return $this;
    }

    /**
     * Method to set the value of field article_comment_count
     *
     * @param integer $article_comment_count
     * @return $this
     */
    public function setArticleCommentCount($article_comment_count)
    {
        $this->article_comment_count = $article_comment_count;

        return $this;
    }

    /**
     * Method to set the value of field article_attitude_1
     *
     * @param integer $article_attitude_1
     * @return $this
     */
    public function setArticleAttitude1($article_attitude_1)
    {
        $this->article_attitude_1 = $article_attitude_1;

        return $this;
    }

    /**
     * Method to set the value of field article_attitude_2
     *
     * @param integer $article_attitude_2
     * @return $this
     */
    public function setArticleAttitude2($article_attitude_2)
    {
        $this->article_attitude_2 = $article_attitude_2;

        return $this;
    }

    /**
     * Method to set the value of field article_attitude_3
     *
     * @param integer $article_attitude_3
     * @return $this
     */
    public function setArticleAttitude3($article_attitude_3)
    {
        $this->article_attitude_3 = $article_attitude_3;

        return $this;
    }

    /**
     * Method to set the value of field article_attitude_4
     *
     * @param integer $article_attitude_4
     * @return $this
     */
    public function setArticleAttitude4($article_attitude_4)
    {
        $this->article_attitude_4 = $article_attitude_4;

        return $this;
    }

    /**
     * Method to set the value of field article_attitude_5
     *
     * @param integer $article_attitude_5
     * @return $this
     */
    public function setArticleAttitude5($article_attitude_5)
    {
        $this->article_attitude_5 = $article_attitude_5;

        return $this;
    }

    /**
     * Method to set the value of field article_attitude_6
     *
     * @param integer $article_attitude_6
     * @return $this
     */
    public function setArticleAttitude6($article_attitude_6)
    {
        $this->article_attitude_6 = $article_attitude_6;

        return $this;
    }

    /**
     * Method to set the value of field article_title_short
     *
     * @param string $article_title_short
     * @return $this
     */
    public function setArticleTitleShort($article_title_short)
    {
        $this->article_title_short = $article_title_short;

        return $this;
    }

    /**
     * Method to set the value of field article_attitude_flag
     *
     * @param integer $article_attitude_flag
     * @return $this
     */
    public function setArticleAttitudeFlag($article_attitude_flag)
    {
        $this->article_attitude_flag = $article_attitude_flag;

        return $this;
    }

    /**
     * Method to set the value of field article_commend_image_flag
     *
     * @param integer $article_commend_image_flag
     * @return $this
     */
    public function setArticleCommendImageFlag($article_commend_image_flag)
    {
        $this->article_commend_image_flag = $article_commend_image_flag;

        return $this;
    }

    /**
     * Method to set the value of field article_share_count
     *
     * @param integer $article_share_count
     * @return $this
     */
    public function setArticleShareCount($article_share_count)
    {
        $this->article_share_count = $article_share_count;

        return $this;
    }

    /**
     * Method to set the value of field article_verify_reason
     *
     * @param string $article_verify_reason
     * @return $this
     */
    public function setArticleVerifyReason($article_verify_reason)
    {
        $this->article_verify_reason = $article_verify_reason;

        return $this;
    }

    /**
     * Returns the value of field article_id
     *
     * @return integer
     */
    public function getArticleId()
    {
        return $this->article_id;
    }

    /**
     * Returns the value of field article_title
     *
     * @return string
     */
    public function getArticleTitle()
    {
        return $this->article_title;
    }

    /**
     * Returns the value of field article_class_id
     *
     * @return integer
     */
    public function getArticleClassId()
    {
        return $this->article_class_id;
    }

    /**
     * Returns the value of field article_origin
     *
     * @return string
     */
    public function getArticleOrigin()
    {
        return $this->article_origin;
    }

    /**
     * Returns the value of field article_origin_address
     *
     * @return string
     */
    public function getArticleOriginAddress()
    {
        return $this->article_origin_address;
    }

    /**
     * Returns the value of field article_author
     *
     * @return string
     */
    public function getArticleAuthor()
    {
        return $this->article_author;
    }

    /**
     * Returns the value of field article_abstract
     *
     * @return string
     */
    public function getArticleAbstract()
    {
        return $this->article_abstract;
    }

    /**
     * Returns the value of field article_content
     *
     * @return string
     */
    public function getArticleContent()
    {
        return $this->article_content;
    }

    /**
     * Returns the value of field article_image
     *
     * @return string
     */
    public function getArticleImage()
    {
        return $this->article_image;
    }

    /**
     * Returns the value of field article_keyword
     *
     * @return string
     */
    public function getArticleKeyword()
    {
        return $this->article_keyword;
    }

    /**
     * Returns the value of field article_link
     *
     * @return string
     */
    public function getArticleLink()
    {
        return $this->article_link;
    }

    /**
     * Returns the value of field article_goods
     *
     * @return string
     */
    public function getArticleGoods()
    {
        return $this->article_goods;
    }

    /**
     * Returns the value of field article_start_time
     *
     * @return integer
     */
    public function getArticleStartTime()
    {
        return $this->article_start_time;
    }

    /**
     * Returns the value of field article_end_time
     *
     * @return integer
     */
    public function getArticleEndTime()
    {
        return $this->article_end_time;
    }

    /**
     * Returns the value of field article_publish_time
     *
     * @return integer
     */
    public function getArticlePublishTime()
    {
        return $this->article_publish_time;
    }

    /**
     * Returns the value of field article_click
     *
     * @return integer
     */
    public function getArticleClick()
    {
        return $this->article_click;
    }

    /**
     * Returns the value of field article_sort
     *
     * @return integer
     */
    public function getArticleSort()
    {
        return $this->article_sort;
    }

    /**
     * Returns the value of field article_commend_flag
     *
     * @return integer
     */
    public function getArticleCommendFlag()
    {
        return $this->article_commend_flag;
    }

    /**
     * Returns the value of field article_comment_flag
     *
     * @return integer
     */
    public function getArticleCommentFlag()
    {
        return $this->article_comment_flag;
    }

    /**
     * Returns the value of field article_verify_admin
     *
     * @return string
     */
    public function getArticleVerifyAdmin()
    {
        return $this->article_verify_admin;
    }

    /**
     * Returns the value of field article_verify_time
     *
     * @return integer
     */
    public function getArticleVerifyTime()
    {
        return $this->article_verify_time;
    }

    /**
     * Returns the value of field article_state
     *
     * @return integer
     */
    public function getArticleState()
    {
        return $this->article_state;
    }

    /**
     * Returns the value of field article_publisher_name
     *
     * @return string
     */
    public function getArticlePublisherName()
    {
        return $this->article_publisher_name;
    }

    /**
     * Returns the value of field article_publisher_id
     *
     * @return integer
     */
    public function getArticlePublisherId()
    {
        return $this->article_publisher_id;
    }

    /**
     * Returns the value of field article_type
     *
     * @return integer
     */
    public function getArticleType()
    {
        return $this->article_type;
    }

    /**
     * Returns the value of field article_attachment_path
     *
     * @return string
     */
    public function getArticleAttachmentPath()
    {
        return $this->article_attachment_path;
    }

    /**
     * Returns the value of field article_image_all
     *
     * @return string
     */
    public function getArticleImageAll()
    {
        return $this->article_image_all;
    }

    /**
     * Returns the value of field article_modify_time
     *
     * @return integer
     */
    public function getArticleModifyTime()
    {
        return $this->article_modify_time;
    }

    /**
     * Returns the value of field article_tag
     *
     * @return string
     */
    public function getArticleTag()
    {
        return $this->article_tag;
    }

    /**
     * Returns the value of field article_comment_count
     *
     * @return integer
     */
    public function getArticleCommentCount()
    {
        return $this->article_comment_count;
    }

    /**
     * Returns the value of field article_attitude_1
     *
     * @return integer
     */
    public function getArticleAttitude1()
    {
        return $this->article_attitude_1;
    }

    /**
     * Returns the value of field article_attitude_2
     *
     * @return integer
     */
    public function getArticleAttitude2()
    {
        return $this->article_attitude_2;
    }

    /**
     * Returns the value of field article_attitude_3
     *
     * @return integer
     */
    public function getArticleAttitude3()
    {
        return $this->article_attitude_3;
    }

    /**
     * Returns the value of field article_attitude_4
     *
     * @return integer
     */
    public function getArticleAttitude4()
    {
        return $this->article_attitude_4;
    }

    /**
     * Returns the value of field article_attitude_5
     *
     * @return integer
     */
    public function getArticleAttitude5()
    {
        return $this->article_attitude_5;
    }

    /**
     * Returns the value of field article_attitude_6
     *
     * @return integer
     */
    public function getArticleAttitude6()
    {
        return $this->article_attitude_6;
    }

    /**
     * Returns the value of field article_title_short
     *
     * @return string
     */
    public function getArticleTitleShort()
    {
        return $this->article_title_short;
    }

    /**
     * Returns the value of field article_attitude_flag
     *
     * @return integer
     */
    public function getArticleAttitudeFlag()
    {
        return $this->article_attitude_flag;
    }

    /**
     * Returns the value of field article_commend_image_flag
     *
     * @return integer
     */
    public function getArticleCommendImageFlag()
    {
        return $this->article_commend_image_flag;
    }

    /**
     * Returns the value of field article_share_count
     *
     * @return integer
     */
    public function getArticleShareCount()
    {
        return $this->article_share_count;
    }

    /**
     * Returns the value of field article_verify_reason
     *
     * @return string
     */
    public function getArticleVerifyReason()
    {
        return $this->article_verify_reason;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'cms_article';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CmsArticle[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CmsArticle
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
