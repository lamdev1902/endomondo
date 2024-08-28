<?php
function bmi_call_shortcode($info) {
	$curl = curl_init();
	$info = json_encode($info);
	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://dev.ehproject.org/wp-json/api/v1/bmi-calculate/',
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
function create_shortcode_tool_bmi($args, $content) {
	ob_start();
	?>
    <div id="calculate">
        <div class="container">
			<div id="spinner"></div>
            <div class="wrapper">
                <div class="wrapper__content">
				<div class="content-top">
					<h4>Input Your Information Below </h4>
                        <form action="#" class="form" id="bmiCalculate">
                            <div class="column">
                                <div class="label-wrapper img">
                                    <label for="male" class="label">Gender <img src="<?=get_template_directory_uri() . '/shortcode/calorie/assets/images/calories-note.svg'?>" alt=""></label>
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
                                    <label for="male" class="label">Weight</label>
                                </div>
                                <div class="text-wrapper">
                                        <div class="text-wrapper__item only-one">
                                            <input type="text"  class="" value="" name="info[weight]" id="weight">
                                            <div class="place-holder">
                                                <span>pounds</span>
                                            </div>
                                        </div>
                                        <span style="" class="weight-error error"></span>
                                    </div>
                            </div>
							<div class="column">
                              <div class="label-wrapper">
                                    <label for="male" class="label">Age</label>
								  <p style="color: #5D5D5D;">Ages: 2-120</p>
                            </div>
                                <div class="text-wrapper">
                                        <div class="text-wrapper__item only-one">
                                            <input type="text"  class="" value="" name="info[age]" id="age">
                                            <div class="place-holder">
                                                <span>years</span>
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
              <div class="action odd">
                                <button id="btn"  class="btn-primary" type="submit">
                                    Calculate
                                </button>
								<button type="button" id="btnClear" class="calories-clear">Clear</button>
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
	wp_enqueue_style( 'tool-css', get_template_directory_uri() . '/shortcode/calorie/assets/css/tool.css','','1.0');
	wp_enqueue_script( 'bmi-js', get_template_directory_uri() . '/shortcode/calorie/assets/js/bmi-tool.js','','1.0.0');
	wp_enqueue_script( 'validate-js', get_template_directory_uri() . '/shortcode/calorie/assets/js/jquery.validate.min.js','','1.0.0');
	return $rt;
}
add_shortcode( 'hc_tool_bmi', 'create_shortcode_tool_bmi' );
/* call ajax tool */
function is_ajax_bmi_tool(){
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}
add_action('init', 'get_bmi_tool');
function get_bmi_tool() {
		if(isset($_GET['get_bmi_tool']) && is_ajax_bmi_tool()){
		$info = $_GET["jsonData"];
		$tool_result = bmi_call_shortcode($info);
		$result_bmi = $tool_result->bmi;

        
        $bmi = $result_bmi->bmi;
        

        if($bmi < 16)
        {
            $angel =  ( 16 - $bmi ) * 6;
        }

        if($bmi < 16){
            $color = "#F83A2A";
        }else if($bmi < 17)
        {
            $color = "#EF7A34";
        }else if($bmi < 18.5)
        {
            $color = "#FFC727";
        }else if($bmi >= 18.5 && $bmi < 25)
        {
            $color = "#4DDBC3";
        }else if($bmi >= 25 && $bmi < 30){
            $color = "#EDB003";
        }else if($bmi >= 30 && $bmi < 35){
            $color = "#F55C00";
        }else if($bmi >= 35 && $bmi < 40){
            $color = "#ED2E1E";
        }else if($bmi >= 40){
            $color = "#AE291D";
        }

        $i = $bmi / 5 * 0.6 + $bmi / 5;

        $angle = $bmi * 3.7 + $i;

		ob_start();
		?>
			<div class="title">
				<h2>Result</h2>
			</div>
			<div class="result flex-row full-width">
				<div class="result-left">
                    <div class="main-result"><h3>BMI: <?= $result_bmi->bmi . " kg/m2 " . " <strong style='color: $color'>[" . $result_bmi->description . "]</strong>"  ?></h3>  </div>
                    <div class="range" style="position: relative;">
                        <img src="<?= get_template_directory_uri() . '/shortcode/calorie/assets/images/rule.svg'?> " alt="" class="" style="position: absolute;left: -6px;top: -17px;width: 360px;">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="163px" viewBox="0 0 300 163">
                            <g transform="translate(2.5,20)" style="font-family:arial,helvetica,sans-serif;font-size: 12px;">
                                <defs>
                                    <marker id="arrowhead" markerWidth="10" markerHeight="7" refX="0" refY="3.5" orient="auto">
                                        <polygon points="0 0, 10 3.5, 0 7"></polygon>
                                    </marker>
                                    <path id="curvetxt1" d="M67 104 A140 140, 0, 0, 1, 320 130" style="fill: none;"></path>
                                    <path id="curvetxt2" d="M114 61 A140 140, 0, 0, 1, 277 140" style="fill: #none;"></path>
                                    <path id="curvetxt3" d="M147 57 A140 140, 0, 0, 1, 245 142" style="fill: #none;"></path>
                                    <path id="curvetxt4" d="M197 81 A140 140, 0, 0, 1, 225 140" style="fill: #none;"></path>
                                </defs>
                                <path d="M0 140 A140 140, 0, 0, 1, 77.9 15 L140 140 Z" fill="#F83A2A"></path>
                                <path d="M88 10.2 A140 140, 0, 0, 1, 77.9 14.9 L140 140 Z" fill="#EF7A34"></path>
                                <!-- <path d="M6.9 96.7 A140 140, 0, 0, 1, 12.1 83.1 L140 140 Z" fill="#d38888"></path> -->
                                <path d="M92.7 8.4 A140 140, 0, 0, 1, 88 10.2 L140 140 Z" fill="#FFC727"></path>                                
                                <!-- <path d="M12.1 83.1 A140 140, 0, 0, 1, 22.6 63.8 L140 140 Z" fill="#ffe400"></path> -->
                                <!-- <path d="M22.6 63.8 A140 140, 0, 0, 1, 96.7 6.9 L140 140 Z" fill="#008137"></path> -->
                                <path d="M92.2 8.7 A140 140, 0, 0, 1, 165.5 2.4 L140 140 Z" fill="#4DDBC3"></path>
                                <!-- <path d="M96.7 6.9 A140 140, 0, 0, 1, 169.1 3.1 L140 140 Z" fill="#ffe400"></path> -->
                                <path d="M165.5 2.3 A140 140, 0, 0, 1, 210.7 19 L140 140 Z" fill="#EDB003"></path>
                                <path d="M210.7 19 A140 140, 0, 0, 1, 248.1 50 L140 140 Z" fill="#F55C00"></path>
                                <path d="M248 50 A140 140, 0, 0, 1, 272.1 92.7 L140 140 Z" fill="#ED2E1E"></path>
                                <!-- <path d="M273.1 96.7 A140 140, 0, 0, 1, 280 140 L140 140 Z" fill="#8a0101"></path> -->
                                <path d="M271.5 91 A140 140, 0, 0, 1, 280 140 L140 140 Z" fill="#AE291D" class=""></path>
                                <path d="M45 140 A90 90, 0, 0, 1, 230 140 Z" fill="#fff" class=""></path>
                                <circle cx="140" cy="140" r="5" fill="#666"></circle>
                                <g style="paint-order: stroke;stroke: #fff;stroke-width: 2px; font-size: 10px;">
                                    <text x="108" y="90" transform="rotate(-27, 24, 108)">16</text>
                                    <text x="114" y="71" transform="rotate(-27, 30, 96)">17</text>
                                    <text x="97" y="20" transform="rotate(-18, 97, 29)">18.5</text>
                                    <text x="157" y="20" transform="rotate(12, 157, 20)">25</text>
                                    <text x="204" y="20" transform="rotate(35, 181, 17)">30</text>
                                    <text x="236" y="45" transform="rotate(42, 214, 45)">35</text>
                                    <text x="252" y="95" transform="rotate(72, 252, 95)">40</text>
                                </g>
                                <g style="font-size: 8px;">
                                    <text>
                                        <textPath xlink:href="#curvetxt1">Underweight</textPath>
                                    </text>
                                    <text>
                                        <textPath xlink:href="#curvetxt2">Normal</textPath>
                                    </text>
                                    <text>
                                        <textPath xlink:href="#curvetxt3">Overweight</textPath>
                                    </text>
                                    <text>
                                        <textPath xlink:href="#curvetxt4">Obesity</textPath>
                                    </text>
                                </g>
                                <line x1="140" y1="140" x2="65" y2="140" stroke="#666" stroke-width="2" marker-end="url(#arrowhead)">
                                    <animateTransform attributeName="transform" attributeType="XML" type="rotate" from="0 140 140" to="<?=$angle?> 140 140" dur="1s" fill="freeze" repeatCount="1"></animateTransform>
                                </line>
                            </g>
                        </svg>
                    </div>
                    <div class="description-range">
                        <div class="severe">
                            <div style="background: #F83A2A" class=""></div>
                            <div class=""><p class="number">< 16</p></div>
                        </div>
                        <div class="moderate">
                            <div style="background: #EF7A34" class=""></div>
                            <div class=""><p class="number">16-17</p></div>
                        </div>
                        <div class="mild">
                            <div style="background: #FFC727" class=""></div>
                            <div class=""><p class="number">17-18.5</p></div>
                        </div>
                        <div class="normal">
                            <div style="background: #4DDBC3" class=""></div>
                            <div class=""><p class="number">18.5-25</p></div>
                        </div>
                        <div class="overweight">
                            <div style="background: #EDB003" class=""></div>
                            <div class=""><p class="number">25-30</p></div>
                        </div>
                        <div  class="obese-1">
                            <div  style="background: #F55C00" class=""></div>
                            <div class=""><p class="number">30-35</p></div>
                        </div>
                        <div  class="obese-2">
                            <div style="background: #ED2E1E" class=""></div>
                            <div class=""><p class="number">35-40</p></div>
                        </div>
                        <div  class="obese-2">
                            <div style="background: #AE291D" class=""></div>
                            <div class=""><p class="number">> 40</p></div>
                        </div>
                    </div>
                </div>
                <div class="result-right">
                    <ul>
                        <li><span>Healthy BMI range:</span><span><strong><?= $result_bmi->healthy_range ?></strong></span></li>
                        <li><span>Healthy weight for the height: </span><span><strong><?= $result_bmi->ideal_weight ?></strong></span></li>
                        <?php 
                            if($result_bmi->propose)
                            {
                                echo "<li>". $result_bmi->propose->title . "<strong>" . $result_bmi->propose->result . " lbs </strong>" . " to reach a BMI of <strong>25 kg/m2</strong>" . "</li>";
                            }
                        ?>
                        <li><span>BMI Prime: </span><span><strong><?=$result_bmi->prime?></strong><span></li>
                        <li><span>Ponderal Index: </span><span><strong><?=$result_bmi->ponderal . " kg/m3"?></strong></span></li>
                    </ul>
                </div>
			</div>
		<?php
		$result_get = ob_get_clean();
		echo json_encode($result_get);
		exit;
	}
}