<?php

namespace Ypk\Models;

class Store extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $store_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $store_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $grade_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $member_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $member_name;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $seller_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $sc_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $store_company_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=8, nullable=false)
     */
    protected $province_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $area_info;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $store_address;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $store_zip;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $store_state;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $store_close_info;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $store_sort;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $store_time;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=true)
     */
    protected $store_end_time;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $store_label;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $store_banner;

    /**
     *
     * @var string
     * @Column(type="string", length=150, nullable=true)
     */
    protected $store_avatar;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $store_keywords;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $store_description;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $store_qq;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $store_ww;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=true)
     */
    protected $store_phone;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $store_zy;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $store_domain;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    protected $store_domain_times;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $store_recommend;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $store_theme;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $store_credit;

    /**
     *
     * @var double
     * @Column(type="double", nullable=false)
     */
    protected $store_desccredit;

    /**
     *
     * @var double
     * @Column(type="double", nullable=false)
     */
    protected $store_servicecredit;

    /**
     *
     * @var double
     * @Column(type="double", nullable=false)
     */
    protected $store_deliverycredit;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $store_collect;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $store_slide;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $store_slide_url;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=true)
     */
    protected $store_stamp;

    /**
     *
     * @var string
     * @Column(type="string", length=500, nullable=true)
     */
    protected $store_printdesc;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $store_sales;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $store_presales;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $store_aftersales;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $store_workingtime;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $store_free_price;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $store_decoration_switch;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $store_decoration_only;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $store_decoration_image_count;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $is_own_shop;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $bind_all_gc;

    /**
     *
     * @var string
     * @Column(type="string", length=3, nullable=true)
     */
    protected $store_vrcode_prefix;

    /**
     *
     * @var string
     * @Column(type="string", length=150, nullable=true)
     */
    protected $mb_title_img;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $mb_sliders;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $left_bar_type;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $deliver_region;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $is_distribution;

    /**
     * Method to set the value of field store_id
     *
     * @param integer $store_id
     * @return $this
     */
    public function setStoreId($store_id)
    {
        $this->store_id = $store_id;

        return $this;
    }

    /**
     * Method to set the value of field store_name
     *
     * @param string $store_name
     * @return $this
     */
    public function setStoreName($store_name)
    {
        $this->store_name = $store_name;

        return $this;
    }

    /**
     * Method to set the value of field grade_id
     *
     * @param integer $grade_id
     * @return $this
     */
    public function setGradeId($grade_id)
    {
        $this->grade_id = $grade_id;

        return $this;
    }

    /**
     * Method to set the value of field member_id
     *
     * @param integer $member_id
     * @return $this
     */
    public function setMemberId($member_id)
    {
        $this->member_id = $member_id;

        return $this;
    }

    /**
     * Method to set the value of field member_name
     *
     * @param string $member_name
     * @return $this
     */
    public function setMemberName($member_name)
    {
        $this->member_name = $member_name;

        return $this;
    }

    /**
     * Method to set the value of field seller_name
     *
     * @param string $seller_name
     * @return $this
     */
    public function setSellerName($seller_name)
    {
        $this->seller_name = $seller_name;

        return $this;
    }

    /**
     * Method to set the value of field sc_id
     *
     * @param integer $sc_id
     * @return $this
     */
    public function setScId($sc_id)
    {
        $this->sc_id = $sc_id;

        return $this;
    }

    /**
     * Method to set the value of field store_company_name
     *
     * @param string $store_company_name
     * @return $this
     */
    public function setStoreCompanyName($store_company_name)
    {
        $this->store_company_name = $store_company_name;

        return $this;
    }

    /**
     * Method to set the value of field province_id
     *
     * @param integer $province_id
     * @return $this
     */
    public function setProvinceId($province_id)
    {
        $this->province_id = $province_id;

        return $this;
    }

    /**
     * Method to set the value of field area_info
     *
     * @param string $area_info
     * @return $this
     */
    public function setAreaInfo($area_info)
    {
        $this->area_info = $area_info;

        return $this;
    }

    /**
     * Method to set the value of field store_address
     *
     * @param string $store_address
     * @return $this
     */
    public function setStoreAddress($store_address)
    {
        $this->store_address = $store_address;

        return $this;
    }

    /**
     * Method to set the value of field store_zip
     *
     * @param string $store_zip
     * @return $this
     */
    public function setStoreZip($store_zip)
    {
        $this->store_zip = $store_zip;

        return $this;
    }

    /**
     * Method to set the value of field store_state
     *
     * @param integer $store_state
     * @return $this
     */
    public function setStoreState($store_state)
    {
        $this->store_state = $store_state;

        return $this;
    }

    /**
     * Method to set the value of field store_close_info
     *
     * @param string $store_close_info
     * @return $this
     */
    public function setStoreCloseInfo($store_close_info)
    {
        $this->store_close_info = $store_close_info;

        return $this;
    }

    /**
     * Method to set the value of field store_sort
     *
     * @param integer $store_sort
     * @return $this
     */
    public function setStoreSort($store_sort)
    {
        $this->store_sort = $store_sort;

        return $this;
    }

    /**
     * Method to set the value of field store_time
     *
     * @param string $store_time
     * @return $this
     */
    public function setStoreTime($store_time)
    {
        $this->store_time = $store_time;

        return $this;
    }

    /**
     * Method to set the value of field store_end_time
     *
     * @param string $store_end_time
     * @return $this
     */
    public function setStoreEndTime($store_end_time)
    {
        $this->store_end_time = $store_end_time;

        return $this;
    }

    /**
     * Method to set the value of field store_label
     *
     * @param string $store_label
     * @return $this
     */
    public function setStoreLabel($store_label)
    {
        $this->store_label = $store_label;

        return $this;
    }

    /**
     * Method to set the value of field store_banner
     *
     * @param string $store_banner
     * @return $this
     */
    public function setStoreBanner($store_banner)
    {
        $this->store_banner = $store_banner;

        return $this;
    }

    /**
     * Method to set the value of field store_avatar
     *
     * @param string $store_avatar
     * @return $this
     */
    public function setStoreAvatar($store_avatar)
    {
        $this->store_avatar = $store_avatar;

        return $this;
    }

    /**
     * Method to set the value of field store_keywords
     *
     * @param string $store_keywords
     * @return $this
     */
    public function setStoreKeywords($store_keywords)
    {
        $this->store_keywords = $store_keywords;

        return $this;
    }

    /**
     * Method to set the value of field store_description
     *
     * @param string $store_description
     * @return $this
     */
    public function setStoreDescription($store_description)
    {
        $this->store_description = $store_description;

        return $this;
    }

    /**
     * Method to set the value of field store_qq
     *
     * @param string $store_qq
     * @return $this
     */
    public function setStoreQq($store_qq)
    {
        $this->store_qq = $store_qq;

        return $this;
    }

    /**
     * Method to set the value of field store_ww
     *
     * @param string $store_ww
     * @return $this
     */
    public function setStoreWw($store_ww)
    {
        $this->store_ww = $store_ww;

        return $this;
    }

    /**
     * Method to set the value of field store_phone
     *
     * @param string $store_phone
     * @return $this
     */
    public function setStorePhone($store_phone)
    {
        $this->store_phone = $store_phone;

        return $this;
    }

    /**
     * Method to set the value of field store_zy
     *
     * @param string $store_zy
     * @return $this
     */
    public function setStoreZy($store_zy)
    {
        $this->store_zy = $store_zy;

        return $this;
    }

    /**
     * Method to set the value of field store_domain
     *
     * @param string $store_domain
     * @return $this
     */
    public function setStoreDomain($store_domain)
    {
        $this->store_domain = $store_domain;

        return $this;
    }

    /**
     * Method to set the value of field store_domain_times
     *
     * @param integer $store_domain_times
     * @return $this
     */
    public function setStoreDomainTimes($store_domain_times)
    {
        $this->store_domain_times = $store_domain_times;

        return $this;
    }

    /**
     * Method to set the value of field store_recommend
     *
     * @param integer $store_recommend
     * @return $this
     */
    public function setStoreRecommend($store_recommend)
    {
        $this->store_recommend = $store_recommend;

        return $this;
    }

    /**
     * Method to set the value of field store_theme
     *
     * @param string $store_theme
     * @return $this
     */
    public function setStoreTheme($store_theme)
    {
        $this->store_theme = $store_theme;

        return $this;
    }

    /**
     * Method to set the value of field store_credit
     *
     * @param integer $store_credit
     * @return $this
     */
    public function setStoreCredit($store_credit)
    {
        $this->store_credit = $store_credit;

        return $this;
    }

    /**
     * Method to set the value of field store_desccredit
     *
     * @param double $store_desccredit
     * @return $this
     */
    public function setStoreDesccredit($store_desccredit)
    {
        $this->store_desccredit = $store_desccredit;

        return $this;
    }

    /**
     * Method to set the value of field store_servicecredit
     *
     * @param double $store_servicecredit
     * @return $this
     */
    public function setStoreServicecredit($store_servicecredit)
    {
        $this->store_servicecredit = $store_servicecredit;

        return $this;
    }

    /**
     * Method to set the value of field store_deliverycredit
     *
     * @param double $store_deliverycredit
     * @return $this
     */
    public function setStoreDeliverycredit($store_deliverycredit)
    {
        $this->store_deliverycredit = $store_deliverycredit;

        return $this;
    }

    /**
     * Method to set the value of field store_collect
     *
     * @param integer $store_collect
     * @return $this
     */
    public function setStoreCollect($store_collect)
    {
        $this->store_collect = $store_collect;

        return $this;
    }

    /**
     * Method to set the value of field store_slide
     *
     * @param string $store_slide
     * @return $this
     */
    public function setStoreSlide($store_slide)
    {
        $this->store_slide = $store_slide;

        return $this;
    }

    /**
     * Method to set the value of field store_slide_url
     *
     * @param string $store_slide_url
     * @return $this
     */
    public function setStoreSlideUrl($store_slide_url)
    {
        $this->store_slide_url = $store_slide_url;

        return $this;
    }

    /**
     * Method to set the value of field store_stamp
     *
     * @param string $store_stamp
     * @return $this
     */
    public function setStoreStamp($store_stamp)
    {
        $this->store_stamp = $store_stamp;

        return $this;
    }

    /**
     * Method to set the value of field store_printdesc
     *
     * @param string $store_printdesc
     * @return $this
     */
    public function setStorePrintdesc($store_printdesc)
    {
        $this->store_printdesc = $store_printdesc;

        return $this;
    }

    /**
     * Method to set the value of field store_sales
     *
     * @param integer $store_sales
     * @return $this
     */
    public function setStoreSales($store_sales)
    {
        $this->store_sales = $store_sales;

        return $this;
    }

    /**
     * Method to set the value of field store_presales
     *
     * @param string $store_presales
     * @return $this
     */
    public function setStorePresales($store_presales)
    {
        $this->store_presales = $store_presales;

        return $this;
    }

    /**
     * Method to set the value of field store_aftersales
     *
     * @param string $store_aftersales
     * @return $this
     */
    public function setStoreAftersales($store_aftersales)
    {
        $this->store_aftersales = $store_aftersales;

        return $this;
    }

    /**
     * Method to set the value of field store_workingtime
     *
     * @param string $store_workingtime
     * @return $this
     */
    public function setStoreWorkingtime($store_workingtime)
    {
        $this->store_workingtime = $store_workingtime;

        return $this;
    }

    /**
     * Method to set the value of field store_free_price
     *
     * @param double $store_free_price
     * @return $this
     */
    public function setStoreFreePrice($store_free_price)
    {
        $this->store_free_price = $store_free_price;

        return $this;
    }

    /**
     * Method to set the value of field store_decoration_switch
     *
     * @param integer $store_decoration_switch
     * @return $this
     */
    public function setStoreDecorationSwitch($store_decoration_switch)
    {
        $this->store_decoration_switch = $store_decoration_switch;

        return $this;
    }

    /**
     * Method to set the value of field store_decoration_only
     *
     * @param integer $store_decoration_only
     * @return $this
     */
    public function setStoreDecorationOnly($store_decoration_only)
    {
        $this->store_decoration_only = $store_decoration_only;

        return $this;
    }

    /**
     * Method to set the value of field store_decoration_image_count
     *
     * @param integer $store_decoration_image_count
     * @return $this
     */
    public function setStoreDecorationImageCount($store_decoration_image_count)
    {
        $this->store_decoration_image_count = $store_decoration_image_count;

        return $this;
    }

    /**
     * Method to set the value of field is_own_shop
     *
     * @param integer $is_own_shop
     * @return $this
     */
    public function setIsOwnShop($is_own_shop)
    {
        $this->is_own_shop = $is_own_shop;

        return $this;
    }

    /**
     * Method to set the value of field bind_all_gc
     *
     * @param integer $bind_all_gc
     * @return $this
     */
    public function setBindAllGc($bind_all_gc)
    {
        $this->bind_all_gc = $bind_all_gc;

        return $this;
    }

    /**
     * Method to set the value of field store_vrcode_prefix
     *
     * @param string $store_vrcode_prefix
     * @return $this
     */
    public function setStoreVrcodePrefix($store_vrcode_prefix)
    {
        $this->store_vrcode_prefix = $store_vrcode_prefix;

        return $this;
    }

    /**
     * Method to set the value of field mb_title_img
     *
     * @param string $mb_title_img
     * @return $this
     */
    public function setMbTitleImg($mb_title_img)
    {
        $this->mb_title_img = $mb_title_img;

        return $this;
    }

    /**
     * Method to set the value of field mb_sliders
     *
     * @param string $mb_sliders
     * @return $this
     */
    public function setMbSliders($mb_sliders)
    {
        $this->mb_sliders = $mb_sliders;

        return $this;
    }

    /**
     * Method to set the value of field left_bar_type
     *
     * @param integer $left_bar_type
     * @return $this
     */
    public function setLeftBarType($left_bar_type)
    {
        $this->left_bar_type = $left_bar_type;

        return $this;
    }

    /**
     * Method to set the value of field deliver_region
     *
     * @param string $deliver_region
     * @return $this
     */
    public function setDeliverRegion($deliver_region)
    {
        $this->deliver_region = $deliver_region;

        return $this;
    }

    /**
     * Method to set the value of field is_distribution
     *
     * @param integer $is_distribution
     * @return $this
     */
    public function setIsDistribution($is_distribution)
    {
        $this->is_distribution = $is_distribution;

        return $this;
    }

    /**
     * Returns the value of field store_id
     *
     * @return integer
     */
    public function getStoreId()
    {
        return $this->store_id;
    }

    /**
     * Returns the value of field store_name
     *
     * @return string
     */
    public function getStoreName()
    {
        return $this->store_name;
    }

    /**
     * Returns the value of field grade_id
     *
     * @return integer
     */
    public function getGradeId()
    {
        return $this->grade_id;
    }

    /**
     * Returns the value of field member_id
     *
     * @return integer
     */
    public function getMemberId()
    {
        return $this->member_id;
    }

    /**
     * Returns the value of field member_name
     *
     * @return string
     */
    public function getMemberName()
    {
        return $this->member_name;
    }

    /**
     * Returns the value of field seller_name
     *
     * @return string
     */
    public function getSellerName()
    {
        return $this->seller_name;
    }

    /**
     * Returns the value of field sc_id
     *
     * @return integer
     */
    public function getScId()
    {
        return $this->sc_id;
    }

    /**
     * Returns the value of field store_company_name
     *
     * @return string
     */
    public function getStoreCompanyName()
    {
        return $this->store_company_name;
    }

    /**
     * Returns the value of field province_id
     *
     * @return integer
     */
    public function getProvinceId()
    {
        return $this->province_id;
    }

    /**
     * Returns the value of field area_info
     *
     * @return string
     */
    public function getAreaInfo()
    {
        return $this->area_info;
    }

    /**
     * Returns the value of field store_address
     *
     * @return string
     */
    public function getStoreAddress()
    {
        return $this->store_address;
    }

    /**
     * Returns the value of field store_zip
     *
     * @return string
     */
    public function getStoreZip()
    {
        return $this->store_zip;
    }

    /**
     * Returns the value of field store_state
     *
     * @return integer
     */
    public function getStoreState()
    {
        return $this->store_state;
    }

    /**
     * Returns the value of field store_close_info
     *
     * @return string
     */
    public function getStoreCloseInfo()
    {
        return $this->store_close_info;
    }

    /**
     * Returns the value of field store_sort
     *
     * @return integer
     */
    public function getStoreSort()
    {
        return $this->store_sort;
    }

    /**
     * Returns the value of field store_time
     *
     * @return string
     */
    public function getStoreTime()
    {
        return $this->store_time;
    }

    /**
     * Returns the value of field store_end_time
     *
     * @return string
     */
    public function getStoreEndTime()
    {
        return $this->store_end_time;
    }

    /**
     * Returns the value of field store_label
     *
     * @return string
     */
    public function getStoreLabel()
    {
        return $this->store_label;
    }

    /**
     * Returns the value of field store_banner
     *
     * @return string
     */
    public function getStoreBanner()
    {
        return $this->store_banner;
    }

    /**
     * Returns the value of field store_avatar
     *
     * @return string
     */
    public function getStoreAvatar()
    {
        return $this->store_avatar;
    }

    /**
     * Returns the value of field store_keywords
     *
     * @return string
     */
    public function getStoreKeywords()
    {
        return $this->store_keywords;
    }

    /**
     * Returns the value of field store_description
     *
     * @return string
     */
    public function getStoreDescription()
    {
        return $this->store_description;
    }

    /**
     * Returns the value of field store_qq
     *
     * @return string
     */
    public function getStoreQq()
    {
        return $this->store_qq;
    }

    /**
     * Returns the value of field store_ww
     *
     * @return string
     */
    public function getStoreWw()
    {
        return $this->store_ww;
    }

    /**
     * Returns the value of field store_phone
     *
     * @return string
     */
    public function getStorePhone()
    {
        return $this->store_phone;
    }

    /**
     * Returns the value of field store_zy
     *
     * @return string
     */
    public function getStoreZy()
    {
        return $this->store_zy;
    }

    /**
     * Returns the value of field store_domain
     *
     * @return string
     */
    public function getStoreDomain()
    {
        return $this->store_domain;
    }

    /**
     * Returns the value of field store_domain_times
     *
     * @return integer
     */
    public function getStoreDomainTimes()
    {
        return $this->store_domain_times;
    }

    /**
     * Returns the value of field store_recommend
     *
     * @return integer
     */
    public function getStoreRecommend()
    {
        return $this->store_recommend;
    }

    /**
     * Returns the value of field store_theme
     *
     * @return string
     */
    public function getStoreTheme()
    {
        return $this->store_theme;
    }

    /**
     * Returns the value of field store_credit
     *
     * @return integer
     */
    public function getStoreCredit()
    {
        return $this->store_credit;
    }

    /**
     * Returns the value of field store_desccredit
     *
     * @return double
     */
    public function getStoreDesccredit()
    {
        return $this->store_desccredit;
    }

    /**
     * Returns the value of field store_servicecredit
     *
     * @return double
     */
    public function getStoreServicecredit()
    {
        return $this->store_servicecredit;
    }

    /**
     * Returns the value of field store_deliverycredit
     *
     * @return double
     */
    public function getStoreDeliverycredit()
    {
        return $this->store_deliverycredit;
    }

    /**
     * Returns the value of field store_collect
     *
     * @return integer
     */
    public function getStoreCollect()
    {
        return $this->store_collect;
    }

    /**
     * Returns the value of field store_slide
     *
     * @return string
     */
    public function getStoreSlide()
    {
        return $this->store_slide;
    }

    /**
     * Returns the value of field store_slide_url
     *
     * @return string
     */
    public function getStoreSlideUrl()
    {
        return $this->store_slide_url;
    }

    /**
     * Returns the value of field store_stamp
     *
     * @return string
     */
    public function getStoreStamp()
    {
        return $this->store_stamp;
    }

    /**
     * Returns the value of field store_printdesc
     *
     * @return string
     */
    public function getStorePrintdesc()
    {
        return $this->store_printdesc;
    }

    /**
     * Returns the value of field store_sales
     *
     * @return integer
     */
    public function getStoreSales()
    {
        return $this->store_sales;
    }

    /**
     * Returns the value of field store_presales
     *
     * @return string
     */
    public function getStorePresales()
    {
        return $this->store_presales;
    }

    /**
     * Returns the value of field store_aftersales
     *
     * @return string
     */
    public function getStoreAftersales()
    {
        return $this->store_aftersales;
    }

    /**
     * Returns the value of field store_workingtime
     *
     * @return string
     */
    public function getStoreWorkingtime()
    {
        return $this->store_workingtime;
    }

    /**
     * Returns the value of field store_free_price
     *
     * @return double
     */
    public function getStoreFreePrice()
    {
        return $this->store_free_price;
    }

    /**
     * Returns the value of field store_decoration_switch
     *
     * @return integer
     */
    public function getStoreDecorationSwitch()
    {
        return $this->store_decoration_switch;
    }

    /**
     * Returns the value of field store_decoration_only
     *
     * @return integer
     */
    public function getStoreDecorationOnly()
    {
        return $this->store_decoration_only;
    }

    /**
     * Returns the value of field store_decoration_image_count
     *
     * @return integer
     */
    public function getStoreDecorationImageCount()
    {
        return $this->store_decoration_image_count;
    }

    /**
     * Returns the value of field is_own_shop
     *
     * @return integer
     */
    public function getIsOwnShop()
    {
        return $this->is_own_shop;
    }

    /**
     * Returns the value of field bind_all_gc
     *
     * @return integer
     */
    public function getBindAllGc()
    {
        return $this->bind_all_gc;
    }

    /**
     * Returns the value of field store_vrcode_prefix
     *
     * @return string
     */
    public function getStoreVrcodePrefix()
    {
        return $this->store_vrcode_prefix;
    }

    /**
     * Returns the value of field mb_title_img
     *
     * @return string
     */
    public function getMbTitleImg()
    {
        return $this->mb_title_img;
    }

    /**
     * Returns the value of field mb_sliders
     *
     * @return string
     */
    public function getMbSliders()
    {
        return $this->mb_sliders;
    }

    /**
     * Returns the value of field left_bar_type
     *
     * @return integer
     */
    public function getLeftBarType()
    {
        return $this->left_bar_type;
    }

    /**
     * Returns the value of field deliver_region
     *
     * @return string
     */
    public function getDeliverRegion()
    {
        return $this->deliver_region;
    }

    /**
     * Returns the value of field is_distribution
     *
     * @return integer
     */
    public function getIsDistribution()
    {
        return $this->is_distribution;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'store';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Store[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Store
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
