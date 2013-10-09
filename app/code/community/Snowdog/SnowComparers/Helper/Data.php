<?php
/*
 *  Snowdog_SnowComparers_Helper_Data
 *
 *	Covers data conversion between the form (from the backend) and the process method in Model_Scheme
 *  @author Snowdog
 */
 
 /* Array format
	   array("header"=>"tag head","data"=>array("name of tag"=>"function/attribute to use","name of tag"=>array("attribute"=>"function"));
	   
	   String format
	   header
	   name of tag:function/attribute to use
	   name of tag:attribute=function,attribute2=function2
 */
class Snowdog_SnowComparers_Helper_Data extends Mage_Core_Helper_Abstract
{
	
	 
	public function toArray($input)
	{
		if ($input=='')
			return array();
		$input=trim($input); 
		
		$body=explode("\n",$input);	 //Dividing the input into Header and the Data
		$result['header']=$body[0];
		
		if (strrchr($body[0],'='))
		{
			$result['header']=explode(',',$body[0]);
			$params=array();
			for($i=1;$i<count($result['header']);$i++)
			{	
				$temporaryArray=explode('=',$result['header'][$i]);
				$params[$temporaryArray[0]]=$temporaryArray[1];
			}
			$result['header']=array($result['header'][0],$params);
		}
	
		for($i=1;$i<count($body);$i++)
		{
			$nameAndValue=explode(':',$body[$i]); //Dividing the data into tagname - value
			$name=$nameAndValue[0];
			$value=$nameAndValue[1];
			
			if(count(explode(',',$value))>1 || substr_count($value,'=')) //If the value is a attribute set...
			{
				$value=explode(',',$value); //Divide it once more 
				
				$temporaryValue=array();
				foreach ($value as $dividedValue)
				{
					$attributesCodes=explode('=',trim($dividedValue));
					$temporaryValue[$attributesCodes[0]]=$attributesCodes[1];
				}
					
				$value=$temporaryValue; //store the result
			
			}				
			else 
				$value=trim($value); //or if its just a simple function
			
			$result['data'][$name]=$value;
		}
		return $result;
	}
		
	
	public function toString($input)
	{
		//$input=unserialize($input);

		//$str=$input['header']."\n";
		//foreach ($input['data'] as $key=>$value)
		//{
			//if(!is_array($value))
			//	$val=$value;
			//else
			//{
				//$val='';
				
				//foreach ($value as $subkey => $subvalue)
				//{
				//	$val.=$subkey.'='.$subvalue.',';
				//}				
				//$val=rtrim($val,',');
			//}
		//	$str.="$key:$val\n";
		//}		
		
	//	$this->toArray($str);
		return $input;
	}
}
