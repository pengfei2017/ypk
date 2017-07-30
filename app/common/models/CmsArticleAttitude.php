<?php

namespace Ypk\Models;

class CmsArticleAttitude extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $attitude_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $attitude_article_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $attitude_member_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $attitude_time;

    /**
     * Method to set the value of field attitude_id
     *
     * @param integer $attitude_id
     * @return $this
     */
    public function setAttitudeId($attitude_id)
    {
        $this->attitude_id = $attitude_id;

        return $this;
    }

    /**
     * Method to set the value of field attitude_article_id
     *
     * @param integer $attitude_article_id
     * @return $this
     */
    public function setAttitudeArticleId($attitude_article_id)
    {
        $this->attitude_article_id = $attitude_article_id;

        return $this;
    }

    /**
     * Method to set the value of field attitude_member_id
     *
     * @param integer $attitude_member_id
     * @return $this
     */
    public function setAttitudeMemberId($attitude_member_id)
    {
        $this->attitude_member_id = $attitude_member_id;

        return $this;
    }

    /**
     * Method to set the value of field attitude_time
     *
     * @param integer $attitude_time
     * @return $this
     */
    public function setAttitudeTime($attitude_time)
    {
        $this->attitude_time = $attitude_time;

        return $this;
    }

    /**
     * Returns the value of field attitude_id
     *
     * @return integer
     */
    public function getAttitudeId()
    {
        return $this->attitude_id;
    }

    /**
     * Returns the value of field attitude_article_id
     *
     * @return integer
     */
    public function getAttitudeArticleId()
    {
        return $this->attitude_article_id;
    }

    /**
     * Returns the value of field attitude_member_id
     *
     * @return integer
     */
    public function getAttitudeMemberId()
    {
        return $this->attitude_member_id;
    }

    /**
     * Returns the value of field attitude_time
     *
     * @return integer
     */
    public function getAttitudeTime()
    {
        return $this->attitude_time;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'cms_article_attitude';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CmsArticleAttitude[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CmsArticleAttitude
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
