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
class Item extends \Illuminate\Database\Eloquent\Model {

    protected $table = 'item';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function commande(){
    	return $this->belongsTo('lbs\common\models\Commande', 'id_commande');
    }

    public function taille(){
    	return $this->belongsTo('lbs\common\models\Taille', 'id_taille_sandwich');
    }

    public function sandwich(){
    	return $this->belongsTo('lbs\common\models\Sandwich', 'id_sandwich');
    }

}
