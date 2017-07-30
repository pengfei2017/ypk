<?php

namespace Ypk\Models;

class ComplainSubject extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $complain_subject_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $complain_subject_content;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $complain_subject_desc;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $complain_subject_state;

    /**
     * Method to set the value of field complain_subject_id
     *
     * @param integer $complain_subject_id
     * @return $this
     */
    public function setComplainSubjectId($complain_subject_id)
    {
        $this->complain_subject_id = $complain_subject_id;

        return $this;
    }

    /**
     * Method to set the value of field complain_subject_content
     *
     * @param string $complain_subject_content
     * @return $this
     */
    public function setComplainSubjectContent($complain_subject_content)
    {
        $this->complain_subject_content = $complain_subject_content;

        return $this;
    }

    /**
     * Method to set the value of field complain_subject_desc
     *
     * @param string $complain_subject_desc
     * @return $this
     */
    public function setComplainSubjectDesc($complain_subject_desc)
    {
        $this->complain_subject_desc = $complain_subject_desc;

        return $this;
    }

    /**
     * Method to set the value of field complain_subject_state
     *
     * @param integer $complain_subject_state
     * @return $this
     */
    public function setComplainSubjectState($complain_subject_state)
    {
        $this->complain_subject_state = $complain_subject_state;

        return $this;
    }

    /**
     * Returns the value of field complain_subject_id
     *
     * @return integer
     */
    public function getComplainSubjectId()
    {
        return $this->complain_subject_id;
    }

    /**
     * Returns the value of field complain_subject_content
     *
     * @return string
     */
    public function getComplainSubjectContent()
    {
        return $this->complain_subject_content;
    }

    /**
     * Returns the value of field complain_subject_desc
     *
     * @return string
     */
    public function getComplainSubjectDesc()
    {
        return $this->complain_subject_desc;
    }

    /**
     * Returns the value of field complain_subject_state
     *
     * @return integer
     */
    public function getComplainSubjectState()
    {
        return $this->complain_subject_state;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'complain_subject';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ComplainSubject[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ComplainSubject
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
