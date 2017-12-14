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
class Sandwich extends \Illuminate\Database\Eloquent\Model {

    protected $table = 'sandwich';
    protected $primaryKey = 'id';
    public $timestamps = false;


	public function categories() {
	       return $this->belongsToMany('\lbs\common\models\Categorie', 'sand2cat', 'sand_id', 'cat_id');

	       /* 'Clubs'          : le nom de la classe du model lié */
	       /* 'usagers_clubs ' : le nom de la table pivot */

	       /* 'usagers_id'     : la clé étrangère de ce modèle dans la table pivot */
	       /* 'club_id'        : la clé étrangère du modèle lié dans la table pivot */
	}

}
