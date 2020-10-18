<!doctype html>

<html lang="en">
<head>
	<title>Gaslands: Legacy<?php IF(ISSET($_GET['vehicle-name'])) { echo " - " . $_GET['vehicle-name']; } ?></title>
	<meta name="description" content="Create your Gaslands: Legacy vehicle!">
	<meta property="og:site_name" content="Gaslands" />
	<meta property="og:image" content="https://i2.wp.com/gaslands.com/wp-content/uploads/SKM_C25820092208520_grunge.jpg?fit=900%2C637&amp;ssl=1" />
	<link href="https://fonts.googleapis.com/css?family=Orbitron|Press+Start+2P|Quantico|Russo+One|VT323|Roboto" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<link rel="stylesheet" type="text/css" href="legacy-styles.css">  
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-68265959-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-68265959-1');
	</script>

	
	
	
</head>

<body <?php IF ($_GET['print']) { echo 'class="print"'; } ELSE { echo 'class="screen"'; } ?>>
    
    
<?php

include 'random_name/function.php';

$display = 'results';

IF (!$_GET) { $display = 'form'; }

$valid_vehicle_types = array('car', 'performancecar', 'truck', 'buggy');

IF (!in_array(strtolower($_GET['vehicle-type']), $valid_vehicle_types)) { $display = 'form'; }

IF ($display == 'form')	{
	
	IF($_GET['random']) { $default_name = randomName(); } ELSE { $default_name = 'Screamliner'; }
	
	?>
	
	<div class="container">
	
	    <h1 class="caps">Gaslands: Legacy</h1>
	
    	<p>In Gaslands: Legacy, every named vehicle has different stats. Look on the bottom of your toy car for its name, enter it below, and see what your are stuck driving!</p>

    	<div class="divider centred">
    		<form>
    			
      		  <p>Vehicle Name:
	
      			  <input type="text" id="vehicle-name" name="vehicle-name" value= "<?php echo $default_name; ?>" size="20"> <a href="?random=1" style="text-decoration:none;">&#8635</a></p>
    			
    			<p>Vehicle Type:			 
    				<select name="vehicle-type">
    				<option selected="selected">Car</option><option >Buggy</option><option value="PerformanceCar">Performance Car</option><option >Truck</option></select>
    			</p>	
    				
    		  <p> <button>Generate</button></p>
    
    		   
    		</form>
    	</div>
	
	    <div class="divider">
	        
	        <p>Gaslands: Legacy is an exciting new game mode for Gaslands, coming soon via <a href="https://gaslands.com/blaster">BLASTER</a>.</p>
	    
	   	</div>
		
		<footer class="small">
		
			<h4><a href="https://gaslands.com/legacy/Gaslands_Legacy_DashboardCards.pdf">Dashboard Cards (PDF)</a> | <a href="https://gaslands.com/legacy/Gaslands_Legacy_Movement_Templates.pdf">Movement Templates (PDF)</a> | <a href="https://github.com/crikeymiles2/gaslands-legacy">Source Code</a></h4>
		</footer>

	</div>
	
	
<?php   

} ELSE {
  

    
// Get the files
$perks = file_get_contents('perks.txt');
$weapons = file_get_contents('weapons.txt');
$upgrades = file_get_contents('upgrades.txt');
$perk_costs = file_get_contents('perk_costs.txt');
$weapon_costs = file_get_contents('weapon_costs.txt');
$upgrade_costs = file_get_contents('upgrade_costs.txt');
$mutations = file_get_contents('mutations.txt');

// Create an array form the files of the files
$perks = explode("\n", $perks);
$weapons = explode("\n", $weapons);
$upgrades = explode("\n", $upgrades);
$perk_costs = explode("\n", $perk_costs);
$weapon_costs = explode("\n", $weapon_costs);
$upgrade_costs = explode("\n", $upgrade_costs);
$mutations = explode("\n", $mutations);

// Stats Setup
$default_stats['buggy']['hull'] = 6;
$default_stats['buggy']['handling'] = 4;
$default_stats['buggy']['max_gear'] = 6;
$default_stats['buggy']['crew'] = 2;
$default_stats['buggy']['cost'] = 6;

$default_stats['car']['hull'] = 10;
$default_stats['car']['handling'] = 3;
$default_stats['car']['max_gear'] = 5;
$default_stats['car']['crew'] = 2;
$default_stats['car']['cost'] = 12;

$default_stats['performancecar']['hull'] = 8;
$default_stats['performancecar']['handling'] = 4;
$default_stats['performancecar']['max_gear'] = 6;
$default_stats['performancecar']['crew'] = 1;
$default_stats['performancecar']['cost'] = 15;

$default_stats['truck']['hull'] = 12;
$default_stats['truck']['handling'] = 2;
$default_stats['truck']['max_gear'] = 4;
$default_stats['truck']['crew'] = 3;
$default_stats['truck']['cost'] = 15;



// This vehicle's current values
$vehicle_name = trim(strtolower($_GET['vehicle-name']));
$vehicle_name = preg_replace('/[^a-zA-Z0-9\s]/', '', strip_tags(html_entity_decode($vehicle_name)));
$vehicle_type = strtolower($_GET['vehicle-type']);
$vehicle_cost = $default_stats[$vehicle_type]['cost'];



////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////
//// HASHING FUNCTION
function numHash($str, $len=null)
{
    $binhash = md5($str, true);
    $numhash = unpack('N2', $binhash);
    $hash = $numhash[1] . $numhash[2];
    if($len && is_int($len)) {
        $hash = substr($hash, 0, $len);
    }
    return $hash;
}
////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////



// Setup the Vehicle hashes
$vehicle_hash = numHash($vehicle_name, 8);




////////////////////////////////////////////////////////////////
//// HULL

$hull_roll = substr($vehicle_hash,0,1);

switch ($hull_roll) {
    case 1:
        $modifier = -1;
        break;
    case 2:
        $modifier = -1;
        break;
    case 3:
        $modifier = 0;
        break;    
    case 4:
        $modifier = 0;
        break;     
    case 5:
        $modifier = 0;
        break;    
    case 6:
        $modifier = 1;
        break;    
    case 7:
        $modifier = 1;
        break;    
    case 8:
        $modifier = 2;
        break;
    case 9:
        $modifier = 3;
        break;    
    case 0:
        $modifier = 4;
        break;    
    default:
        $modifier = 0;
}

$hull_modifier = $modifier;
$hull = $default_stats[$vehicle_type]['hull'] + $hull_modifier;
if($vehicle_type == "buggy") { $hull = $hull + 2; }

$vehicle_cost = $vehicle_cost + $modifier;


////////////////////////////////////////////////////////////////
//// Max Gear

$max_gear_roll = substr($vehicle_hash,1,1);

switch ($max_gear_roll) {
    case 1:
        $modifier = 0;
        break;
    case 2:
        $modifier = 1;
        break;
    case 9:
        $modifier = 1;
        break;    
    case 0:
        $modifier = 1;
        break;    
    default:
        $modifier = 0;
}

$max_gear_modifier = $modifier;
$max_gear = min($default_stats[$vehicle_type]['max_gear'] + $max_gear_modifier,6);

$vehicle_cost = $vehicle_cost + ($modifier * 4);

    
////////////////////////////////////////////////////////////////
//// Handling

$handling_roll = substr($vehicle_hash,2,1);

switch ($handling_roll) {
    case 1:
        $modifier = 0;
        break;
    case 2:
        $modifier = 0;
        break;
    case 9:
        $modifier = 1;
        break;    
    case 0:
        $modifier = 1;
        break;    
    default:
        $modifier = 0;
}

$handling_modifier = $modifier;
$handling = max($default_stats[$vehicle_type]['handling'] + $handling_modifier,2);

$vehicle_cost = $vehicle_cost + ($modifier * 4);

    
////////////////////////////////////////////////////////////////
//// Crew

$crew_roll = substr($vehicle_hash,3,1);

switch ($crew_roll) {
    case 8:
        $modifier = 1;
        break;
    case 9:
        $modifier = 1;
        break;    
    case 0:
        $modifier = 1;
        break;    
    default:
        $modifier = 0;
}

$crew_modifier = $modifier;
$crew = max($default_stats[$vehicle_type]['crew'] + $crew_modifier,1);

$vehicle_cost = $vehicle_cost + ($modifier * 4);
    
    
////////////////////////////////////////////////////////////////
//// Weapons

$weapons_roll = substr($vehicle_hash,4,1);

switch ($weapons_roll) {
    case 1:
        $quantity = 1;
        break;
    case 2:
        $quantity = 1;
        break;
    case 3:
        $quantity = 1;
        break;    
    case 4:
        $modifier = 1;
        break;     
    case 5:
        $quantity = 1;
        break;    
    case 6:
        $quantity = 2;
        break;    
    case 7:
        $quantity = 2;
        break;    
    case 8:
        $quantity = 2;
        break;
    case 9:
        $quantity = 3;
        break;    
    case 0:
        $quantity = 4;
        break;    
    default:
        $quantity = 2;
}

$weapons_quantity = $quantity;
if($vehicle_type == "truck") { $weapons_quantity++; }
if($vehicle_type == "performancecar" AND $weapons_quantity > 1) { $weapons_quantity--; }


if($weapons_quantity) { 
    
    for ($x = 0; $x < $weapons_quantity; $x++) {
		$weapons_d100 = ltrim(substr($vehicle_hash,$x,2), '0') + 1;
        $weapons_list[$x] = $weapons[$weapons_d100];
		$vehicle_cost = $vehicle_cost + $weapon_costs[$weapons_d100];
		//echo "<p>[" . __LINE__ . ": Cost is now $vehicle_cost]</p>";
		//echo "cost: " . $weapon_costs[ltrim(substr($vehicle_hash,$x,2), '0')];
    }   

}

////////////////////////////////////////////////////////////////
//// Upgrades

$upgrades_roll = substr($vehicle_hash,5,1);

switch ($upgrades_roll) {
    case 6:
        $quantity = 1;
        break;    
    case 7:
        $quantity = 1;
        break;    
    case 8:
        $quantity = 1;
        break;
    case 9:
        $quantity = 2;
        break;    
    case 0:
        $quantity = 2;
        break;    
    default:
        $quantity = 0;
}

$upgrades_quantity = $quantity;
if($vehicle_type == "buggy") { $upgrades_quantity = max($upgrades_quantity,1); }

if($upgrades_quantity) { 
    
    for ($x = 0; $x < $upgrades_quantity; $x++) {
		$upgrades_d10 = ltrim(substr($vehicle_hash,$x,1), '0') + 1;
        $upgrades_list[$x] = $upgrades[$upgrades_d10];
		$vehicle_cost = $vehicle_cost + $upgrade_costs[$upgrades_d10];
    }   

}



////////////////////////////////////////////////////////////////
//// Perks

/*
$perks_roll = substr($vehicle_hash,6,1);

switch ($perks_roll) {
    case 5:
        $quantity = 2;
        break;  
    case 6:
        $quantity = 2;
        break;    
    case 7:
        $quantity = 2;
        break;    
    case 8:
        $quantity = 3;
        break;
    case 9:
        $quantity = 3;
        break;    
    case 0:
        $quantity = 4;
        break;    
    default:
        $quantity = 1;
}
*/
$quantity = 3;

$perks_quantity = $quantity;
if($vehicle_type == "truck") { $perks_quantity--; }

if($perks_quantity) { 
    
    for ($x = 0; $x < $perks_quantity; $x++) {
        $perks_list[$x] = $perks[ltrim(substr($vehicle_hash,$x,2), '0')];
		$vehicle_cost = $vehicle_cost + $perk_costs[ltrim(substr($vehicle_hash,$x,2), '0')];
    }   
}


////////////////////////////////////////////////////////////////
//// Brucie bonus if your car sucks

IF (($weapons_quantity + $upgrades_quantity + $perks_quantity) < 3) {
	$hull = $default_stats[$vehicle_type]['hull'] + 2;
}




?>
<div class="container">
<h1 class="caps centred">Gaslands: Legacy</h1>

<div class="divider">
<table class="fields">
	<tr class="spacer"><th><p></p></td></tr>
	<tr><th><p>Vehicle Name:</p></th>		<td><p><?php echo $_GET['vehicle-name']; ?></p></td></tr>
	<tr><th><p>Vehicle Type:</p></th>		<td><p><?php IF($vehicle_type == "performancecar") { echo "Performance Car"; } ELSE { echo $_GET['vehicle-type']; } ?></p></td></tr>
	
	<tr class="spacer"><th><p></p></td></tr>
	<tr><th><p>Hull:</p></th>				<td><p><?php echo $hull; ?></p></td></tr>
	<tr><th><p>Max Gear:</p></th>			<td><p><?php echo $max_gear; ?></p></td></tr>
	<tr><th><p>Handling:</p></th>			<td><p><?php echo $handling; ?></p></td></tr>
	<tr><th><p>Crew:</p></th>				<td><p><?php echo $crew; ?></p></td></tr>
	<tr class="spacer"><th><p></p></td></tr>
	
	<tr><th><p>Weapons:</p></th>			
		<td><p><?php IF($weapons_list) { echo implode(", ",$weapons_list); } ELSE { echo "None"; } ?>.</p></td></tr>

	<tr><th><p>Upgrades:</p></th>			
		<td><p><?php IF($upgrades_list) { echo implode(", ",$upgrades_list); } ELSE { echo "None"; } ?>.</p></td></tr>	

		<tr><th><p>Perks:</p></th>			
		<td><p><?php IF($perks_list) { echo implode(", ",array_filter($perks_list)); } ELSE { echo "None"; } ?>.</p></td></tr>
	<tr class="spacer"><th><p></p></td></tr>
	<tr><th><p>Vehicle Rating:</p></th>	<td><p><?php echo $vehicle_cost; ?> Cans (+ mutations)</p></td></tr>

</table>
</div>		

<div id="mutations" class="divider">
<table class="fields">
	<tr>
		<th><p>Mutations:</p></th>
		
		<td><?php 
			
			$filtered = array();

			foreach($_GET as $key => $value)
			  if(preg_match('/adv\d/',$key))
			    $filtered[] = $key;

			$number_of_mutations_to_display = count($filtered) + 1;
				
		    for ($x = 1; $x <= $number_of_mutations_to_display; $x++) {

				$url = 'https://gaslands.com' . $_SERVER['REQUEST_URI'];
				
				$adv_param = "adv" . $x;
				
				// The secret code to unlock this achievement is the hash of the name of the vehicle plus the string "advX=unlocked"
				$mutation_unlock_code = numHash($vehicle_name . $vehicle_type . '&adv' . $x . '=unlocked',4);
				
				IF ($_GET[$adv_param] == $mutation_unlock_code) {
					$url .= '&adv' . $x . '=' . $mutation_unlock_code;
					$mutation_number = floor(ltrim(substr($mutation_unlock_code,1,2), '0') / 2);
					//echo "mutation_number " . $mutation_number;
					IF ( $mutation_number == NULL ) { $mutation_number = 0; };
					echo '<p class="unlocked-mutation">' . $mutations[$mutation_number] . '</p>'; 
					// TO DO: It's still possible to unlock the same template twice: https://gaslands.com/legacy/?vehicle-name=%09Hi+Beam&vehicle-type=Car&adv5=3577&adv4=1895&adv3=1881&adv2=3634&adv1=2898&adv6=1807
				}
				
				else {
					//$url .= '&adv' . $x . '=unlocked';
					$url .= '&adv' . $x . '=' . $mutation_unlock_code;
					echo '<p><a href="' . $url . '"><button>Gain Mutation</button></a></p>';
				}
		        
		    }   
		?></td>
		
	</tr>
</table>

</div>


<?php
	IF ($_GET['print']) {
		$print_link = '<a href="https://gaslands.com' . str_replace('&print=1', '', $_SERVER['REQUEST_URI']) . '">VIEW VEHICLE</a>';	
	} ELSE {
		$print_link = '<a href="https://gaslands.com' . $_SERVER['REQUEST_URI'] . '&print=1">PRINT VEHICLE</a>';	
	}
?>

<div class="divider centred">
	
	<h4><a href="https://gaslands.com<?php echo $_SERVER['REQUEST_URI']; ?>">VEHICLE LINK</a> | <?php echo $print_link; ?></h4>
	
	<h4><a href="https://gaslands.com/legacy/Gaslands_Legacy_DashboardCards.pdf" target="_blank" >Dashboard Cards (PDF)</a> | <a href="https://gaslands.com/legacy/Gaslands_Legacy_Movement_Templates.pdf" target="_blank" >Movement Templates (PDF)</a></h4>
		
	<h4><a href="http://gaslands.com/legacy/"><button>Create new vehicle</button></a></h4>

</div>

<?php } ?>

<!--footer><p>Check out Gaslands: Legacy in BLASTER!</p></footer-->
	
</body>
</html>