<?php

/**
 * This is the model class for table "tcpdump".
 *
 * The followings are the available columns in table 'tcpdump':
 * @property string $id
 * @property string $srchw
 * @property integer $size
 * @property string $proto
 * @property string $srcip
 * @property string $dstip
 * @property integer $dstport
 */
class Tcpdump extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tcpdump the static model class
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
		return 'tcpdump';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('srchw, size', 'required'),
			array('size, dstport', 'numerical', 'integerOnly'=>true),
			array('srchw', 'length', 'max'=>17),
			array('proto', 'length', 'max'=>4),
			array('srcip, dstip', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, srchw, size, proto, srcip, dstip, dstport', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'srchw' => 'Srchw',
			'size' => 'Size',
			'proto' => 'Proto',
			'srcip' => 'Srcip',
			'dstip' => 'Dstip',
			'dstport' => 'Dstport',
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
    $criteria->select='id,srchw,size,proto,inet_ntoa(srcip) srcip,inet_ntoa(dstip) dstip,dstport';
		$criteria->compare('id',$this->id,true);
		$criteria->compare('srchw',$this->srchw,true);
		$criteria->compare('size',$this->size);
		$criteria->compare('proto',$this->proto,true);
		$criteria->compare('inet_ntoa(srcip)',$this->srcip,true);
		$criteria->compare('inet_ntoa(dstip)',$this->dstip,true);
		$criteria->compare('dstport',$this->dstport);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}