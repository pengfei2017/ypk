<?php

namespace Ypk\Models;

class Web extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $web_id;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=true)
     */
    protected $web_name;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=true)
     */
    protected $style_name;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=true)
     */
    protected $web_page;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $update_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    protected $web_sort;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    protected $web_show;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $web_html;

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
     * Method to set the value of field web_name
     *
     * @param string $web_name
     * @return $this
     */
    public function setWebName($web_name)
    {
        $this->web_name = $web_name;

        return $this;
    }

    /**
     * Method to set the value of field style_name
     *
     * @param string $style_name
     * @return $this
     */
    public function setStyleName($style_name)
    {
        $this->style_name = $style_name;

        return $this;
    }

    /**
     * Method to set the value of field web_page
     *
     * @param string $web_page
     * @return $this
     */
    public function setWebPage($web_page)
    {
        $this->web_page = $web_page;

        return $this;
    }

    /**
     * Method to set the value of field update_time
     *
     * @param integer $update_time
     * @return $this
     */
    public function setUpdateTime($update_time)
    {
        $this->update_time = $update_time;

        return $this;
    }

    /**
     * Method to set the value of field web_sort
     *
     * @param integer $web_sort
     * @return $this
     */
    public function setWebSort($web_sort)
    {
        $this->web_sort = $web_sort;

        return $this;
    }

    /**
     * Method to set the value of field web_show
     *
     * @param integer $web_show
     * @return $this
     */
    public function setWebShow($web_show)
    {
        $this->web_show = $web_show;

        return $this;
    }

    /**
     * Method to set the value of field web_html
     *
     * @param string $web_html
     * @return $this
     */
    public function setWebHtml($web_html)
    {
        $this->web_html = $web_html;

        return $this;
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
     * Returns the value of field web_name
     *
     * @return string
     */
    public function getWebName()
    {
        return $this->web_name;
    }

    /**
     * Returns the value of field style_name
     *
     * @return string
     */
    public function getStyleName()
    {
        return $this->style_name;
    }

    /**
     * Returns the value of field web_page
     *
     * @return string
     */
    public function getWebPage()
    {
        return $this->web_page;
    }

    /**
     * Returns the value of field update_time
     *
     * @return integer
     */
    public function getUpdateTime()
    {
        return $this->update_time;
    }

    /**
     * Returns the value of field web_sort
     *
     * @return integer
     */
    public function getWebSort()
    {
        return $this->web_sort;
    }

    /**
     * Returns the value of field web_show
     *
     * @return integer
     */
    public function getWebShow()
    {
        return $this->web_show;
    }

    /**
     * Returns the value of field web_html
     *
     * @return string
     */
    public function getWebHtml()
    {
        return $this->web_html;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'web';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Web[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Web
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
