Building a controller and a view for Magento
============================================

We will not describe the whole process of creating a controller and a view in the Moufgento documentation.
Indeed, Moufgento is just a compatibility layer on top of the Splash MVC framework. Therefore, you can
simply refer to the [Splash MVC video tutorial to get started](http://mouf-php.com/packages/mouf/mvc.splash/doc/writing_controllers.md).

Integrating with Magento theme
------------------------------

When you run Moufgento's installer, a `magentoTemplate` instance will be created. This instance represents the current
Magento theme.

In your controller, assuming `$this->template` refers to the `magentoTemplate` instance, if you want to display a page
wrapped in the default template, your controller action must end with:

```php
use Mouf\Html\HtmlElement;

public function index() {
	//...
	return new HtmlElement($this->template);
}

```

If you do not call this method, the Magento theme will not be displayed and the response will be directly 
sent to the browser. This is a fairly easy way to do some Ajax since you won't be polluted by the Magento theme at all.

Managing the title
------------------

As with any Splash templates, you can modify the title of the template using the `setTitle`.

```php
/**
 * @URL mytest
 */
public function index() {
	//...

	$this->template->setTitle('My title');

	return new HtmlElement($this->template);
}
```

What next?
----------

Learn more about:

<a href="scripts-and-styles.md" class="btn btn-primary">Web library (JS/CSS) &gt;</a>

<a href="blocks.md" class="btn">Blocks integration &gt;</a>

<a href="authentication_and_right_management.md" class="btn">Authentication and authorization &gt;</a>
