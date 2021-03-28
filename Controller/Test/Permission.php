<?php
/**
 * @author DiZed Team
 * @copyright Copyright (c) DiZed (https://github.com/di-zed/)
 */
namespace DiZed\FrontAclSample\Controller\Test;

use DiZed\FrontAcl\Controller\App\HttpAclActionInterface;
use DiZed\FrontAclSample\Helper\Data;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Exception\ConfigurationMismatchException;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class Permission implements HttpGetActionInterface, HttpAclActionInterface
{
    /**
     * Front ACL Permission.
     */
    const FRONT_ACL_PERMISSION = ['FrontAcl_Permission::test_permission'];

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var Data
     */
    protected $helper;

    /**
     * Action constructor.
     *
     * @param PageFactory $resultPageFactory
     * @param Data $helper
     */
    public function __construct(
        PageFactory $resultPageFactory,
        Data $helper
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->helper = $helper;
    }

    /**
     * Execute action.
     *
     * @return Page
     * @throws ConfigurationMismatchException
     */
    public function execute(): Page
    {
        if (!$this->helper->isModuleEnabled()) {
            throw new ConfigurationMismatchException(__('Enable the module, please.'));
        }

        return $this->resultPageFactory->create();
    }
}
