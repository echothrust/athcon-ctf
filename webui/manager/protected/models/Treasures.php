<?php

/**
 * This is the model class for table "treasures".
 *
 * The followings are the available columns in table 'treasures':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $points
 * @property string $category
 * @property string $csum
 * @property integer $appears
 * @property string $effects
 *
 * The followings are the available model relations:
 * @property UsersTreasures[] $usersTreasures
 */
class Treasures extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Treasures the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'treasures';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('appears', 'numerical', 'integerOnly'=>true),
      array('name', 'length', 'max'=>255),
      array('pubname', 'length', 'max'=>255),
      array('code', 'length', 'max'=>250),
			array('points', 'length', 'max'=>10),
			array('category', 'length', 'max'=>6),
			array('csum', 'length', 'max'=>128),
			array('effects', 'length', 'max'=>8),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, pubname,description, points, category, csum, appears, effects, code', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'usersTreasures' => array(self::HAS_MANY, 'UsersTreasures', 'treasures_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
            'name' => 'Name',
            'pubname' => 'Public Name',
			'description' => 'Description',
			'points' => 'Points',
			'category' => 'Category',
			'csum' => 'checksum of treasure file',
			'appears' => 'Appears (Times)',
      'effects' => 'Effects',
      'effects' => 'Claim Code',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('pubname',$this->pubname,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('points',$this->points,true);
		$criteria->compare('category',$this->category,true);
		$criteria->compare('csum',$this->csum,true);
		$criteria->compare('appears',$this->appears);
    $criteria->compare('effects',$this->effects,true);
    $criteria->compare('code',$this->code,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
  public static function randHASH()
  {
    $result = "";
    $charPool = '0123456789abcdefghijklmnopqrstuvwxyz';
    for($p = 0; $p<15; $p++)
    $result .= $charPool[mt_rand(0,strlen($charPool)-1)];
    return sha1(md5(sha1($result.time())));
  }

  public static function enumItem($model,$attribute)
  {
       $attr=$attribute;
      //self::resolveName($model,$attr);
       preg_match('/\((.*)\)/',$model->tableSchema->columns[$attr]->dbType,$matches);
            foreach(explode(',', $matches[1]) as $value)
            {
                    $value=str_replace("'",null,$value);
                    $values[$value]=Yii::t('enumItem',$value);
            }
            
            return $values;
    }       

}