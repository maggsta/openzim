<?php

/**
 * BaseAnlage
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $kuerzel
 * @property integer $zeit
 * @property string $ziel
 * @property string $methode
 * @property string $material
 * @property string $tip
 * @property string $kurzinhalt
 * @property string $inhalt
 * @property string $rolle_tm
 * @property integer $stunde_id
 * @property integer $lnr
 * @property Stunde $Stunde
 * @property Doctrine_Collection $Bilder
 * @property Doctrine_Collection $Anhaenge
 * 
 * @method string              getKuerzel()    Returns the current record's "kuerzel" value
 * @method integer             getZeit()       Returns the current record's "zeit" value
 * @method string              getZiel()       Returns the current record's "ziel" value
 * @method string              getMethode()    Returns the current record's "methode" value
 * @method string              getMaterial()   Returns the current record's "material" value
 * @method string              getTip()        Returns the current record's "tip" value
 * @method string              getKurzinhalt() Returns the current record's "kurzinhalt" value
 * @method string              getInhalt()     Returns the current record's "inhalt" value
 * @method string              getRolleTm()    Returns the current record's "rolle_tm" value
 * @method integer             getStundeId()   Returns the current record's "stunde_id" value
 * @method integer             getLnr()        Returns the current record's "lnr" value
 * @method Stunde              getStunde()     Returns the current record's "Stunde" value
 * @method Doctrine_Collection getBilder()     Returns the current record's "Bilder" collection
 * @method Doctrine_Collection getAnhaenge()   Returns the current record's "Anhaenge" collection
 * @method Anlage              setKuerzel()    Sets the current record's "kuerzel" value
 * @method Anlage              setZeit()       Sets the current record's "zeit" value
 * @method Anlage              setZiel()       Sets the current record's "ziel" value
 * @method Anlage              setMethode()    Sets the current record's "methode" value
 * @method Anlage              setMaterial()   Sets the current record's "material" value
 * @method Anlage              setTip()        Sets the current record's "tip" value
 * @method Anlage              setKurzinhalt() Sets the current record's "kurzinhalt" value
 * @method Anlage              setInhalt()     Sets the current record's "inhalt" value
 * @method Anlage              setRolleTm()    Sets the current record's "rolle_tm" value
 * @method Anlage              setStundeId()   Sets the current record's "stunde_id" value
 * @method Anlage              setLnr()        Sets the current record's "lnr" value
 * @method Anlage              setStunde()     Sets the current record's "Stunde" value
 * @method Anlage              setBilder()     Sets the current record's "Bilder" collection
 * @method Anlage              setAnhaenge()   Sets the current record's "Anhaenge" collection
 * 
 * @package    openZIM
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseAnlage extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('anlage');
        $this->hasColumn('kuerzel', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('zeit', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ziel', 'string', 1000, array(
             'type' => 'string',
             'length' => 1000,
             ));
        $this->hasColumn('methode', 'string', 1000, array(
             'type' => 'string',
             'length' => 1000,
             ));
        $this->hasColumn('material', 'string', 1000, array(
             'type' => 'string',
             'length' => 1000,
             ));
        $this->hasColumn('tip', 'string', 1000, array(
             'type' => 'string',
             'length' => 1000,
             ));
        $this->hasColumn('kurzinhalt', 'string', 1000, array(
             'type' => 'string',
             'length' => 1000,
             ));
        $this->hasColumn('inhalt', 'string', 10000, array(
             'type' => 'string',
             'length' => 10000,
             ));
        $this->hasColumn('rolle_tm', 'string', 1000, array(
             'type' => 'string',
             'length' => 1000,
             ));
        $this->hasColumn('stunde_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('lnr', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));


        $this->index('kuerzel_lnr', array(
             'fields' => 
             array(
              0 => 'kuerzel',
              1 => 'lnr',
             ),
             'type' => 'unique',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Stunde', array(
             'local' => 'stunde_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('Bild as Bilder', array(
             'local' => 'id',
             'foreign' => 'anlage_id'));

        $this->hasMany('Anhang as Anhaenge', array(
             'local' => 'id',
             'foreign' => 'anlage_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}