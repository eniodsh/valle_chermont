<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title>2º IRTDPJ Valle Chermont</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css(array('app'));

		echo $this->fetch('meta');
		echo $this->Html->css(array('app', 'slick'));
		echo $this->fetch('script');
	?>
	<?php echo $this->Html->script('bower_components/modernizr/modernizr') ?>
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta2/css/all.css">
</head>
<body class="<?php echo $this->fetch('bodyClass') ?>">
	<div data-offcanvas="data-offcanvas" class="off-canvas-wrap">
	<header>
		<?php echo $this->Flash->render(); ?>
        <?php echo $this->element('top') ?>
    </header>

	<div id="content">

		<?php echo $this->fetch('content'); ?>
	</div>

	<footer id="footer">
        <?php echo $this->element('footer') ?>
    </footer>
</div>
	
	<?php echo $this->element('sql_dump'); ?>

	<!-- Grab Google CDN's jQuery, fall back to local if offline -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/libs/jquery-2.0.2.min.js"><\/script>')</script>
    <?php echo $this->Html->script(array('bower_components/foundation/js/foundation.min', 'admin/libs/jquery.meio.mask.min', 'bower_components/foundation/js/foundation/foundation.abide', 'bower_components/foundation/js/foundation/foundation.alert', 'bower_components/foundation/js/foundation/foundation.magellan', 'slick', 'app')); ?>
    <?php echo $this->fetch('script'); ?> 
</body>
</html>
