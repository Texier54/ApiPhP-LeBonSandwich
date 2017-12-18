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
class Commande extends \Illuminate\Database\Eloquent\Model {

    protected $table = 'commande';
    protected $primaryKey = 'id';
    public $timestamps = false;

}
