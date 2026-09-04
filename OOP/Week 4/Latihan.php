<?php

class Mahasiswa{
    private $name;

    public function setName($name){
        $this->name = $name;
    }

    private function getName(){
        return $this->name;
    }

    public function greeting(){
        return 'Hello, my name is ' . $this->getName();
    }
}

$mhs = new Mahasiswa();
$mhs->setName('Derriel Mulya Ramadhan');
echo $mhs->greeting();