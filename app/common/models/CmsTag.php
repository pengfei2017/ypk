<?php

namespace Ypk\Models;

class CmsTag extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $tag_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $tag_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $tag_sort;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $tag_count;

    /**
     * Method to set the value of field tag_id
     *
     * @param integer $tag_id
     * @return $this
     */
    public function setTagId($tag_id)
    {
        $this->tag_id = $tag_id;

        return $this;
    }

    /**
     * Method to set the value of field tag_name
     *
     * @param string $tag_name
     * @return $this
     */
    public function setTagName($tag_name)
    {
        $this->tag_name = $tag_name;

        return $this;
    }

    /**
     * Method to set the value of field tag_sort
     *
     * @param integer $tag_sort
     * @return $this
     */
    public function setTagSort($tag_sort)
    {
        $this->tag_sort = $tag_sort;

        return $this;
    }

    /**
     * Method to set the value of field tag_count
     *
     * @param integer $tag_count
     * @return $this
     */
    public function setTagCount($tag_count)
    {
        $this->tag_count = $tag_count;

        return $this;
    }

    /**
     * Returns the value of field tag_id
     *
     * @return integer
     */
    public function getTagId()
    {
        return $this->tag_id;
    }

    /**
     * Returns the value of field tag_name
     *
     * @return string
     */
    public function getTagName()
    {
        return $this->tag_name;
    }

    /**
     * Returns the value of field tag_sort
     *
     * @return integer
     */
    public function getTagSort()
    {
        return $this->tag_sort;
    }

    /**
     * Returns the value of field tag_count
     *
     * @return integer
     */
    public function getTagCount()
    {
        return $this->tag_count;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'cms_tag';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CmsTag[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CmsTag
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
