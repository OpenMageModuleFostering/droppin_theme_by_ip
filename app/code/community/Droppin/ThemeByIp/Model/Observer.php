<?php
class Droppin_ThemeByIp_Model_Observer extends Varien_Event_Observer
{

	public function preDispatchEvent($observer)
	{
		$controllerAction = $observer->getControllerAction();
		if ($controllerAction->getLayout()->getArea() == Mage_Core_Model_App_Area::AREA_FRONTEND) {
			$ipAddress = Mage::helper('core/http')->getRemoteAddr();
			
			
			$ip_array = Mage::getStoreConfig('dev/themebyip_group1/ip_array', Mage::app()->getStore());
			
			
			$ipAddresses = explode(',', $ip_array);
			
			if (in_array($ipAddress, $ipAddresses)) {
				
				
				$package = Mage::getStoreConfig('dev/themebyip_group1/theme_package', Mage::app()->getStore());
				$template = Mage::getStoreConfig('dev/themebyip_group1/theme_template', Mage::app()->getStore());
							
				Mage::getDesign()
					->setPackageName($package)
					->setTheme($template);
				
			}
		}
	}
}
?>