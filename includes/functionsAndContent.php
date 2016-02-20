<?php
    function getPasswordForm() {
        
        $content = '
        
           <form action="" method="POST">
             <div class="outerContent">
             <div class="mainContent"> '
             
             . getBasicFields() . 
             
             
             '</div>
              <div class="options">' . getUserGeneratedOptions()
                 
              
             . '</div>
           
            </div>
           </form>
        
        
        
        
        
        ';
        
        return $content;
        
    }
    
    function getUserGeneratedOptions() {
        $content = "";
        
        $content .= '
             <label> How many Words do you want in your password?</label><input name="pWordCount" type="text">
             <label> Include number in password ?</label><input name="pIncludeNumbers" type="checkbox">
             <label> Include special symbol (for example, @).?</label><input name="pIncludeSpecialCharacters" type="checkbox">
              
             
        ';
        
        return $content;
    }
    function getBasicFields() {
        
        $content = "";
        
       
        $maxIterations = 20;
        
        for ($iterations = 1; $iterations <= $maxIterations; $iterations++) {
            
            $content .= "<div class=\"passwordInstance\"><label class=\"questionLabel label$iterations\">Password : $iterations</label><input class=\"questioninput question$iterations\" type=\"text\" name=\"password$iterations\" id=\"password$iterations\" /></div>";  
            
        };
        
        
        return $content;
        
    }
?>