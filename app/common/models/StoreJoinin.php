<?php

namespace Ypk\Models;

class StoreJoinin extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $member_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $member_name;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $company_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=8, nullable=false)
     */
    protected $company_province_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $company_address;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $company_address_detail;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=true)
     */
    protected $company_phone;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $company_employee_count;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $company_registered_capital;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $contacts_name;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=true)
     */
    protected $contacts_phone;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $contacts_email;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $business_licence_number;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $business_licence_address;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $business_licence_start;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $business_licence_end;

    /**
     *
     * @var string
     * @Column(type="string", length=1000, nullable=true)
     */
    protected $business_sphere;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $business_licence_number_elc;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $organization_code;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $organization_code_electronic;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $general_taxpayer;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $bank_account_name;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $bank_account_number;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $bank_name;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $bank_code;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $bank_address;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $bank_licence_electronic;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    protected $is_settlement_account;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $settlement_bank_account_name;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $settlement_bank_account_number;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $settlement_bank_name;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $settlement_bank_code;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $settlement_bank_address;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $tax_registration_certificate;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $taxpayer_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $tax_registration_certif_elc;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $seller_name;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $store_name;

    /**
     *
     * @var string
     * @Column(type="string", length=1000, nullable=true)
     */
    protected $store_class_ids;

    /**
     *
     * @var string
     * @Column(type="string", length=1000, nullable=true)
     */
    protected $store_class_names;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $joinin_state;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=true)
     */
    protected $joinin_message;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $joinin_year;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $sg_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $sg_id;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=true)
     */
    protected $sg_info;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $sc_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $sc_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=8, nullable=false)
     */
    protected $sc_bail;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=true)
     */
    protected $store_class_commis_rates;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $paying_money_certificate;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=true)
     */
    protected $paying_money_certif_exp;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $paying_amount;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=true)
     */
    protected $business_departments;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=true)
     */
    protected $business_professional;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=true)
     */
    protected $business_lockHospital;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=true)
     */
    protected $business_activeHospital;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=true)
     */
    protected $business_idcard_number;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=true)
     */
    protected $business_person_body;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=true)
     */
    protected $business_id_card;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=true)
     */
    protected $business_qualification_certificate;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=true)
     */
    protected $business_certified_certificate;

    /**
     *
     * @var string
     * @Column(type="string", length=5000, nullable=true)
     */
    protected $mail_content;

    /**
     * @return string
     */
    public function getBusinessDepartments()
    {
        return $this->business_departments;
    }

    /**
     * @param string $business_departments
     */
    public function setBusinessDepartments($business_departments)
    {
        $this->business_departments = $business_departments;
    }

    /**
     * @return string
     */
    public function getBusinessProfessional()
    {
        return $this->business_professional;
    }

    /**
     * @param string $business_professional
     */
    public function setBusinessProfessional($business_professional)
    {
        $this->business_professional = $business_professional;
    }

    /**
     * @return string
     */
    public function getBusinessLockHospital()
    {
        return $this->business_lockHospital;
    }

    /**
     * @param string $business_lockHospital
     */
    public function setBusinessLockHospital($business_lockHospital)
    {
        $this->business_lockHospital = $business_lockHospital;
    }

    /**
     * @return string
     */
    public function getBusinessActiveHospital()
    {
        return $this->business_activeHospital;
    }

    /**
     * @param string $business_activeHospital
     */
    public function setBusinessActiveHospital($business_activeHospital)
    {
        $this->business_activeHospital = $business_activeHospital;
    }

    /**
     * @return string
     */
    public function getBusinessIdcardNumber()
    {
        return $this->business_idcard_number;
    }

    /**
     * @param string $business_idcard_number
     */
    public function setBusinessIdcardNumber($business_idcard_number)
    {
        $this->business_idcard_number = $business_idcard_number;
    }

    /**
     * @return string
     */
    public function getBusinessPersonBody()
    {
        return $this->business_person_body;
    }

    /**
     * @param string $business_person_body
     */
    public function setBusinessPersonBody($business_person_body)
    {
        $this->business_person_body = $business_person_body;
    }

    /**
     * @return string
     */
    public function getBusinessIdCard()
    {
        return $this->business_id_card;
    }

    /**
     * @param string $business_id_card
     */
    public function setBusinessIdCard($business_id_card)
    {
        $this->business_id_card = $business_id_card;
    }

    /**
     * @return string
     */
    public function getBusinessQualificationCertificate()
    {
        return $this->business_qualification_certificate;
    }

    /**
     * @param string $business_qualification_certificate
     */
    public function setBusinessQualificationCertificate($business_qualification_certificate)
    {
        $this->business_qualification_certificate = $business_qualification_certificate;
    }

    /**
     * @return string
     */
    public function getBusinessCertifiedCertificate()
    {
        return $this->business_certified_certificate;
    }

    /**
     * @param string $business_certified_certificate
     */
    public function setBusinessCertifiedCertificate($business_certified_certificate)
    {
        $this->business_certified_certificate = $business_certified_certificate;
    }

    /**
     * @return string
     */
    public function getMailContent()
    {
        return $this->mail_content;
    }

    /**
     * @param string $mail_content
     */
    public function setMailContent($mail_content)
    {
        $this->mail_content = $mail_content;
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
     * Method to set the value of field company_name
     *
     * @param string $company_name
     * @return $this
     */
    public function setCompanyName($company_name)
    {
        $this->company_name = $company_name;

        return $this;
    }

    /**
     * Method to set the value of field company_province_id
     *
     * @param integer $company_province_id
     * @return $this
     */
    public function setCompanyProvinceId($company_province_id)
    {
        $this->company_province_id = $company_province_id;

        return $this;
    }

    /**
     * Method to set the value of field company_address
     *
     * @param string $company_address
     * @return $this
     */
    public function setCompanyAddress($company_address)
    {
        $this->company_address = $company_address;

        return $this;
    }

    /**
     * Method to set the value of field company_address_detail
     *
     * @param string $company_address_detail
     * @return $this
     */
    public function setCompanyAddressDetail($company_address_detail)
    {
        $this->company_address_detail = $company_address_detail;

        return $this;
    }

    /**
     * Method to set the value of field company_phone
     *
     * @param string $company_phone
     * @return $this
     */
    public function setCompanyPhone($company_phone)
    {
        $this->company_phone = $company_phone;

        return $this;
    }

    /**
     * Method to set the value of field company_employee_count
     *
     * @param integer $company_employee_count
     * @return $this
     */
    public function setCompanyEmployeeCount($company_employee_count)
    {
        $this->company_employee_count = $company_employee_count;

        return $this;
    }

    /**
     * Method to set the value of field company_registered_capital
     *
     * @param integer $company_registered_capital
     * @return $this
     */
    public function setCompanyRegisteredCapital($company_registered_capital)
    {
        $this->company_registered_capital = $company_registered_capital;

        return $this;
    }

    /**
     * Method to set the value of field contacts_name
     *
     * @param string $contacts_name
     * @return $this
     */
    public function setContactsName($contacts_name)
    {
        $this->contacts_name = $contacts_name;

        return $this;
    }

    /**
     * Method to set the value of field contacts_phone
     *
     * @param string $contacts_phone
     * @return $this
     */
    public function setContactsPhone($contacts_phone)
    {
        $this->contacts_phone = $contacts_phone;

        return $this;
    }

    /**
     * Method to set the value of field contacts_email
     *
     * @param string $contacts_email
     * @return $this
     */
    public function setContactsEmail($contacts_email)
    {
        $this->contacts_email = $contacts_email;

        return $this;
    }

    /**
     * Method to set the value of field business_licence_number
     *
     * @param string $business_licence_number
     * @return $this
     */
    public function setBusinessLicenceNumber($business_licence_number)
    {
        $this->business_licence_number = $business_licence_number;

        return $this;
    }

    /**
     * Method to set the value of field business_licence_address
     *
     * @param string $business_licence_address
     * @return $this
     */
    public function setBusinessLicenceAddress($business_licence_address)
    {
        $this->business_licence_address = $business_licence_address;

        return $this;
    }

    /**
     * Method to set the value of field business_licence_start
     *
     * @param string $business_licence_start
     * @return $this
     */
    public function setBusinessLicenceStart($business_licence_start)
    {
        $this->business_licence_start = $business_licence_start;

        return $this;
    }

    /**
     * Method to set the value of field business_licence_end
     *
     * @param string $business_licence_end
     * @return $this
     */
    public function setBusinessLicenceEnd($business_licence_end)
    {
        $this->business_licence_end = $business_licence_end;

        return $this;
    }

    /**
     * Method to set the value of field business_sphere
     *
     * @param string $business_sphere
     * @return $this
     */
    public function setBusinessSphere($business_sphere)
    {
        $this->business_sphere = $business_sphere;

        return $this;
    }

    /**
     * Method to set the value of field business_licence_number_elc
     *
     * @param string $business_licence_number_elc
     * @return $this
     */
    public function setBusinessLicenceNumberElc($business_licence_number_elc)
    {
        $this->business_licence_number_elc = $business_licence_number_elc;

        return $this;
    }

    /**
     * Method to set the value of field organization_code
     *
     * @param string $organization_code
     * @return $this
     */
    public function setOrganizationCode($organization_code)
    {
        $this->organization_code = $organization_code;

        return $this;
    }

    /**
     * Method to set the value of field organization_code_electronic
     *
     * @param string $organization_code_electronic
     * @return $this
     */
    public function setOrganizationCodeElectronic($organization_code_electronic)
    {
        $this->organization_code_electronic = $organization_code_electronic;

        return $this;
    }

    /**
     * Method to set the value of field general_taxpayer
     *
     * @param string $general_taxpayer
     * @return $this
     */
    public function setGeneralTaxpayer($general_taxpayer)
    {
        $this->general_taxpayer = $general_taxpayer;

        return $this;
    }

    /**
     * Method to set the value of field bank_account_name
     *
     * @param string $bank_account_name
     * @return $this
     */
    public function setBankAccountName($bank_account_name)
    {
        $this->bank_account_name = $bank_account_name;

        return $this;
    }

    /**
     * Method to set the value of field bank_account_number
     *
     * @param string $bank_account_number
     * @return $this
     */
    public function setBankAccountNumber($bank_account_number)
    {
        $this->bank_account_number = $bank_account_number;

        return $this;
    }

    /**
     * Method to set the value of field bank_name
     *
     * @param string $bank_name
     * @return $this
     */
    public function setBankName($bank_name)
    {
        $this->bank_name = $bank_name;

        return $this;
    }

    /**
     * Method to set the value of field bank_code
     *
     * @param string $bank_code
     * @return $this
     */
    public function setBankCode($bank_code)
    {
        $this->bank_code = $bank_code;

        return $this;
    }

    /**
     * Method to set the value of field bank_address
     *
     * @param string $bank_address
     * @return $this
     */
    public function setBankAddress($bank_address)
    {
        $this->bank_address = $bank_address;

        return $this;
    }

    /**
     * Method to set the value of field bank_licence_electronic
     *
     * @param string $bank_licence_electronic
     * @return $this
     */
    public function setBankLicenceElectronic($bank_licence_electronic)
    {
        $this->bank_licence_electronic = $bank_licence_electronic;

        return $this;
    }

    /**
     * Method to set the value of field is_settlement_account
     *
     * @param integer $is_settlement_account
     * @return $this
     */
    public function setIsSettlementAccount($is_settlement_account)
    {
        $this->is_settlement_account = $is_settlement_account;

        return $this;
    }

    /**
     * Method to set the value of field settlement_bank_account_name
     *
     * @param string $settlement_bank_account_name
     * @return $this
     */
    public function setSettlementBankAccountName($settlement_bank_account_name)
    {
        $this->settlement_bank_account_name = $settlement_bank_account_name;

        return $this;
    }

    /**
     * Method to set the value of field settlement_bank_account_number
     *
     * @param string $settlement_bank_account_number
     * @return $this
     */
    public function setSettlementBankAccountNumber($settlement_bank_account_number)
    {
        $this->settlement_bank_account_number = $settlement_bank_account_number;

        return $this;
    }

    /**
     * Method to set the value of field settlement_bank_name
     *
     * @param string $settlement_bank_name
     * @return $this
     */
    public function setSettlementBankName($settlement_bank_name)
    {
        $this->settlement_bank_name = $settlement_bank_name;

        return $this;
    }

    /**
     * Method to set the value of field settlement_bank_code
     *
     * @param string $settlement_bank_code
     * @return $this
     */
    public function setSettlementBankCode($settlement_bank_code)
    {
        $this->settlement_bank_code = $settlement_bank_code;

        return $this;
    }

    /**
     * Method to set the value of field settlement_bank_address
     *
     * @param string $settlement_bank_address
     * @return $this
     */
    public function setSettlementBankAddress($settlement_bank_address)
    {
        $this->settlement_bank_address = $settlement_bank_address;

        return $this;
    }

    /**
     * Method to set the value of field tax_registration_certificate
     *
     * @param string $tax_registration_certificate
     * @return $this
     */
    public function setTaxRegistrationCertificate($tax_registration_certificate)
    {
        $this->tax_registration_certificate = $tax_registration_certificate;

        return $this;
    }

    /**
     * Method to set the value of field taxpayer_id
     *
     * @param string $taxpayer_id
     * @return $this
     */
    public function setTaxpayerId($taxpayer_id)
    {
        $this->taxpayer_id = $taxpayer_id;

        return $this;
    }

    /**
     * Method to set the value of field tax_registration_certif_elc
     *
     * @param string $tax_registration_certif_elc
     * @return $this
     */
    public function setTaxRegistrationCertifElc($tax_registration_certif_elc)
    {
        $this->tax_registration_certif_elc = $tax_registration_certif_elc;

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
     * Method to set the value of field store_class_ids
     *
     * @param string $store_class_ids
     * @return $this
     */
    public function setStoreClassIds($store_class_ids)
    {
        $this->store_class_ids = $store_class_ids;

        return $this;
    }

    /**
     * Method to set the value of field store_class_names
     *
     * @param string $store_class_names
     * @return $this
     */
    public function setStoreClassNames($store_class_names)
    {
        $this->store_class_names = $store_class_names;

        return $this;
    }

    /**
     * Method to set the value of field joinin_state
     *
     * @param string $joinin_state
     * @return $this
     */
    public function setJoininState($joinin_state)
    {
        $this->joinin_state = $joinin_state;

        return $this;
    }

    /**
     * Method to set the value of field joinin_message
     *
     * @param string $joinin_message
     * @return $this
     */
    public function setJoininMessage($joinin_message)
    {
        $this->joinin_message = $joinin_message;

        return $this;
    }

    /**
     * Method to set the value of field joinin_year
     *
     * @param integer $joinin_year
     * @return $this
     */
    public function setJoininYear($joinin_year)
    {
        $this->joinin_year = $joinin_year;

        return $this;
    }

    /**
     * Method to set the value of field sg_name
     *
     * @param string $sg_name
     * @return $this
     */
    public function setSgName($sg_name)
    {
        $this->sg_name = $sg_name;

        return $this;
    }

    /**
     * Method to set the value of field sg_id
     *
     * @param integer $sg_id
     * @return $this
     */
    public function setSgId($sg_id)
    {
        $this->sg_id = $sg_id;

        return $this;
    }

    /**
     * Method to set the value of field sg_info
     *
     * @param string $sg_info
     * @return $this
     */
    public function setSgInfo($sg_info)
    {
        $this->sg_info = $sg_info;

        return $this;
    }

    /**
     * Method to set the value of field sc_name
     *
     * @param string $sc_name
     * @return $this
     */
    public function setScName($sc_name)
    {
        $this->sc_name = $sc_name;

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
     * Method to set the value of field sc_bail
     *
     * @param integer $sc_bail
     * @return $this
     */
    public function setScBail($sc_bail)
    {
        $this->sc_bail = $sc_bail;

        return $this;
    }

    /**
     * Method to set the value of field store_class_commis_rates
     *
     * @param string $store_class_commis_rates
     * @return $this
     */
    public function setStoreClassCommisRates($store_class_commis_rates)
    {
        $this->store_class_commis_rates = $store_class_commis_rates;

        return $this;
    }

    /**
     * Method to set the value of field paying_money_certificate
     *
     * @param string $paying_money_certificate
     * @return $this
     */
    public function setPayingMoneyCertificate($paying_money_certificate)
    {
        $this->paying_money_certificate = $paying_money_certificate;

        return $this;
    }

    /**
     * Method to set the value of field paying_money_certif_exp
     *
     * @param string $paying_money_certif_exp
     * @return $this
     */
    public function setPayingMoneyCertifExp($paying_money_certif_exp)
    {
        $this->paying_money_certif_exp = $paying_money_certif_exp;

        return $this;
    }

    /**
     * Method to set the value of field paying_amount
     *
     * @param double $paying_amount
     * @return $this
     */
    public function setPayingAmount($paying_amount)
    {
        $this->paying_amount = $paying_amount;

        return $this;
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
     * Returns the value of field company_name
     *
     * @return string
     */
    public function getCompanyName()
    {
        return $this->company_name;
    }

    /**
     * Returns the value of field company_province_id
     *
     * @return integer
     */
    public function getCompanyProvinceId()
    {
        return $this->company_province_id;
    }

    /**
     * Returns the value of field company_address
     *
     * @return string
     */
    public function getCompanyAddress()
    {
        return $this->company_address;
    }

    /**
     * Returns the value of field company_address_detail
     *
     * @return string
     */
    public function getCompanyAddressDetail()
    {
        return $this->company_address_detail;
    }

    /**
     * Returns the value of field company_phone
     *
     * @return string
     */
    public function getCompanyPhone()
    {
        return $this->company_phone;
    }

    /**
     * Returns the value of field company_employee_count
     *
     * @return integer
     */
    public function getCompanyEmployeeCount()
    {
        return $this->company_employee_count;
    }

    /**
     * Returns the value of field company_registered_capital
     *
     * @return integer
     */
    public function getCompanyRegisteredCapital()
    {
        return $this->company_registered_capital;
    }

    /**
     * Returns the value of field contacts_name
     *
     * @return string
     */
    public function getContactsName()
    {
        return $this->contacts_name;
    }

    /**
     * Returns the value of field contacts_phone
     *
     * @return string
     */
    public function getContactsPhone()
    {
        return $this->contacts_phone;
    }

    /**
     * Returns the value of field contacts_email
     *
     * @return string
     */
    public function getContactsEmail()
    {
        return $this->contacts_email;
    }

    /**
     * Returns the value of field business_licence_number
     *
     * @return string
     */
    public function getBusinessLicenceNumber()
    {
        return $this->business_licence_number;
    }

    /**
     * Returns the value of field business_licence_address
     *
     * @return string
     */
    public function getBusinessLicenceAddress()
    {
        return $this->business_licence_address;
    }

    /**
     * Returns the value of field business_licence_start
     *
     * @return string
     */
    public function getBusinessLicenceStart()
    {
        return $this->business_licence_start;
    }

    /**
     * Returns the value of field business_licence_end
     *
     * @return string
     */
    public function getBusinessLicenceEnd()
    {
        return $this->business_licence_end;
    }

    /**
     * Returns the value of field business_sphere
     *
     * @return string
     */
    public function getBusinessSphere()
    {
        return $this->business_sphere;
    }

    /**
     * Returns the value of field business_licence_number_elc
     *
     * @return string
     */
    public function getBusinessLicenceNumberElc()
    {
        return $this->business_licence_number_elc;
    }

    /**
     * Returns the value of field organization_code
     *
     * @return string
     */
    public function getOrganizationCode()
    {
        return $this->organization_code;
    }

    /**
     * Returns the value of field organization_code_electronic
     *
     * @return string
     */
    public function getOrganizationCodeElectronic()
    {
        return $this->organization_code_electronic;
    }

    /**
     * Returns the value of field general_taxpayer
     *
     * @return string
     */
    public function getGeneralTaxpayer()
    {
        return $this->general_taxpayer;
    }

    /**
     * Returns the value of field bank_account_name
     *
     * @return string
     */
    public function getBankAccountName()
    {
        return $this->bank_account_name;
    }

    /**
     * Returns the value of field bank_account_number
     *
     * @return string
     */
    public function getBankAccountNumber()
    {
        return $this->bank_account_number;
    }

    /**
     * Returns the value of field bank_name
     *
     * @return string
     */
    public function getBankName()
    {
        return $this->bank_name;
    }

    /**
     * Returns the value of field bank_code
     *
     * @return string
     */
    public function getBankCode()
    {
        return $this->bank_code;
    }

    /**
     * Returns the value of field bank_address
     *
     * @return string
     */
    public function getBankAddress()
    {
        return $this->bank_address;
    }

    /**
     * Returns the value of field bank_licence_electronic
     *
     * @return string
     */
    public function getBankLicenceElectronic()
    {
        return $this->bank_licence_electronic;
    }

    /**
     * Returns the value of field is_settlement_account
     *
     * @return integer
     */
    public function getIsSettlementAccount()
    {
        return $this->is_settlement_account;
    }

    /**
     * Returns the value of field settlement_bank_account_name
     *
     * @return string
     */
    public function getSettlementBankAccountName()
    {
        return $this->settlement_bank_account_name;
    }

    /**
     * Returns the value of field settlement_bank_account_number
     *
     * @return string
     */
    public function getSettlementBankAccountNumber()
    {
        return $this->settlement_bank_account_number;
    }

    /**
     * Returns the value of field settlement_bank_name
     *
     * @return string
     */
    public function getSettlementBankName()
    {
        return $this->settlement_bank_name;
    }

    /**
     * Returns the value of field settlement_bank_code
     *
     * @return string
     */
    public function getSettlementBankCode()
    {
        return $this->settlement_bank_code;
    }

    /**
     * Returns the value of field settlement_bank_address
     *
     * @return string
     */
    public function getSettlementBankAddress()
    {
        return $this->settlement_bank_address;
    }

    /**
     * Returns the value of field tax_registration_certificate
     *
     * @return string
     */
    public function getTaxRegistrationCertificate()
    {
        return $this->tax_registration_certificate;
    }

    /**
     * Returns the value of field taxpayer_id
     *
     * @return string
     */
    public function getTaxpayerId()
    {
        return $this->taxpayer_id;
    }

    /**
     * Returns the value of field tax_registration_certif_elc
     *
     * @return string
     */
    public function getTaxRegistrationCertifElc()
    {
        return $this->tax_registration_certif_elc;
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
     * Returns the value of field store_name
     *
     * @return string
     */
    public function getStoreName()
    {
        return $this->store_name;
    }

    /**
     * Returns the value of field store_class_ids
     *
     * @return string
     */
    public function getStoreClassIds()
    {
        return $this->store_class_ids;
    }

    /**
     * Returns the value of field store_class_names
     *
     * @return string
     */
    public function getStoreClassNames()
    {
        return $this->store_class_names;
    }

    /**
     * Returns the value of field joinin_state
     *
     * @return string
     */
    public function getJoininState()
    {
        return $this->joinin_state;
    }

    /**
     * Returns the value of field joinin_message
     *
     * @return string
     */
    public function getJoininMessage()
    {
        return $this->joinin_message;
    }

    /**
     * Returns the value of field joinin_year
     *
     * @return integer
     */
    public function getJoininYear()
    {
        return $this->joinin_year;
    }

    /**
     * Returns the value of field sg_name
     *
     * @return string
     */
    public function getSgName()
    {
        return $this->sg_name;
    }

    /**
     * Returns the value of field sg_id
     *
     * @return integer
     */
    public function getSgId()
    {
        return $this->sg_id;
    }

    /**
     * Returns the value of field sg_info
     *
     * @return string
     */
    public function getSgInfo()
    {
        return $this->sg_info;
    }

    /**
     * Returns the value of field sc_name
     *
     * @return string
     */
    public function getScName()
    {
        return $this->sc_name;
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
     * Returns the value of field sc_bail
     *
     * @return integer
     */
    public function getScBail()
    {
        return $this->sc_bail;
    }

    /**
     * Returns the value of field store_class_commis_rates
     *
     * @return string
     */
    public function getStoreClassCommisRates()
    {
        return $this->store_class_commis_rates;
    }

    /**
     * Returns the value of field paying_money_certificate
     *
     * @return string
     */
    public function getPayingMoneyCertificate()
    {
        return $this->paying_money_certificate;
    }

    /**
     * Returns the value of field paying_money_certif_exp
     *
     * @return string
     */
    public function getPayingMoneyCertifExp()
    {
        return $this->paying_money_certif_exp;
    }

    /**
     * Returns the value of field paying_amount
     *
     * @return double
     */
    public function getPayingAmount()
    {
        return $this->paying_amount;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'store_joinin';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreJoinin[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreJoinin
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
