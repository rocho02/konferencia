<?php

/**
 * InviteForm class.
 */
class InviteForm extends CFormModel
{
    public $invite = array();

    /**
     * Declares the validation rules.
     */
    public function rules()
    {
        return array(
           // array('invite', 'required'),
            array('invite', 'isNotEmpty'),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels()
    {
        return array(
            'verifyCode'=>'Verification Code',
        );
    }
    
    public function isNotEmpty($attribute,$params){
        if( sizeof($this->invite) == 0)
                $this->addError('invite','You have to select users to invite!');
    }
}