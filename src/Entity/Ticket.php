<?php
namespace App\Entity;


class Ticket extends AbstractEntity implements \JsonSerializable
{
    private string $title;

    private string $content;

    private \DateTime $createdat;

    private ?\DateTime $openedat;

    private ?\DateTime $closedat;

    private string $type;

    private string $color;

    private string $createdby;

    /**
     * Get the value of title
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set the value of title
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of content
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Set the value of content
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of createdat
     */
    public function getCreatedat(): \DateTime
    {
        return $this->createdat;
    }

    /**
     * Set the value of createdat
     */
    public function setCreatedat(?string $createdat): self
    {
        $this->createdat = new \DateTime($createdat);

        return $this;
    }

    /**
     * Get the value of type
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Set the value of type
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of createdby
     */
    public function getCreatedby(): string
    {
        return $this->createdby;
    }

    /**
     * Set the value of createdby
     */
    public function setCreatedby(string $createdby): self
    {
        $this->createdby = $createdby;

        return $this;
    }

    /**
     * Get the value of openedat
     */
    public function getOpenedat(): ?\DateTime
    {
        return $this->openedat;
    }

    /**
     * Set the value of openedat
     */
    public function setOpenedat(?string $openedat): self
    {
        $this->openedat = $openedat ? new \DateTime($openedat) : null;

        return $this;
    }

    /**
     * Get the value of closedat
     */
    public function getClosedat(): ?\DateTime
    {
        return $this->closedat;
    }

    /**
     * Set the value of closedat
     */
    public function setClosedat(?string $closedat): self
    {
        $this->closedat = $closedat ? new \DateTime($closedat) : null;

        return $this;
    }

    /**
     * Get the value of color
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * Set the value of color
     */
    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'title' => $this->titre,
            'content' => $this->content,
            'createdat' => $this->createdat->format('d-m-Y'),
            'type' => $this->type
        ];
    }
}