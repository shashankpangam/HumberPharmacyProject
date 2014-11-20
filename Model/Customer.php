<?php
    class Customer{
        private $id;
        private $fname;
        private $lname;
        private $dob;
        private $address1;
        private $address2;
        private $city;
        private $zip;
        private $province;
        private $gender;
        private $email;
        private $username;
        private $password;
        private $lastsignin;
        
        public function __construct($id,$fname,$lname,$dob,$address1,$address2,$city,$zip,$province,$gender,$email,$username,$password,$lastsignin) {
            $this->id=$id;
            $this->fname=$fname;
            $this->lname=$lname;
            $this->dob=$dob;
            $this->address1=$address1;
            $this->address2=$address2;
            $this->city=$city;
            $this->zip=$zip;
            $this->province=$province;
            $this->email=$email;
            $this->gender=$gender;
            $this->username=$username;
            $this->password=$password;
            $this->lastsignin=$lastsignin;
        }
        
        public function getID()
        {
            return $this->id;
        }
        public function getFname()
        {
            return $this->fname;
        }
        public function setFname($fname){
            $this->fname=$fname;
        }
        public function getLname()
        {
            return $this->lname;
        }
        public function setLname($lname)
        {
            $this->lname=$lname;
        }
        public function getDOB()
        {
            return $this->dob;
        }
        public function setDOB($dob){
            $this->dob=$dob;
        }        
        public function getAddress1()
        {
            return $this->address1;
        }
        public function setAddress1($add1)
        {
            $this->address1=$add1;
        }
        public function getAddress2()
        {
            return $this->address2;
        }
        public function setAddress2($add2){
            $this->address2=$add2;
        }
        public function getCity()
        {
            return $this->city;
        }
        public function setCity($city)
        {
            $this->city=$city;
        }
        public function getProvince()
        {
            return $this->province;
        }
        public function setProvince($prov)
        {
            $this->province=$province;
        }
        public function getZip()
        {
            return $this->zip;
        }
        public function setZip($zip)
        {
            $this->zip=$zip;
        }
        public function getGender()
        {
            return $this->gender;
        }
        public function setGender($gender)
        {
            $this->gender=$gender;
        }
        public function getEmail()
        {
            return $this->email;
        }
        public function setEmail($email)
        {
            $this->email=$email;
        }       
        public function getUsername()
        {
            return $this->username;
        }
        public function setUsername($username)
        {
            $this->usename=$username;
        }
        public function getPassword()
        {
            return $this->password;
        }
        public function setPassword($password)
        {
            $this->password=$password;
        }
        public function getLastSign()
        {
            return $this->lastsignin;
        }
        public function setLastSignIn($last)
        {
            $this->lastsignin=$last;
        }      
    }
?>

