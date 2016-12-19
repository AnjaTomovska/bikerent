<?php
/**
 * Created by PhpStorm.
 * User: anjatomovska
 * Date: 12/16/16
 * Time: 1:10 PM
 */

namespace BikeRentBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use BikeRentBundle\Entity\User;
/**
 * @ORM\Entity
 *
 */
class Reservation
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     *
     * @ORM\ManyToMany(targetEntity="Bike")
     * @ORM\JoinTable(name="reservation_bikes",
     *      joinColumns={@ORM\JoinColumn(name="reservation_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="bike_id", referencedColumnName="id")}
     *      )
     */
    private $bikes;

    /**
     *
     * @ORM\ManyToMany(targetEntity="Accessory")
     * @ORM\JoinTable(name="reservation_accessories",
     *      joinColumns={@ORM\JoinColumn(name="reservation_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="accessory_id", referencedColumnName="id")}
     *      )
     */
    private $accessories;

    /**
     * @ORM\Column(type="date")
     */
    private $startDate;


    /**
     * @ORM\Column(type="date")
     */
    private $endDate;


    /**
     * @ORM\Column(type="string")
     */
    private $phone;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->bikes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return Reservation
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     *
     * @return Reservation
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Add bike
     *
     * @param \BikeRentBundle\Entity\Bike $bike
     *
     * @return Reservation
     */
    public function addBike(\BikeRentBundle\Entity\Bike $bike)
    {
        $this->bikes[] = $bike;

        return $this;
    }

    /**
     * Remove bike
     *
     * @param \BikeRentBundle\Entity\Bike $bike
     */
    public function removeBike(\BikeRentBundle\Entity\Bike $bike)
    {
        $this->bikes->removeElement($bike);
    }

    /**
     * Get bikes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBikes()
    {
        return $this->bikes;
    }

    /**
     * Set user
     *
     * @param \BikeRentBundle\Entity\User $user
     *
     * @return Reservation
     */
    public function setUser(\BikeRentBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \BikeRentBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add accessory
     *
     * @param \BikeRentBundle\Entity\Accessory $accessory
     *
     * @return Reservation
     */
    public function addAccessory(\BikeRentBundle\Entity\Accessory $accessory)
    {
        $this->accessories[] = $accessory;

        return $this;
    }

    /**
     * Remove accessory
     *
     * @param \BikeRentBundle\Entity\Accessory $accessory
     */
    public function removeAccessory(\BikeRentBundle\Entity\Accessory $accessory)
    {
        $this->accessories->removeElement($accessory);
    }

    /**
     * Get accessories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAccessories()
    {
        return $this->accessories;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Reservation
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }
}
