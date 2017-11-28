<?php
/**
 * File:  Categorie.php
 * Creation Date: 09/11/2017
 * description:
 *
 * @author: canals
 */

namespace lbs\models;


/**
 * Class Categorie
 * @package catawish\models
 */
class Sandwich extends \Illuminate\Database\Eloquent\Model {

    protected $table = 'sandwich';
    protected $primaryKey = 'id';
    public $timestamps = false;

}
