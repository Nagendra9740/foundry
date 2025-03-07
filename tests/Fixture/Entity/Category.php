<?php

/*
 * This file is part of the zenstruck/foundry package.
 *
 * (c) Kevin Bond <kevinbond@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zenstruck\Foundry\Tests\Fixture\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Zenstruck\Foundry\Tests\Fixture\Model\Base;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
#[ORM\Entity]
class Category extends Base
{
    /** @var Collection<int,Contact> */
    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Contact::class)]
    protected Collection $contacts;

    /** @var Collection<int,Contact> */
    #[ORM\OneToMany(mappedBy: 'secondaryCategory', targetEntity: Contact::class)]
    protected Collection $secondaryContacts;

    #[ORM\Column(length: 255)]
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->contacts = new ArrayCollection();
        $this->secondaryContacts = new ArrayCollection();
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int,Contact>
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contact $contact): static
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts->add($contact);
            $contact->setCategory($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): static
    {
        $this->contacts->removeElement($contact);

        return $this;
    }

    /**
     * @return Collection<int,Contact>
     */
    public function getSecondaryContacts(): Collection
    {
        return $this->secondaryContacts;
    }

    public function addSecondaryContact(Contact $secondaryContact): static
    {
        if (!$this->secondaryContacts->contains($secondaryContact)) {
            $this->secondaryContacts->add($secondaryContact);
            $secondaryContact->setSecondaryCategory($this);
        }

        return $this;
    }

    public function removeSecondaryContact(Contact $secondaryContact): static
    {
        $this->secondaryContacts->removeElement($secondaryContact);

        return $this;
    }
}
