# Magento 2 Product Tags

The product tag supports both the administrator and the user, adding one or more tags. Using keywords and phrases to identify products and product features, administrators can easily group related items together and attach them to one tag and users can easily choose which items to buy one by one. easy way. With such a utility, it will save a lot of time searching and supporting customers a lot.

Before you continue, ensure you meet the following requirements:

  * You have installed Magento 2.
  * You are using a Linux or Mac OS machine. Windows is not currently supported.


## 1. Download Magento 2 Product Tags

 ### Install via composer (recommend).
Run the following commands in Magento 2 root folder:
```
composer require magepow/producttags
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy -f
```

## 2. User guide
   #### Key features of Magento 2 Product Tags Extension:

  * Easily group products with the same feature into one card.
  * Highlighting the product and narrowing the search results makes it convenient for customers to buy.
  * Show on the product detail page and also on the sidebar.
  * Easily add new and remove products in the admin area.
  * Can show on pages when adding widgets.
  * Clicking on the tag will display a page listing the products that have been grouped into the tag.
  ### 2.1. General configuration

  `Login to Magento Admin > Stores > Configuration > Magepow > Proucttags > Enable > Choose Yes/No to Show or hide module Producttags.`
  
  ![Image of Magento admin config](https://github.com/magepow/magento2-producttags/blob/master/media/adminconfig_producttags.png)
  * Route: This text will change your URL, default is "productags".
  * Show the number of products: Show/hide Show number of products beside tags.
  * Tag on the product details: Show/hide product tags on the product detail page.
  * Product tags title: This text will show title tags on the page product details. 
  * Limit tags to show: Show the number of product tags on the product detail page, default is 10.
  * Enable tag on Sidebar: Show/hide product tags on the sidebar position.
  * Sidebar tags title: This text will show title tags on the sidebar block.
  * Limit tags on Sidebar: This text will limit the number of tags shown on the sidebar block. 

  `Login to Magento Admin > Stores > Configuration > Magepow > Proucttags > Tag on the product details > Choose Yes/No to show/hide product tags on the product detail page.`
  Result show in the front end store.
  ![Image of Magento storefront](https://github.com/magepow/magento2-producttags/blob/master/media/product_details.png)
  `Login to Magento Admin > Stores > Configuration > Magepow > Proucttags > Enable tag on Sidebar > Choose Yes/No to show/hide product tags on the sidebar position.`
  Result show in the front end store.
  ![Image of Magento storefront](https://github.com/magepow/magento2-producttags/blob/master/media/producttags_sidebar.png)
  ### 2.2. Add new tag
   `Login to Magento Admin > Magepow > Product Tags => Click on Add New Tag, Create new content and information for the tag.`
  ![Image of Magento admin config](https://github.com/magepow/magento2-producttags/blob/master/media/form_producttags.png)
   * Add the product you want in the tag.
  ![Image of Magento admin config](https://github.com/magepow/magento2-producttags/blob/master/media/gallery_product.png)
   * Once saved, you have the list tags.
   ![Image of Magento admin config](https://github.com/magepow/magento2-producttags/blob/master/media/list_tags.png)
   * In the tag list, you can take bulk actions like batch delete, enable status, and disable multiple tags.
   ![Image of Magento admin config](https://github.com/magepow/magento2-producttags/blob/master/media/massaction.png)
  ### 2.3. Config Producttags on Widget.
   * Add new widget.
   `Login to Magento Admin > Content > Widgets > Add Widget > In type choose Display Product Tags > In design theme, choose the theme you want to use => Click continue.`
   ![Image of Magento admin config](https://github.com/magepow/magento2-producttags/blob/master/media/add_widget.png)
   `Login to Magento Admin > Content > Widgets > Add Widget > Storefront Properties > Setting widget and save.`
   * Add widget title, assign store views, sort order and in layout updates to display on pages the example shown below.
   ![Image of Magento admin config](https://github.com/magepow/magento2-producttags/blob/master/media/config_widget.png)
    In widget options config.
   ![Image of Magento admin config](https://github.com/magepow/magento2-producttags/blob/master/media/config_widget_producttags.png)
   * Title: This text will display the title on the page selected.
   * Tags Limit: This will limit the number of tags shown on the widget.
   * Show Number Of Products: Show/hide Show number of products beside tags.

   Results show up in the UI store by setting.
   ![Image of Magento storefront](https://github.com/magepow/magento2-producttags/blob/master/media/producttags_widget.png)
  ### 2.4. Result 
  Click the tabs on the sidebar, in product details, or in the widgets section. Will display a tab containing the selected products in that tab.
  ![Image of Magento storefront](https://github.com/magepow/magento2-producttags/blob/master/media/list_product.png)
 ## Donation

If this project help you reduce time to develop, you can give me a cup of coffee :).

[![paypal](https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif)](https://www.paypal.com/paypalme/alopay)

      
**Free Extensions List**

* [Magento 2 Categories Extension](https://magepow.com/magento-categories-extension.html)

* [Magento 2 Sticky Cart](https://magepow.com/magento-sticky-cart.html)

**Premium Extensions List**

* [Magento 2 Pages Speed Optimizer](https://magepow.com/magento2-speed-optimizer.html)

* [Magento 2 Mutil Translate](https://magepow.com/magento-multi-translate.html)

* [Magento 2 Instagram Integration](https://magepow.com/magento-2-instagram.html)

* [Magento 2 Lookbook Pin Products](https://magepow.com/lookbook-pin-products.html)

**Featured Magento Themes**

* [Expert Multipurpose responsive Magento 2 Theme](https://1.envato.market/c/1314680/275988/4415?u=https://themeforest.net/item/expert-premium-responsive-magento-2-and-1-support-rtl-magento-2-/21667789)

* [Gecko Premium responsive Magento 2 Theme](https://1.envato.market/c/1314680/275988/4415?u=https://themeforest.net/item/gecko-responsive-magento-2-theme-rtl-supported/24677410)

* [Milano Fashion responsive Magento 2 Theme](https://1.envato.market/c/1314680/275988/4415?u=https://themeforest.net/item/milano-fashion-responsive-magento-1-2-theme/12141971)

* [Electro responsive Magento 2 Theme](https://1.envato.market/c/1314680/275988/4415?u=https://themeforest.net/item/electro-responsive-magento-1-2-theme/17042067)

* [Pizzaro Food responsive Magento 2 Theme](https://1.envato.market/c/1314680/275988/4415?u=https://themeforest.net/item/pizzaro-food-responsive-magento-1-2-theme/19438157)

* [Biolife Organic responsive Magento 2 Theme](https://1.envato.market/c/1314680/275988/4415?u=https://themeforest.net/item/biolife-organic-food-magento-2-theme-rtl-supported/25712510)

* [Market responsive Magento 2 Theme](https://1.envato.market/c/1314680/275988/4415?u=https://themeforest.net/item/market-responsive-magento-2-theme/22997928)

* [Kuteshop responsive Magento 2 Theme](https://1.envato.market/c/1314680/275988/4415?u=https://themeforest.net/item/kuteshop-multipurpose-responsive-magento-1-2-theme/12985435)

**Featured Magento Services**

* [PSD to Magento 2 Theme Conversion](https://magepow.com/psd-to-magento-theme-conversion.html)

* [Magento Speed Optimization Service](https://magepow.com/magento-speed-optimization-service.html)

* [Magento Security Patch Installation](https://magepow.com/magento-security-patch-installation.html)

* [Magento Website Maintenance Service](https://magepow.com/website-maintenance-service.html)

* [Magento Professional Installation Service](https://magepow.com/professional-installation-service.html)

* [Magento Upgrade Service](https://magepow.com/magento-upgrade-service.html)

* [Customization Service](https://magepow.com/customization-service.html)

* [Hire Magento Developer](https://magepow.com/hire-magento-developer.html)

[![Latest Stable Version](https://poser.pugx.org/magepow/producttags/v/stable)](https://packagist.org/packages/magepow/producttags)
[![Total Downloads](https://poser.pugx.org/magepow/producttags/downloads)](https://packagist.org/packages/magepow/producttags)
