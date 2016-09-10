<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 6/5/2016
 * Time: 10:10 AM
 */
require_once("Sql.php");
class Member{
    private $name,$NIC,$dateOfBirth,$email,$homeAddress,$mobileNumber,
            $occupation,$clubPost,$profileImage,$status,$dateOfJoin,$username,$password;
    public function __construct() {
        $argv = func_get_args();
        switch( func_num_args() ) {
            case 0:
                self::__construct1();
                break;
            case 13:
                self::__construct2( $argv[0], $argv[1], $argv[2], $argv[3],$argv[4],$argv[5],$argv[6],$argv[7],$argv[8],$argv[9],$argv[10],$argv[11],$argv[12]);
        }
    }
    public function __construct1()
    {
        $this->name = "";
        $this->NIC = "";
        $this->dateOfBirth = "";
        $this->email = "";
        $this->homeAddress = "";
        $this->mobileNumber = "";
        $this->occupation = "";
        $this->clubPost = "";
        $this->profileImage = "";
        $this->status = "";
        $this->dateOfJoin = "";
        $this->username = "";
        $this->password = "";
    }
    public function __construct2($name,$NIC,$dateOfBirth,$email,$homeAddress,$mobileNumber,$occupation,$clubPost,$profileImage,$status,$dateOfJoin,$username,$password){
        $this->name = $name;
        $this->NIC = $NIC;
        $this->dateOfBirth = $dateOfBirth;
        $this->email = $email;
        $this->homeAddress = $homeAddress;
        $this->mobileNumber = $mobileNumber;
        $this->occupation = $occupation;
        $this->clubPost = $clubPost;
        $this->profileImage = $profileImage;
        $this->status = $status;
        $this->dateOfJoin = $dateOfJoin;
        $this->username = $username;
        $this->password = $password;
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
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getNIC()
    {
        return $this->NIC;
    }

    /**
     * @param mixed $NIC
     */
    public function setNIC($NIC)
    {
        $this->NIC = $NIC;
    }

    /**
     * @return mixed
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * @param mixed $dateOfBirth
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getHomeAddress()
    {
        return $this->homeAddress;
    }

    /**
     * @param mixed $homeAddress
     */
    public function setHomeAddress($homeAddress)
    {
        $this->homeAddress = $homeAddress;
    }

    /**
     * @return mixed
     */
    public function getMobileNumber()
    {
        return $this->mobileNumber;
    }

    /**
     * @param mixed $mobileNumber
     */
    public function setMobileNumber($mobileNumber)
    {
        $this->mobileNumber = $mobileNumber;
    }

    /**
     * @return mixed
     */
    public function getOccupation()
    {
        return $this->occupation;
    }

    /**
     * @param mixed $occupation
     */
    public function setOccupation($occupation)
    {
        $this->occupation = $occupation;
    }

    /**
     * @return mixed
     */
    public function getClubPost()
    {
        return $this->clubPost;
    }

    /**
     * @param mixed $clubPost
     */
    public function setClubPost($clubPost)
    {
        $this->clubPost = $clubPost;
    }

    /**
     * @return mixed
     */
    public function getProfileImage()
    {
        return $this->profileImage;
    }

    /**
     * @param mixed $profileImage
     */
    public function setProfileImage($profileImage)
    {
        $this->profileImage = $profileImage;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getDateOfJoin()
    {
        return $this->dateOfJoin;
    }

    /**
     * @param mixed $dateOfJoin
     */
    public function setDateOfJoin($dateOfJoin)
    {
        $this->dateOfJoin = $dateOfJoin;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function insertIntoDB($connection){
        (new Sql)->createNewMember($connection,$this->getName(),$this->getNIC(),$this->getDateOfBirth(),
            $this->getEmail(),$this->getHomeAddress(),$this->getMobileNumber(),$this->getOccupation(),
            $this->getClubPost(),$this->getProfileImage(),$this->getStatus(),$this->getDateOfJoin(),
            $this->getUsername(),$this->getPassword());
    }
    public function loadMembersForElection($connection){
        $minQualifiedMembers = (new Sql)->selectMembersForElection($connection);
        return $minQualifiedMembers;
    }
    public function changeMemStatus($connection,$status,$memberID){
        (new Sql)->changeMemberStatus($connection,$status,$memberID);
    }
    public function addMemberElectionDetails($connection,$memberID,$electID,$votingStatus){
        (new Sql)->insertIntoMemberElectionDetails($connection,$memberID,$electID,$votingStatus);
    }
    public function selectEmailAndMobile($connection,$memberID){
        $emailMobileQuery = (new Sql)->selectMemberEmailAndMobile($connection,$memberID);
        return $emailMobileQuery;
    }
    public function deleteVoters($connection,$electID,$memberID){
        (new Sql)->deleteVoterRow($connection,$electID,$memberID);
    }
    public function getRegMemNotInElect($connection,$electID){
        $registeredNotInElecMem = (new Sql)->getRegisteredMembersNotInElection($connection,$electID);
        return $registeredNotInElecMem;
    }
    public function getMembersNotCandidates($connection,$electionID){
        $membersNotCandidates = (new Sql)->getCandidatesNotInElection($connection,$electionID);
        return $membersNotCandidates;
    }
    public function getMemberName($connection,$memberID){
        $membersName = (new Sql)->getMemberName($connection,$memberID);
        return $membersName;
    }
    public  function changeStatusToCandidate($connection,$memberID){
        (new Sql)->changeStatusToCandidate($connection,$memberID);
    }
    public  function haveElections($connection,$memberID){
        (new Sql)->loadHaveElectionsWithDetails($connection,$memberID);
    }
}

?>