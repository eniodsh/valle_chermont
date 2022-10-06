<div class="faixa_top_header">
	<div class="central">
		<ul class="box_redes">
			<li>
				<a href="#" target="_blank">
					<i class="fab fa-whatsapp"></i>
				</a>
			</li>
			<li>
				<a href="#" target="_blank">
					<i class="fab fa-instagram"></i>
				</a>
			</li>
			<li>
				<a href="#" target="_blank" style="font-size: 21px;padding-top: 4px;">
					<i class="fab fa-facebook-f"></i>
				</a>
			</li>
		</ul>
		<a href="#" target="_blank" class="link_tel">
			<i class="fa fa-phone"></i> <span>(61) 3000-0000</span>
		</a>
	</div>
</div>
<div class="top_header">
	<div class="central">
		<h1>
			<?php echo $this->Html->image('marca.png', array('url' =>"/",'alt' => __("Irtdpj Pará"))) ?>
		</h1>
		<nav class="top-bar" data-topbar role="navigation" data-options="is_hover: false">
			<ul class="title-area">
			  
			   <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
			  <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
			</ul>

			<section class="top-bar-section">
			  <div>
			    <ul>
			      <li class="has-dropdown">
			        <a href="#" title="Sobre">Sobre</a>
			        <ul class="dropdown">
	        			<li class="title back js-generated">
        					<h5><a href="javascript:void(0)"><i class="fa-solid fa-chevrons-left"></i> VOLTAR</a></h5>
	        			</li>	
						<li><?php echo $this->Html->link('Quem somos', '/pages/quem-somos', array('class' => $this->request->params['action'] == 'index' && $this->request->params['controller'] == 'quem-somos' ? 'quem-somos' : '')); ?></li>
						<li><?php echo $this->Html->link('O cartório', '/pages/cartorio', array('class' => $this->request->params['action'] == 'index' && $this->request->params['controller'] == 'cartorio' ? 'cartorio' : '')); ?></li>
						<li><?php echo $this->Html->link('LGPD', '/pages/lgpd', array('class' => $this->request->params['action'] == 'index' && $this->request->params['controller'] == 'lgpd' ? 'lgpd' : '')); ?></li>
						<li><?php echo $this->Html->link('Transparência', '/pages/transparencia', array('class' => $this->request->params['action'] == 'index' && $this->request->params['controller'] == 'transparencia' ? 'transparencia' : '')); ?></li>
						<li><?php echo $this->Html->link('Política de Privacidade', '/pages/politica', array('class' => $this->request->params['action'] == 'index' && $this->request->params['controller'] == 'politica' ? 'politica' : '')); ?></li>
			        </ul>
			      </li>
			      <li><?php echo $this->Html->link('Serviços', '/pages/servicos', array('class' => $this->request->params['action'] == 'index' && $this->request->params['controller'] == 'servicos' ? 'servicos' : '')); ?></li>
			      <li><?php echo $this->Html->link('Notícias', '/pages/noticias', array('class' => $this->request->params['action'] == 'index' && $this->request->params['controller'] == 'noticias' ? 'noticias' : '')); ?></li>
			      <li><?php echo $this->Html->link('Tabelha de Emolumentos', 'https://irtdpjbrasil.org.br/files/emolumento/PR-Tabela-Atualizada-Extrajudicial.pdf', array('target' =>"_blank",'class' => $this->request->params['action'] == 'index' && $this->request->params['controller'] == 'emolumentos' ? 'emolumentos' : '')); ?></li>
  			      <li><?php echo $this->Html->link('Links úteis', '/pages/links-uteis', array('class' => $this->request->params['action'] == 'index' && $this->request->params['controller'] == 'links-uteis' ? 'links-uteis' : '')); ?></li>
			      <li><?php echo $this->Html->link('Contato', '/pages/contato', array('class' => $this->request->params['action'] == 'index' && $this->request->params['controller'] == 'contato' ? 'contato' : '')); ?></li>
			    </ul>
			  </div>
			</section>
		</nav>
	</div>
</div>