<?php

class PageRecord extends MRActiveRecord
{
        
   /**
     * Сохранение связанных данных - описаний аренд, после созранения самой аренды
     */
    public function saveTranslations($new = false) {
	foreach ($this->translations as $t) {
	    $t->row_id = $this->id;
	    if (!$new) {
		$t->isNewRecord = false;
	    }

	    $t->save();
	}
    }

}