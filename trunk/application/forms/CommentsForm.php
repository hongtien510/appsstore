<?php

class Application_Form_CommentsForm extends Zend_Form 
{ 
   public function init()
    {
	
        // Set the method for the display form to POST
        $this->setMethod('post');
 
       
			
        $this->addElement('textarea', 'content', array(
            'label'      => 'content:',
			'rows' => 3, 
			'cols' => 30,
			'class' => 'content',
			'id'=>'content',
            'required'   => true,
     
        ));
		
				
		
		// Add the submit button
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Thêm',
        ));
 

	}
	
	


}
