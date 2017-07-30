<?php

namespace Ypk\Models;

class CmsModuleAssembly extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $assembly_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $assembly_title;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $assembly_name;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $assembly_explain;

    /**
     * Method to set the value of field assembly_id
     *
     * @param integer $assembly_id
     * @return $this
     */
    public function setAssemblyId($assembly_id)
    {
        $this->assembly_id = $assembly_id;

        return $this;
    }

    /**
     * Method to set the value of field assembly_title
     *
     * @param string $assembly_title
     * @return $this
     */
    public function setAssemblyTitle($assembly_title)
    {
        $this->assembly_title = $assembly_title;

        return $this;
    }

    /**
     * Method to set the value of field assembly_name
     *
     * @param string $assembly_name
     * @return $this
     */
    public function setAssemblyName($assembly_name)
    {
        $this->assembly_name = $assembly_name;

        return $this;
    }

    /**
     * Method to set the value of field assembly_explain
     *
     * @param string $assembly_explain
     * @return $this
     */
    public function setAssemblyExplain($assembly_explain)
    {
        $this->assembly_explain = $assembly_explain;

        return $this;
    }

    /**
     * Returns the value of field assembly_id
     *
     * @return integer
     */
    public function getAssemblyId()
    {
        return $this->assembly_id;
    }

    /**
     * Returns the value of field assembly_title
     *
     * @return string
     */
    public function getAssemblyTitle()
    {
        return $this->assembly_title;
    }

    /**
     * Returns the value of field assembly_name
     *
     * @return string
     */
    public function getAssemblyName()
    {
        return $this->assembly_name;
    }

    /**
     * Returns the value of field assembly_explain
     *
     * @return string
     */
    public function getAssemblyExplain()
    {
        return $this->assembly_explain;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'cms_module_assembly';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CmsModuleAssembly[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CmsModuleAssembly
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
