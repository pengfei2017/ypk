<?php

namespace Ypk\Models;

class CmsModule extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $module_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $module_title;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $module_name;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $module_type;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $module_class;

    /**
     * Method to set the value of field module_id
     *
     * @param integer $module_id
     * @return $this
     */
    public function setModuleId($module_id)
    {
        $this->module_id = $module_id;

        return $this;
    }

    /**
     * Method to set the value of field module_title
     *
     * @param string $module_title
     * @return $this
     */
    public function setModuleTitle($module_title)
    {
        $this->module_title = $module_title;

        return $this;
    }

    /**
     * Method to set the value of field module_name
     *
     * @param string $module_name
     * @return $this
     */
    public function setModuleName($module_name)
    {
        $this->module_name = $module_name;

        return $this;
    }

    /**
     * Method to set the value of field module_type
     *
     * @param string $module_type
     * @return $this
     */
    public function setModuleType($module_type)
    {
        $this->module_type = $module_type;

        return $this;
    }

    /**
     * Method to set the value of field module_class
     *
     * @param integer $module_class
     * @return $this
     */
    public function setModuleClass($module_class)
    {
        $this->module_class = $module_class;

        return $this;
    }

    /**
     * Returns the value of field module_id
     *
     * @return integer
     */
    public function getModuleId()
    {
        return $this->module_id;
    }

    /**
     * Returns the value of field module_title
     *
     * @return string
     */
    public function getModuleTitle()
    {
        return $this->module_title;
    }

    /**
     * Returns the value of field module_name
     *
     * @return string
     */
    public function getModuleName()
    {
        return $this->module_name;
    }

    /**
     * Returns the value of field module_type
     *
     * @return string
     */
    public function getModuleType()
    {
        return $this->module_type;
    }

    /**
     * Returns the value of field module_class
     *
     * @return integer
     */
    public function getModuleClass()
    {
        return $this->module_class;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'cms_module';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CmsModule[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CmsModule
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
