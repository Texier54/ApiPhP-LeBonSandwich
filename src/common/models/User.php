<?php
/**
 * File:  Categorie.php
 * Creation Date: 09/11/2017
 * description:
 *
 * @author: canals
 */

namespace lbs\common\models;


/**
 * Class Categorie
 * @package catawish\models
 */
class User extends \Illuminate\Database\Eloquent\Model {

    protected $table = 'user';
    protected $primaryKey = 'id';
    public $timestamps = false;

}
