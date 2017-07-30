<?php

namespace Ypk\Models;

class WebCode extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $code_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $web_id;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $code_type;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=false)
     */
    protected $var_name;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $code_info;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=true)
     */
    protected $show_name;

    /**
     * Method to set the value of field code_id
     *
     * @param integer $code_id
     * @return $this
     */
    public function setCodeId($code_id)
    {
        $this->code_id = $code_id;

        return $this;
    }

    /**
     * Method to set the value of field web_id
     *
     * @param integer $web_id
     * @return $this
     */
    public function setWebId($web_id)
    {
        $this->web_id = $web_id;

        return $this;
    }

    /**
     * Method to set the value of field code_type
     *
     * @param string $code_type
     * @return $this
     */
    public function setCodeType($code_type)
    {
        $this->code_type = $code_type;

        return $this;
    }

    /**
     * Method to set the value of field var_name
     *
     * @param string $var_name
     * @return $this
     */
    public function setVarName($var_name)
    {
        $this->var_name = $var_name;

        return $this;
    }

    /**
     * Method to set the value of field code_info
     *
     * @param string $code_info
     * @return $this
     */
    public function setCodeInfo($code_info)
    {
        $this->code_info = $code_info;

        return $this;
    }

    /**
     * Method to set the value of field show_name
     *
     * @param string $show_name
     * @return $this
     */
    public function setShowName($show_name)
    {
        $this->show_name = $show_name;

        return $this;
    }

    /**
     * Returns the value of field code_id
     *
     * @return integer
     */
    public function getCodeId()
    {
        return $this->code_id;
    }

    /**
     * Returns the value of field web_id
     *
     * @return integer
     */
    public function getWebId()
    {
        return $this->web_id;
    }

    /**
     * Returns the value of field code_type
     *
     * @return string
     */
    public function getCodeType()
    {
        return $this->code_type;
    }

    /**
     * Returns the value of field var_name
     *
     * @return string
     */
    public function getVarName()
    {
        return $this->var_name;
    }

    /**
     * Returns the value of field code_info
     *
     * @return string
     */
    public function getCodeInfo()
    {
        return $this->code_info;
    }

    /**
     * Returns the value of field show_name
     *
     * @return string
     */
    public function getShowName()
    {
        return $this->show_name;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'web_code';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return WebCode[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return WebCode
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
