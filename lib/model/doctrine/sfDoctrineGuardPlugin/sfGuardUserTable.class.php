<?php
/**
 * Most of the functions were derived from the Partisan package
 */
class sfGuardUserTable extends PluginsfGuardUserTable
{
    
    public static function getQuery()
    {
        return Doctrine_Query::create()->from('sfGuardUser u');
    }
    
    public static function getOneByUsernameQuery($username, $isActive)
    {
        return self::getQuery()->where('u.username = ?', $username)->addWhere('u.is_active = ?', $isActive);
    }
    
    /**
     * Returns a User whos username is present in the sfGuardUser table. Optionally filters the Users according to is_active.
     *
     * Had to override normal behaviour to solve a bug in sfGuardAuth.
     *
     * @param string $username The username of the User
     * @param bool $isActive Defines if the user should be active or not.
     * @return Doctrine_Record The User record inside the database
     * @author Olmo Maldonado, <ibolmo@ucla.edu>
     * @package Partisan
     */
    
    public static function findOneByUsername($username, $isActive = true)
    {
        return self::getOneByUsernameQuery($username, $isActive)->fetchOne();
    }
    
    public static function getOneByUsernameAndPasswordQuery($username, $password, $isActive)
    {
        return self::getOneByUsernameQuery($username, $isActive)->andWhere('u.password = ?', $password);
    }
    
    public static function findOneByUsernameAndPassword($username, $password, $isActive = true)
    {
        return self::getOneByUsernameAndPasswordQuery($username, $password, $isActive)->fetchOne();
    }
    
    public static function findOneByEmailAddress($address)
    {
        $email = Doctrine::getTable('Email')->findOneByAddress($address);
        return $email ? $email->Profile->User : false;
    }
    
    public static function getOneByIdAndPasswordQuery($id, $password)
    {
        return self::getQuery()->andWhere('u.id = ?', $id)->andWhere('u.password = ?', $password);
    }
    
    public static function findOneByIdAndPassword($id, $password)
    {
        return self::getOneByIdAndPasswordQuery($id, $password)->fetchOne();
    }
    
}
