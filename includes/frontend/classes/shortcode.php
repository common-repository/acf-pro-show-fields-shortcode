<?php

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

class MXASTS_Shortcode
{

	/*
	* MXASTS_Shortcode
	*/
	public function __construct()
	{
	}

	/*
	* Registration of styles and scripts
	*/
	public static function mxasts_register_shortcode()
	{

		// register shortcode
		add_shortcode('mxasts_acfp_show_field', array('MXASTS_Shortcode', 'mxasts_acfp_show_field_function'));
	}

	public static function mxasts_acfp_show_field_function($atts)
	{

		// [mxasts_acfp_show_field debug="true" get_field="card" show_all_fields="true"]

		if ($atts == '') {

			return;
		}

		$debug = $atts['debug'];

		$get_field = $atts['get_field'];

		// all fields
		$show_all_fields = $atts['show_all_fields'];

		ob_start();

		// debuging
		if ($debug == 'true') {

			echo '<pre>';

			echo 'Debugging mode<br>';

			var_dump('debug = ' . $debug);

			echo '<br>';

			var_dump('get_field = ' . $get_field);

			echo '<br>';

			echo 'get_field value = ';

			var_dump(get_field($get_field));

			echo '<br>';

			echo 'get_fields = ';

			var_dump(get_fields());

			echo '<br><br>';

			echo '</pre>';
		}		

		// show all fields
		if ($show_all_fields == 'true') { ?>

			<ul>

				<?php foreach (get_fields() as $key => $value) : ?>

					<?php if ($value !== '') : ?>

						<li>

							<?php if (is_array($value)) : ?>

								<ul>
									<?php foreach ($value as $_key => $_value) : ?>

										<li>

											<?php if (is_array($_value)) : ?>

												<?php foreach ($_value as $__key => $__value) : ?>

													<ul>
														<li><?php echo $__value; ?></li>
													</ul>

												<?php endforeach; ?>

											<?php else : ?>

												<?php echo $_value; ?>

											<?php endif; ?>

										</li>

									<?php endforeach; ?>

								</ul>

							<?php else : ?>

								<?php echo $value; ?>

							<?php endif; ?>

						</li>

					<?php endif; ?>

				<?php endforeach; ?>

			</ul>

		<?php } else {

			if ($get_field !== NULL) {

				echo get_field($get_field);
				
			}

		}

		?>

<?php return ob_get_clean();
	}
}
