<?php

namespace Raccoon\Bloggers\Model\ResourceModel\Bloggers;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection {
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Raccoon\Bloggers\Model\Bloggers', 'Raccoon\Bloggers\Model\ResourceModel\Bloggers');
        // $this->_map['fields']['page_id'] = 'main_table.page_id';
    }

}