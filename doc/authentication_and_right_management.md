Authentication and authorization
================================

Magento features a complete user management system. Unlike Mouf, Magento's front does not 
feature a system to manage authorization via permissions. Customers can be stored in groups, but
Magento does not allow to bind those groups to special permissions.
Magento's back-office has this capability, but this is out of Moufgento scope.

Mouf features an authentication system named [UserService](http://mouf-php.com/packages/mouf/security.userservice/README.md)
and a authorization system named [RightsService](http://mouf-php.com/packages/mouf/security.rightsservice/README.md).

Moufgento only maps the user service of Mouf to Magento user management system. Nothing is done for the right service
since the permissions notion does not exist natively in Magento.

When you install Moufgento, the install process will create one instance related to authentication:

- `userService` : an instance of the `MagentoUserService` class that is compatible with the `UserServiceInterface`

Many Mouf packages rely on the `userService`, and therefore, can be fed the `MagentoUserService`.

A few examples of what you can do with this objects:

```php
// Connects the user
Mouf::getUserService()->login('login', 'password');

// Returns whether a user is connected or not
$isLogged = Mouf::getUserService()->isLogged();

// Returns the login of the current logged user
$login = Mouf::getUserService()->getUserLogin();
```

You can also use the `@Logged` annotation in your actions code to force a user to be logged to access some URL:

```php
/**
 * @URL my-protected-url/
 * @Logged
 */
function index() {
    // You must be logged to access this page
}
```
