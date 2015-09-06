<?php
/**
 * XLoginForm class file.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

/**
 * XLoginForm represents a form model for collecting user login information.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @version $Id: $
 */
class XLoginForm extends CFormModel
{
	/**
	 * @var string username input
	 */
	public $email;
	/**
	 * @var string password input
	 */
	public $password;
	/**
	 * @var boolean whether to remember the login for the next time
	 */
	public $rememberMe;

	/**
	 * Returns the validation rules of the model.
	 * @return array validation rules
	 */
	public function rules()
	{
		return array(
			// username and password are both required
		    	array('email', 'required',
			    'message'=>Yii::t('default','message.wgt.Login.email.required')),
			array('password', 'required',
			    'message'=>Yii::t('default','message.wgt.Login.passwd.required')),
			array('rememberMe','numerical','integerOnly'=>true),

		);
	}
        	public function attributeLabels()
	{
		return array(
				'email'=>Yii::t('default','wgt.XLoginForm.email'),
				'password'=>Yii::t('default','wgt.XLoginForm.password'),
				'rememberMe'=>Yii::t('default','wgt.XLoginForm.rememberMe')
		);  
	}
}
