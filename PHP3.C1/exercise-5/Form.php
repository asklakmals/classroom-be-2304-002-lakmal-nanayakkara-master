<?php
declare(strict_types=1);

class InputText
{
    public string $inputHtml;

    function __construct(string $name, string $label)
    {
        $this->inputHtml = '<label for="'. $name .'">'.$label .'</label>
                            <input type="text" id="'. $name .'" name="'. $name .'" />';
    }

    public function InputHtml():string
    {
        return $this->inputHtml;
    }
}
class Form
{
    public string $name;
    public string $method;
    public string $action;
    public string $submit;
    public array $input = [];

     function __construct(string $name, string $method, string $action)
     {
         $this->name = $name;
         $this->method = $method;
         $this->action = $action;
     }

     public function addInput(InputText $input):void
     {
         $this->input[] = $input->InputHtml();
     }

     public function setSubmitButtonLabel(string $label):void
     {
        $this->submit = '<br><input type="submit" value="'.$label.'">';
     }

     public function render():void
     {
         echo '<!DOCTYPE html>';
         echo '<html>';
         echo '<form name="' .$this->name.'" method="' .$this->method.'" action="' .$this->action.'">';
         echo implode('<br>', $this->input);
         echo $this->submit;
         echo '</form>';
         echo '</html>';
     }

}




$testForm = new Form('test-form', 'post', '/handle.php');
$testForm->addInput(new InputText('first_name', 'First Name'));
$testForm->addInput(new InputText('last_name', 'Last Name'));
$testForm->setSubmitButtonLabel('SUBMIT');
$testForm->render();



