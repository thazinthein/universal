<?php

class WooCartFrontendFestiPlugin extends WooCartFestiPlugin
{
    protected $settings = array();
    protected $localizeVars = array();
    
    protected function onInit()
    {
        $this->settings = $this->getOptions('settings');
        
        $this->_onInitPluginCookie();
        
        $this->addActionListener('wp_enqueue_scripts', 'onInitJsAction');

        $this->addActionListener('wp_print_styles', 'onInitCssAction');

        $this->addActionListener(
            'wp_ajax_nopriv_remove_product',
            'onRemoveCartProductAction'
        );
        
        $this->addActionListener(
            'woocommerce_add_to_cart',
            'showPopupContainerAction'
        );
        
        $this->addActionListener(
            'wp_ajax_remove_product',
            'onRemoveCartProductAction'
        );
        
        $this->addFilterListener(
            'add_to_cart_fragments',
            'onDisplayCartFilter'
        );
        
        $this->addShortcodeListener(
            'WooCommerceWooCartPro',
            'onDisplayShortCode'
        );

        $this->appendToMenu($this->settings);
        
        $this->appendToWindow($this->settings);
        
        $this->appendHiddenDropdownList($this->settings);
        
        $this->appendCssToHeaderForCartCustomize($this->settings);
        
        $this->appendHiddenPopupContainer($this->settings);
    } // end onInit
    
    public function showPopupContainerAction()
    {
        $this->addActionListener(
            'wp_head',
            'appendCallScriptPopupContainerAction'
        );
    } // end showPopupContainerAction
    
    public function appendCallScriptPopupContainerAction()
    {
        echo $this-> fetch('popup_call_script.phtml');
    } // end appendCallScriptPopupContainerAction
    
    public function getPluginCssUrl($fileName) 
    {
        return $this->_pluginCssUrl.'frontend/'.$fileName;
    } // end getPluginCssUrl
    
    public function getPluginJsUrl($fileName)
    {
        return $this->_pluginJsUrl.'frontend/'.$fileName;
    } // end getPluginJsUrl
    
    public function getPluginTemplatePath($fileName)
    {
        return $this->_pluginTemplatePath.'frontend/'.$fileName;
    } // end getPluginTemplatePath
    
    public function onInitJsAction()
    {

        
        $settings = $this->settings;
        
        $this->onEnqueueJsFileAction('jquery');
        $this->onEnqueueJsFileAction(
            'festi-cart-general',
            'general.js',
            'festi-cart-popup',
            $this->_version
        );
        $this->onEnqueueJsFileAction(
            'festi-cart-popup',
            'popup.js',
            'jquery',
            $this->_version
        );
        
        $this->localizeVars = array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'imagesUrl' => $this->getPluginImagesUrl(''),
        );
        
        if ($this->_isEnableDropdownList($settings)) {
            $optionName = 'cartDropdownListAligment';
            $this->localizeVars['productListAligment'] = $settings[$optionName];
        }
        
        wp_localize_script(
            'festi-cart-general',
            'fesiWooCart',
            $this->localizeVars
        );
        
        $this->addActionListener(
            'wp_head',
            'appendAdditionallocalizeScript'
        );

        $this->appendCartToCustomPositionInMenu($settings);
    } // end onInitJsAction
    
    public function appendAdditionallocalizeScript()
    {
        $args = array(
            'vars' => json_encode($this->localizeVars)
        );
        
        echo $this-> fetch('additional_localize_script.phtml', $args);    
    } // end appendAdditionallocalizeScript
    
    public function appendCartToCustomPositionInMenu($settings)
    {
        if (!$this->isEnableDisplayingCartInMenu($settings, false)) {
           return false;
        }
        
        $this->onEnqueueJsFileAction(
            'festi-cart-position-in-menu',
            'cart_in_menu.js',
            'jquery',
            $this->_version
        );
            
                 
        $vars = array(
            'menu'        => '',
            'settings'    => $settings,
        );

        $cartInMenu = $this->fetch('menu_item.phtml', $vars);
        
        $vars = array(
            'cartContent' => $cartInMenu
        );

        wp_localize_script(
            'jquery',
            'fesiWooCartInMenu',
            $vars
        );
    } // end appendCartToCustomPositionInMenu
    
    public function onRemoveCartProductAction()
    {
        if ($this->_hasDeleteItemInRequest()) {
            $woocommerce = $this->getWoocommerceInstance();
            $item = $_POST['deleteItem'];
            $woocommerce->cart->set_quantity($item , 0);
            
            echo $woocommerce->cart->get_cart_contents_count();
        }       
        
        exit();
    } // end onRemoveCartProductAction
    
    private function _hasDeleteItemInRequest()
    {
        return array_key_exists('deleteItem', $_POST) 
               && !empty($_POST['deleteItem']);
    } // end _hasDeleteItemInRequest
    
    public function onInitCssAction()
    {
        $this->onEnqueueCssFileAction(
            'festi-cart-styles',
            'style.css',
            array(),
            $this->_version
        );
    } // end onInitCssAction
    
    private function _onInitPluginCookie()
    {
        $value = $this->getPluginCookie();
        
        if (!$value) {
            return false;
        }
        
        if (!$this->_hasValueInCookieArray('woocommerce_cart_hash')) {
            $this->_setCookieForWoocommerceCartHash(
                'woocommerce_cart_hash',
                $value
            );     
        }

        $cookieName = 'festi_cart_for_woocommerce_storage';
        if (!$this->_hasValueInCookieArray($cookieName)) {
            $this->_setCookieForWoocommerceCartHash(
                'festi_cart_for_woocommerce_storage',
                $value
            );
        } else if ($this->_isChangedCookieValue($value)) {
            add_action(
                'wp_enqueue_scripts',
                array(&$this, 'onClearStorageAction')
            );
            
           $this->_setCookieForWoocommerceCartHash(
                'festi_cart_for_woocommerce_storage',
                $value
            );
        }
        
        return true;

    } // end _onInitPluginCookie
    
    public function getPluginCookie()
    {
        $value = array();
        
        $value = $this->getOptions('cookie');

        return $value[0];
    } // end getPluginCookie

    private function _setCookieForWoocommerceCartHash($name, $value, $time = 0)
    {
        setcookie(
            $name,
            $value, 
            $time,
            COOKIEPATH,
            COOKIE_DOMAIN
        );
    } // end _setCookieForWoocommerceCartHash
    
    public function fetchDropdownListContent()
    {
        $vars = array(
            'woocommerce' => $this->getWoocommerceInstance(),
            'settings'    => $this->settings
        );
        
       return $this->fetch('dropdown_list_content.phtml', $vars);
    } // end fetchDropdownListContent
    
    private function _hasValueInCookieArray($cookieName)
    {
        return isset($_COOKIE[$cookieName])
               && !empty($_COOKIE[$cookieName]);
    } // end _hasValueInCookieArray
    
    private function _isChangedCookieValue($value)
    {
        return $_COOKIE['festi_cart_for_woocommerce_storage'] != $value;
    } // end _isChangedCookieValue
    
    public function onClearStorageAction()
    {
        $this->onEnqueueJsFileAction(
            'festi-cart-clear-storage',
            'clear_storage.js',
            'jquery'
        );
    } // end onHeadAction
    
    public function appendToMenu($options)
    { 
        if (!$this->isEnableDisplayingCartInMenu($options)) {
           return false;       
        }
        
        $currentValue = $options['menuList'];
              
        foreach ($currentValue as $menuSlug) {
            add_filter(
                'wp_nav_menu_'.$menuSlug.'_items', 
                array(&$this, 'onMenuItemsFilter'), 
                10, 
                2
            ); 
        }
        
        return true;
    } // end appendToMenu
    
    public function appendToWindow($options)
    {
        if (!$this->_isEnableDisplayingCartInWindow($options)) {
            return false;       
        }
        
        $this->addActionListener(
            'wp_footer',
            'onDisplayCartInBrowserWindowAction'
        );
    } // end appendToWindow
    
    public function onDisplayCartInBrowserWindowAction()
    {
        $vars = array(
            'settings' => $this->settings,
        );

        echo $this->fetch('browser_window_cart.phtml', $vars);
    } // end onDisplayCartInBrowserWindowAction
    
    private function _isEnableDisplayingCartInWindow($options)
    {
        return array_key_exists('windowCart', $options);
    } // end _isEnableDisplayingCartInWindow
    
    public function appendHiddenDropdownList($options)
    {
        if (!$this->_isEnableDropdownList($options)) {
            return false; 
        }
        
        $this->addActionListener(
            'wp_footer',
            'onDisplayDropdownListAction'
        );
              
        $this->appendArrowToDropdownList($options);
    } // end appendHiddenDropdownList
    
    public function appendHiddenPopupContainer($options)
    {
        if (!$this->_isEnablePopUpWindow($options)) {
            return false; 
        }
        
        $this->addActionListener(
            'wp_footer',
            'onDisplayPopupContainerAction'
        );
    } // end appendHiddenPopupContainer
    
    private function _isEnablePopUpWindow($options)
    {
        return array_key_exists('popup', $options);      
    } // end _isEnablePopUpWindow
    
    public function onDisplayDropdownListAction()
    {
        $content = $this->fetchDropdownListContent();
        
        $vars = array(
            'content' => $content,
        );

        echo $this->fetch('dropdown_list.phtml', $vars);
    } // end onDisplayDropdownListAction
    
    public function onDisplayPopupContainerAction()
    {
        $vars = array(
            'woocommerce' => $this->getWoocommerceInstance(),
            'settings'    => $this->settings
        );
        
        $content = $this->fetch('popup_content.phtml', $vars);
        
        $vars['content'] = $content;
        
        echo $this->fetch('popup_container.phtml', $vars);
    } // end onDisplayPopupContainerAction
    
    private function _isEnableDropdownList($options)
    {
        return $options['dropdownAction'] != 'disable';       
    } // end _isEnableDropdownList
    
    public function appendArrowToDropdownList($options)
    {
        if (!$this->_isEnableDisplayingArrowOnDropdownList($options)) {
            return false;       
        }
        
        $this->addActionListener(
            'wp_footer',
            'onDisplayArrowOnDropdownListAction'
        );
    } // end appendArrowToDropdownList
    
    public function onDisplayArrowOnDropdownListAction()
    {
        $vars = array(
            'settings' => $this->settings,
        );

        echo $this->fetch('dropdown_arrow.phtml', $vars);
    } // end onDisplayArrowOnDropdownListAction
    
    private function _isEnableDisplayingArrowOnDropdownList($options)
    {
        return array_key_exists('borderArrow', $options);
    } // end _isEnableDisplayingArrowOnDropdownList
    
    public function appendCssToHeaderForCartCustomize($options)
    {
        $this->addActionListener(
            'wp_head',
            'addCssToHeaderAction'
        );
    } // end appendCssToHeaderForCartCustomize
    
    public function addCssToHeaderAction()
    {
        $vars = array(
            'settings' => $this->settings,
            'woocommerce'=> $this->getWoocommerceInstance()
        );

        echo $this->fetch('cart_customize_style.phtml', $vars);
        echo $this->fetch('dropdown_list_customize_style.phtml', $vars);
        echo $this->fetch('widget_customize_style.phtml', $vars);
        echo $this->fetch('popup_customize_style.phtml', $vars);
    } // end addCssToHeaderAction
    
    public function onMenuItemsFilter($nav, $args) 
    {
        $vars = array(
            'menu'        => $nav,
            'settings'    => $this->settings,
        );

        return $this->fetch('menu_item.phtml', $vars); 
    } // end onMenuItemsFilter
    
    public function isEnableDisplayingCartInMenu($options, $menuList = true)
    {
        $result = array_key_exists('displayMenu', $options);

        if (!$result || ($result && !$menuList)) {
            return $result;
        }

        return !empty($options['menuList']);
    } // end isEnableDisplayingCartInMenu
    
    public function onDisplayShortCode($attr = array())
    {
        $folder = 'shortcode/';
        
        if (!$attr) {
            return $this->fetch($folder.'shortcode.phtml');
        }
       
        if ($this->_hasOptionInShortcodeAttributes('widgettextformenu', $attr))
        {
            return $this->fetch($folder.'widget_text_for_menu.phtml');
        }
    } // end onDisplayShortCode
    
    private function _hasOptionInShortcodeAttributes($oprionName, $attr)
    {
        return array_key_exists($oprionName, $attr)
               && !empty($attr[$oprionName]);
    } // end _hasOptionInShortcodeAttributes
    
    public function fetchCart($class = '', $template = 'cart.phtml')
    {
        $vars = array(
            'woocommerce' => $this->getWoocommerceInstance(),
            'settings'    => $this->settings
        );
        
        if ($class) {
           $vars['additionaClass'] = $class;
        }
        
        return $this->fetch($template, $vars);
    } // end fetchCart
    
    public function onDisplayCartFilter($cssSelectors)
    {
        $classes = array(
            'festi-cart-widget',
            'festi-cart-shortcode',
            'festi-cart-menu',
            'festi-cart-window'
        );

        foreach ($classes as $value) {
            $class = $value;

            $content = $this->fetchCart($class);
            
            $cssSelectors['.festi-cart.'.$value] = $content;
        }
        
        $content = $this->fetchCart(false, 'dropdown_list_content.phtml');
        
        $selectorName = '.festi-cart-products-content';
        
        $cssSelectors[$selectorName] = $content;
        
        $content = $this->fetchCart(false, 'widget_products_list.phtml');
        
        $selectorName = '.festi-cart-widget-products-content';
        
        $cssSelectors[$selectorName] = $content;
        
        $content = $this->fetchCart(false, 'popup_content.phtml');
        
        $selectorName = '.festi-cart-pop-up-products-content';
        
        $cssSelectors[$selectorName] = $content;
        
        return $cssSelectors;
    } // end onDisplayCartFilter
}