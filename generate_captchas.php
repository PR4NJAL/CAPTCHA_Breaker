<?php
define('WP_USE_THEMES', false);
//require('./wp-load.php');
require_once('really-simple-captcha.2.3/really-simple-captcha.php');
$captcha = new ReallySimpleCaptcha();
$captcha->chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
$captcha->length = 6;
$captcha->img_size = array(150, 60);
$output_dir = 'captcha_dataset/';
if (!file_exists($output_dir)) {
    mkdir($output_dir, 0755, true);
}
$num_captcha = 10000;
for ($i = 0; $i < $num_captcha; $i++) {
    $word = $captcha->generate_random_word();
    $prefix = mt_rand();
    $captcha->generate_image($prefix, $word);
    $image_file = $captcha->tmp_dir . $prefix . '.png';
    $label_file = $output_dir . $prefix . '.txt';
    $new_image_file = $output_dir . $prefix . '.png';
    rename($image_file, $new_image_file);
    file_put_contents($label_file, $word);
}
echo "Generate $num_captcha CAPTCHA images in $output_dir.";
?>
