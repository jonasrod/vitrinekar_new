<?php
namespace App\Models\Entity;

/**
 * @Entity
 * @Table(name="manufacturer")
 */
class Manufacture
{
    /**
     * @Id
     * @GeneratedValue(strategy="AUTO")]
     * @Column(type="integer", name="id_manufacturer")
     */
    public $id;

    /**
     * @Column(type="string", name="name")
     */
    public $name;

    /**
     * @Column(type="integer", name="main")
     */
    public $main;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Manufacture
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Manufacture
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMain()
    {
        return $this->main;
    }

    /**
     * @param mixed $main
     * @return Manufacture
     */
    public function setMain($main)
    {
        $this->main = $main;
        return $this;
    }
}