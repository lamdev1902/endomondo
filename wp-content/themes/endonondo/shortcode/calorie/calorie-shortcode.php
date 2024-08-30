<?php
function calorie_call_shortcode($age, $gender, $weight, $feet, $inches, $activity, $bodyfat, $unit, $receip)
{
	$curl = curl_init();
	if ($receip == 3) {
		$bodyc = '{
		    "info" : {
		        "age": ' . $age . ',
		        "gender": ' . $gender . ',
		        "weight": ' . $weight . ',
		        "height": {
		            "feet": ' . $feet . ',
		            "inches": ' . $inches . '
		        },
		        "activity": ' . $activity . ',
		        "body-fat": ' . $bodyfat . '
		    },
		    "unit": ' . $unit . ',
		    "receip": ' . $receip . '
		}';
	} else {
		$bodyc = '{
		    "info" : {
		        "age": ' . $age . ',
		        "gender": ' . $gender . ',
		        "weight": ' . $weight . ',
		        "height": {
		            "feet": ' . $feet . ',
		            "inches": ' . $inches . '
		        },
		        "activity": ' . $activity . '
		    },
		    "unit": ' . $unit . ',
		    "receip": ' . $receip . '
		}';
	}
	curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://dev.ehproject.org/wp-json/api/v1/calorie-calculate/',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => $bodyc,
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json'
		),
	));
	$response = curl_exec($curl);
	$response = json_decode($response);
	$response = $response->result;
	curl_close($curl);
	return $response;
}
function create_shortcode_tool_calorie($args, $content)
{
	ob_start();
	?>
	<div class="calories-box">
		<div class="calories-form">
			<h2 class="mr-bottom-40">Input Your Information Below </h2>
			<form action="" id="clorieToolForm">
				<div class="form-col">
					<label for="">Gender <img src="assets/images/calories-note.svg" alt=""></label>
					<div class="form-radio-list form-radio gender-radio two-grid">
						<div class="form-input checked">
							<label for="genderMale">
								<input type="radio" name="calorie_gender" value="1" id="genderMale" checked>
								<span class="radio"></span>
								Male
							</label>
						</div>
						<div class="form-input">
							<label for="genderFemale">
								<input type="radio" name="calorie_gender" value="2" id="genderFemale">
								<span class="radio"></span>
								Female
							</label>
						</div>
					</div>
				</div>
				<div class="form-col">
					<label for="">Weight</label>
					<div class="form-input">
						<input class="input-it" type="text" name="calorie_weight">
						<p class="">pounds</p>
					</div>
				</div>
				<div class="form-col">
					<label for="">Age</label>
					<div class="form-input">
						<input class="input-it" type="text" name="calorie_age">
						<p>years</p>
					</div>
				</div>
				<div class="form-col">
					<label for="">Height</label>
					<div class="form-input-list two-grid">
						<div class="form-input">
							<input class="input-it" type="text" name="calorie_height_ft">
							<p>ft</p>
						</div>
						<div class="form-input">
							<input class="input-it" type="text" name="calorie_height_in">
							<p>in</p>
						</div>
					</div>
				</div>
				<div class="form-col">
					<h3>Setting</h3>
					<label for="">Results unit:</label>
					<div class="form-radio-list two-grid">
						<div class="form-radio checked">
							<label for="unitCalo">
								<input id="unitCalo" type="radio" name="calorie_unit" value="1" checked>
								<span class="radio"></span>
								Calories
							</label>
						</div>
						<div class="form-input">
							<label for="unitKilo">
								<input id="unitKilo" type="radio" name="calorie_unit" value="2">
								<span class="radio"></span>
								Kilojoules
							</label>
						</div>
					</div>
					<div class="form-radio-list form-radio">
						<label for="">BMR estimation formula: <img src="assets/images/calories-note.svg" alt=""></label>
						<div class="form-radio checked">
							<label for="bmr1">
								<input id="bmr1" type="radio" name="calorie_receip" value="1" checked>
								<span class="radio"></span>
								Mifflin St Joer
							</label>
						</div>
						<div class="form-radio">
							<label for="bmr2">
								<input id="bmr2" type="radio" name="calorie_receip" value="2">
								<span class="radio"></span>
								Revised Harris Benedict
							</label>
						</div>
						<div class="form-radio">
							<label for="bmr3">
								<input id="bmr3" type="radio" name="calorie_receip" value="3">
								<span class="radio"></span>
								Katch - McArdle
							</label>
						</div>
						<div class="input-body" style="opacity: 0;">
							<label for="">Body Fat: </label>
							<input class="input-it" type="text" placeholder=" %" name="calorie_fat">
						</div>
					</div>
				</div>
				<div class="form-col">
					<div class="calories-pc">
						<label for="">Level of Activity</label>
						<select class="select-ip form-input input-it" name="calorie_level">
							<option value="1">Basal Metabolic Rate (BMR)</option>
							<option value="2">Sedentary: little or no exercise</option>
							<option value="3">Light: exercise 1-3 times/week</option>
							<option value="4">Moderate: exercise 4-5 times/week</option>
							<option value="5">Active: daily exercise or intense exercise 3-4 times/week</option>
							<option value="6">Very active: intense exercise 6-7 times/week</option>
							<option value="7">Extra active: very intense exercise daily, or physical job</option>
						</select>
					</div>
					<input type="submit" value="Calculate" class="calories-submit has-medium-font-size">
					<p class="has-ssmall-font-size sec-color-4 text-center">
						The Healthcare.com Copyright 2021 © All Rights Reserved. As an associate partner with many brands
						and manufacture. Bizreport.com earns from qualifying purchase. The content in this site is not
						intended replacing professional advices, and only for general use.
					</p>
				</div>
			</form>
		</div>
		<div class="fillResult"></div>
	</div>
	<?php
	$rt = ob_get_clean();
	wp_enqueue_style('calorie-css', get_template_directory_uri() . '/shortcode/calorie/assets/css/calorie-tool.css', '', '1.0.0');
	wp_enqueue_script('calorie-js', get_template_directory_uri() . '/shortcode/calorie/assets/js/calorie-tool.js', '', '1.0.4');
	wp_enqueue_script('validate-js', get_template_directory_uri() . '/shortcode/calorie/assets/js/jquery.validate.min.js', '', '1.0.0');
	return $rt;
}
add_shortcode('hc_tool_calorie', 'create_shortcode_tool_calorie');
/* call ajax tool */
function is_ajax_calorie_tool()
{
	return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}
add_action('init', 'get_calorie_tool');
function get_calorie_tool()
{
	if (isset($_GET['get_calorie_tool']) && is_ajax_calorie_tool()) {
		$calorie_gender = $_GET['calorie_gender'];
		$calorie_age = $_GET['calorie_age'];
		$calorie_weight = $_GET['calorie_weight'];
		$calorie_height_ft = $_GET['calorie_height_ft'];
		$calorie_height_in = $_GET['calorie_height_in'];
		$calorie_activity = $_GET['calorie_level'];
		$calorie_unit = $_GET['calorie_unit'];
		if ($calorie_unit == 1)
			$unit_label = 'Calories';
		else
			$unit_label = 'Kilojoules';
		$calorie_receip = $_GET['calorie_receip'];
		$calorie_fat = $_GET['calorie_fat'];
		$tool_result = calorie_call_shortcode($calorie_age, $calorie_gender, $calorie_weight, $calorie_height_ft, $calorie_height_in, $calorie_activity, $calorie_fat, $calorie_unit, $calorie_receip);
		$result_cal = $tool_result->calorie;
		$zigzag_schedule_1 = $tool_result->zigzag_schedule_1;
		$zigzag_schedule_2 = $tool_result->zigzag_schedule_2;
		ob_start();
		?>
		<div class="calories-result grid">
			<div class="calories-col">
				<h2>Result</h2>
				<p>The results show a number of daily calorie estimates that can be used as a guideline for how many calories to
					consume each day to maintain, lose, or gain weight at a chosen rate.</p>
				<?php if ($result_cal->gain) { ?>
					<p><a href="#" class="show-wgain">Show info for weight gain</a></p><?php } ?>
			</div>
			<div class="calories-col">
				<ul>
					<?php if ($result_cal->loss) {
						foreach ($result_cal->loss as $rc) {
							?>
							<li>
								<p><?php echo $rc->name; ?> <small class="has-ssmall-font-size"><?php echo $rc->description; ?></small>
								</p>
								<p><b><?php echo number_format($rc->calorie); ?></b><span>100%</span><small
										class="has-ssmall-font-size"><?php echo $unit_label; ?>/day</small>
								</p>
							</li>
						<?php }
					}
					if ($result_cal->gain) {
						foreach ($result_cal->gain as $rc) {
							?>
							<li class="result-gain lhide">
								<p><?php echo $rc->name; ?> <small class="has-ssmall-font-size"><?php echo $rc->description; ?></small>
								</p>
								<p><b><?php echo number_format($rc->calorie); ?></b><span>100%</span><small
										class="has-ssmall-font-size"><?php echo $unit_label; ?>/day</small>
								</p>
							</li>
						<?php }
					} ?>
				</ul>
			</div>
		</div>
		<?php if ($zigzag_schedule_1 || $zigzag_schedule_2) { ?>
			<h3>Zigzag Calorie Cycling:</h3>
			<p>As you keep a low-calorie diet, your body will likely adapt to the new, lower energy environment, which can lead to a
				plateau in your progress. </p>
			<p>Zigzag calorie cycling, also known as a "zigzag diet," is a method of calorie consumption that can potentially help
				you overcome this plateau and get you back on track to meeting your goals. <a href="#zigzag">Click here</a> to learn
				more about zigzag diet. The following are two sample 7-day Zigzag calorie cycling schedules.</p>
			<?php if ($zigzag_schedule_1) {
				$mild_weight = $zigzag_schedule_1->mild_weight;
				$weight_loss = $zigzag_schedule_1->weight_loss;
				$extreme_loss = $zigzag_schedule_1->extreme_loss;
				?>
				<h4>Zigzag diet schedule 1</h4>
				<div class="medical-table">
					<figure class="wp-block-table">
						<table>
							<tr>
								<td>Activity level</td>
								<?php if ($mild_weight) { ?>
									<td>Mild weight loss</td><?php } ?>
								<?php if ($weight_loss) { ?>
									<td>Weight loss</td><?php } ?>
								<?php if ($extreme_loss) { ?>
									<td>Extreme weight loss</td><?php } ?>
							</tr>
							<?php if ($mild_weight) {
								foreach ($mild_weight as $m => $mw) {
									?>
									<tr>
										<td><?php echo $mw->title; ?></td>
										<td><?php echo number_format($mw->calorie); ?> Calories</td>
										<?php if ($weight_loss) { ?>
											<td><?php echo number_format($weight_loss[$m]->calorie); ?> 							<?php echo $unit_label; ?></td><?php } ?>
										<?php if ($extreme_loss) { ?>
											<td><?php echo number_format($extreme_loss[$m]->calorie); ?> 							<?php echo $unit_label; ?></td><?php } ?>
									</tr>
								<?php }
							} ?>
						</table>
					</figure>
				</div>
			<?php }
			if ($zigzag_schedule_2) {
				$mild_weight = $zigzag_schedule_2->mild_weight;
				$weight_loss = $zigzag_schedule_2->weight_loss;
				$extreme_loss = $zigzag_schedule_2->extreme_loss;
				?>
				<h4>Zigzag diet schedule 2</h4>
				<div class="medical-table">
					<figure class="wp-block-table">
						<table>
							<tr>
								<td>Activity level</td>
								<?php if ($mild_weight) { ?>
									<td>Mild weight loss</td><?php } ?>
								<?php if ($weight_loss) { ?>
									<td>Weight loss</td><?php } ?>
								<?php if ($extreme_loss) { ?>
									<td>Extreme weight loss</td><?php } ?>
							</tr>
							<?php if ($mild_weight) {
								foreach ($mild_weight as $m => $mw) {
									?>
									<tr>
										<td><?php echo $mw->title; ?></td>
										<td><?php echo number_format($mw->calorie); ?> 						<?php echo $unit_label; ?></td>
										<?php if ($weight_loss) { ?>
											<td><?php echo number_format($weight_loss[$m]->calorie); ?> 							<?php echo $unit_label; ?></td><?php } ?>
										<?php if ($extreme_loss) { ?>
											<td><?php echo number_format($extreme_loss[$m]->calorie); ?> 							<?php echo $unit_label; ?></td><?php } ?>
									</tr>
								<?php }
							} ?>
						</table>
					</figure>
				</div>
			<?php }
		} ?>
		<h3>Activity Level:</h3>
		<p>Another effective way to lose weight, aside from reducing calorie intake, is increasing your activity level. The
			following is a general list of estimated weight lost based on varying activity levels and the maintenance intake of
			2,549 calories per day.</p>
		<div class="medical-table">
			<figure class="wp-block-table">
				<table>
					<tr>
						<td>Activity level</td>
						<td>Mild weight loss</td>
					</tr>
					<tr>
						<td>Daily exercise, or intense exercise 3-4 times per week</td>
						<td>0.4 lb</td>
					</tr>
					<tr>
						<td>Intense exercise 6-7 times per week</td>
						<td>1.3 lb</td>
					</tr>
					<tr>
						<td>Very intense exercise daily, or a highly physical job</td>
						<td>2.2 lb</td>
					</tr>
				</table>
			</figure>
		</div>
		<?php
		$result_get = ob_get_clean();
		echo json_encode($result_get);
		exit;
	}
}