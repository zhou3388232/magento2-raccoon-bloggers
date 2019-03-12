<?php
namespace Raccoon\Bloggers\Block\Adminhtml\Bloggers\Edit;

/**
 * Admin page left menu
 */
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('bloggers_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Bloggers Information'));
    }
}