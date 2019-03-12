<?php
namespace Raccoon\Bloggers\Model;

class Bloggers extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Raccoon\Bloggers\Model\ResourceModel\Bloggers');
    }
}
?>