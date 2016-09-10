<?php
/**
 * Created by PhpStorm.
 * User: Tharindu Piyumantha
 * Date: 6/15/2016
 * Time: 9:15 PM
 */
require_once("Sql.php");

class User {
    private  $_db, $_data, $_sessionName, $_isLoggedIn;
    public function __construct($user = null){
        $this->_db = DB::getInstance();
        $this->_sessionName = Config::get('session/session_name');

        if(!$user){
            if(Session::exists($this->_sessionName)){
                $user = Session::get($this->_sessionName);

                if($this->find($user)){
                    $this->_isLoggedIn = true;
                }else{

                }
            }
        }else{
            $this->find($user);
        }

    }

    public function create($fields = array()){
        if(!$this->_db->insert('clubmember', $fields)){
            throw new Exception('There was a problem');
        }
    }

    public function find($user = null){
        if($user){
            $field = (is_numeric($user)) ? 'memberID' : 'username';
            $data = $this->_db->get('clubmember', array($field, '=', $user));

            if($data->count()){
                $this->_data = $data->first();
                return true;
            }
        }
        return false;
    }
    public function login($username= null, $password= null){
        $user = $this->find($username);
        if($user){
            Session::put($this->_sessionName, $this->data()->memberID);
            Session::put("username", $this->data()->username);

            $str = str_replace(PHP_EOL, '', $this->data()->status);
            if(($this->data()->password === hash("sha256", $password)) && (($str == "registered") || ($str == "candidate"))){
                return true;
            }

        }

        return false;
    }
    public  function logout(){
        Session::delete($this->_sessionName);
        Session::delete("username");
    }

    public function data(){
        return $this->_data;
    }

    public function isLoggedIn(){
        return $this->_isLoggedIn;
    }
    public function hasPermission($key){
        $group = $this->_db->get('groups', array('id','=', $this->data()->user_group));
        if($group->count()){
            $permissions = json_decode($group->first()->permissions, true);
            if($permissions[$key]== true){
                return true;
            }
        }
        return false;
    }
    public function checksecurity(){
        $results = $this->_db->get('securityquestionanswer', array('memberID','=', $this->data()->memberID));
        return $results;
    }
}