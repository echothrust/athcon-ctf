<?php

/**
 * This is the model class for table "vuln".
 *
 * The followings are the available columns in table 'vuln':
 * @property integer $id
 * @property integer $users_id
 * @property string $subject
 * @property string $server
 * @property string $message
 * @property string $ts
 *
 * The followings are the available model relations:
 * @property Users $users
 */
class Vuln extends CActiveRecord
{
    public $treasure_id;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Vuln the static model class
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
		return 'vuln';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('users_id, subject, server', 'required'),
			array('users_id, treasure_id', 'numerical', 'integerOnly'=>true),
      array('status', 'length', 'max'=>255),
      array('subject, server', 'length', 'max'=>255),
			array('message', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, users_id, status,subject, server, message', 'safe', 'on'=>'search'),
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
			'users' => array(self::BELONGS_TO, 'Users', 'users_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'users_id' => 'Users',
			'subject' => 'Subject',
			'server' => 'Server',
            'message' => 'Message',
            'status' => 'Status',
            'treasure_id' => 'Extra Achievement for the Report',
			'ts' => 'Ts',
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
		$criteria->compare('users_id',$this->users_id);
        $criteria->compare('subject',$this->subject,true);
        $criteria->compare('status',$this->status,true);
		$criteria->compare('server',$this->server,true);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('ts',$this->ts,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
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

  public static function treasureItem()
  {
        $results = Yii::app()->db->createCommand("SELECT id,name FROM treasures WHERE category='hacker' and code='' and id!=61 and csum='VULNREPORT'")->queryAll();
        $ret=null;
        foreach($results as $res)
            $ret[$res['id']]=$res['name'];
        return $ret;
    } 
}