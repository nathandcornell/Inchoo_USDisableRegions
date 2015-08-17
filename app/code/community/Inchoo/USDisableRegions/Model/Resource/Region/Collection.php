<?php
/**
 * Inchoo
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Please do not edit or add to this file if you wish to upgrade
 * Magento or this extension to newer versions in the future.
 * Inchoo developers (Inchooer's) give their best to conform to
 * "non-obtrusive, best Magento practices" style of coding.
 * However, Inchoo does not guarantee functional accuracy of
 * specific extension behavior. Additionally we take no responsibility
 * for any possible issue(s) resulting from extension usage.
 * We reserve the full right not to provide any kind of support for our free extensions.
 * Thank you for your understanding.
 *
 * @category    Inchoo
 * @package     Inchoo_USDisableRegions
 * @author      Tomas Novoselić <tomas@inchoo.net>
 * @copyright   Copyright (c) Inchoo (http://inchoo.net/)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Inchoo_USDisableRegions_Model_Resource_Region_Collection extends Mage_Directory_Model_Resource_Region_Collection
{
    public function addCountryFilter($countryId)
    {
        if ( ! empty($countryId) ) {
            if (is_array($countryId)) {
                $this->addFieldToFilter('main_table.country_id', array('in' => $countryId));
            } else {
                $this->addFieldToFilter('main_table.country_id', $countryId);
            }
        }

        $allowedRegions = Mage::getStoreConfig('general/enabled_regions/region');

        if ( ! Mage::app()->getStore()->isAdmin() && Mage::getDesign()->getArea() != 'adminhtml' ) {

            if($countryId == "US" || is_array($countryId) && in_array('US', $countryId)) {
                if ( strpos( $allowedRegions, ',') ) {
                    $this->addRegionCodeFilter(explode(",", $allowedRegions));
                } else {
                    $this->addRegionCodeFilter($allowedRegions);
                }
            }
        }

        return $this;
    }
}
