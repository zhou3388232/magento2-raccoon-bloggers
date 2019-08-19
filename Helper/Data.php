<?php

namespace Raccoon\Bloggers\Helper;

use \Magento\Framework\App\ObjectManager;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper {

    private function _getMediaUrl($_path) {
        return ObjectManager::getInstance()->get('Magento\Store\Model\StoreManagerInterface')
                                           ->getStore()
                                           ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . $_path;
    }

    public function getBloggers($_start, $_count) {
        $_object_manager =  ObjectManager::getInstance();
        $_bloggers_collection = $_object_manager->create('Raccoon\Bloggers\Model\ResourceModel\Bloggers\Collection');
        $_bloggers = $_bloggers_collection->load();

        $_skus = [];
        foreach ($_bloggers as $_blogger) {
            $_skus[] = $_blogger['skus'];
        }

        $_products_collection = $_object_manager->create('Magento\Catalog\Model\ResourceModel\Product\CollectionFactory');
        $_products = $_products_collection->create()
                                          ->addAttributeToSelect('*')
                                          ->addAttributeToFilter('sku', $_skus)
                                          ->load();
        $_products_array = [];
        foreach ($_products as $_product) {
            $_products_array[$_product->getData('sku')] = $_product->getData();
        }

        $_result = [];
        foreach ($_bloggers as $_blogger) {
            $_product = $_products_array[$_blogger->getData('skus')];
            $_result[] = [
                'name' => $_product['name'],
                'url' => '', 
                'price' => '',
                'productimg' => '',

                'username' => $_blogger->getData('username'), 
                'userlink' => $_blogger->getData('link'), 
                'usermsg' => $_blogger->getData('description'),
                'userthumb' => $this->_getMediaUrl($_blogger->getData('profile_image')),
                'image' => $this->_getMediaUrl($_blogger->getData('image')),
            ];
        }

        return $_result;
    }
}