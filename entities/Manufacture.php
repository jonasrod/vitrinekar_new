<?php
/**
 * Created by PhpStorm.
 * User: Jonas
 * Date: 25/01/2018
 * Time: 22:51
 */
namespace entities\Entitie;

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
    protected $id;

    /**
     * @Column(type="string", name="name")
     */
    protected $name;

    /**
     * @Column(type="integer", name="main")
     */
    protected $main;

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