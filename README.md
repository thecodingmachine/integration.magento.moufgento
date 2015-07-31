Moufgento: a modern MVC framework for Magento based on Mouf and PSR-7
=====================================================================

Why should I care?
------------------

Moufgento is a **modern MVC framework for Magento**. Actually, it is a bridge between [Magento](http://magento.com/) and the [Splash MVC framework](http://mouf-php.com/packages/mouf/mvc.splash/index.md)
used by [Mouf-PHP](http://mouf-php.com) (a dependency injection based framework).

Magento comes with a very heavy framework, based on Zend Framework 1. It is definitely very powerful, allowing to overload almost any part of the application. Yet, it is somewhat old and lacks the modern features we have come to love in the current MVC frameworks, like dependency injection, annotations support, few or no XML configuration files... For these reasons, if you find yourself with a need to do a massive custom application inside Magento, you might want to use something else than Magento default framework.

Moufgento is at the same time a module for Magento that adds PSR-7 compatible middleware support AND an integration of Splash, 
the default MVC framework that comes with Mouf and that is provided as a middleware.

Moufgento offers the following features:

- The ability to plug any zend/stratigility middleware (i.e. PSR-7 Middleware) in Magento
- A default router (Splash) with
    - **controllers**, declared through a nice graphical DI container
    - use of **annotations** in your controllers (for instance: `@URL` to declare a new route, `@Logged` to restrict access to logged users, etc...)
    - support for any kind of **views** supported in Splash MVC (this includes plain PHP files, [Twig templates](http://twig.sensiolabs.org/), etc...)
    - a [nice web-based UI to scafold your controllers and views](http://mouf-php.com/packages/mouf/mvc.splash/doc/writing_controllers.md)
    - integration of your views inside the Magento theme
    - (very) easy Ajax support
    - integration of Mouf's [**authentication**](doc/authentication_and_right_management.md) system into Magento
    - integration of Mouf's [**web library (JS/CSS)**](doc/scripts-and-styles.md) system into Magento

Moufgento has been tested with Magento CE 1.9.


Another interesting feature is that your code is **100% compatible** with Splash MVC. This means that you can write a controller in Splash MVC and deploy it later in Magento (or the opposite), or any other third party system that Splash can be plugged into (i.e. Drupal, Wordpress, Joomla...)

Installation
------------

You will first need to install Magento and Mouf side by side.

1. Start by installing [Magento](http://magento.com/) as you would normally do.
2. [Install the Mouf PHP framework](http://mouf-php.com/packages/mouf/mouf/doc/installing_mouf.md) _in the same directory_ as Magento
   This means you should have the **composer.json** file of Composer in the same directory as the **index.php** of Magento.
3. Modify **composer.json** and add the **moufgento** module. Your **composer.json** should contain at least these lines:

```json
{
    "repositories": [
    {
        "type": "composer",
        "url": "http://packages.firegento.com"
    },
    {
        "type": "vcs",
        "url": "https://github.com/magento-hackathon/magento-composer-installer"
    }
    ],
    "autoload" : {
        "psr-0" : {
            "MyApp" : "src/"
        }
    },
    "require" : {
        "magento-hackathon/magento-composer-installer": "*",
        "mouf/mouf" : "~2.0",
        "mouf/integration.magento.moufgento" : "~1.0",
    },
    "minimum-stability" : "dev",
    "prefer-stable": true
}
```

   Do not forget to customize your vendor name (the `MyApp` part of the autoloader section).
4. Create the empty `src/` directory at the root of your project.
5. Run the install process in Mouf: connect to Mouf UI and run the install process for all the packages
   (including Moufgento install process of course)
6. You have now to patch the Magento Autoloader because there is [some weird issue with the `class_exists` function](http://www.webguys.de/magento/tuerchen-11-the-magento-autoloader-and-external-libraries/) .
   First, copy `app/code/core/Varien/Autoload.php` into `app/code/local/Varien/Autoload.php`
   Then, in the `autoload` method, replace :

```php
return include $classFile;
```

   By

```php
return @include $classFile;

```

Getting started
---------------

[In the next section, we will learn **how to create a controller and a view**.](doc/mvc.md)

Or if you already know Splash, you can directly jump to another part of this documentation:

- [widgets integration](doc/widgets.md)
- [authentication and authorization](doc/authentication_and_right_management.md)
- [web library (JS/CSS)](doc/scripts-and-styles.md)
