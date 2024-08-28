<?php
function lean_body_mass_call_shortcode($info) {
	$curl = curl_init();
	$info = json_encode($info);
	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://dev.ehproject.org/wp-json/api/v1/lean-body-mass-calculate/',
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
function create_shortcode_tool_lean_body_mass($args, $content) {
	ob_start();
	?>
	<div id="spinner"></div>
    <div id="calculate">
        <div class="container">
            <div class="wrapper">
                <div class="wrapper__content">
                    <div class="content-top">
                        <form action="#" class="form lean-body-calculate" id="leanBodyMass">
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
                                <div class="label-wrapper img">
                                    <label for="male" class="label">Age 14 or younger</label>
                                </div>
                                <div class="radio-wrapper">
                                    <div class="radio-wrapper__item">
                                        <input type="radio" checked class="radio-wrapper__btn" value="1" name="info[age]" id="age1">
                                        <label for="age1" class="radio-wrapper__label">
                                            <span class="radio-visibility"></span>
                                            Yes
                                        </label>
                                    </div>
                                    <div class="radio-wrapper__item">
                                        <input type="radio" class="radio-wrapper__btn" value="2" name="info[age]" id="age2">
                                        <label for="age2" class="radio-wrapper__label">
                                            <span class="radio-visibility"></span>
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="column">
                                <div class="label-wrapper">
                                    <label for="male" class="label">Weight</label>
                                </div>
                                <div class="text-wrapper">
                                        <div class="text-wrapper__item only-one">
                                            <input type="text"  class="" value="" name="info[weight]" id="weight">
                                            <div class="place-holder">
                                                <span>Pounds</span>
                                            </div>
                                        </div>
                                        <span style="" class="weight-error error"></span>
                                    </div>
                            </div>
                            <div class="column">
                                <div class="label-wrapper">
                                    <label for="" class="label">Height</label>
                                </div>
                                <div class="text-wrapper">
                                    <div class="text-wrapper__item us">
                                        <div class="height-ft">
                                            <input type="text" class="radio-wrapper__btn" value="" name="info[height][feet]" id="heightFt">
                                            <div class="place-holder">
                                                <span>ft</span>
                                            </div>
                                        </div>
                                        <div class="height-in">
                                            <input type="text" class="radio-wrapper__btn" value="" name="info[height][inches]" id="heightIn">
                                            <div class="place-holder">
                                                <span>in</span>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="height-error error"></span>
                                </div>
                            </div>
                            <div class="action">
                                <button id="btnLeanBody" class="btn-primary" type="submit">
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
	wp_enqueue_script( 'lean-body-mass-js', get_template_directory_uri() . '/shortcode/calorie/assets/js/lean-body-mass-tool.js','','1.0.0');
	wp_enqueue_script( 'validate-js', get_template_directory_uri() . '/shortcode/calorie/assets/js/jquery.validate.min.js','','1.0.0');
	return $rt;
}
add_shortcode( 'hc_tool_lean_body_mass', 'create_shortcode_tool_lean_body_mass' );
/* call ajax tool */
function is_ajax_lean_body_mass_tool(){
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}
add_action('init', 'get_lean_body_mass_tool');
function get_lean_body_mass_tool() {
		if(isset($_GET['get_lean_body_mass_tool']) && is_ajax_lean_body_mass_tool()){
		$info = $_GET["jsonData"];
		$tool_result = lean_body_mass_call_shortcode($info);
		$result = $tool_result->lean_body_mass;
		ob_start();
		?>
            <div class="title">
				<h2>Result</h2>
			</div>
            <div class="result">
                <div class="flex-column lean-body-table">
                    <div class="goals">
                        <table class="lean-body">
                            <tbody>
                                <tr>
                                    <td>Formular</td>
                                    <td>Lean Body</td>
                                    <td>Body Fat</td>
                                </tr>
                                <?php foreach($result as $item):?>
                                <tr>
                                    <td><?= $item->title?></td>
                                    <td><?= $item->score . " ( " . $item->percent . "% )"?></td>
                                    <td><?= $item->body_fat?></td>
                                </tr>
                                <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
        <?php
		$result_get = ob_get_clean();
		echo json_encode($result_get);
		exit;
	}
}