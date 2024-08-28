<?php
function army_body_fat_call_shortcode($info) {
	$curl = curl_init();
	$info = json_encode($info);
	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://dev.ehproject.org/wp-json/api/v1/army-body-fat-calculate/',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_POSTFIELDS =>$info,
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
function create_shortcode_tool_army_body_fat($args, $content) {
	ob_start();
	?>
	<div id="spinner"></div>
    <div id="calculate">
        <div class="container">
            <div class="wrapper">
                <div class="wrapper__content">
                    <div class="content-top">
                        <form action="#" class="form lean-body-calculate" id="armyBodyFat">
                            <div class="column">
                                <div class="label-wrapper img">
                                    <label for="male" class="label">Gender</label>
                                </div>
                                <div class="radio-wrapper">
                                    <div class="radio-wrapper__item">
                                        <input type="radio" checked class="radio-wrapper__btn" value="1" name="info[gender]" id="male">
                                        <label for="male" class="radio-wrapper__label">
                                            <span class="radio-visibility"></span>
                                            Male
                                        </label>
                                    </div>
                                    <div class="radio-wrapper__item">
                                        <input type="radio" class="radio-wrapper__btn" value="2" name="info[gender]" id="female">
                                        <label for="female" class="radio-wrapper__label">
                                            <span class="radio-visibility"></span>
                                            Female
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="column">
                                <div class="label-wrapper">
                                    <label for="male" class="label">Age</label>
                                </div>
                                <div class="text-wrapper">
                                    <div class="text-wrapper__item only-one">
                                        <input type="text"  class="" value="" name="info[age]" id="age">
                                        <div class="place-holder">
                                            <span>Years</span>
                                        </div>
                                    </div>
                                    <span style="" class="age-error error"></span>
                                </div>
                            </div>
                            <div class="column">
                                <div class="label-wrapper">
                                    <label for="" class="label">Height</label>
                                </div>
                                <div class="text-wrapper">
                                    <div class="text-wrapper__item us">
                                        <div class="place height-ft">
                                            <input type="text" class="radio-wrapper__btn" value="" name="info[height][feet]" id="heightFt">
                                            <div class="place-holder">
                                                <span>ft</span>
                                            </div>
                                        </div>
                                        <div class="place height-in">
                                            <input type="text" class="radio-wrapper__btn" value="" name="info[height][inches]" id="heightIn">
                                            <div class="place-holder">
                                                <span>in</span>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="height-error error"></span>
                                </div>
                            </div>
                            <div class="column">
									<div class="label-wrapper">
										<label for="" class="label">Neck</label>
									</div>
									<div class="text-wrapper">
										<div class="text-wrapper__item us">
											<div class="place neck-ft">
												<input type="text" class="radio-wrapper__btn" value="" name="info[neck][feet]" id="neckFt">
												<div class="place-holder">
													<span>ft</span>
												</div>
											</div>
											<div class="place neck-in">
												<input type="text" class="radio-wrapper__btn" value="" name="info[neck][inches]" id="neckIn">
												<div class="place-holder">
													<span>in</span>
												</div>
											</div>
										</div>
										<span class="neck-error error"></span>
									</div>
								</div>
								<div class="column">
									<div class="label-wrapper">
										<label for="" class="label">Waist</label>
									</div>
									<div class="text-wrapper">
										<div class="text-wrapper__item us">
											<div class="place waist-ft">
												<input type="text" class="radio-wrapper__btn" value="" name="info[waist][feet]" id="waistFt">
												<div class="place-holder">
													<span>ft</span>
												</div>
											</div>
											<div class="place waist-in">
												<input type="text" class="radio-wrapper__btn" value="" name="info[waist][inches]" id="waistIn">
												<div class="place-holder">
													<span>in</span>
												</div>
											</div>
										</div>
										<span class="waist-error error"></span>
									</div>
								</div>
								<div class="column hip inactive">
									<div class="label-wrapper">
										<label for="" class="label">Hip</label>
									</div>
									<div class="text-wrapper">
										<div class="text-wrapper__item us">
											<div class="place hip-ft">
												<input type="text" class="radio-wrapper__btn" value="" name="info[hip][feet]" id="hipFt">
												<div class="place-holder">
													<span>ft</span>
												</div>
											</div>
											<div class="place hip-in">
												<input type="text" class="radio-wrapper__btn" value="" name="info[hip][inches]" id="hipIn">
												<div class="place-holder">
													<span>in</span>
												</div>
											</div>
										</div>
										<span class="hip-error error"></span>
									</div>
								</div>
                            <div class="action">
                                <button id="btnLeanBody"  class="btn-primary" type="submit">
                                    Calculate
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="content-bottom">
                    </div>
                </div>
            </div>
        </div>
    </div>
	<?php 
	$rt = ob_get_clean();
	wp_enqueue_style( 'tool-css', get_template_directory_uri() . '/shortcode/calorie/assets/css/tool.css','','1.0.0');
	wp_enqueue_script( 'army-body-fat-js', get_template_directory_uri() . '/shortcode/calorie/assets/js/army-body-fat-tool.js','','1.0.0');
	wp_enqueue_script( 'validate-js', get_template_directory_uri() . '/shortcode/calorie/assets/js/jquery.validate.min.js','','1.0.1');
	return $rt;
}
add_shortcode( 'hc_tool_army_body_fat', 'create_shortcode_tool_army_body_fat' );
/* call ajax tool */
function is_ajax_army_body_fat_tool(){
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}
add_action('init', 'get_army_body_fat_tool');
function get_army_body_fat_tool() {
    if(isset($_GET['get_army_body_fat_tool']) && is_ajax_army_body_fat_tool()){
		$info = $_GET["jsonData"];
		$tool_result = army_body_fat_call_shortcode($info);
		$result = $tool_result->army_bodyfat;

        $score = $result->score;
        $description = $result->description;

        unset($result->score);
        unset($result->description);
		ob_start();
		?>
            <div class="title">
				<h2>Result</h2>
			</div>
			<div class="result">
                <div class="main-result">
                    <h3>Body Fat: <span class="primary-title"><?= $score ?>%</span> <?=$description?></h3>  
                </div>
                <?php if($info['info']['gender'] == 1 && $result): ?>
                    <div class="result">
                        <div class="flex-column lean-body-table">
                            <div class="goals">
                                <table class="lean-body">
                                    <tbody>
                                        <tr>
                                            <td>Goal</td>
                                            <td>Body Fat Reduction Needed</td>
                                            <td>Equivalent Body Fat Reduction for a 140-Pound Person</td>
                                        </tr>
                                        <?php foreach($result as $item):?>
                                        <tr>
                                            <td><?= $item->title?></td>
                                            <td><?= $item->percent . " %"?></td>
                                            <td><?= $item->pounds . " pounds"?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php
		$result_get = ob_get_clean();
		echo json_encode($result_get);
		exit;
	}
}