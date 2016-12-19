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



    /**
     *
     * @ORM\ManyToMany(targetEntity="Bike")
     * @ORM\JoinTable(name="users_favorites",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="bike_id", referencedColumnName="id")}
     *      )
     */
    private $favorites;


    /**
     * Add favorite
     *
     * @param \BikeRentBundle\Entity\Bike $favorite
     *
     * @return User
     */
    public function addFavorite(\BikeRentBundle\Entity\Bike $favorite)
    {
        $this->favorites[] = $favorite;

        return $this;
    }

    /**
     * Remove favorite
     *
     * @param \BikeRentBundle\Entity\Bike $favorite
     */
    public function removeFavorite(\BikeRentBundle\Entity\Bike $favorite)
    {
        $this->favorites->removeElement($favorite);
    }

    /**
     * Get favorites
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFavorites()
    {
        return $this->favorites;
    }
}
