<?php
/**
 * @author DiZed Team
 * @copyright Copyright (c) DiZed (https://github.com/di-zed/)
 */
namespace DiZed\FrontAclSample\Block\Customer\Account;

use DiZed\FrontAcl\Api\RoleManagementInterface;
use DiZed\FrontAcl\Block\View\Element\AclBlockInterface;
use DiZed\FrontAclSample\Helper\Data;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

/**
 * Permissions block.
 */
class Permissions extends Template implements AclBlockInterface
{
    /**
     * Available permissions.
     */
    const FRONT_ACL_PERMISSION = ['FrontAcl_Permission::permissions_info'];

    /**
     * @var RoleManagementInterface
     */
    protected $roleManagement;

    /**
     * @var Data
     */
    protected $helper;

    /**
     * Block constructor.
     *
     * @param Context $context
     * @param RoleManagementInterface $roleManagement
     * @param Data $helper
     * @param array $data
     */
    public function __construct(
        Context $context,
        RoleManagementInterface $roleManagement,
        Data $helper,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->roleManagement = $roleManagement;
        $this->helper = $helper;
    }

    /**
     * Get customer role names.
     *
     * @return string
     */
    public function getRoleName(): string
    {
        return $this->roleManagement->getRoleName();
    }

    /**
     * Get customer permission names.
     *
     * @return array
     */
    public function getPermissionNames(): array
    {
        return $this->roleManagement->getPermissionNames();
    }

    /**
     * @inheritdoc
     */
    protected function _toHtml(): string
    {
        if (!$this->helper->isModuleEnabled()) {
            return __('Enable the module, please.');
        }

        return parent::_toHtml();
    }
}
