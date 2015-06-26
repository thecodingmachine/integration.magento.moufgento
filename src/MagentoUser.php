<?php
namespace Mouf\Integration\Magento;

use Mouf\Security\UserService\UserInterface;

/**
 * A user in magento, represented as a UserInterface
 */
class MagentoUser implements UserInterface {

    private $customer;

    public function __construct(\Mage_Customer_Model_Customer $customer)
    {
        $this->customer = $customer;
    }


    /**
     * Returns the ID for the current user.
     *
     * @return string
     */
    public function getId()
    {
        return $this->customer->getId();
    }

    /**
     * Returns the login for the current user.
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->customer->getEmail();
    }
}