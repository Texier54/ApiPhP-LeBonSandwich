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
class Categorie extends \Illuminate\Database\Eloquent\Model {

    protected $table = 'categorie';
    protected $primaryKey = 'id';
    public $timestamps = false;


	public function sandwichs() {
	       return $this->belongsToMany('\lbs\common\models\Sandwich', 'sand2cat', 'cat_id', 'sand_id');

	       /* 'Clubs'          : le nom de la classe du model lié */
	       /* 'usagers_clubs ' : le nom de la table pivot */

	       /* 'usagers_id'     : la clé étrangère de ce modèle dans la table pivot */
	       /* 'club_id'        : la clé étrangère du modèle lié dans la table pivot */
	}

}
