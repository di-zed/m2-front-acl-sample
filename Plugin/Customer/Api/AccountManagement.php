<?php
/**
 * @author DiZed Team
 * @copyright Copyright (c) DiZed (https://github.com/di-zed/)
 */
namespace DiZed\FrontAclSample\Plugin\Customer\Api;

use DiZed\FrontAcl\Model\Config\Source\Roles as SourceRoles;
use DiZed\FrontAclSample\Helper\Data;
use Magento\Customer\Api\Data\CustomerInterface;

/**
 * Plugin for the main account management plugin.
 *
 * @see \DiZed\FrontAcl\Plugin\Customer\Api\AccountManagement
 */
class AccountManagement
{
    /**
     * @var SourceRoles
     */
    protected $sourceRoles;

    /**
     * @var Data
     */
    protected $helper;

    /**
     * Plugin constructor.
     *
     * @param SourceRoles $sourceRoles
     * @param Data $helper
     */
    public function __construct(
        SourceRoles $sourceRoles,
        Data $helper
    ) {
        $this->sourceRoles = $sourceRoles;
        $this->helper = $helper;
    }

    /**
     * Add custom logic to identify customer role.
     *
     * @param \DiZed\FrontAcl\Plugin\Customer\Api\AccountManagement $subject
     * @param string $result
     * @param CustomerInterface $customer
     * @return string
     * @see \DiZed\FrontAcl\Plugin\Customer\Api\AccountManagement::getDetectedRole
     */
    public function afterGetDetectedRole(
        \DiZed\FrontAcl\Plugin\Customer\Api\AccountManagement $subject,
        string $result,
        CustomerInterface $customer
    ): string {
        if (!$this->helper->isModuleEnabled()) {
            return $result;
        }

        if ($roleOptions = $this->sourceRoles->toOptionArray()) {
            $roleOption = $roleOptions[array_rand($roleOptions)];
            $result = $roleOption['value'];
        }

        return $result;
    }
}
