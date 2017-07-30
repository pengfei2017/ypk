<?php

namespace Ypk\Models;

class Document extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $doc_id;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $doc_code;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $doc_title;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $doc_content;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $doc_time;

    /**
     * Method to set the value of field doc_id
     *
     * @param integer $doc_id
     * @return $this
     */
    public function setDocId($doc_id)
    {
        $this->doc_id = $doc_id;

        return $this;
    }

    /**
     * Method to set the value of field doc_code
     *
     * @param string $doc_code
     * @return $this
     */
    public function setDocCode($doc_code)
    {
        $this->doc_code = $doc_code;

        return $this;
    }

    /**
     * Method to set the value of field doc_title
     *
     * @param string $doc_title
     * @return $this
     */
    public function setDocTitle($doc_title)
    {
        $this->doc_title = $doc_title;

        return $this;
    }

    /**
     * Method to set the value of field doc_content
     *
     * @param string $doc_content
     * @return $this
     */
    public function setDocContent($doc_content)
    {
        $this->doc_content = $doc_content;

        return $this;
    }

    /**
     * Method to set the value of field doc_time
     *
     * @param integer $doc_time
     * @return $this
     */
    public function setDocTime($doc_time)
    {
        $this->doc_time = $doc_time;

        return $this;
    }

    /**
     * Returns the value of field doc_id
     *
     * @return integer
     */
    public function getDocId()
    {
        return $this->doc_id;
    }

    /**
     * Returns the value of field doc_code
     *
     * @return string
     */
    public function getDocCode()
    {
        return $this->doc_code;
    }

    /**
     * Returns the value of field doc_title
     *
     * @return string
     */
    public function getDocTitle()
    {
        return $this->doc_title;
    }

    /**
     * Returns the value of field doc_content
     *
     * @return string
     */
    public function getDocContent()
    {
        return $this->doc_content;
    }

    /**
     * Returns the value of field doc_time
     *
     * @return integer
     */
    public function getDocTime()
    {
        return $this->doc_time;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'document';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Document[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Document
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
