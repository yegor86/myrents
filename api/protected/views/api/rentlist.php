<?php echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'?>
<?php echo '<advertisements>'?>
<?php foreach ($rents as $rent){
    echo '<advertisement>';
    echo "<action>edit</action>";
    echo "<id>$rent->id</id>";
    echo "<maininfo>
      <todo>". str_replace('todo.', '',  $rent->rent_todo->name)."</todo>
      <type>". str_replace('type.', '',  $rent->rent_type->name)."</type>
      <square>$rent->square</square>
      <floor>$rent->floor</floor>
      <rooms>$rent->rooms_count</rooms>
    </maininfo>";
    echo "<pricing>";
      if($rent->todo==1)
      echo "<day>$rent->price_day</day>
      <week>$rent->price_week</week>
      <month>$rent->price_month</month>";
      else echo"<price>$rent->price_day</price>";
      echo"<currency>".$rent->currency->short_name."</currency>
      <default>";
      switch ($rent->current_price){
	  case '1':echo 'day';break;
	  case '2':echo 'week';break;
	  case '3':echo 'month';break;
	  default:echo'day';
      }
      echo "</default>
    </pricing>";
      echo"<text>";
      foreach ($rent->descriptions as $description){
	  echo "<textpath>
	    <language>".$description->lang->language."</language>
	<title>$description->name</title>
	<description>$description->overview</description>
	<rules>$description->rules</rules>
	</textpath>";
      }
      echo"</text>";
      if($rent->adress){
      echo "<address>
	  <textLocation>".$rent->adress->name."</textLocation>
      <geopoint>
	<longitude>".$rent->adress->geox."</longitude>
	<latitude>".$rent->adress->geoy."</latitude>
      </geopoint>	   
    </address>";
      }
      echo "<amenities>";
      foreach($rent->amenities as $amenity){
	  echo '<amenity>'.str_replace('amenity.', '', $amenity->name).'</amenity>';
      }
    echo "</amenities>";
          echo "<neighbors>";
      foreach($rent->neighbors as $neighbor){
	  echo '<neighbor>'.str_replace('neighbor.', '', $neighbor->name).'</neighbor>';
      }
    echo "</neighbors>";
    echo "<photos>";
    foreach ($rent->photos as $photo){
	echo '<photo>'.$this->createAbsoluteUrl('/'). '/uploads/rentpic/'.$rent->id.'/' .$photo->file.'</photo>';
    }
    echo"</photos>";
    
    echo '</advertisement>';
}
?>
<?php echo '</advertisements>'?>