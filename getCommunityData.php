<?php 
require_once("lib/config.php");
require_once("lib/api.php");

//Implement api call logic once we get address from google location


	//SET configuration URL
	$config['7503bab3271a4aa8db25f26a4ce490b9']= API_URL;
	$config['7503bab3271a4aa8db25f26a4ce490b9']= API_KEY;
	if($config["api_key"]=="" || $config["api_key"]=="7503bab3271a4aa8db25f26a4ce490b9"){
		die("Please paste your API KEY in config.php which is located under library folder.");
	}
	$communityObj = new model($config); //Create class object of library file
	
	$address = ', Suffern, NY, United States 10901';
	$areaType = 'ZI';
	$addressPosted = isset($_REQUEST['address'])?urlencode($_REQUEST['address']):urlencode($address);
	$areaType = isset($_REQUEST['geoType'])?$_REQUEST['geoType']:$areaType;
	$geoValue = isset($_REQUEST['geoValue'])?$_REQUEST['geoValue']:'';

	$businessCat = isset($_REQUEST['businessCat'])?$_REQUEST['businessCat']:'';
	$geoTypesArr = array('ZI'=>'Zip code','PL'=>'City','ND'=>'Neighborhood');
	if(!empty($addressPosted) ){

		$explodeAddress = explode(' ',urldecode($addressPosted));
		$zipCode = array_pop($explodeAddress);
		$firstPartAddr = implode(' ',$explodeAddress);
		
		$poiAddr = $firstPartAddr.'; '.$zipCode;
		
		$poiAddrExplode = explode(',',$firstPartAddr);	
		
		$address1 = $poiAddrExplode[0];
		unset($poiAddrExplode[0]);
		$address2 = implode(' ',$poiAddrExplode);
		
		//echo $address1.'--'.$address2;die;
		
		$subjectProperty = $communityObj->getCommunityByAddress(urlencode($address1),urlencode($address2));
			
		//echo '<pre>';print_r($subjectProperty);die;	
			
		if(!isset($subjectProperty['property'][0]['location']['latitude'])){
			//SET LAT LONG AS PER IP ADDRESS
			$sourceLocationLatitude = '41.1148';
			$sourceLocationLongitude = '74.1496';
		}else{
			@$sourceLocationLatitude = $subjectProperty['property'][0]['location']['latitude'];
			@$sourceLocationLongitude = $subjectProperty['property'][0]['location']['longitude'];
		}
		
		
		$amenitiesData = array();
		$uniqueBusinessCat = array();	
		
		
		$poiData = $communityObj->getAreaHierarchy($sourceLocationLatitude,$sourceLocationLongitude,$areaType);	
		
		$geoARRAY = array();
		$geoValName = array();
		foreach ($poiData['response']['result']['package']['item'] as $key => $area) { 
				$geoARRAY[]  = $area['geo_key'];
				$geoValName[$area['geo_key']] = $area['name'];
		}
		$popup = false;
		if(count($geoARRAY)>1){
			$popup = true;	
			if($geoValue!=''){
				$popup = false;
				$areaboundaryData = $communityObj->getAreaBoundary($geoValue);
				if(@$areaboundaryData['response']['result']['package']['item'][0]['boundary']!=''){
				$areaBoundary = $areaboundaryData['response']['result']['package']['item'][0]['boundary'];
				//echo $areaBoundary;
				$communityData = $communityObj->getCommunityByAreaId1($geoValue);
				}
			}
		}else{
			$areaboundaryData = $communityObj->getAreaBoundary($geoARRAY[0]);
			if(@$areaboundaryData['response']['result']['package']['item'][0]['boundary']!=''){
			$areaBoundary = $areaboundaryData['response']['result']['package']['item'][0]['boundary'];
			//echo $areaBoundary;
			$communityData = $communityObj->getCommunityByAreaId1($geoARRAY[0]);
			}
		}
		
		//echo '<pre>';print_r($poiData);die;
		
		
	}	

?>
