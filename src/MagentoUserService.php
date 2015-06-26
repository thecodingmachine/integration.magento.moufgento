<?php
namespace Mouf\Integration\Magento;


use Mouf\Security\UserService\UserServiceInterface;

/**
 * A special implementation of Mouf's user service that uses Magento in the shadows.
 */
class MagentoUserService implements UserServiceInterface {

    /**
     * Logs the user using the provided login and password.
     * Returns true on success, false if the user or password is incorrect.
     *
     * @param string $user
     * @param string $password
     * @return boolean.
     */
    public function login($user, $password)
    {
        /* @var $session \Mage_Customer_Model_Session */
        $session = Mage::getSingleton('customer/session');
        return $session->login($user, $password);
    }

    /**
     * Logs the user using the provided login.
     * The password is not needed if you use this function.
     * Of course, you should use this functions sparingly.
     * For instance, it can be useful if you want an administrator to "become" another
     * user without requiring the administrator to provide the password.
     *
     * @param string $login
     */
    public function loginWithoutPassword($login)
    {
        $customer = Mage::getModel('customer/customer')
            ->setWebsiteId(Mage::app()->getStore()->getWebsiteId());
        $customer->loadByEmail($login);
        if ($customer->getConfirmation() && $customer->isConfirmationRequired()) {
            throw Mage::exception('Mage_Core', Mage::helper('customer')->__('This account is not confirmed.'),
                \Mage_Customer_Model_Customer::EXCEPTION_EMAIL_NOT_CONFIRMED
            );
        }

        /* @var $session \Mage_Customer_Model_Session */
        $session = Mage::getSingleton('customer/session');
        $session->setCustomerAsLoggedIn($customer);
    }

    /**
     * Logs a user using a token. The token should be discarded as soon as it
     * was used.
     *
     * @param string $token
     */
    public function loginViaToken($token)
    {
        throw new MoufgentoException("Feature not implemented yet");
    }

    /**
     * Returns "true" if the user is logged, "false" otherwise.
     *
     * @return boolean
     */
    public function isLogged()
    {
        return Mage::getSingleton('customer/session')->isLoggedIn();
    }

    /**
     * Redirects the user to the login page if he is not logged.
     *
     * @return boolean
     */
    public function redirectNotLogged()
    {
        // TODO: Implement redirectNotLogged() method.
    }

    /**
     * Logs the user off.
     *
     */
    public function logoff()
    {
        /* @var $session \Mage_Customer_Model_Session */
        $session = Mage::getSingleton('customer/session');
        $session->logout();
    }

    /**
     * Returns the current user ID.
     *
     * @return string
     */
    public function getUserId()
    {
        /* @var $session \Mage_Customer_Model_Session */
        $session = Mage::getSingleton('customer/session');
        $customer = $session->getCustomer();
        if ($customer !== null) {
            return $session->getCustomer()->getId();
        } else {
            return null;
        }
    }

    /**
     * Returns the current user login.
     *
     * @return string
     */
    public function getUserLogin()
    {
        /* @var $session \Mage_Customer_Model_Session */
        $session = Mage::getSingleton('customer/session');
        $customer = $session->getCustomer();
        return $customer->getEmail();
    }

    /**
     * Returns the user that is logged (or null if no user is logged).
     *
     * return UserInterface
     */
    public function getLoggedUser()
    {
        /* @var $session \Mage_Customer_Model_Session */
        $session = Mage::getSingleton('customer/session');
        $customer = $session->getCustomer();
        return new MagentoUser($customer);
    }
}