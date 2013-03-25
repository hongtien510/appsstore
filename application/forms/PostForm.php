<?php

class Application_Form_PostForm extends Zend_Form 
{ 
   public function init()
    {
	
        // Set the method for the display form to POST
        $this->setMethod('post');
 
        $this->addElement('text', 'post_author', array(
            'label'      => 'post_author:',
			'class' => 'post_author',
			'id'=>'post_author',
            'required'   => true,
			'value' => "1",
			// 'onSubmit' => 'validate(this)',
     
        ));
			
        $this->addElement('textarea', 'post_content', array(
            'label'      => 'post_content:',
			'rows' => 3, 
			'cols' => 30,
			'class' => 'post_content',
			'id'=>'post_content',
            'required'   => true,
     
        ));
		
		$this->addElement('text', 'post_title', array(
            'label'      => 'post_title:',
			'class' => 'post_title',
			'id'=>'post_title',
            'required'   => true,
     
        ));
		
		$this->addElement('text', 'post_category', array(
            'label'      => 'post_category:',
			'class' => 'post_category',
			'id'=>'post_category',
            'required'   => true,
     
        ));
		
		
		
		// Add the submit button
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Thêm',
        ));
 

	}
	
	


}
