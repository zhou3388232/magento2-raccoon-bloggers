<?php

namespace Raccoon\Bloggers\Block\Adminhtml\Bloggers\Edit\Tab;

/**
 * Bloggers edit form main tab
 */
class Main extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @var \Raccoon\Bloggers\Model\Status
     */
    protected $_status;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        \Raccoon\Bloggers\Model\Status $status,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        $this->_status = $status;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form
     *
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareForm()
    {
        /* @var $model \Raccoon\Bloggers\Model\BlogPosts */
        $model = $this->_coreRegistry->registry('bloggers');

        $isElementDisabled = false;

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('page_');

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Item Information')]);

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
        }

		
        $fieldset->addField(
            'username',
            'text',
            [
                'name' => 'username',
                'label' => __('Username'),
                'title' => __('Username'),
				
                'disabled' => $isElementDisabled
            ]
        );
					
        $fieldset->addField(
            'fullname',
            'text',
            [
                'name' => 'fullname',
                'label' => __('Fullname'),
                'title' => __('Fullname'),
				
                'disabled' => $isElementDisabled
            ]
        );
									

        $fieldset->addField(
            'profile_image',
            'image',
            [
                'name' => 'profile_image',
                'label' => __('Profile Image'),
                'title' => __('Profile Image'),
				
                'disabled' => $isElementDisabled
            ]
        );
						
										

        $fieldset->addField(
            'image',
            'image',
            [
                'name' => 'image',
                'label' => __('Image'),
                'title' => __('Image'),
				
                'disabled' => $isElementDisabled
            ]
        );
						
							

		$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		$wysiwygConfig = $objectManager->create('Magento\Cms\Model\Wysiwyg\Config');
        $widgetFilters = ['is_email_compatible' => 1];
        $wysiwygConfig = $wysiwygConfig->getConfig(['widget_filters' => $widgetFilters]);		

        $fieldset->addField(
            'description',
            'editor',
            [
                'name' => 'description',
                'label' => __('Description'),
                'title' => __('Description'),
                'config' => $wysiwygConfig,
				
                'disabled' => $isElementDisabled
            ]
        );


						
        $fieldset->addField(
            'skus',
            'textarea',
            [
                'name' => 'skus',
                'label' => __('Skus'),
                'title' => __('Skus'),
				
                'disabled' => $isElementDisabled
            ]
        );
									
						
        $fieldset->addField(
            'is_enabled',
            'select',
            [
                'label' => __('Is Enabled'),
                'title' => __('Is Enabled'),
                'name' => 'is_enabled',
				
                'options' => \Raccoon\Bloggers\Block\Adminhtml\Bloggers\Grid::getOptionArray6(),
                'disabled' => $isElementDisabled
            ]
        );
						
						

        if (!$model->getId()) {
            $model->setData('is_active', $isElementDisabled ? '0' : '1');
        }

        $form->setValues($model->getData());
        $this->setForm($form);
		
        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('Item Information');
    }

    /**
     * Prepare title for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('Item Information');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
    
    public function getTargetOptionArray(){
    	return array(
    				'_self' => "Self",
					'_blank' => "New Page",
    				);
    }
}
