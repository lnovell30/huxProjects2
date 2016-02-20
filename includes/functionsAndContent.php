<?php
    /**
     * getPostVariables - matches the fetching of Post Variables easy and abstract
     * returns : $postVariables - array of post variables from input form
     * notes : uses defaults when no post variables are defined
     **/
    function getPostVariables() {
        $defaultWordCount = 4;
        $defaultUseSymbols = 'no';
        $defaultUseNumbers = 'no';
        
        
        $postVariables = array();
        $postVariables['wordCount'] = isset($_POST['pWordCount']) ? $_POST['pWordCount'] : $defaultWordCount;
        $postVariables['useSymbols'] = isset($_POST['pUseSymbols']) ? $_POST['pUseSymbols'] : $defaultUseSymbols;
        $postVariables['useNumbers'] = isset($_POST['pUseNumbers']) ? $_POST['pUseNumbers'] : $defaultUseNumbers;
        
      
       
       return $postVariables; 
        
        
    }
    
    /**
     * validatePostVariables - matches the validateion of Post Variables easy and abstract
     * @param $postVariables - variables passed in by user or defaulted if user left empty
     * returns : array indicating which user response is invalid from input form
     *  
     **/
    function validatePostVariables($postVariables) {
        
        $postVariablesValidation = array();
        $postVariablesValidation['wordCount'] = intval($postVariables['wordCount']) > 0 && intval($postVariables['wordCount']) <= 4;
        $postVariablesValidation['useSymbols'] = ($postVariables['useSymbols'] == 'no' || $postVariables['useSymbols'] === 'on');
        $postVariablesValidation['useNumbers'] = ($postVariables['useNumbers'] == 'no' || $postVariables['useNumbers'] === 'on');
        
        return $postVariablesValidation;
    
        
    }
    function getPasswordForm() {
        
        
        $postVariables = getPostVariables();
        $validatedPostVariables = validatePostVariables($postVariables);
        
         var_dump($postVariables);
         var_dump($validatedPostVariables);
      
        
        $content = '
         
           <form action="" method="POST">
             <div class="outerContent">
             <div class="options"><legend>Options</legend<fieldlist>' . getUserGeneratedOptions($postVariables,$validatedPostVariables)
                 
              
             . '</fieldlist><br><hr></div>' .
             '<div class="mainContent"> <h2>Passwords</h2><h3><input type="submit"></h3> '
             
             . getBasicFields($postVariables) . 
             
             
             '</div>
              
           
            </div>
           </form>
        
        
        
        
        
        ';
        
        return $content;
        
    }
    function presentValidationMessage($postVariables,$validationVariables,$index) {
        $message  = "";
        
         switch ($index) {
            case 'wordCount' : if ($validationVariables[$index] === false) {
                                   $message = "<span class=\"errorMessage\">$postVariables[$index] is an invalid number, please enter a valid integer between 1 and 5</span>";     
                               }
            break;
            
         }
         
        return $message;
    }
    function getUserGeneratedOptions($generationVariables,$validatedVariables) {
        $content = "";
        
        
        $content .= '
             <ul class="unadornedlist">
             <li class="separated" ><label> How many Words do you want in your password?</label><input name="pWordCount" value="' . ($generationVariables['wordCount']) . '" size="2" type="text">' . presentValidationMessage($generationVariables,$validatedVariables,'wordCount') . '</li>
             <li class="separated" ><label> Include number in password ?</label><input name="pUseNumbers" type="checkbox" ' . ($generationVariables['useNumbers'] == 'on' ? "checked=\"checked\"" : "") . '></li>
             <li class="separated" ><label> Include special symbol (for example, @).?</label><input name="pUseSymbols" type="checkbox" ' . ($generationVariables['useSymbols'] == 'on' ? "checked=\"checked\"" : "") . '></li>
             </ul>
              
             
        ';
        
        return $content;
    }
    
    function getRandomWord() {
        return "Test";
    }
    function getBasicFields($generationVariables) {
        
        $content = "";
        
        
        
       
        $maxIterations = 20;
        
        for ($iterations = 1; $iterations <= $maxIterations; $iterations++) {
            
            $content .= "<div class=\"passwordInstance\"><label class=\"questionLabel label$iterations\">Password : $iterations</label>";
            $generatedPassword = "";
            
            for ($wordIndex = 0; $wordIndex < $generationVariables['wordCount']; $wordIndex++) {
                  $generatedPassword .= getRandomWord();    
            }
            $content .= "<input class=\"questioninput question$iterations\" type=\"text\" name=\"password$iterations\" value=\"$generatedPassword\" id=\"password$iterations\" /></div>";  
            
        };
        
        
        return $content;
        
    }
?>