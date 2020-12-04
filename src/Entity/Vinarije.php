<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VinarijeRepository")
 */
class Vinarije
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="text", length=200)
     */
    private $ime;
    /**
     * @ORM\Column(type="text", length=200)
     */
    private $slug;
    /**
     * @ORM\Column(type="text")
     */
    private $slika;
    /**
     * @ORM\Column(type="text")
     */
    private $opis;
    /**
     * @ORM\Column(type="text")
     */
    private $adresa;
    /**
     * @ORM\Column(type="text")
     */
    private $tel;
    /**
     * @ORM\Column(type="text")
     */
    private $email;
     /**
     * @ORM\Column(type="text")
     */
    private $sajt;
    /**
     * @ORM\Column(type="text")
     */
    private $facebook;
     /**
     * @ORM\Column(type="text")
     */
    private $instagram;



    public function getId(): ?int
    {
        return $this->id;
    }

    

    public function getIme() {
        return $this->ime;
    }
    
    public function setIme($ime) {
        $this->ime = $ime;
    }


    public function getSlug() {
        return $this->slug;
    }
    
    public function setSlug($slug) {
        $this->slug = $slug;
    }
    
    public function getSlika() {
        return $this->slika;
    }
    
    public function setSlika($slika) {
        $this->slika = $slika;
    }

    public function getOpis() {
        return $this->opis;
    }
    
    public function setOpis($opis) {
        $this->opis = $opis;
    }

    

    public function getAdresa() {
        return $this->adresa;
    }
    
    public function setAdresa($adresa) {
        $this->adresa = $adresa;
    }


    public function getTel() {
        return $this->tel;
    }
    
    public function setTel($tel) {
        $this->tel = $tel;
    }

    public function getEmail() {
        return $this->email;
    }
    
    public function setEmail($email) {
        $this->email = $email;
    }

    public function getSajt() {
        return $this->sajt;
    }
    
    public function setSajt($sajt) {
        $this->sajt = $sajt;
    }

    

    public function getFacebook() {
        return $this->facebook;
    }
    
    public function setFacebook($facebook) {
        $this->facebook = $facebook;
    }

   

    public function getInstagram() {
        return $this->instagram;
    }
    
    public function setInstagram($instagram) {
        $this->instagram = $instagram;
    }
}
