<!DOCTYPE html>
<html class="no-js" lang="">

	<head>
		<!-- All meta tags define below -->
		<meta charset="utf-8">
		<meta name="keywords" content="Community" >
		<meta name="description" content="Display all point of interests based on property search">
		<meta name="author" content="Kevin">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
		
		<!-- Title of the page -->
		<title>Community</title>
		
		<link rel="apple-touch-icon" href="apple-touch-icon.png">
		<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
		
		<!-- CDN call for CSS Start-->
		<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,600,700|Roboto:300,400" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.6/css/swiper.min.css" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
		<!-- CDN call for CSS end -->
		

		<!-- css/main.css -->
		<link rel="stylesheet" href="css/main.css">
		<!-- endbuild -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<!-- CDN call for JS Start-->	
		<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		
	</head>
	<!-- This div is used for display page loader untill full page is load -->
	<div id="load"></div>

	<body id="innerCont" class="home">
		
		<!-- Display loader image whe page will start loading start-->
		<div style="display:none" class="ajax-loader">
		  <img src="images/35.gif" class="img-responsive" />
		</div>	
		<!-- Display loader image when page will start loading end-->
		
		<?php
			require_once("getCommunityData.php");
		?>
    <div style="visibility:hidden;"  id="header">
        <span>
            Community
        </span>
    </div>
    <!-- /.header -->

    <!-- body -->
    <div style="visibility:hidden;" id="body">
        <div class="container">
            <div class="row">
				<div class="col-md-7 col-xs-12 col-md-offset-3">
                    <div class="search search-reduce" id="searchByPropForm">
						
						<input class="form-control" id="search" type="text" placeholder="By Property"  onFocus="geolocate()" required="true" value="<?php echo urldecode($addressPosted); ?>"/>
						<input type="hidden" name="postal_code" id="postal_code" value="">
						<input type="hidden" name="geoValue" id="geoVal" value="">
						
						<input type="hidden" id="geoType" name="geoType" value="<?php echo $areaType ?>">
						 <div class="dropdown">
							<button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown"><?php echo $geoTypesArr[$areaType]; ?>
							<span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><a href="javascript:void(0);" data-val="ZI">Zip code</a></li>
								<li><a href="javascript:void(0);" data-val="PL">City</a></li>
								<li><a href="javascript:void(0);" data-val="ND">Neighborhood</a></li>
							</ul>
						</div> 
                        <input class="btn btn-primary" type="button" value="Search" id="searchByProperty">
						<span class="customerror"></span>
                    </div>
                </div>
				<!--
                <div class="col-md-7 col-xs-12">
                    <div class="search" id="estimateForm">
                     
						<input class="form-control" type="text" placeholder="Enter City,Zip or Neighborhood" id="city_zip" required="true">
						
						<input class="btn btn-primary" id="getEstimate" type="button" value="Search">
						
						<span class="customerrorCity"></span>
						
                    </div>
                </div>-->
				
				<?php 
					$nodataFound = '';
					if(!isset($communityData['AGE00_04']) && @$communityData['AGE00_04']=='' && $popup==false){ 
						$nodataFound= 'noshow';
				?>
					<div class="col-md-12 col-xs-12 mt-30">
						<p class="nodatafound">No data found!</p>
					</div>
				<?php } ?>
				
				<div class="col-md-8 col-xs-12 mt-30 <?php echo $nodataFound; ?>" <?php echo($popup==true?'style="display:none;"':'') ?>>
					

					<div class="col-xs-12 mt-30 map" id="map">
                    
					</div>
					<div class="gap20"></div>	
					<div class="stat-section white-bx">
								<div class="listing">
									<div class="row">
										<div class="col-md-6 col-xs-12 pdr50">
										
											<img src="images/icon-key.png" alt="">
											<h2>Market rent<br>information</h2>
											<h3>Info</h3>
											<p>The Fair Market Rents show average gross rent <br>estimates based on figures provided by the U.S. <br>
Department of Housing and Urban Development (HUD).<br></p>
											<div class="gap20"></div>
											
											<div class="list-row">
												<span class="list-title">Studio:</span>
												<span class="list-price">$<?php echo number_format($communityData['STUDIO_COUNTY'], 2); ?></span>
											</div>
											<div class="list-row">
												<span class="list-title">1 Bedroom: </span>
												<span class="list-price">$<?php echo number_format($communityData['ONE_BED_COUNTY'], 2); ?></span>
											</div>
											<div class="list-row">
												<span class="list-title">2 Bedroom: </span>
												<span class="list-price">$<?php echo number_format($communityData['TWO_BED_COUNTY'], 2); ?></span>
											</div>
											<div class="list-row">
												<span class="list-title">3 Bedroom: </span>
												<span class="list-price">$<?php echo number_format($communityData['THREE_BED_COUNTY'], 2); ?></span>
											</div>
											<div class="list-row">
												<span class="list-title">4 Bedroom: </span>
												<span class="list-price">$<?php echo number_format($communityData['FOUR_BED_COUNTY'], 2); ?></span>
											</div>
											
										</div>
										<div class="col-md-6 col-xs-12 pd-col brd">
											
											<img src="images/icon-stat.png" alt="">
											<h2>Highest education<br>level attained</h2>
											<h3>Info</h3>
											<p>Lorem ipsum dolor sit amet, consectetur<br>adipiscing elit. Mauris nec odio.</p>
											<div class="gap20"></div>
											
											<div class="list-row">
												<span class="list-title">No HS</span>
												<span class="list-price"><?php echo round(number_format((100*($communityData['EDULTGR9']/$communityData['EDUTOTALPOP'])), 2)); ?>%</span>
											</div>
											<div class="list-row">
												<span class="list-title">Some HS</span>
												<span class="list-price"><?php echo round(number_format((100*($communityData['EDUSHSCH']/$communityData['EDUTOTALPOP'])), 2)); ?>%</span>
											</div>
											<div class="list-row">
												<span class="list-title">HS Grad</span>
												<span class="list-price"><?php echo round(number_format((100*($communityData['EDUHSCH']/$communityData['EDUTOTALPOP'])), 2)); ?>%</span>
											</div>
											<div class="list-row">
												<span class="list-title">Some College</span>
												<span class="list-price"><?php echo round(number_format((100*($communityData['EDUSCOLL']/$communityData['EDUTOTALPOP'])), 2)); ?>%</span>
											</div>
											<div class="list-row">
												<span class="list-title">Associate Degree</span>
												<span class="list-price"><?php echo round(number_format((100*($communityData['EDUASSOC']/$communityData['EDUTOTALPOP'])), 2)); ?>%</span>
											</div>
											<div class="list-row">
												<span class="list-title">Bachelor's Degreee</span>
												<span class="list-price"><?php echo round(number_format((100*($communityData['EDUBACH']/$communityData['EDUTOTALPOP'])), 2)); ?>%</span>
											</div>
											<div class="list-row">
												<span class="list-title">Graduate Degreee</span>
												<span class="list-price"><?php echo round(number_format((100*($communityData['EDUGRAD']/$communityData['EDUTOTALPOP'])), 2)); ?>%</span>
											</div>
											
											
										</div>
									</div>
								</div>
							</div>
					

				</div>
				<!-- Swiper -->
				<script src="js/main.js"></script>
				<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPAVKxutIiPNXJr8UeB2wwSrzrFA3-GuI&libraries=places&callback=initAutocomplete"></script>
				<div class="col-md-4 col-xs-12 col-xs-12 mt-30 <?php echo $nodataFound; ?>" id="communityContent" <?php echo($popup==true?'style="display:none;"':'') ?>>
					
					<h2 class="ageDemo mt-30">Housing Inventory</h2>
					<div class="chart_bar" style="position: relative; margin:0 auto;width:80%; height:150px;" >	
						<div id="chart-1" ></div> 
					</div> 
					

				
					<h2 class="ageDemo mt-30">Age Demographics</h2>
					<div class="chart_bar" style="position: relative;height:150px;" >	
						<div id="chart-2" ></div> 
					</div> 
					
					<h2 class="ageDemo mt-30">Income by Households</h2>
					<div class="chart_bar" style="position: relative;height:150px;" >	
						<div id="chartincomediv"> </div> 
					</div> 
				</div>
    </div>
			
	<div id="myModal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
	  <div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-header">
			<h4 class="modal-title">Neighborhood Lists</h4>
		  </div>
		  <div class="modal-body">
			<p>Please choose any of them to see the community data:</p>
			<ul class="ndLists">
				<?php foreach($geoARRAY as $geoVal){ ?>
				<li data-val="<?php echo $geoVal; ?>"><label><input type="radio" name="geoVal" value="<?php echo $geoVal; ?>"><?php echo $geoValName[$geoVal]; ?></label></li>
				<?php } ?>
			</ul>
		  </div>
		 
		</div>

	  </div>
	</div>		
	
	<?php if($popup==true){ ?>
		<script type="text/javascript">
			$(function(){
				$('#myModal').modal('show');
			});
		</script>
	
	<?php } ?>

	
			<!-- /.body -->
	<script type="text/javascript">
	
	
	
	
	
	var polys=['<?php echo $areaBoundary; ?>'];
	
	init();	
	
	function parsePolyStrings(ps) {
    var i, j, lat, lng, tmp, tmpArr,
        arr = [],
        //match '(' and ')' plus contents between them which contain anything other than '(' or ')'
        m = ps.match(/\([^\(\)]+\)/g);
    if (m !== null) {
        for (i = 0; i < m.length; i++) {
            //match all numeric strings
            tmp = m[i].match(/-?\d+\.?\d*/g);
            if (tmp !== null) {
                //convert all the coordinate sets in tmp from strings to Numbers and convert to LatLng objects
                for (j = 0, tmpArr = []; j < tmp.length; j+=2) {
                    lng = Number(tmp[j]);
                    lat = Number(tmp[j + 1]);
                    tmpArr.push(new google.maps.LatLng(lat, lng));
                }
                arr.push(tmpArr);
            }
        }
    }
    //array of arrays of LatLng objects, or empty array
    return arr;
}

function init() {
    var i, tmp,
        myOptions = {
            zoom: 13,
            center: new google.maps.LatLng(<?php echo $sourceLocationLatitude; ?>, <?php echo $sourceLocationLongitude; ?>),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        },
        map = new google.maps.Map(document.getElementById("map"), myOptions);
		
		var marker;
			//console.log(locations);
			
			 marker = new google.maps.Marker({
				position: new google.maps.LatLng('<?php echo $sourceLocationLatitude; ?>', '<?php echo $sourceLocationLongitude; ?>'),
				map: map,
				animation: google.maps.Animation.DROP,
				icon: 'images/4.png'
			  });
		
    for (i = 0; i < polys.length; i++) {
        tmp = parsePolyStrings(polys[i]);
        if (tmp.length) {
            polys[i] = new google.maps.Polygon({
                paths : tmp,
                strokeColor : '#0051FF',
                strokeOpacity : 0.8,
                strokeWeight : 2,
                fillColor : '#0051FF',
                fillOpacity : 0.20
            });
            polys[i].setMap(map);
        }
    }
}
</script>
<script type='text/javascript' src="js/jqgraph.js"></script>
<script type="text/javascript">
arrayOfData2 = new Array(
	 [<?php echo $communityData['AGE00_04'] ?>],
   	 [<?php echo $communityData['AGE05_09'] ?>],
	 [<?php echo $communityData['AGE10_14'] ?>],
   	 [<?php echo $communityData['AGE15_19'] ?>],
	 [<?php echo $communityData['AGE20_24'] ?>],
   	 [<?php echo $communityData['AGE25_29'] ?>],
	 [<?php echo $communityData['AGE30_34'] ?>],
   	 [<?php echo $communityData['AGE35_39'] ?>],
	 [<?php echo $communityData['AGE40_44'] ?>],
   	 [<?php echo $communityData['AGE45_49'] ?>],
	 [<?php echo $communityData['AGE50_54'] ?>],
   	 [<?php echo $communityData['AGE55_59'] ?>],
	 [<?php echo $communityData['AGE60_64'] ?>],
   	 [<?php echo $communityData['AGE65_69'] ?>],
	 [<?php echo $communityData['AGE70_74'] ?>],
   	 [<?php echo $communityData['AGE75_79'] ?>],
	 [<?php echo $communityData['AGE80_84'] ?>]
);	


$('#chart-2').jqbargraph({
  	data: arrayOfData2 ,
   colors: ['#0051FF','#43575f'],
   legends: ['Male','Female'],
   legend: false,
   height: 150,
   barSpace: 12
});

 </script>	

<!-- Resources -->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/pie.js"></script>
<script src="https://www.amcharts.com/lib/3/xy.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script> 
 
 <script type='text/javascript' src="js/donut-chart.js"></script>
<script>
var mychart = AmCharts.makeChart( "chart-1", {
  "type": "pie",
  "theme": "light",
  "dataProvider": [ {
    "title": "Rented <?php echo round(number_format((100*($communityData['DWLRENT']/$communityData['DWLTOTAL'])), 2)); ?>%",
    "value": <?php echo round(number_format((100*($communityData['DWLRENT']/$communityData['DWLTOTAL'])), 2)); ?>,
	"color":'#0051FF'
  }, {
    "title": "Owned <?php echo round(number_format((100*($communityData['DWLOWNED']/$communityData['DWLTOTAL'])), 2)); ?>%",
    "value": <?php echo round(number_format((100*($communityData['DWLOWNED']/$communityData['DWLTOTAL'])), 2)); ?>,
	"color":'#43575f'
  }, {
    "title": "Vacant <?php echo round(number_format((100*($communityData['DWLVACNT']/$communityData['DWLTOTAL'])), 2)); ?>%",
    "value": <?php echo round(number_format((100*($communityData['DWLVACNT']/$communityData['DWLTOTAL'])), 2)); ?>,
	"color":'#d6d6d6'
  } ],
  "titleField": "title",
  "valueField": "value",
  "colorField": "color",
  "labelRadius": 0,

  "radius": "42%",
  "innerRadius": "60%",
  "labelText": "[[title]]",
  "export": {
    "enabled": true
  }
} );
</script>

<style>
#chartincomediv {
  width: 100%;
  height: 300px;
}
</style>





<!-- Chart code -->
<script>
var chart = AmCharts.makeChart("chartincomediv", {
  "type": "xy",
  "theme": "light",
  "marginRight": 80,
  "dataDateFormat": "YYYY-MM-DD",
  "startDuration": 1.5,
  "trendLines": [],
  "balloon": {
    "adjustBorderColor": false,
    "shadowAlpha": 0,
    "fixedPosition": true
  },
  "graphs": [{
    "balloonText": "<div style='margin:5px;'><b>[[y]]</b></div>",
    "bullet": "diamond",
    "maxBulletSize": 25,
    "lineAlpha": 0.8,
    "lineThickness": 2,
    "lineColor": "#0051FF",
    "fillAlphas": 0,
    "xField": "date",
    "yField": "ay",
    "valueField": "aValue"
  }],
  "valueAxes": [{
    "id": "ValueAxis-1",
    "axisAlpha": 0,
	"labelsEnabled": false,
	"title": "Number of Households"
  }, {
    "id": "ValueAxis-2",
    "axisAlpha": 0,
    "position": "bottom",
	"labelsEnabled": false,
	"title": "Annual Income"
	
  }],
  "allLabels": [],
  "titles": [],
  "dataProvider": [{
    "date": 1,
    "ay": <?php echo $communityData['HINCY00_10']; ?>,
    "by": 2.2,
    "aValue": 15,
    "bValue": 10
  }, {
    "date": 2,
    "ay": <?php echo $communityData['HINCY10_15']; ?>,
    "by": 4.9,
    "aValue": 8,
    "bValue": 3
  }, {
    "date": 3,
    "ay": <?php echo $communityData['HINCY15_20']; ?>,
    "by": 5.1,
    "aValue": 16,
    "bValue": 4
  }, {
    "date": 5,
    "ay": <?php echo $communityData['HINCY20_25']; ?>,
    "aValue": 9
  }, {
    "date": 7,
    "by": <?php echo $communityData['HINCY25_30']; ?>,
    "bValue": 13
  }, {
    "date": 10,
    "ay": <?php echo $communityData['HINCY30_35']; ?>,
    "by": 13.3,
    "aValue": 9,
    "bValue": 13
  }, {
    "date": 12,
    "ay": <?php echo $communityData['HINCY35_40']; ?>,
    "by": 6.1,
    "aValue": 5,
    "bValue": 2
  }, {
    "date": 13,
    "ay": <?php echo $communityData['HINCY40_45']; ?>,
    "aValue": 10
  }, {
    "date": 15,
    "ay": <?php echo $communityData['HINCY45_50']; ?>,
    "by": 10.5,
    "aValue": 3,
    "bValue": 10
  }, {
    "date": 16,
    "ay": <?php echo $communityData['HINCY50_60']; ?>,
    "by": 12.3,
    "aValue": 5,
    "bValue": 13
  }, {
    "date": 20,
	"ay":<?php echo $communityData['HINCY60_75']; ?>,
    "by": 4.5,
    "bValue": 11
  }, {
    "date": 22,
    "ay": <?php echo $communityData['HINCY75_100']; ?>,
    "by": 15,
    "aValue": 15,
    "bValue": 10
  }, {
    "date": 23,
    "ay": <?php echo $communityData['HINCY100_125']; ?>,
    "by": 10.8,
    "aValue": 1,
    "bValue": 11
  }, {
    "date": 24,
    "ay": <?php echo $communityData['HINCY125_150']; ?>,
    "by": 19,
    "aValue": 12,
    "bValue": 3
  }, {
    "date": 23,
    "ay": <?php echo $communityData['HINCY150_200']; ?>,
    "by": 10.8,
    "aValue": 1,
    "bValue": 11
  }, {
    "date": 24,
    "ay": <?php echo $communityData['HINCY200_250']; ?>,
    "by": 19,
    "aValue": 12,
    "bValue": 3
  }, {
    "date": 23,
    "ay": <?php echo $communityData['HINCY250_500']; ?>,
    "by": 10.8,
    "aValue": 1,
    "bValue": 11
  }, {
    "date": 24,
    "ay": <?php echo $communityData['HINCYGT_500']; ?>,
    "by": 19,
    "aValue": 12,
    "bValue": 3
  }],

  "export": {
    "enabled": false
  },

  "chartScrollbar": {
    "offset": 15,
    "scrollbarHeight": 5
  },
  "chartCursor": {
    "pan": false,
    "cursorAlpha": 0,
    "valueLineAlpha": 0
  }
});
</script>							

		<style>
		.noshow{display:none;}
		.nodatafound {
			font-size: 24px;
			text-align: center;
		}
		.ndLists input[type="radio"] {
			margin-right: 5px;
			
		}	
		.ndLists li {
			display: inline-block;
			padding: 15px 15px 0px 0;
			vertical-align: middle;
		}
		#chart-1 {
			width		: 100%;
			height		: 150px;
			font-size	: 12px;
		}			
		#chart-1 a {
			display: none !important;
		}
		.graphValuechart-2 {
			font-size: 10px;
		}
		.chart-item-bg { stroke: #ddd }

		.chart-item-0 { stroke: #dd0000 }

		.chart-item-1 { stroke: #00cc00 }

		.chart-item-2 { stroke: #0000ff }
		#legendHolder7chart-2 {
			width: 50% !important;
			float: left !important;
			text-align: center !important;
			position: absolute;
			bottom: -50px;
			left: 62px;
		}
		#legend0,#legend1{
			overflow: hidden;
			/* zoom: 1; */
			display: inline-block;
			width: 60px;
			vertical-align: middle;
		}
		#legend1{
			width:70px !important;
		}
		
#legendColor0,#legendColor1{
    background-color: rgb(0, 81, 255);
    float: left;
    margin: 3px;
    height: 10px !important;
    width: 10px !important;
    font-size: 0px;
    border-radius: 50%;
}
.ageDemo {
    font-size: 24px;
    margin-bottom:20px;
}
		</style>
	</body>
</html>
