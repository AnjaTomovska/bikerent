<?php
/**
 * Created by PhpStorm.
 * User: anjatomovska
 * Date: 12/16/16
 * Time: 10:58 AM
 */

namespace BikeRentBundle\Entity;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 *
 */
class User extends BaseUser
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

}