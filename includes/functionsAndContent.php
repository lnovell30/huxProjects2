<?php
    /**
     * getPostVariables - separates the fetching of $_POST Variables from other parts of program.
     * returns : $postVariables - array of post variables from input form
     * notes : uses defaults when no post variables are defined
     **/
    function getPostVariables() {
        $defaultWordCount = 4;
        $defaultuseSymbol = 'no';
        $defaultuseNumber = 'no';
        $defaultNumberPlacement = "front";
        $defaultTotalNumbers = 1;
        $defaultTotalSymbols = 1;
        
        
        $postVariables = array();
        $postVariables['wordCount'] = isset($_POST['pWordCount']) ? $_POST['pWordCount'] : $defaultWordCount;
        $postVariables['useSymbol'] = isset($_POST['puseSymbol']) ? $_POST['puseSymbol'] : $defaultuseSymbol;
        $postVariables['useNumber'] = isset($_POST['puseNumber']) ? $_POST['puseNumber'] : $defaultuseNumber;
        $postVariables['numberPlacement'] = isset($_POST['pNumberPlacement']) ? $_POST['pNumberPlacement'] : $defaultNumberPlacement;
        $postVariables['symbolPlacement'] = isset($_POST['pSymbolPlacement']) ? $_POST['pSymbolPlacement'] : $defaultNumberPlacement;
        $postVariables['totalNumbers'] = isset($_POST['pTotalNumbers']) ? $_POST['pTotalNumbers'] : $defaultTotalNumbers;
        $postVariables['totalSymbols'] = isset($_POST['pTotalSymbols']) ? $_POST['pTotalSymbols'] : $defaultTotalSymbols;
       
        
      
       
       return $postVariables; 
        
        
    }
    
    /**
     * validatePostVariables - achieves the validation of Post Variables,encapsulating the logic
     * @param $postVariables - variables passed in by user or defaulted if user left empty
     * returns : array indicating which user response is invalid from input form
     *  
     **/
    function validatePostVariables($postVariables) {
        
        $postVariablesValidation = array();
        $postVariablesValidation['wordCount'] = intval($postVariables['wordCount']) > 0 && intval($postVariables['wordCount']) <= 4;
        $postVariablesValidation['useSymbol'] = ($postVariables['useSymbol'] == 'no' || $postVariables['useSymbol'] === 'on');
        $postVariablesValidation['useNumber'] = ($postVariables['useNumber'] == 'no' || $postVariables['useNumber'] === 'on');
        $postVariablesValidation['totalNumbers'] = intval($postVariables['totalNumbers']) > 0 && intval($postVariables['totalNumbers']) <= 5;
        $postVariablesValidation['totalSymbols'] = intval($postVariables['totalSymbols']) > 0 && intval($postVariables['totalSymbols']) <= 5;
        return $postVariablesValidation;
    
        
    }
    
    /**
     * getPasswordForm - Serves as the main entry point to file, calling functions that get variables, validates variables and pulls content based on rules
     * @param $postVariables - variables passed in by user or defaulted if user left empty
     * returns : array indicating which user response is invalid from input form
     *  
     **/
    function getPasswordForm() {
        
        
        $postVariables = getPostVariables();
        $validatedPostVariables = validatePostVariables($postVariables);
        
        
        $content = '
         
             <form action="" method="POST">
                <div class="outerContent">
                    <div class="headerArea">
                      <h2>Novell\'s Slick Password Generator </h2>
                    </div>
                    <div class="options"><legend>Generation Options</legend>
                        <fieldset>'
                    
                    . getUserGeneratedOptions($postVariables,$validatedPostVariables) .
                     
                  
                        '</fieldset>
                        <br>
                        <hr>
                  </div>' .
                '<div class="mainContent">
                       <h2 class="sectiontitle">Generated Passwords</h2>
                       <h3><input type="submit"></h3> '
             
                    . getGeneratedPasswordFields($postVariables,$validatedPostVariables) . 
             
           
              
           
                '</div>
           </form>
    
        ';
        
        return $content;
        
    }
      /**
     * presentValidationMessage - returns validation messages based on validation variables
     * @param $postVariables - variables passed in by user or defaulted if user left empty
     * @param $validationVariables - validate variables based on user variables
     * @param $index - common index between $postVariables and $validationVariables, used to make rules easier to interpret
     * @return : array indicating which user response is invalid from input form
     *  
     **/
    function presentValidationMessage($postVariables,$validationVariables,$index) {
        $message  = "";
        
         switch ($index) {
            case 'wordCount' : if ($validationVariables[$index] === false) {
                                   $message = "<span id=\"errorMessage$index\" class=\"errorMessage\">$postVariables[$index] is an invalid number, please enter a valid integer between 1 and 5</span>";     
                               }
            break;
        case 'totalNumbers' : if ($validationVariables[$index] === false) {
                                   $message = "<span id=\"errorMessage$index\" class=\"errorMessage\">$postVariables[$index] is an invalid number, please enter a valid integer between 1 and 5</span>";     
                               }
            break;
        case 'totalSymbols' : if ($validationVariables[$index] === false) {
                                   $message = "<span id=\"errorMessage$index\" class=\"errorMessage\">$postVariables[$index] is an invalid number, please enter a valid integer between 1 and 5</span>";     
                               }
            break;
            
         }
         
        return $message;
    }
    
     /**
     * isOptionSelected - helper function to determine if an html option needs to be selected based on input variables
     * @param $variable - variable to compare
     * @param $comparison - the object/value used to compare against  $variable
     * @return :html - option text indicating if option is selected
     *  
     **/
    function isOptionSelected($variable, $comparison) {
        if ($variable == $comparison) {
            return " selected ";
        }
        return "";
    }
    
    
    
        /**
     * getRandomSymbol - helper function that fetches random symbol from array of possible symbols
     * @param $numberOfRandomSymbols - the number of random symbols to return
     * @return - one or more concatenated symbols
     ***/
    function getRandomSymbol($numberOfRandomSymbols=1) {
        
        $randomSymbols = array("@","#","$","%","^","&","*","(",")","!","+","-","<",">","~",);
       
        if (intval($numberOfRandomSymbols) == 1 ) {
            $output = $randomSymbols[array_rand($randomSymbols)];
            print "Symbol : " . $output;
            return $output;
        }
        // Otherwise continue to evaluate
        $keys = array_rand($randomSymbols,$numberOfRandomSymbols);
       
        $output = "";
        
    
        
        foreach ($keys as $key => $index ) {
            $output .= $randomSymbols[$index];
        }
        
        return $output;
    }
    
    
      /**
     * getRandomNumber - helper function that fetches random number 0..9
     * @param $numberOfRandomNumbers - the number of random numbers to return
     * @return - one or more concatenated numbers
     ***/
    function getRandomNumber($numberOfRandomNumbers=1) {
     $output = "";
     
     for ($count = 0 ; $count < $numberOfRandomNumbers; $count++)
        $output .= rand(0,9);
     
      return $output;
    
    }
    
     /**
     * getRandomWord - helper function that from the web, random words generated by the following website : 'http://randomword.setgetgo.com/get.php'
     * @param $numberOfRandomNumbers - the number of random numbers to return
     * @return - one or more concatenated numbers
     ***/
    function getRandomWord() {
        $content ="uninitialized";
        // Get cURL resource
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://randomword.setgetgo.com/get.php',
            CURLOPT_USERAGENT => 'Password Generation Agent'
        ));
        // Populate Content Variable
        $content = curl_exec($curl);
        // Clear references
        curl_close($curl);
        return $content;
    }
    
     /**
     * getUserGeneratedOptions - helper function to determine if an html option needs to be selected based on input variables
     * @param $generationVariables - variables housing user-submitted input fields
     * @param $validatedVariables - validation variables reflecting accuracy of user submitted input fields
     * @return :html - Options chosen by the user, complete with validation.
     *  
     **/
    
    function getUserGeneratedOptions($generationVariables,$validatedVariables) {
        $content = "";
        
        
        $content .= '
             <ul class="unadornedlist">
             <li class="separated" ><label> How many Words do you want in your password?</label><input name="pWordCount"  id="pWordCount" value="' . ($generationVariables['wordCount']) . '" size="2" type="text">' . presentValidationMessage($generationVariables,$validatedVariables,'wordCount') . '</li>
             <li class="separated" ><label> Include number in password ?</label><input name="puseNumber" id="puseNumber" value="yes" type="checkbox" ' . ($generationVariables['useNumber'] == 'yes' ? "checked=\"checked\"" : "") . '></li>
             <li class="separated" ><label> How Many Numbers in password (1 - 5) ?</label><input name="pTotalNumbers" id="pTotalNumbers" value="'  . ($generationVariables['totalNumbers']) . '" size="2" type="text">' . presentValidationMessage($generationVariables,$validatedVariables,'totalNumbers') . '</li>
             <li class="separated" ><label> Number Placement ?</label><select name="pNumberPlacement" id="pNumberPlacement">' .
               '<option value="front"' . isOptionSelected($generationVariables['numberPlacement'],'front') . '>Front</front>' . 
               '<option value="middle"' . isOptionSelected($generationVariables['numberPlacement'],'middle') . '>Middle</option>' . 
               '<option value="rear"' . isOptionSelected($generationVariables['numberPlacement'],'rear') . '>Rear</option>' . '</select>' .
             '</li>
             <li class="separated" ><label> Include special symbol (for example, @).?</label><input name="puseSymbol"  value="yes" id="puseSymbol" type="checkbox" ' . ($generationVariables['useSymbol'] == 'yes' ? "checked=\"checked\"" : "") . '></li>
             <li class="separated" ><label> How Many Symbols in password (1 - 5)?</label><input name="pTotalSymbols" id="pTotalSymbols" value="'  . ($generationVariables['totalSymbols']) . '" size="2" type="text">' . presentValidationMessage($generationVariables,$validatedVariables,'totalSymbols') . '</li>
             <li class="separated" ><label> Symbol Placement ?</label><select name="pSymbolPlacement" id="pSymbolPlacement">' .
               '<option value="front"' . isOptionSelected($generationVariables['symbolPlacement'],'front') . '>Front</front>' .
               '<option value="middle"' . isOptionSelected($generationVariables['symbolPlacement'],'middle') . '>Middle</option>' .
               '<option value="rear"' . isOptionSelected($generationVariables['symbolPlacement'],'rear') . '>Rear</option>' . '</select>' .
             '</li>
             </ul>
              
             
        ';
        
        return $content;
    }

     /**
     * getGeneratedPasswordFields - primary function that generates the passwords used as the main objective of program
     * @param $generationVariables - variables housing user-submitted input fields
     * @param $validatedFields - validation variables reflecting accuracy of user submitted input fields
     * @return :html - Generated Passwords, based on all the parameters from user input 
     *  
     **/ 
    function getGeneratedPasswordFields($generationVariables,$validatedFields) {
        
        $content = "<div class=\"passwordMasterContainer\"";
        
        
        
       
        $maxIterations = 10;
        
       
        
        for ($iterations = 1; $iterations <= $maxIterations; $iterations++) {
            
            
             
            $content .= "<div class=\"passwordInstance\"><label class=\"questionLabel label$iterations\">Password # $iterations</label>";
                  
            
            $generatedPassword = "";
            
            if ($validatedFields['wordCount'] !== false && $validatedFields['totalSymbols'] !== false && $validatedFields['totalNumbers'] !== false) {
                    for ($wordIndex = 0; $wordIndex < $generationVariables['wordCount']; $wordIndex++) {
                          $generatedPassword .= getRandomWord();    
                    }
                    $generatedNumber = $generationVariables['useNumber'] == "yes" ? ("" . getRandomNumber($generationVariables['totalNumbers'])) : ("");
                    
                    if (strlen($generatedNumber) > 0) {
                      //  print "Generated Number = $generatedNumber";
                        switch ($generationVariables['numberPlacement']) {
                            case 'front' :
                                 $generatedPassword = $generatedNumber . $generatedPassword;
                                 break;
                            case 'rear' :
                                 $generatedPassword = $generatedPassword . $generatedNumber ;
                                 break;
                            case 'middle' :   $passwordLength = strlen($generatedPassword);
                                              $middlePosition = intval($passwordLength / 2);
                                              $generatedPassword = substr($generatedPassword,0,$middlePosition) . $generatedNumber . substr($generatedPassword,$middlePosition + 1);
                                              
                        }
                    }
                    
                    $generatedSymbol = $generationVariables['useSymbol'] == "yes" ? ("" . getRandomSymbol($generationVariables['totalSymbols'])) : ("");
                    
                    if (strlen($generatedSymbol) > 0) {
                        switch ($generationVariables['symbolPlacement']) {
                            case 'front' :
                                 $generatedPassword = $generatedSymbol . $generatedPassword;
                                 break;
                            case 'rear' :
                                 $generatedPassword = $generatedPassword . $generatedSymbol ;
                                 break;
                            case 'middle' :   $passwordLength = strlen($generatedPassword);
                                              $middlePosition = intval($passwordLength / 2);
                                              $generatedPassword = substr($generatedPassword,0,$middlePosition) . $generatedSymbol . substr($generatedPassword,$middlePosition + 1);
                                              
                        }
                    }
            
             }
            $content .= "<input class=\"questioninput question$iterations\" type=\"text\" name=\"password$iterations\" size=\"50\" value=\"$generatedPassword\" id=\"password$iterations\" /></div>";  
            
        };
        
        $content .= "</div>";
        return $content;
        
    }
?>