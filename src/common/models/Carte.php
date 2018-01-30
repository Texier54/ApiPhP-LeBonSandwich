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
class Carte extends \Illuminate\Database\Eloquent\Model {

    protected $table = 'carte';
    protected $primaryKey = 'id';
    public $timestamps = false;

}
