<?php

namespace Ypk\Models;

class InformSubject extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $inform_subject_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $inform_subject_content;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $inform_subject_type_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $inform_subject_type_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $inform_subject_state;

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
     * Method to set the value of field inform_subject_type_id
     *
     * @param integer $inform_subject_type_id
     * @return $this
     */
    public function setInformSubjectTypeId($inform_subject_type_id)
    {
        $this->inform_subject_type_id = $inform_subject_type_id;

        return $this;
    }

    /**
     * Method to set the value of field inform_subject_type_name
     *
     * @param string $inform_subject_type_name
     * @return $this
     */
    public function setInformSubjectTypeName($inform_subject_type_name)
    {
        $this->inform_subject_type_name = $inform_subject_type_name;

        return $this;
    }

    /**
     * Method to set the value of field inform_subject_state
     *
     * @param integer $inform_subject_state
     * @return $this
     */
    public function setInformSubjectState($inform_subject_state)
    {
        $this->inform_subject_state = $inform_subject_state;

        return $this;
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
     * Returns the value of field inform_subject_type_id
     *
     * @return integer
     */
    public function getInformSubjectTypeId()
    {
        return $this->inform_subject_type_id;
    }

    /**
     * Returns the value of field inform_subject_type_name
     *
     * @return string
     */
    public function getInformSubjectTypeName()
    {
        return $this->inform_subject_type_name;
    }

    /**
     * Returns the value of field inform_subject_state
     *
     * @return integer
     */
    public function getInformSubjectState()
    {
        return $this->inform_subject_state;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'inform_subject';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return InformSubject[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return InformSubject
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
