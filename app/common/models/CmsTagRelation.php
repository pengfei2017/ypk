<?php

namespace Ypk\Models;

class CmsTagRelation extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $relation_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $relation_type;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $relation_tag_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $relation_object_id;

    /**
     * Method to set the value of field relation_id
     *
     * @param integer $relation_id
     * @return $this
     */
    public function setRelationId($relation_id)
    {
        $this->relation_id = $relation_id;

        return $this;
    }

    /**
     * Method to set the value of field relation_type
     *
     * @param integer $relation_type
     * @return $this
     */
    public function setRelationType($relation_type)
    {
        $this->relation_type = $relation_type;

        return $this;
    }

    /**
     * Method to set the value of field relation_tag_id
     *
     * @param integer $relation_tag_id
     * @return $this
     */
    public function setRelationTagId($relation_tag_id)
    {
        $this->relation_tag_id = $relation_tag_id;

        return $this;
    }

    /**
     * Method to set the value of field relation_object_id
     *
     * @param integer $relation_object_id
     * @return $this
     */
    public function setRelationObjectId($relation_object_id)
    {
        $this->relation_object_id = $relation_object_id;

        return $this;
    }

    /**
     * Returns the value of field relation_id
     *
     * @return integer
     */
    public function getRelationId()
    {
        return $this->relation_id;
    }

    /**
     * Returns the value of field relation_type
     *
     * @return integer
     */
    public function getRelationType()
    {
        return $this->relation_type;
    }

    /**
     * Returns the value of field relation_tag_id
     *
     * @return integer
     */
    public function getRelationTagId()
    {
        return $this->relation_tag_id;
    }

    /**
     * Returns the value of field relation_object_id
     *
     * @return integer
     */
    public function getRelationObjectId()
    {
        return $this->relation_object_id;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'cms_tag_relation';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CmsTagRelation[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CmsTagRelation
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
