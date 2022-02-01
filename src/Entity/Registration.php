<?php

namespace App\Entity;

use App\Repository\RegistrationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RegistrationRepository::class)
 */
class Registration
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Course::class, inversedBy="registrations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $courseid;

    /**
     * @ORM\ManyToOne(targetEntity=Student::class, inversedBy="registrations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $studentid;

    /**
     * @ORM\ManyToOne(targetEntity=Account::class, inversedBy="registrations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $accountid;

    /**
     * @ORM\Column(type="date")
     */
    private $registrationDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCourseid(): ?Course
    {
        return $this->courseid;
    }

    public function setCourseid(?Course $courseid): self
    {
        $this->courseid = $courseid;

        return $this;
    }

    public function getStudentid(): ?Student
    {
        return $this->studentid;
    }

    public function setStudentid(?Student $studentid): self
    {
        $this->studentid = $studentid;

        return $this;
    }

    public function getAccountid(): ?Account
    {
        return $this->accountid;
    }

    public function setAccountid(?Account $accountid): self
    {
        $this->accountid = $accountid;

        return $this;
    }

    public function getRegistrationDate(): ?\DateTimeInterface
    {
        return $this->registrationDate;
    }

    public function setRegistrationDate(\DateTimeInterface $registrationDate): self
    {
        $this->registrationDate = $registrationDate;

        return $this;
    }
}
