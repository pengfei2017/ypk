<?php

namespace Ypk\Models;

class HelpType extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $type_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $type_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    protected $type_sort;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=true)
     */
    protected $help_code;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    protected $help_show;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    protected $page_show;

    /**
     * Method to set the value of field type_id
     *
     * @param integer $type_id
     * @return $this
     */
    public function setTypeId($type_id)
    {
        $this->type_id = $type_id;

        return $this;
    }

    /**
     * Method to set the value of field type_name
     *
     * @param string $type_name
     * @return $this
     */
    public function setTypeName($type_name)
    {
        $this->type_name = $type_name;

        return $this;
    }

    /**
     * Method to set the value of field type_sort
     *
     * @param integer $type_sort
     * @return $this
     */
    public function setTypeSort($type_sort)
    {
        $this->type_sort = $type_sort;

        return $this;
    }

    /**
     * Method to set the value of field help_code
     *
     * @param string $help_code
     * @return $this
     */
    public function setHelpCode($help_code)
    {
        $this->help_code = $help_code;

        return $this;
    }

    /**
     * Method to set the value of field help_show
     *
     * @param integer $help_show
     * @return $this
     */
    public function setHelpShow($help_show)
    {
        $this->help_show = $help_show;

        return $this;
    }

    /**
     * Method to set the value of field page_show
     *
     * @param integer $page_show
     * @return $this
     */
    public function setPageShow($page_show)
    {
        $this->page_show = $page_show;

        return $this;
    }

    /**
     * Returns the value of field type_id
     *
     * @return integer
     */
    public function getTypeId()
    {
        return $this->type_id;
    }

    /**
     * Returns the value of field type_name
     *
     * @return string
     */
    public function getTypeName()
    {
        return $this->type_name;
    }

    /**
     * Returns the value of field type_sort
     *
     * @return integer
     */
    public function getTypeSort()
    {
        return $this->type_sort;
    }

    /**
     * Returns the value of field help_code
     *
     * @return string
     */
    public function getHelpCode()
    {
        return $this->help_code;
    }

    /**
     * Returns the value of field help_show
     *
     * @return integer
     */
    public function getHelpShow()
    {
        return $this->help_show;
    }

    /**
     * Returns the value of field page_show
     *
     * @return integer
     */
    public function getPageShow()
    {
        return $this->page_show;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'help_type';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return HelpType[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return HelpType
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
