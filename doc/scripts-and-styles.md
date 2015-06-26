Scripts and styles integration
==============================

By default, Moufgento uses the [`addJs`](http://docs.magentocommerce.com/Mage_Page/Mage_Page_Block_Html_Head.html#addJs) 
and [`addCss`](http://docs.magentocommerce.com/Mage_Page/Mage_Page_Block_Html_Head.html#addCss) functions to handle
CSS and JS files.

In Mouf, on the other hand, scripts and styles are handled using 
[WebLibraries](http://mouf-php.com/packages/mouf/html.utils.weblibrarymanager/README.md).

When you use Moufgento, you can use both techniques to add JS and CSS files to your pages.

**One important thing:** Web libraries are used on pages managed by Moufgento only.
On pages managed by Magento (a product page, the home page, etc...) web libraries will be ignored. Therefore:

- If you want to add JS/CSS on *all pages* of your Magento site, including the pages not managed by
  Moufgento, you should do this *the Magento way*.
- If on the other hand, you want some JS and CSS specifically on the *dynamic pages* handled by Moufgento's controllers,
  you should declare a *web library*.

Using *Web libraries* in Moufgento
----------------------------------

We will not cover the use of web libraries in this documentation. If you want to learn how to use
we libraries, please refer to the [web libraries documentation](http://mouf-php.com/packages/mouf/html.utils.weblibrarymanager/README.md).

What next?
----------

Learn more about:

- [blocks integration](doc/blocks.md)
- [authentication and authorization](doc/authentication_and_right_management.md)