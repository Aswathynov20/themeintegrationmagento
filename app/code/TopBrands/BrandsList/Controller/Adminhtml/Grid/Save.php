<?php

/**
 * Save Controller
 */
namespace TopBrands\BrandsList\Controller\Adminhtml\Grid;

use Magento\Backend\App\Action;
use Magento\Framework\Filesystem;
use Magento\Framework\Controller\ResultFactory;
use TopBrands\BrandsList\Model\GridFactory;

class Save extends Action
{
    /**
     * @var GridFactory
     */
    protected $gridFactory;

    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * Save constructor.
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param GridFactory $gridFactory
     * @param Filesystem $filesystem
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        GridFactory $gridFactory,
        Filesystem $filesystem
    ) {
        parent::__construct($context);
        $this->gridFactory = $gridFactory;
        $this->filesystem = $filesystem;
    }

    /**
     * Execute action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $storeManager = $objectManager->get(\Magento\Store\Model\StoreManagerInterface::class);
        $baseurl = $storeManager->getStore()->getBaseUrl();

        $data = $this->getRequest()->getPostValue();

        if (!$data) {
            $this->_redirect('topbrands/grid/addrow');
            return;
        }

        try {
            $rowData = $this->gridFactory->create();

            // Handle image upload
            $imageUploader = $this->_objectManager->create(
                \Magento\Catalog\Model\ImageUploader::class,
                ['fileId' => 'image']
            );
            if ($imageUploader->validate()) {
                $imageUploader->setAllowedExtensions(['jpg', 'jpeg', 'png', 'gif']);
                $imageUploader->setAllowRenameFiles(true);
                $imageUploader->setFilesDispersion(false);

                $mediaDirectory = $this->filesystem->
                        getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);

                $result = $imageUploader->save($mediaDirectory->getAbsolutePath('Grid/images'));
                $data['image'] = $baseurl . 'media/Grid/images/' . $result['file'];
            }

            $rowData->setData($data);
            if (isset($data['id'])) {
                $rowData->setEntityId($data['id']);
            }

            $rowData->save();
            $this->messageManager->addSuccess(__('Row data has been successfully saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }

        $this->_redirect('topbrands/grid/index');
    }

    /**
     * Check if the current user is allowed to access the controller.
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Topbands_Grid::save');
    }
}
