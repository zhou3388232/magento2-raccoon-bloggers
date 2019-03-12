<?php
namespace Raccoon\Bloggers\Block\Adminhtml\Bloggers;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;

    /**
     * @var \Raccoon\Bloggers\Model\bloggersFactory
     */
    protected $_bloggersFactory;

    /**
     * @var \Raccoon\Bloggers\Model\Status
     */
    protected $_status;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Raccoon\Bloggers\Model\bloggersFactory $bloggersFactory
     * @param \Raccoon\Bloggers\Model\Status $status
     * @param \Magento\Framework\Module\Manager $moduleManager
     * @param array $data
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Raccoon\Bloggers\Model\BloggersFactory $BloggersFactory,
        \Raccoon\Bloggers\Model\Status $status,
        \Magento\Framework\Module\Manager $moduleManager,
        array $data = []
    ) {
        $this->_bloggersFactory = $BloggersFactory;
        $this->_status = $status;
        $this->moduleManager = $moduleManager;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('postGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(false);
        $this->setVarNameFilter('post_filter');
    }

    /**
     * @return $this
     */
    protected function _prepareCollection()
    {
        $collection = $this->_bloggersFactory->create()->getCollection();
        $this->setCollection($collection);

        parent::_prepareCollection();

        return $this;
    }

    /**
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'id',
            [
                'header' => __('ID'),
                'type' => 'number',
                'index' => 'id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id'
            ]
        );


		
				$this->addColumn(
					'username',
					[
						'header' => __('Username'),
						'index' => 'username',
					]
				);
				
				$this->addColumn(
					'fullname',
					[
						'header' => __('Fullname'),
						'index' => 'fullname',
					]
				);
				
						
						$this->addColumn(
							'is_enabled',
							[
								'header' => __('Is Enabled'),
								'index' => 'is_enabled',
								'type' => 'options',
								'options' => \Raccoon\Bloggers\Block\Adminhtml\Bloggers\Grid::getOptionArray6()
							]
						);
						
						


		
        //$this->addColumn(
            //'edit',
            //[
                //'header' => __('Edit'),
                //'type' => 'action',
                //'getter' => 'getId',
                //'actions' => [
                    //[
                        //'caption' => __('Edit'),
                        //'url' => [
                            //'base' => '*/*/edit'
                        //],
                        //'field' => 'id'
                    //]
                //],
                //'filter' => false,
                //'sortable' => false,
                //'index' => 'stores',
                //'header_css_class' => 'col-action',
                //'column_css_class' => 'col-action'
            //]
        //);
		

		
		   $this->addExportType($this->getUrl('bloggers/*/exportCsv', ['_current' => true]),__('CSV'));
		   $this->addExportType($this->getUrl('bloggers/*/exportExcel', ['_current' => true]),__('Excel XML'));

        $block = $this->getLayout()->getBlock('grid.bottom.links');
        if ($block) {
            $this->setChild('grid.bottom.links', $block);
        }

        return parent::_prepareColumns();
    }

	
    /**
     * @return $this
     */
    protected function _prepareMassaction()
    {

        $this->setMassactionIdField('id');
        //$this->getMassactionBlock()->setTemplate('Raccoon_Bloggers::bloggers/grid/massaction_extended.phtml');
        $this->getMassactionBlock()->setFormFieldName('bloggers');

        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('bloggers/*/massDelete'),
                'confirm' => __('Are you sure?')
            ]
        );

        $statuses = $this->_status->getOptionArray();

        $this->getMassactionBlock()->addItem(
            'status',
            [
                'label' => __('Change status'),
                'url' => $this->getUrl('bloggers/*/massStatus', ['_current' => true]),
                'additional' => [
                    'visibility' => [
                        'name' => 'status',
                        'type' => 'select',
                        'class' => 'required-entry',
                        'label' => __('Status'),
                        'values' => $statuses
                    ]
                ]
            ]
        );


        return $this;
    }
		

    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('bloggers/*/index', ['_current' => true]);
    }

    /**
     * @param \Raccoon\Bloggers\Model\bloggers|\Magento\Framework\Object $row
     * @return string
     */
    public function getRowUrl($row)
    {
		
        return $this->getUrl(
            'bloggers/*/edit',
            ['id' => $row->getId()]
        );
		
    }

	
		static public function getOptionArray6()
		{
            $data_array=array(); 
			$data_array[0]='yes';
			$data_array[1]='no';
            return($data_array);
		}
		static public function getValueArray6()
		{
            $data_array=array();
			foreach(\Raccoon\Bloggers\Block\Adminhtml\Bloggers\Grid::getOptionArray6() as $k=>$v){
               $data_array[]=array('value'=>$k,'label'=>$v);		
			}
            return($data_array);

		}
		

}