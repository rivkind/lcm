<?php

namespace app\components;
use Edvlerblog\Adldap2\model\UserDbLdap;

/**
 * Created by PhpStorm.
 * User: Alexey.Rivkind
 * Date: 10.06.2018
 * Time: 0:18
 */

class UserLdap extends UserDbLdap
{

    private $individualSyncOptions = null;

    public static function findByUsername($username) {

        if(static::getExtensionOptions('ENABLE_YII2_PROFILING') == true) {
            Yii::beginProfile('findByUsername', static::YII2_PROFILE_NAME . 'findByUsername');
        }

        $userObjectDb = static::findOne(['username' => $username]);



        if($userObjectDb == null){
            $userObjectGuid = new static();
            $userObjectGuid->username = $username;
            $ldapUserGuid = $userObjectGuid->queryLdapUserObject();
            if($ldapUserGuid != null){
                // если не нулл то обновить фамилию
                $userObjectDb = static::findOne(['guid' => $ldapUserGuid->getConvertedGuid()]);
                $userObjectDb->username = $username;
                $userObjectDb->save();
            }
        }else{
            $ldapUser = $userObjectDb->queryLdapUserObject();
            $guid = $ldapUser->getConvertedGuid();
            if($ldapUser != null && $ldapUser->getConvertedGuid() != $userObjectDb->guid){

                $userObjectDb = null;
            }
        }



        //Create user if not found in db
        if ($userObjectDb == null) {

            //Just create to get synchronisation options
            $userObjectDb = new static();

            if(static::getSyncOptions('ON_LOGIN_CREATE_USER', $userObjectDb->individualSyncOptions) == true) {
                $userObjectDb = static::createNewUser($username);
            } else {
                $userObjectDb = null;
            }
        } else {

            //Refresh group assignments of user if found in database
            if (static::getSyncOptions('ON_LOGIN_REFRESH_GROUP_ASSIGNMENTS', $userObjectDb->individualSyncOptions) == true) {
                $userObjectDb->updateGroupAssignment();
            }
            //Refresh account status of user if found in database
            if (static::getSyncOptions('ON_LOGIN_REFRESH_LDAP_ACCOUNT_STATUS', $userObjectDb->individualSyncOptions) == true &&
                static::getSyncOptions('ON_REQUEST_REFRESH_LDAP_ACCOUNT_STATUS', $userObjectDb->individualSyncOptions) == false)
            {
                $userObjectDb->updateAccountStatus();
            }
        }

        $checkedUserObjectDB = static::checkAllowedToLogin($userObjectDb);
        if(static::getExtensionOptions('ENABLE_YII2_PROFILING') == true) {
            Yii::endProfile('findByUsername', static::YII2_PROFILE_NAME . 'findByUsername');
        }
        return $checkedUserObjectDB;
    }

    public static function createNewUser($username,$individualGroupAssignmentOptions = null) {
        if(static::getExtensionOptions('ENABLE_YII2_PROFILING') == true) {
            Yii::beginProfile('createNewUser', static::YII2_PROFILE_NAME . 'createNewUser');
        }

        $userObjectDb = new static();

        //Username has to be set before a LDAP query
        $userObjectDb->username = $username;
        $userObjectDb->setIndividualGroupAssignmentOptions($individualGroupAssignmentOptions);

        //Check if user exists in LDAP.
        $ll = $userObjectDb->queryLdapUserObject();
        if($ll == null) {
            $userObjectDb = null;
        } else {

            $userObjectDb->guid = $ll->getConvertedGuid();
            $roles = $userObjectDb->updateGroupAssignment();

            //When a group is needed for login and no roles are assigned to user, don't create one
            if (count($roles) > 0 || static::getGroupAssigmentOptions('LOGIN_POSSIBLE_WITH_ROLE_ASSIGNED_MATCHING_REGEX',$userObjectDb->individualGroupAssignmentOptions) == null) {


                $userObjectDb->generateAuthKey();
                $userObjectDb->updateAccountStatus();
                $userObjectDb->save();
            } else {
                $userObjectDb = null;
            }
        }

        if(static::getExtensionOptions('ENABLE_YII2_PROFILING') == true) {
            Yii::endProfile('createNewUser', static::YII2_PROFILE_NAME . 'createNewUser');
        }
        return $userObjectDb;
    }

}