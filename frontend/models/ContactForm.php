<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $email;
    public $phone;
    public $body;
    public $verifyCode;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // email and  body are required
            ['body', 'required'],
            [ 'email', 'required', 'when' => function($model) { return !$model->phone; },
                'whenClient' => 'function(attribute, value){
                    var formId = attribute.$form.attr("id").replace("-", "");
                    return $(attribute.$form).find("#"+formId+"-phone").val() == "" && value == "";
                }',
                'message' => 'Телефон или адрес электронной почты обязательны',
            ],
            [ 'phone', 'required', 'when' => function($model) { return !$model->email; },
                'whenClient' => 'function(attribute, value){
                    var formId = attribute.$form.attr("id").replace("-", "");
                    return $(attribute.$form).find("#"+formId+"-email").val() == "" && value == "";
                }',
                'message' => 'Телефон или адрес электронной почты обязательны',
            ],
            // phone has to be a valid phone number
            [ 'phone' , 'match', 'pattern' => '/^[0-9 +\-()]+$/i' ],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'phone' => 'Телефон',
            'body' => 'Текст',
            'verifyCode' => 'Captcha',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose('requestProduct', [
            'contactEmail' => $this->email,
            'contactPhone' => $this->phone,
            'body' => $this->body,
        ])
            ->setTo($email)
//            ->setFrom([$this->email => $this->name])
            ->setFrom('request-system@himsale.ru')
            ->setSubject("Online-заявка")
            ->setTextBody($this->body)
            ->send();
    }



}
