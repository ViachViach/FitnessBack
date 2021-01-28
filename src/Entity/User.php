<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use DateTimeInterface;
use DateTimeImmutable;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="user", schema="public")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @Assert\Email()
     * @Assert\NotNull()
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private string $email;

    /**
     * @ORM\Column(type="json")
     */
    private array $roles = [];

    /**
     * @ORM\Column(type="string")
     */
    private string $password;

    /**
     * @ORM\Column(type="string")
     */
    private string $firstName;

    /**
     * @ORM\Column(type="string")
     */
    private string $secondName;

    /**
     * @ORM\Column(type="float")
     */
    private float $height;

    /**
     * @ORM\Column(type="float")
     */
    private float $weight;

    /**
     * @ORM\Column(type="integer")
     */
    private int $sex;

    /**
     * @ORM\Column(type="date")
     */
    private DateTimeInterface $birthday;

    /**
     * @ORM\Column(type="integer")
     */
    private int $age;

    /**
     * @ORM\Column(type="bigint")
     */
    private int $phone;

    /**
     * @ORM\ManyToOne(targetEntity="City")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     */
    private int $city;

    /**
     * @ORM\Column(type="string")
     */
    private string $address;

    /**
     * @ORM\Column(type="string", name="post_code")
     */
    private string $postCode;

    /**
     * @ORM\Column(type="datetimetz", options={"default": "CURRENT_TIMESTAMP"})
     */
    private DateTimeInterface $createAt;

    /**
     * @ORM\Column(type="datetimetz", options={"default": "CURRENT_TIMESTAMP"})
     */
    private DateTimeInterface $updateAt;

    /**
     * @ORM\Column(type="datetimetz", nullable=true)
     */
    private ?DateTimeInterface $deleteAt;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Training", inversedBy="users")
     */
    private Collection $trainings;

    public function __construct()
    {
        $this->trainings = new ArrayCollection();
        $this->createAt = new DateTimeImmutable();
        $this->updateAt = new DateTimeImmutable();
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return User
     */
    public function setId(int $id): User
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName(string $firstName): User
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getSecondName(): string
    {
        return $this->secondName;
    }

    /**
     * @param string $secondName
     *
     * @return User
     */
    public function setSecondName(string $secondName): User
    {
        $this->secondName = $secondName;
        return $this;
    }

    /**
     * @return float
     */
    public function getHeight(): float
    {
        return $this->height;
    }

    /**
     * @param float $height
     *
     * @return User
     */
    public function setHeight(float $height): User
    {
        $this->height = $height;
        return $this;
    }

    /**
     * @return float
     */
    public function getWeight(): float
    {
        return $this->weight;
    }

    /**
     * @param float $weight
     *
     * @return User
     */
    public function setWeight(float $weight): User
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * @return int
     */
    public function getSex(): int
    {
        return $this->sex;
    }

    /**
     * @param int $sex
     *
     * @return User
     */
    public function setSex(int $sex): User
    {
        $this->sex = $sex;
        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getBirthday(): DateTimeInterface
    {
        return $this->birthday;
    }

    /**
     * @param DateTimeInterface $birthday
     *
     * @return User
     */
    public function setBirthday(DateTimeInterface $birthday): User
    {
        $this->birthday = $birthday;
        return $this;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * @param int $age
     *
     * @return User
     */
    public function setAge(int $age): User
    {
        $this->age = $age;
        return $this;
    }

    /**
     * @return int
     */
    public function getPhone(): int
    {
        return $this->phone;
    }

    /**
     * @param int $phone
     *
     * @return User
     */
    public function setPhone(int $phone): User
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return int
     */
    public function getCity(): int
    {
        return $this->city;
    }

    /**
     * @param int $city
     *
     * @return User
     */
    public function setCity(int $city): User
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     *
     * @return User
     */
    public function setAddress(string $address): User
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getPostCode(): string
    {
        return $this->postCode;
    }

    /**
     * @param string $postCode
     *
     * @return User
     */
    public function setPostCode(string $postCode): User
    {
        $this->postCode = $postCode;
        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getCreateAt(): DateTimeInterface
    {
        return $this->createAt;
    }

    /**
     * @param DateTimeInterface $createAt
     *
     * @return User
     */
    public function setCreateAt(DateTimeInterface $createAt): User
    {
        $this->createAt = $createAt;
        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getUpdateAt(): DateTimeInterface
    {
        return $this->updateAt;
    }

    /**
     * @param DateTimeInterface $updateAt
     *
     * @return User
     */
    public function setUpdateAt(DateTimeInterface $updateAt): User
    {
        $this->updateAt = $updateAt;
        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDeleteAt(): ?DateTimeInterface
    {
        return $this->deleteAt;
    }

    /**
     * @param DateTimeInterface|null $deleteAt
     *
     * @return User
     */
    public function setDeleteAt(?DateTimeInterface $deleteAt): User
    {
        $this->deleteAt = $deleteAt;
        return $this;
    }

    /**
     * @return ArrayCollection|Collection
     */
    public function getTrainings()
    {
        return $this->trainings;
    }

    /**
     * @param ArrayCollection|Collection $trainings
     *
     * @return User
     */
    public function setTrainings($trainings)
    {
        $this->trainings = $trainings;
        return $this;
    }
}
