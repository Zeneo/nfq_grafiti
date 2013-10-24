<?php

class TranslatesController extends AppController {

    public function index() {
    }

    public function admin_index($lang = null) {
        $this->loadModel('Language');
		if(!empty($lang)){
			$locale = $this->Language->get3LetterValue($lang);
		}else{
			$lang = $this->Language->getDefaultSite();
			$locale = $this->Language->get3LetterValue($lang);
		}
	
		//$locale = Configure::read('Config.language');
		$dir = ROOT."/app/Locale/".$locale;
		if(!empty($this->request->data)){
			if(isset($this->request->data['Change'])){
				if($this->request->data['Change']['language']){
					$this->redirect(array($this->request->data['Change']['language']));
				}else{
					$this->redirect($this->referer());
				}
			}
			if(isset($this->request->data['Translate'])){
				if(!file_exists($dir)){
					mkdir($dir);
				}
				if(!file_exists($dir."/LC_MESSAGES")){
					mkdir($dir."/LC_MESSAGES");
				}
				$this->Translate->SaveData($this->request->data);
				$this->redirect($this->referer());
			}
		}

		$langDefaultFile = ROOT."/app/Locale/".$locale."/LC_MESSAGES/default.po";
		$localeDefaultFile = ROOT."/app/Locale/default.pot";

		$return = $this->Translate->Compare($this->Translate->getArray($localeDefaultFile), $this->Translate->getArray($langDefaultFile));
		$languageArray = $this->Translate->getLanguages();
		$this->set("langFile", $langDefaultFile);
		$this->set("languageArray", $languageArray);
		$this->set("currentLanguage", $lang);
		$this->set("array", $return);
    }

}

?>
