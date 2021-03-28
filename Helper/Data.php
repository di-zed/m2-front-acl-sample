<?php
/**
 * @author DiZed Team
 * @copyright Copyright (c) DiZed (https://github.com/di-zed/)
 */
namespace DiZed\FrontAclSample\Helper;

use DiZed\FrontAcl\Helper\Data as CoreHelper;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;

/**
 * Helper Data.
 */
class Data extends AbstractHelper
{
    /**
     * Path for the module status.
     */
    const XML_PATH_ENABLED = 'dized_front_acl/sample/enabled';

    /**
     * @var CoreHelper
     */
    protected $coreHelper;

    /**
     * Helper constructor.
     *
     * @param Context $context
     * @param CoreHelper $coreHelper
     */
    public function __construct(
        Context $context,
        CoreHelper $coreHelper
    ) {
        parent::__construct($context);

        $this->coreHelper = $coreHelper;
    }

    /**
     * Is module enabled?
     *
     * @return bool
     */
    public function isModuleEnabled(): bool
    {
        if ($this->coreHelper->isModuleEnabled()) {
            return $this->scopeConfig->isSetFlag(self::XML_PATH_ENABLED, ScopeInterface::SCOPE_STORE);
        }

        return false;
    }
}
