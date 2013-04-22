<?php
	class TestViewer extends MySectionViewer
	{
  		private static $count=0;
  		
		public function getCSSName() 
		{
				self::$count++;
				if (self::$count %2 ==0)
					return 'test';
				return 'comment test';
		}

		private function getTitle($titles,$src)
		{
			return $titles[$src];
		}
		
		public function convertSection($sec)
		{
			$t=$sec->ob;
			$titles=$sec->obTitles;
			//print_r($titles);
			$values=get_object_vars($t);
		
			$reflect = new ReflectionClass($t);
			$a = $reflect->getConstants();
			$fields=(array_values($a));
			
			$to=array_map(null,$fields,$values);
			//$fields=get_class_vars(get_class($t));//$class_name);
			//var_dump($to);
			
			echo "<div class='".$this->getCSSName()."'>";
			echo "<table class='customers'>\n";
			echo "<tr>";
  			echo "<th>Information</th>";
  			echo "<th></th>";
			echo "</tr>";
			$i=0;
			foreach($to as $value)
			{
				$i++;
				if ($i%2==0)
					echo "<tr>";
				else 
					echo "<tr class='alt'>";
					
				echo "<td>";				
				echo $this->getTitle($titles,$value[0]);
				echo "</td>\n";
				echo "<td class=\"says\">";				
				echo trim($value[1]);
				echo "</td>\n";
				echo "</tr>";
			} 
			echo "</table>\n";
			echo "</div>";
			
			$this->printTitle('Test Steps');

			echo "<div class='".$this->getCSSName()."'>";

			echo "<table class='customers'>\n";
			echo "<tr>";
  			echo "<th>Steps</th>";
  			echo "<th></th>";
			echo "</tr>";
			$tests=$sec->testItems;
			
			$i=1;
			foreach($tests as $value)
			{
				$class='';				
				if ($i %2==0 ) $class='alt';		
				echo "<tr class=\"$class\">";
				//step test
					echo "<td>";
						echo "Step ".$i;
					echo "</td>";
					echo "<td>";
						echo trim($value->desc);
					echo "</td>";
				echo "</tr><tr class=\"$class\">";
					echo "<td>";
						echo "Expected";
					echo "</td>";
					echo "<td>";
						echo trim($value->expected);
					echo "</td>";
				echo "</tr>";
				$i++;
			}
			echo "</table>\n";
			echo "</div>";
			
		} 
			
	}
?>
