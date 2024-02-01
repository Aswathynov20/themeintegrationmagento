<?php

/**
 * Controller for deleting a post in the admin grid.
 */
namespace TopBrands\BrandsList\Controller\Adminhtml\Grid;

class Deletepost extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory = false;

    /**
     * @var \TopBrands\BrandsList\Model\GridFactory
     */
    protected $gridFactory;

        /**
         * Deletepost constructor.
         *
         * @param \Magento\Backend\App\Action\Context      $context
         * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
         * @param \TopBrands\BrandsList\Model\GridFactory   $gridFactory
         */
    
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \TopBrands\BrandsList\Model\GridFactory $gridFactory
    ) {
        $this->gridFactory = $gridFactory;
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Execute action to delete a post.
     *
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('id');

        try {
            $model = $this->gridFactory->create()->load($id);
            $model->delete();
            $this->messageManager->addSuccessMessage(__('You have deleted the post.'));
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the post.'));
        }

        return $resultRedirect->setPath('*/*/');
    }
}
