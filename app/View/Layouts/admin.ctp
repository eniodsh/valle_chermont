<!doctype html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" lang="en"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" lang="en"><!--<![endif]-->
<head>
  <?php echo $this->Html->charset(); ?>
  <title><?php echo $this->fetch('title'); ?> :: Área Administrativa</title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <?php
    echo $this->fetch('meta');
    echo $this->Html->meta('icon');
    echo $this->Html->css(array(
        'admin/libs/bootstrap.min',
        'admin/libs/bootstrap-responsive.min',
        'admin/admin',
    )), $this->fetch('css');
  ?>

  <!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script><![endif]-->
  <script>window.html5 || document.write('<script src="<?php echo $this->Html->url('/js/admin/libs/html5shiv.min.js') ?>"><\/script>')</script>
  <script>
    var www_root;
    www_root = "<?php echo $this->Html->url('/') ?>";
  </script>
</head>
<body>
  <div class="navbar navbar-fixed-top navbar-inverse">
    <div class="navbar-inner">
      <div class="container-fluid">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>

        <?php echo
          $this->Html->image('admin/logo-admin.png', array('alt' => 'Part', 'class' => 'brand logo-part')),
          $this->Html->link('Área administrativa', '/admin/', array('class' => 'brand'))
        ?>

        <div class="nav-collapse">
          <?php echo $this->element('admin/menu_superior') ?>
          <p class="navbar-text pull-right">
            Bem-vindo, <?php echo AuthComponent::user('nome') ? AuthComponent::user('nome') : AuthComponent::user('usuario') ?>
            <span class="divider-vertical"></span>
            <i class="icon-off icon-white"></i>
            <?php echo $this->Html->link('Sair', '/admin/usuarios/logout') ?>
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid clearfix">
    <div class="row-fluid">
      <?php echo $this->element('admin/menu_lateral') ?>
      <div id="content" class="<?php echo $this->fetch('menu') != '' ? 'span9' : 'span12' ?>">
        <?php echo $this->fetch('content') ?>
      </div>
    </div>

    <hr />

    <footer>
      <p>&copy; Part Comunicação <?php echo date('Y') ?></p>
      <?php //echo $this->element('sql_dump') ?>
    </footer>
  </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo $this->Html->url('/js/admin/libs/jquery-1.7.1.min.js') ?>"><\/script>')</script>

    <?php
    // adiciona os scripts para todas as paginas
    echo $this->Html->script(array(
        'admin/libs/bootstrap.min',
        'admin/libs/ckeditor/ckeditor',
        'admin/libs/ckfinder/ckfinder',
        'admin/libs/jquery.meio.mask.min',
        'admin/libs/jquery.stringToSlug.min',
        'admin/admin'
    )), $this->fetch('script');

    // adiciona os scripts em paginas especificas
    switch ($this->params['controller']) {
        case 'banners' :
            echo $this->Html->script(array('admin/banners/form'));
            break;
        case 'noticias' :
            echo $this->Html->script(array('admin/noticias/form'));
            break;
    }
    ?>
</body>
</html>
