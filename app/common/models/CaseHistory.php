<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/31
 * Time: 15:35
 */

namespace Ypk\Models;


use Phalcon\Mvc\Model;

class CaseHistory extends Model
{
    /**
     *
     * @var integer
     * @Primary
     * @Identity
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
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $store_id;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $case_content;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $is_public;


    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $add_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $order_id;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $title;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return int
     */
    public function getOrderId()
    {
        return $this->order_id;
    }

    /**
     * @param int $order_id
     */
    public function setOrderId($order_id)
    {
        $this->order_id = $order_id;
    }

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
     * @return int
     */
    public function getStoreId()
    {
        return $this->store_id;
    }

    /**
     * @param int $store_id
     */
    public function setStoreId($store_id)
    {
        $this->store_id = $store_id;
    }

    /**
     * @return string
     */
    public function getCaseContent()
    {
        return $this->case_content;
    }

    /**
     * @param string $case_content
     */
    public function setCaseContent($case_content)
    {
        $this->case_content = $case_content;
    }

    /**
     * @return int
     */
    public function getIsPublic()
    {
        return $this->is_public;
    }

    /**
     * @param int $is_public
     */
    public function setIsPublic($is_public)
    {
        $this->is_public = $is_public;
    }

    /**
     * @return int
     */
    public function getAddTime()
    {
        return $this->add_time;
    }

    /**
     * @param int $add_time
     */
    public function setAddTime($add_time)
    {
        $this->add_time = $add_time;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'case_history';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Article[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Article
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }
}