<?php
namespace Raccoon\Bloggers\Model\ResourceModel;

class Bloggers extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('bloggers', 'id');
    }
}
?>