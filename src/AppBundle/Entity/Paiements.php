<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paiements
 *
 * @ORM\Table(name="paiements")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PaiementsRepository")
 */
class Paiements
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="cpm_site_id", type="string", length=255, nullable=true)
     */
    private $cpmSiteId;

    /**
     * @var string
     *
     * @ORM\Column(name="signature", type="string", length=255, nullable=true)
     */
    private $signature;

    /**
     * @var string
     *
     * @ORM\Column(name="cpm_amount", type="string", length=255, nullable=true)
     */
    private $cpmAmount;

    /**
     * @var string
     *
     * @ORM\Column(name="cpm_trans_id", type="string", length=255, nullable=true)
     */
    private $cpmTransId;

    /**
     * @var string
     *
     * @ORM\Column(name="cpm_custom", type="string", length=255, nullable=true)
     */
    private $cpmCustom;

    /**
     * @var string
     *
     * @ORM\Column(name="cpm_currency", type="string", length=255, nullable=true)
     */
    private $cpmCurrency;

    /**
     * @var string
     *
     * @ORM\Column(name="cpm_payid", type="string", length=255, nullable=true)
     */
    private $cpmPayid;

    /**
     * @var string
     *
     * @ORM\Column(name="cpm_payment_date", type="string", length=255, nullable=true)
     */
    private $cpmPaymentDate;

    /**
     * @var string
     *
     * @ORM\Column(name="cpm_payment_time", type="string", length=255, nullable=true)
     */
    private $cpmPaymentTime;

    /**
     * @var string
     *
     * @ORM\Column(name="cpm_error_message", type="string", length=255, nullable=true)
     */
    private $cpmErrorMessage;

    /**
     * @var string
     *
     * @ORM\Column(name="payment_method", type="string", length=255, nullable=true)
     */
    private $paymentMethod;

    /**
     * @var string
     *
     * @ORM\Column(name="cpm_phone_prefixe", type="string", length=255, nullable=true)
     */
    private $cpmPhonePrefixe;

    /**
     * @var string
     *
     * @ORM\Column(name="cel_phone_num", type="string", length=255, nullable=true)
     */
    private $celPhoneNum;

    /**
     * @var string
     *
     * @ORM\Column(name="cpm_ipn_ack", type="string", length=255, nullable=true)
     */
    private $cpmIpnAck;

    /**
     * @var string
     *
     * @ORM\Column(name="cpm_result", type="string", length=255, nullable=true)
     */
    private $cpmResult;

    /**
     * @var string
     *
     * @ORM\Column(name="cpm_trans_status", type="string", length=255, nullable=true)
     */
    private $cpmTransStatus;

    /**
     * @var string
     *
     * @ORM\Column(name="cpm_designation", type="string", length=255, nullable=true)
     */
    private $cpmDesignation;

    /**
     * @var string
     *
     * @ORM\Column(name="buyer_name", type="string", length=255, nullable=true)
     */
    private $buyerName;

    /**
     * @var string
     *
     * @ORM\Column(name="created_at", type="string", length=255, nullable=true)
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(name="updated_at", type="string", length=255, nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\UserInfos")
     * @ORM\JoinColumn(name="userinfo_id", referencedColumnName="id")
     */
    private $userinfo;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set cpmSiteId
     *
     * @param string $cpmSiteId
     *
     * @return Paiements
     */
    public function setCpmSiteId($cpmSiteId)
    {
        $this->cpmSiteId = $cpmSiteId;

        return $this;
    }

    /**
     * Get cpmSiteId
     *
     * @return string
     */
    public function getCpmSiteId()
    {
        return $this->cpmSiteId;
    }

    /**
     * Set signature
     *
     * @param string $signature
     *
     * @return Paiements
     */
    public function setSignature($signature)
    {
        $this->signature = $signature;

        return $this;
    }

    /**
     * Get signature
     *
     * @return string
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * Set cpmAmount
     *
     * @param string $cpmAmount
     *
     * @return Paiements
     */
    public function setCpmAmount($cpmAmount)
    {
        $this->cpmAmount = $cpmAmount;

        return $this;
    }

    /**
     * Get cpmAmount
     *
     * @return string
     */
    public function getCpmAmount()
    {
        return $this->cpmAmount;
    }

    /**
     * Set cpmTransId
     *
     * @param string $cpmTransId
     *
     * @return Paiements
     */
    public function setCpmTransId($cpmTransId)
    {
        $this->cpmTransId = $cpmTransId;

        return $this;
    }

    /**
     * Get cpmTransId
     *
     * @return string
     */
    public function getCpmTransId()
    {
        return $this->cpmTransId;
    }

    /**
     * Set cpmCustom
     *
     * @param string $cpmCustom
     *
     * @return Paiements
     */
    public function setCpmCustom($cpmCustom)
    {
        $this->cpmCustom = $cpmCustom;

        return $this;
    }

    /**
     * Get cpmCustom
     *
     * @return string
     */
    public function getCpmCustom()
    {
        return $this->cpmCustom;
    }

    /**
     * Set cpmCurrency
     *
     * @param string $cpmCurrency
     *
     * @return Paiements
     */
    public function setCpmCurrency($cpmCurrency)
    {
        $this->cpmCurrency = $cpmCurrency;

        return $this;
    }

    /**
     * Get cpmCurrency
     *
     * @return string
     */
    public function getCpmCurrency()
    {
        return $this->cpmCurrency;
    }

    /**
     * Set cpmPayid
     *
     * @param string $cpmPayid
     *
     * @return Paiements
     */
    public function setCpmPayid($cpmPayid)
    {
        $this->cpmPayid = $cpmPayid;

        return $this;
    }

    /**
     * Get cpmPayid
     *
     * @return string
     */
    public function getCpmPayid()
    {
        return $this->cpmPayid;
    }

    /**
     * Set cpmPaymentDate
     *
     * @param string $cpmPaymentDate
     *
     * @return Paiements
     */
    public function setCpmPaymentDate($cpmPaymentDate)
    {
        $this->cpmPaymentDate = $cpmPaymentDate;

        return $this;
    }

    /**
     * Get cpmPaymentDate
     *
     * @return string
     */
    public function getCpmPaymentDate()
    {
        return $this->cpmPaymentDate;
    }

    /**
     * Set cpmPaymentTime
     *
     * @param string $cpmPaymentTime
     *
     * @return Paiements
     */
    public function setCpmPaymentTime($cpmPaymentTime)
    {
        $this->cpmPaymentTime = $cpmPaymentTime;

        return $this;
    }

    /**
     * Get cpmPaymentTime
     *
     * @return string
     */
    public function getCpmPaymentTime()
    {
        return $this->cpmPaymentTime;
    }

    /**
     * Set cpmErrorMessage
     *
     * @param string $cpmErrorMessage
     *
     * @return Paiements
     */
    public function setCpmErrorMessage($cpmErrorMessage)
    {
        $this->cpmErrorMessage = $cpmErrorMessage;

        return $this;
    }

    /**
     * Get cpmErrorMessage
     *
     * @return string
     */
    public function getCpmErrorMessage()
    {
        return $this->cpmErrorMessage;
    }

    /**
     * Set paymentMethod
     *
     * @param string $paymentMethod
     *
     * @return Paiements
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    /**
     * Get paymentMethod
     *
     * @return string
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * Set cpmPhonePrefixe
     *
     * @param string $cpmPhonePrefixe
     *
     * @return Paiements
     */
    public function setCpmPhonePrefixe($cpmPhonePrefixe)
    {
        $this->cpmPhonePrefixe = $cpmPhonePrefixe;

        return $this;
    }

    /**
     * Get cpmPhonePrefixe
     *
     * @return string
     */
    public function getCpmPhonePrefixe()
    {
        return $this->cpmPhonePrefixe;
    }

    /**
     * Set celPhoneNum
     *
     * @param string $celPhoneNum
     *
     * @return Paiements
     */
    public function setCelPhoneNum($celPhoneNum)
    {
        $this->celPhoneNum = $celPhoneNum;

        return $this;
    }

    /**
     * Get celPhoneNum
     *
     * @return string
     */
    public function getCelPhoneNum()
    {
        return $this->celPhoneNum;
    }

    /**
     * Set cpmIpnAck
     *
     * @param string $cpmIpnAck
     *
     * @return Paiements
     */
    public function setCpmIpnAck($cpmIpnAck)
    {
        $this->cpmIpnAck = $cpmIpnAck;

        return $this;
    }

    /**
     * Get cpmIpnAck
     *
     * @return string
     */
    public function getCpmIpnAck()
    {
        return $this->cpmIpnAck;
    }

    /**
     * Set cpmResult
     *
     * @param string $cpmResult
     *
     * @return Paiements
     */
    public function setCpmResult($cpmResult)
    {
        $this->cpmResult = $cpmResult;

        return $this;
    }

    /**
     * Get cpmResult
     *
     * @return string
     */
    public function getCpmResult()
    {
        return $this->cpmResult;
    }

    /**
     * Set cpmTransStatus
     *
     * @param string $cpmTransStatus
     *
     * @return Paiements
     */
    public function setCpmTransStatus($cpmTransStatus)
    {
        $this->cpmTransStatus = $cpmTransStatus;

        return $this;
    }

    /**
     * Get cpmTransStatus
     *
     * @return string
     */
    public function getCpmTransStatus()
    {
        return $this->cpmTransStatus;
    }

    /**
     * Set cpmDesignation
     *
     * @param string $cpmDesignation
     *
     * @return Paiements
     */
    public function setCpmDesignation($cpmDesignation)
    {
        $this->cpmDesignation = $cpmDesignation;

        return $this;
    }

    /**
     * Get cpmDesignation
     *
     * @return string
     */
    public function getCpmDesignation()
    {
        return $this->cpmDesignation;
    }

    /**
     * Set buyerName
     *
     * @param string $buyerName
     *
     * @return Paiements
     */
    public function setBuyerName($buyerName)
    {
        $this->buyerName = $buyerName;

        return $this;
    }

    /**
     * Get buyerName
     *
     * @return string
     */
    public function getBuyerName()
    {
        return $this->buyerName;
    }

    /**
     * Set createdAt
     *
     * @param string $createdAt
     *
     * @return Paiements
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param string $updatedAt
     *
     * @return Paiements
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set userinfo
     *
     * @param \AppBundle\Entity\UserInfos $userinfo
     *
     * @return Paiements
     */
    public function setUserinfo(\AppBundle\Entity\UserInfos $userinfo = null)
    {
        $this->userinfo = $userinfo;

        return $this;
    }

    /**
     * Get userinfo
     *
     * @return \AppBundle\Entity\UserInfos
     */
    public function getUserinfo()
    {
        return $this->userinfo;
    }
}
