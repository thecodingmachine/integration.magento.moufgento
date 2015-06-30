Bridging Magento blocks with Mouf
=================================

In Magento, HTML pieces are organized in blocks. This layout system is very powerful and allow the reuse of HTML blocks 
in many contexts.
In Mouf, the same concept is represented by [**Html elements**](http://mouf-php.com/packages/mouf/html.htmlelement/README.md). These are objects
implementing the [`HtmlElementInterface`](https://github.com/thecodingmachine/html.html_element/blob/2.0/src/Mouf/Html/HtmlElement/HtmlElementInterface.php).

Moufgento's MagentoTemplate comes with a feature that lets you add HTML in any block already defined in Magento (i.e. 
you can add objects implementing the `HtmlElementInterface` in any Magento block dynamically.

For this, you simply have to edit the 

![Moufgento blocks](doc/blocks.png)

Have a look at the screenshot of the Mouf admin above. You can map in the template a Mouf block to a Magento block.

What can I use this for?
------------------------
Virtually anything!

You can decide to code your own class implementing the [`HtmlElementInterface`](https://github.com/thecodingmachine/html.html_element/blob/2.0/src/Mouf/Html/HtmlElement/HtmlElementInterface.php).
Once your class is written, do not forget to create an instance of your class in Mouf UI.

Or, you can decide to use one of the html element already developed for you. The list is huge:
[Evolugrid](http://mouf-php.com/packages/mouf/html.widgets.evolugrid/README.md) to display an ajax datagrid,
[BCE](http://mouf-php.com/packages/mouf/mvc.bce/readme.md) to display a form with direct mapping in database,
a Twig template using the Twig block, etc... There are many possibilities if you take the time to scan the existing Mouf packages!

What next?
----------

Learn more about:

- [authentication and authorization](doc/authentication_and_right_management.md)
