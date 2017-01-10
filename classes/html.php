<?php

class Html 
{
	// показ одного товара в списке корзины
	public static function row_cart($data)
	{
		?>
		<tr valign="top" class="odd">
							<td class="desc">
							<div class="product_teaser product_short_teaser">
								<div class="product_teaser_pic">
									<a href="goods.php?id=<?php echo $data['id_goods'];?>"><img src="<?php echo $data['image']; ?>" alt="<?php echo $data['title']; ?>" title="<?php echo $data['title']; ?>"  class="imagecache imagecache-product_teaser_short" width="59" height="110" /></a>    
								</div>
								<div class="product_teaser_info">
									<h3><a href="goods.php?id=<?php echo $data['id_goods'];?>"><?php echo $data['title']; ?></a></h3>
									<div class="teaser_text">
										<p><?php echo Helper::getFirstSentence($data['description']);?></p>
									</div>
								</div>
							</div>
							</td>
							<td class="price"><span class="uc-price"><?php echo ($data['price']*$data['count']);?> руб.</span>
							</td>
							<td class="qty">
								<div class="form-item" id="edit-items-0-qty-wrapper">
									<input type="text" maxlength="6" form="rform" name="counts[]" id="edit-items-0-qty" size="5" value="<?php echo $data['count'];?>" class="form-text" />
								</div>
							</td>
							
						</tr>
		<?php
	}
	
	// форма оформления заказа
	public static function form_order($data)
	{
		?>
			<div class="clear-block">
                <form action=""  accept-charset="UTF-8" method="post" id="uc-cart-checkout-form">
				<input type="hidden" name="rd" id="edit-mail" value="rd"  />
<div><div id="checkout-instructions"></div>

<fieldset id="comments-pane"><legend>Примечания к заказу</legend><div class="form-item" id="edit-panes-comments-comments-wrapper">
 <textarea cols="60" rows="5" name="cat1" id="edit-panes-comments-comments"  class="form-textarea resizable "><?php echo $data['comment']; ?></textarea>
</div>
</fieldset>
<fieldset id="customer-pane"><div class="form-item" id="edit-panes-customer-primary-email-wrapper">
 <label for="edit-panes-customer-primary-email">Электронный адрес: <span class="form-required" title="Обязательное поле">*</span></label>
 <input type="text" maxlength="64" name="cat2" id="edit-panes-customer-primary-email" size="32" value="<?php echo $data['email']; ?>" class="form-text required" />
</div>
</fieldset>
<fieldset id="delivery-pane"><legend>Кому доставить заказ</legend><div class="description"><span class="form-required">*</span> - поля, обязательные для заполнения</div><div class="address-pane-table"><table><tr><td class="field-label">Организация:</td><td><div class="form-item" id="edit-panes-delivery-delivery-company-wrapper">
 <input type="text" maxlength="64" name="cat3" id="edit-panes-delivery-delivery-company" size="32" value="<?php echo $data['company']; ?>" class="form-text" />
</div>
</td></tr><tr><td class="field-label"><span class="form-required">*</span>Имя:</td><td><div class="form-item" id="edit-panes-delivery-delivery-first-name-wrapper">
 <input type="text" maxlength="32" name="cat4" id="edit-panes-delivery-delivery-first-name" size="32" value="<?php echo $data['name']; ?>" class="form-text required" />
</div>
</td></tr><tr><td class="field-label">Фамилия:</td><td><div class="form-item" id="edit-panes-delivery-delivery-last-name-wrapper">
 <input type="text" maxlength="32" name="cat5" id="edit-panes-delivery-delivery-last-name" size="32" value="<?php echo $data['surname']; ?>" class="form-text required" />
</div>
</td></tr><tr><td class="field-label"><span class="form-required">*</span>Телефон:</td><td><div class="form-item" id="edit-panes-delivery-delivery-phone-wrapper">
 <input type="text" maxlength="32" name="cat6" id="edit-panes-delivery-delivery-phone" size="16" value="<?php echo $data['phone']; ?>" class="form-text required" />
</div>
</td></tr>
<tr><td class="field-label"><span class="form-required">*</span>Город:</td><td><div class="form-item" id="edit-panes-delivery-delivery-city-wrapper">
 <input type="text" maxlength="32" name="cat7" id="edit-panes-delivery-delivery-city" size="32" value="<?php echo $data['city']; ?>" class="form-text required" />
</div>
</td></tr><tr><td class="field-label"><span class="form-required">*</span>Адрес:</td><td><div class="form-item" id="edit-panes-delivery-delivery-street1-wrapper">
 <input type="text" maxlength="64" name="cat8" id="edit-panes-delivery-delivery-street1" size="32" value="<?php echo $data['address']; ?>" class="form-text required" />
</div>
</td></tr><tr><td class="field-label">Почтовый код:</td><td><div class="form-item" id="edit-panes-delivery-delivery-postal-code-wrapper">
 <input type="text" maxlength="10" name="cat9" id="edit-panes-delivery-delivery-postal-code" size="10" value="<?php echo $data['code']; ?>" class="form-text required" />
</div>
</td></tr></table></div></fieldset>
<div id="checkout-form-bottom">
<input type="hidden" name="finish" value="finish">
<input type="submit" name="op" id="edit-continue2" value="Оформить заказ"  class="form-submit" />
<span>или</span> <a href="cart.php" class="uc_continue_shopping_link">Вернуться в корзину</a></div>
</div></form>
                                                                                                                        </div>
		<?php
	}
	
	// навигация по страницам каталога
	public static function pager($count, $id_category, $bonus, $sort, $page)
	{
		if ($count>9) {
		?>
			<div class="pager pager-lower">
				<div class="item-list">
					<ul class="pager">
						<?php 
						for ($i=0; $i<=$count/9; $i++) {
							if ($i!=$page) {
						?>
						<li class="pager-item"><a href="goods.php?cat=<?php echo $id_category;?>&b=<?php echo $bonus;?>&s=<?php echo $sort;?>&p=<?php echo $i?>" title="" class="active"><?php echo $i+1;?></a></li>
						<? } else { ?>
						<li class="pager-current first"><?php echo $i+1;?></li>
						<?php } } ?>
					</ul>
				</div>
			</div>
		<?php 
		}
	}
	
	// меню для каталога сортировки по цене, названию и показ акций, хитов и т.д.
	public static function sort_menu($id_category, $bonus, $sort)
	{
		?>
			<div class="sortbar-1">
				<div class="sortbar-2">
					<div class="sortbar">
						<div class="title sortbar-title">Сортировать по:</div>
						<div class="control sort-title"><a href="goods.php?cat=<?php echo $id_category;?>&b=<?php echo $bonus;?>&s=1" class=" active">Названию</a></div>
						<div class="control sort-price"><a href="goods.php?cat=<?php echo $id_category;?>&b=<?php echo $bonus;?>&s=2" class=" active">Цене</a></div>
						<div class="title type-title">Показывать:</div>
						<div class="control show-new"><a href="goods.php?cat=<?php echo $id_category;?>&b=1&s=<?php echo $sort;?>" class=" active">Новинки</a></div>
						<div class="control show-spec"><a href="goods.php?cat=<?php echo $id_category;?>&b=3&s=<?php echo $sort;?>" class=" active">Акции</a></div>
						<div class="control show-spec"><a href="goods.php?cat=<?php echo $id_category;?>&b=2&s=<?php echo $sort;?>" class=" active">Хиты</a></div>
						<div class="control show-all"><a href="goods.php?cat=<?php echo $id_category;?>&b=0&s=<?php echo $sort;?>" class=" active">Все</a></div>
					</div>
				</div>
			</div>
		<?php
	}
	
	// показ полной информации об одном товаре
	public static function one_full_goods($data, $user)
	{
		if (!empty($data)) {
		?>
	<h1><?php echo $data['title']; ?></h1> 
    <?php if ($user==1) echo '<h3><a href="edit.php?id='.$data['id_goods'].'">Редактировать</a></h3>';?>	
        <div class="clear-block"><div id="node-1855" class="node clear-block">
  <div class="content">
        <div class="mts-product-price-outer">
      <div class="mts-product-price">
        <div class="content">
          <h2>Варианты приобретения</h2>
          <div class="mts_price mts_price_first">
                      <div class="mts_tab_title_wrapper"><div class="mts_tab_title active"><div class="mts_clickable mts_clickable_active first" onclick="if($(this).hasClass('first')){$('.mts_price').addClass('mts_price_first')}else{$('.mts_price').removeClass('mts_price_first')};$('.mts_tab_title.active').removeClass('active');$('.mts_tab_title .mts_clickable').removeClass('mts_clickable_active');$(this).parent().toggleClass('active');$(this).toggleClass('mts_clickable_active');$('.mts_tab_body').hide();$('#mts_tab_body_0').toggle();">Купить</div><div class="price_value"><?php echo $data['price'];?> руб.</div></div><div class="mts_tab_title"><div class="mts_clickable" onclick="if($(this).hasClass('first')){$('.mts_price').addClass('mts_price_first')}else{$('.mts_price').removeClass('mts_price_first')};$('.mts_tab_title.active').removeClass('active');$('.mts_tab_title .mts_clickable').removeClass('mts_clickable_active');$(this).parent().toggleClass('active');$(this).toggleClass('mts_clickable_active');$('.mts_tab_body').hide();$('#mts_tab_body_1').toggle();">Акция</div><div class="price_value"><?php echo round($data['price']*0.8);?> руб.</div></div></div>
            <div class="mts_tab_body_wrapper"><div class="mts_tab_body_wrapper-content"><div class="mts_tab_body mts_hidded active" id="mts_tab_body_0"><div class="rounded_border"><div class="rounded_border-content"><div class="price_name">Цена:</div><div class="price_value"><b><?php echo $data['price'];?></b> руб.</div></div></div><div class="price_desc">При покупке в магазинах или у представителей цена может отличаться</div><div class="cart"><div class="add-to-cart">
			
<form action=""  accept-charset="UTF-8" method="post" id="fcart" class="">
	<div>
	    <input type="hidden" name="id_goods" value="<?php echo $data['id_goods'];?>">
		<input type="submit" name="op"  value="В корзину"  class="form-submit node-add-to-cart"/>
	</div>
</form>

</div></div></div>
<div class="mts_tab_body mts_hidded" id="mts_tab_body_1"><div class="rounded_border"><div class="rounded_border-content"><div class="price_name">Акционная цена:</div><div class="price_value"><b><?php echo round($data['price']*0.8);?></b> руб.</div></div></div><div class="price_desc"><p style="text-align:center;">Условия акции</p><p>Для покупки по акции звоните по телефону: 375-29-8982370 или 5050. Приобрести товар за полную стоимость, в рассрочку или по акции можно также в салонах или у наших представителей</p></div></div>
</div></div>
          </div>
        </div>
      </div>  <!-- /.mts-product-price -->
          </div>  <!-- /.mts-product-price-outer -->
    <div class="field-field-product-pics">
      <div class="cck_field_gallery_wrapper clear-block"><div class="cck_field_gallery"><a href="<?php echo $data['image'];?>"  title="Смартфон Samsung Galaxy S III Duos (I9300I) черный"><img src="<?php echo $data['image'];?>" alt="" title=""  class="imagecache imagecache-gallery_medium" width="250" height="250" /></a></div></div>    
	</div>
    <div class="mts_product_tabs_wrapper">
      <div class="mts_product_tabs_title">
        <div class="mts_product_tab_title first"><a class="mts_product_tab0 active" href="#mts_product_tab0"><span>Описание товара</span></a></div>
      </div>
      <div class="mts_product_tab active" id="mts_product_tab0">
        <div class="field-node-body">
          <h2>Описание</h2>
          <div class="product-body">
			<p>
				<?php echo $data['description'];?>
			</p>
		  </div>
		</div>
	  </div>
</div> <!-- /.mts_product_tabs_wrapper -->
</div>  <!-- .content -->
</div>  <!-- #node -->
</div>
		<?php }
	}
	
	// перевод числа-типа товара в слово
	public static function int_to_bonus($int)
	{
		if ($int==1)
			echo 'Новое';
		else if ($int==2)
			echo 'Хит';
		else if ($int==3)
			echo 'Акция';
	}
	
	// при выводе товаров по три в строке нижняя часть блока одного товара
	public static function one_down_goods($id_goods, $price, $rating)
	{
		?>
				<div class="product_teaser_controls">
					<div class="price">
						<span class="currency-int"><?php echo $price;?></span> <span class="currency">руб.</span>    
					</div>
					<div class="cart">
						<div class="cart">
							<div class="add-to-cart">
								<form action=""  accept-charset="UTF-8" method="post" id="<?php echo 'f'.$id_goods;?>" class="ajax-cart-submit-form">
									<div>
									    <input type="hidden" name="id_goods" value="<?php echo $id_goods;?>">
										<input type="submit" name="op" id="" value="В корзину"  class="form-submit node-add-to-cart " />
									</div>
								</form>
							</div>
						</div>        
					</div>
					<div class="fivestar-static-form-item">
						<div class="form-item">
						 <div class="fivestar-widget-static fivestar-widget-static-vote fivestar-widget-static-5 clear-block">
						 <?php for ($i=1; $i<=$rating; $i++) { ?>
							 <div class="star star-<?php echo $i; ?> star-odd"><span class="on"></span></div>
						 <?php } 
							for ($i=$rating+1; $i<=5; $i++) { ?>
								<div class="star star-<?php echo $i; ?> star-odd"><span class="off"></span></div>
							<?php }
						 ?>
						 </div>
						</div>
					</div>
				</div>  
		<?php
	}
	
	// при аыводе товаров по три в строку верхняя часть блока одного товара
	public static function one_up_goods($data)
	{
		?>
			<div class="product_teaser pic_default">
			<?php if ($data['bonus']!=0) { ?>
				<a href="samsung-galaxy-s-iii-duos-i9300i-chernyi.htm" class="mts-label-action"><?php self::int_to_bonus($data['bonus']);?></a>   
			<?php } ?>
			<div class="product_teaser_pic">
				<a href="goods.php?id=<?php echo $data['id_goods'];?>"><img src="<?php echo $data['image'];?>"  alt="" title="<?php $data['title'];?>"  class="imagecache imagecache-product_teaser" width="87" height="164" /></a>   
			</div>

			<div class="product_teaser_info">
				<h3>
				   <a href="goods.php?id=<?php echo $data['id_goods'];?>"><?php echo $data['title'];?></a>
				</h3>
				<div class="favorite_link" id="fav_1855">		   
				</div>
                            <div class="item-1 item">
                            <span class="product_label"></span> <?php echo Helper::getFirstSentence($data['description']);?> 
							</div>
	          </div>
    </div>  
		<?php
	}
	
	// вывод сообщения об ошибке
	public static function error_message($msg)
	{
		echo '<div class="messages error">'.$msg.'</div>';
	}
	
	// вывод сообщения о успешном событии
	public static function success_message($msg)
	{
		echo '<div class="messages status">'.$msg.'</div>';
	}
	
	// вывод заголовка для страницы администрирования (добавление статьи, добавление категории и т.д.)
	public static function title_admin_form($title)
	{
		if ($title=='categories')
			echo 'Категории товаров';
		else if ($title=='goods')
			echo 'Новый товар';
		else if ($title=='articles')
			echo 'Новая статья';
	}	
	
	// перевод типа статьи в число
	public static function article_int_type($type)
	{
		if ($type=='news')
			return 1;
		else if ($type=='reviews')
			return 2;
		else if ($type=='discounts')
			return 3;
	}
	
	// перевод типа статьи на англ на русский
	public static function article_type($type)
	{
		if ($type=='news')
			echo 'Новости';
		else if ($type=='reviews')
			echo 'Обзоры';
		else if ($type=='discounts')
			echo 'Скидки и акции';
	}
	
	// создание фрагмента ссылки из числового значения типа статьм
	public static function article_link($type, $id)
	{
		if ($type==1)
			$t='news';
		else if ($type==2)
			$t='reviews';
		else if ($type==3)
			$t='discounts';
		echo 'articles.php?t='.$t.'&id='.$id;
	}
	
	// вывод статьи
	public static function article($data)
	{
		?>
		 <div class="views-row views-row-2 views-row-even">   
  <div class="views-field views-field-title">        <span class="field-content"><a href="<?php self::article_link($data['category'],$data['id_article']);?>"><?php echo $data['title'];?></a></span>  </div>  
  <div class="views-field views-field-created">        <span class="field-content"><?php echo $data['date'];?></span>  </div>  
  <div class="views-field views-field-field-news-pic-fid">        <span class="field-content"></span>  </div>  
  <div class="views-field views-field-teaser">        <div class="field-content"><p style="text-align: justify;">
  <?php echo $data['text'];?>
  </p>
</div>  </div>  
</div>
		<?php
	}
	
	
	// форма входа в кабинет
	public static function form_entrance()
	{
		?>
			<form action=""  accept-charset="UTF-8" method="post" id="user-login">
			<input type="hidden" name="rd" id="edit-mail" value="rd"  />
			<div class="enter_form">
			<div class="tr_1"></div>
			<div class="tl_1"></div>
			<div class="content_1">
			<div class="form-item" id="edit-name-wrapper">
			 <label for="edit-name">E-mail: <span class="form-required" title="Обязательное поле">*</span></label>
			 <input type="text" maxlength="60" name="cat1" id="edit-name" size="60" value="" class="form-text required" />
			</div>
			<div class="form-item" id="edit-pass-wrapper">
			 <label for="edit-pass">Пароль: <span class="form-required" title="Обязательное поле">*</span></label>
			 <input type="password" name="cat2" id="edit-pass"  maxlength="128"  size="60"  class="form-text required" />
			</div>
			
			<a href="reg.php">Зарегистрироваться</a>
			<input type="submit" name="op" id="edit-submit" value="Войти"  class="form-submit" />
			</div>
			<div class="br_1"></div>
			<div class="bl_1"></div>
			</div>
			</form>
		<?php
	}
	
	// форма с данными пользователя
	public static function form_user($data)
	{
		?>
			<form action="history.php?t"  accept-charset="UTF-8" method="post" id="user-register">
			<div>
			<input type="hidden" name="t">
			<fieldset>
			<div class="form-item" id="edit-profile-lastname-wrapper">
			 <label for="edit-profile-lastname">Фамилия:</label>
			<label><strong><?php echo $data['surname'];?></strong></label>
			</div>
			<div class="form-item" id="edit-profile-name-wrapper">
			 <label for="edit-profile-name">Имя:</label>
			 <label><strong><?php echo $data['name'];?></strong></label>
			</div>
			
			<div class="form-item" id="edit-profile-date-wrapper">
			 <label for="edit-profile-date">Дата рождения:</label>
			 <label><strong><?php echo $data['birth'];?></strong></label>
			</div>
			
			<fieldset>
			<div class="form-item" id="edit-mail-wrapper">
			 <label for="edit-mail">E-mail: <span class="form-required" title="Обязательное поле">*</span></label>
			 <input type="text" maxlength="64" name="email" id="edit-mail" size="60" value="<?php echo $data['email'];?>" class="form-text required" />
			</div>
			<input type="hidden" name="rd" id="edit-mail" value="rd"  />
			</fieldset>
			
			<div class="form-item" id="edit-profile-lastname-wrapper">
			 <label for="edit-profile-lastname">Телефон: <span class="form-required" title="Обязательное поле">*</span></label>
			 <input type="text" maxlength="255" name="phone" id="edit-profile-lastname" size="60" value="<?php echo $data['phone'];?>" class="form-text required" />
			</div>
			
			<div class="form-item" id="edit-profile-lastname-wrapper">
			 <label for="edit-profile-lastname">Новый пароль:</label>
			 <input type="password" maxlength="255" name="password" id="edit-profile-lastname" size="60" value="<?php echo $data['password'];?>" class="form-text required" />
			</div>
			
			<div class="form-item" id="edit-profile-lastname-wrapper">
			 <label for="edit-profile-lastname">Повтор: </label>
			 <input type="password" maxlength="255" name="password2" id="edit-profile-lastname" size="60" value="<?php echo $data['password2'];?>" class="form-text required" />
			</div>
			
			</fieldset>

			<input type="submit" name="op" id="edit-submit" value="Применить"  class="edit-submit2" />

			</div></form>		
		<?php
	}
	
	// форма показа заказа для администратора
	public static function form_admin_order($data)
	{
		?>
			<form action="history.php?o=<?php echo $data['id_order'];?>"  accept-charset="UTF-8" method="post" id="user-register">
			<div>
			<fieldset>
			<div class="form-item" id="edit-profile-lastname-wrapper">
			 <label for="edit-profile-lastname">Номер заказа:</label>
			<label><strong><?php echo $data['id_order'];?></strong></label>
			</div>
			
			<div class="form-item" id="edit-profile-lastname-wrapper">
			 <label for="edit-profile-lastname">Дата заказа:</label>
			<label><strong><?php echo $data['date'];?></strong></label>
			</div>
			
			<?php if ($data['id_user']!=0) { ?>
			
			<div class="form-item" id="edit-profile-name-wrapper">
			 <label for="edit-profile-name">Заказчик:</label>
			 <label><strong><a href="history.php?t=<?php echo $data['id_user']; ?>"><?php echo $data['user']['name'].' '.$data['user']['surname'];?></a></strong></label>
			</div>
			
			<?php } ?>
			
			<?php if (trim($data['company'])!='') { ?>
			
			<div class="form-item" id="edit-profile-name-wrapper">
			 <label for="edit-profile-name">Организация</label>
			 <label><strong><?php echo $data['company'];?></strong></label>
			</div>
			
			<?php } ?>
			
			<div class="form-item" id="edit-profile-date-wrapper">
			 <label for="edit-profile-date">Контактное лицо:</label>
			 <label><strong><?php echo $data['fio'];?></strong></label>
			</div>
			
			<div class="form-item" id="edit-profile-date-wrapper">
			 <label for="edit-profile-date">Телефон:</label>
			 <label><strong><?php echo $data['phone'];?></strong></label>
			</div>
			
			<div class="form-item" id="edit-profile-date-wrapper">
			 <label for="edit-profile-date">Город:</label>
			 <label><strong><?php echo $data['city'];?></strong></label>
			</div>
			
			<div class="form-item" id="edit-profile-date-wrapper">
			 <label for="edit-profile-date">Адрес:</label>
			 <label><strong><?php echo $data['address'];?></strong></label>
			</div>
			
			<?php if (trim($data['code'])!='') { ?>
				<div class="form-item" id="edit-profile-date-wrapper">
				 <label for="edit-profile-date">Код:</label>
				 <label><strong><?php echo $data['code'];?></strong></label>
				</div>
			<?php } ?>
			
			<fieldset>
			<div class="form-item" id="edit-mail-wrapper">
			 <label for="edit-mail">E-mail: </label>
			  <label><strong><?php echo $data['email'];?></strong></label>
			</div>
			<input type="hidden" name="rd" id="edit-mail" value="rd"  />
			</fieldset>
			
			<div class="form-item" id="edit-profile-lastname-wrapper">
			 <label for="edit-profile-lastname">Цена: </label>
			  <label><strong><?php echo $data['price'];?></strong></label>
			</div>
			
			<div class="form-item" id="edit-profile-lastname-wrapper">
			 <label for="edit-profile-lastname">Товары: </label>
			  <div style="padding-left: 130px;">
			  <?php 
				if (count($data['goods'])<1)
				{
					echo 'отсутствуют';
				}
				else {
					foreach ($data['goods'] as $gd) 
					{
						echo '<a href="goods.php?id='.$gd['id_goods'].'">'.$gd['title'].'</a> ('.$gd['count'].' шт)<br> ';
					}
				}
				?>
			  </div>
			</div>
			
			<div class="form-item" id="edit-profile-date-wrapper">
			 <label for="edit-profile-date">Комментарий:</label>
			 <div style="padding-top: 6px;"><strong><?php echo $data['comment'];?></strong></div>
			</div>
			
			<div class="form-item" id="edit-profile-date-wrapper">
			 <label for="edit-profile-date">Статус:</label>
			 <div class="container-inline"><div class="form-item" id="edit-profile-date-day-wrapper">
			 <select name="type" class="form-select" >
				<option value="1" <?php if ($data['status']==1) echo 'selected'; ?>><?php echo Helper::int_to_status_order(1);?></option>
				<option value="2" <?php if ($data['status']==2) echo 'selected'; ?>><?php echo Helper::int_to_status_order(2);?></option>
				<option value="3" <?php if ($data['status']==3) echo 'selected'; ?>><?php echo Helper::int_to_status_order(3);?></option>
			 </select>
			</div>
			</div>
			</div>
			<input type="submit" name="op" id="edit-submit" value="Применить"  class="edit-submit2" />
			</fieldset>
			<p><a href="history.php">к списку заказов</a></p>
			</div></form>		
		<?php
	}
	
	// форма с данными пользователя для администратора
	public static function form_admin_user($data)
	{
		?>
			<form action="history.php?t"  accept-charset="UTF-8" method="post" id="user-register">
			<div>
			<input type="hidden" name="t">
			<fieldset>
			<div class="form-item" id="edit-profile-lastname-wrapper">
			 <label for="edit-profile-lastname">Фамилия:</label>
			<label><strong><?php echo $data['surname'];?></strong></label>
			</div>
			<div class="form-item" id="edit-profile-name-wrapper">
			 <label for="edit-profile-name">Имя:</label>
			 <label><strong><?php echo $data['name'];?></strong></label>
			</div>
			
			<div class="form-item" id="edit-profile-date-wrapper">
			 <label for="edit-profile-date">Дата рождения:</label>
			 <label><strong><?php echo $data['birth'];?></strong></label>
			</div>
			
			<fieldset>
			<div class="form-item" id="edit-mail-wrapper">
			 <label for="edit-mail">E-mail: </label>
			  <label><strong><?php echo $data['email'];?></strong></label>
			</div>
			<input type="hidden" name="rd" id="edit-mail" value="rd"  />
			</fieldset>
			
			<div class="form-item" id="edit-profile-lastname-wrapper">
			 <label for="edit-profile-lastname">Телефон: </label>
			  <label><strong><?php echo $data['phone'];?></strong></label>
			</div>
			
			<div class="form-item" id="edit-profile-lastname-wrapper">
			 <label for="edit-profile-lastname">Заказы: </label>
			  <label>
			  <?php 
				if (count($data['orders'])<1)
				{
					echo 'отсутствуют';
				}
				else {
					foreach ($data['orders'] as $ord) 
					{
						echo '<a href="history.php?o='.$ord['id_order'].'">'.$ord['id_order'].'</a> ';
					}
				}
				?>
			  </label>
			</div>
			
			</fieldset>
			
			<p><a href="history.php?t=0">к списку пользователей</a></p>
			</div></form>		
		<?php
	}
	
	// форма регистрации нового клиента
	public static function form_reg($data)
	{
		?>
			<form action=""  accept-charset="UTF-8" method="post" id="user-register">
			<div>
			<fieldset>
			<div class="form-item" id="edit-mail-wrapper">
			 <label for="edit-mail">E-mail: <span class="form-required" title="Обязательное поле">*</span></label>
			 <input type="text" maxlength="64" name="cat1" id="edit-mail" size="60" value="<?php echo $data[1];?>" class="form-text required" />
			</div>
			<input type="hidden" name="rd" id="edit-mail" value="rd"  />
			</fieldset>
			
			<fieldset>
			<div class="form-item" id="edit-profile-lastname-wrapper">
			 <label for="edit-profile-lastname">Фамилия: <span class="form-required" title="Обязательное поле">*</span></label>
			 <input type="text" maxlength="255" name="cat2" id="edit-profile-lastname" size="60" value="<?php echo $data[2];?>" class="form-text required" />
			</div>
			<div class="form-item" id="edit-profile-name-wrapper">
			 <label for="edit-profile-name">Имя: <span class="form-required" title="Обязательное поле">*</span></label>
			 <input type="text" maxlength="255" name="cat3" id="edit-profile-name" size="60" value="<?php echo $data[3];?>" class="form-text required" />
			</div>
			<div class="form-item" id="edit-profile-secondname-wrapper">
			 <label for="edit-profile-secondname">Отчество: </label>
			 <input type="text" maxlength="255" name="cat4" id="edit-profile-secondname" size="60" value="<?php echo $data[4];?>" class="form-text" />
			</div>
			<div class="form-item" id="edit-profile-date-wrapper">
			 <label for="edit-profile-date">Дата рождения:</label>
			 <div class="container-inline"><div class="form-item" id="edit-profile-date-day-wrapper">
			 <select name="cat5" class="form-select" id="edit-profile-date-day" ><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14" selected="selected">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option></select>
			</div>
			<div class="form-item" id="edit-profile-date-month-wrapper">
			 <select name="cat6" class="form-select" id="edit-profile-date-month" ><option value="1">Январь</option><option value="2">Февраль</option><option value="3" selected="selected">Март</option><option value="4">Апрель</option><option value="5">Май</option><option value="6">Июнь</option><option value="7">Июль</option><option value="8">Август</option><option value="9">Сентябрь</option><option value="10">Октябрь</option><option value="11">Ноябрь</option><option value="12">Декабрь</option></select>
			</div>
			<div class="form-item" id="edit-profile-date-year-wrapper">
			 <select name="cat7" class="form-select" id="edit-profile-date-year" ><option value="1900">1900</option><option value="1901">1901</option><option value="1902">1902</option><option value="1903">1903</option><option value="1904">1904</option><option value="1905">1905</option><option value="1906">1906</option><option value="1907">1907</option><option value="1908">1908</option><option value="1909">1909</option><option value="1910">1910</option><option value="1911">1911</option><option value="1912">1912</option><option value="1913">1913</option><option value="1914">1914</option><option value="1915">1915</option><option value="1916">1916</option><option value="1917">1917</option><option value="1918">1918</option><option value="1919">1919</option><option value="1920">1920</option><option value="1921">1921</option><option value="1922">1922</option><option value="1923">1923</option><option value="1924">1924</option><option value="1925">1925</option><option value="1926">1926</option><option value="1927">1927</option><option value="1928">1928</option><option value="1929">1929</option><option value="1930">1930</option><option value="1931">1931</option><option value="1932">1932</option><option value="1933">1933</option><option value="1934">1934</option><option value="1935">1935</option><option value="1936">1936</option><option value="1937">1937</option><option value="1938">1938</option><option value="1939">1939</option><option value="1940">1940</option><option value="1941">1941</option><option value="1942">1942</option><option value="1943">1943</option><option value="1944">1944</option><option value="1945">1945</option><option value="1946">1946</option><option value="1947">1947</option><option value="1948">1948</option><option value="1949">1949</option><option value="1950">1950</option><option value="1951">1951</option><option value="1952">1952</option><option value="1953">1953</option><option value="1954">1954</option><option value="1955">1955</option><option value="1956">1956</option><option value="1957">1957</option><option value="1958">1958</option><option value="1959">1959</option><option value="1960">1960</option><option value="1961">1961</option><option value="1962">1962</option><option value="1963">1963</option><option value="1964">1964</option><option value="1965">1965</option><option value="1966">1966</option><option value="1967">1967</option><option value="1968">1968</option><option value="1969">1969</option><option value="1970">1970</option><option value="1971">1971</option><option value="1972">1972</option><option value="1973">1973</option><option value="1974">1974</option><option value="1975">1975</option><option value="1976">1976</option><option value="1977">1977</option><option value="1978">1978</option><option value="1979">1979</option><option value="1980">1980</option><option value="1981">1981</option><option value="1982">1982</option><option value="1983">1983</option><option value="1984">1984</option><option value="1985">1985</option><option value="1986">1986</option><option value="1987">1987</option><option value="1988">1988</option><option value="1989">1989</option><option value="1990">1990</option><option value="1991">1991</option><option value="1992">1992</option><option value="1993">1993</option><option value="1994">1994</option><option value="1995">1995</option><option value="1996">1996</option><option value="1997">1997</option><option value="1998">1998</option><option value="1999">1999</option><option value="2000">2000</option><option value="2001">2001</option><option value="2002">2002</option><option value="2003">2003</option><option value="2004">2004</option><option value="2005">2005</option><option value="2006">2006</option><option value="2007">2007</option><option value="2008">2008</option><option value="2009">2009</option><option value="2010">2010</option><option value="2011">2011</option><option value="2012">2012</option><option value="2013">2013</option><option value="2014">2014</option><option value="2017" selected="selected">2017</option></select>
			</div>
			</div>
			</div>
			<div class="form-item" id="edit-profile-lastname-wrapper">
			 <label for="edit-profile-lastname">Телефон: <span class="form-required" title="Обязательное поле">*</span></label>
			 <input type="text" maxlength="255" name="cat8" id="edit-profile-lastname" size="60" value="<?php echo $data[8];?>" class="form-text required" />
			</div>
			
			<div class="form-item" id="edit-profile-lastname-wrapper">
			 <label for="edit-profile-lastname">Пароль: <span class="form-required" title="Обязательное поле">*</span></label>
			 <input type="password" maxlength="255" name="cat9" id="edit-profile-lastname" size="60" value="<?php echo $data[9];?>" class="form-text required" />
			</div>
			
			<div class="form-item" id="edit-profile-lastname-wrapper">
			 <label for="edit-profile-lastname">Повтор: <span class="form-required" title="Обязательное поле">*</span></label>
			 <input type="password" maxlength="255" name="cat10" id="edit-profile-lastname" size="60" value="<?php echo $data[10];?>" class="form-text required" />
			</div>
			
			</fieldset>
			<fieldset class="captcha"><legend>CAPTCHA</legend><div class="description">Введите символы, которые вы видите на картинке <span class="form-required" title="Обязательное поле">*</span></div>
			
			<img src="lib/kcaptcha/?<?php echo session_name()?>=<?php echo session_id()?>" alt="CAPTCHA на основе изображений" title="CAPTCHA на основе изображений" /><div class="form-item" id="edit-captcha-response-wrapper">
			 <label for="edit-captcha-response">Какой код на картинке?: <span class="form-required" title="Обязательное поле">*</span></label>
			 <input type="text" maxlength="128" name="cat11" id="edit-captcha-response" size="15" value="" class="form-text required" />
			</div>
			</fieldset>

			<input type="submit" name="op" id="edit-submit" value="Зарегистрироваться"  class="form-submit" />

			</div></form>		
		<?php
	}
	
	// форма добавления товара
	public static function form_goods($data, $cats)
	{
		?>
		<form action=""  enctype="multipart/form-data" accept-charset="UTF-8" method="post" id="user-register">
		    <input type="hidden" name="rd" id="edit-mail" value="rd"  />
			<div>
			<fieldset>
			<div class="form-item" id="edit-mail-wrapper">
			 <label for="edit-mail">Название</label>
			 <input type="text" maxlength="64" name="cat1" id="edit-mail" size="60" value="<?php echo $data[1];?>" class="form-text required" />
			</div>
			</fieldset>

			<div class="form-item" id="edit-profile-date-wrapper">
			 <label for="edit-profile-date">Категория</label>
			 <div class="container-inline"><div class="form-item" id="edit-profile-date-day-wrapper">
			 <select name="cat2" class="form-select" >
			 <?php foreach ($cats as $cat) { ?>
				<option value="<?php echo $cat['id_category'];?>"><?php echo $cat['category'];?></option>
				<?php if ($cat['id_parent']==0 && count($cat['childs'])>0) {
					foreach ($cat['childs'] as $scat) { ?>
				<option value="<?php echo $scat['id_category'];?>"><?php echo '&nbsp;&nbsp;&nbsp;'.$scat['category'];?></option>
				<?php } } ?>
			<?php } ?>
			 </select>
			</div>
			</div>
			</div>

			<fieldset>
			<div class="form-item" id="edit-mail-wrapper">
			 <label for="edit-mail">Цена (руб) </label>
			 <input type="text" maxlength="64" name="cat3" id="edit-mail" size="60" value="<?php echo $data[3];?>" class="form-text required" />
			</div>
			</fieldset>
			
			<fieldset>
			<div class="form-item" id="edit-mail-wrapper">
			 <label for="edit-mail">Фото </label>
			 <input type="file"  name="cat4" id="edit-mail" size="60" class="form-text required" />
			</div>
			</fieldset>

			<fieldset>
			<div class="form-item" id="edit-mail-wrapper">
			 <label for="text-article">Описание </label>
			 <textarea name="cat5" rows="10" cols="45" id="text-article"><?php echo $data[5];?></textarea>
			</div>
			</fieldset>
			
			<div class="form-item" id="edit-profile-date-wrapper">
			 <label for="edit-profile-date">Тип </label>
			 <div class="container-inline"><div class="form-item" id="edit-profile-date-day-wrapper">
			 <select name="cat6" class="form-select" >
			    <option value="0">Обычные товары</option>
				<option value="1">Новые товары</option>
				<option value="2">Хиты продаж</option>
				<option value="3">Акции</option>
			 </select>
			</div>
			</div>
			</div>
			
			<input type="submit" name="op" id="edit-submit" value="Применить"  class="edit-submit2" />

			</div>
			</form>
		<?php
	}
	
	// форма с данными товара для редактирования администратором
	public static function form_edit_goods($data, $cats)
	{
		if (!empty($data)) {
		?>
		<p style="padding-left: 220px;"><img src="<?php echo $data['image'];?>"></p>
		<form action=""  enctype="multipart/form-data" accept-charset="UTF-8" method="post" id="user-register">
		    <input type="hidden" name="rd" id="edit-mail" value="rd"  />
			<div>
			<fieldset>
			<div class="form-item" id="edit-mail-wrapper">
			 <label for="edit-mail">Номер товара</label>
			 <label for="edit-mail"><?php echo $data['id_goods'];?></label>
			</div>
			</fieldset>
			
			<fieldset>
			<div class="form-item" id="edit-mail-wrapper">
			 <label for="edit-mail">Название</label>
			 <input type="text" maxlength="64" name="cat1" id="edit-mail" size="60" value="<?php echo $data['title'];?>" class="form-text required" />
			</div>
			</fieldset>

			<div class="form-item" id="edit-profile-date-wrapper">
			 <label for="edit-profile-date">Категория</label>
			 <div class="container-inline"><div class="form-item" id="edit-profile-date-day-wrapper">
			 <select name="cat2" class="form-select" >
			 <?php foreach ($cats as $cat) { ?>
				<option value="<?php echo $cat['id_category'];?>" <?php if ($cat['id_category']==$data['id_category']) echo 'selected'; ?>><?php echo $cat['category'];?></option>
				<?php if ($cat['id_parent']==0 && count($cat['childs'])>0) {
					foreach ($cat['childs'] as $scat) { ?>
				<option value="<?php echo $scat['id_category'];?>" <?php if ($scat['id_category']==$data['id_category']) echo 'selected'; ?> ><?php echo '&nbsp;&nbsp;&nbsp;'.$scat['category'];?></option>
				<?php } } ?>
			<?php } ?>
			 </select>
			</div>
			</div>
			</div>

			<fieldset>
			<div class="form-item" id="edit-mail-wrapper">
			 <label for="edit-mail">Цена (руб) </label>
			 <input type="text" maxlength="64" name="cat3" id="edit-mail" size="60" value="<?php echo $data['price'];?>" class="form-text required" />
			</div>
			</fieldset>
			
			<fieldset>
			<div class="form-item" id="edit-mail-wrapper">
			 <label for="edit-mail">Новое фото </label>
			 <input type="file"  name="cat4" id="edit-mail" size="60" class="form-text required" />
			</div>
			</fieldset>

			<fieldset>
			<div class="form-item" id="edit-mail-wrapper">
			 <label for="text-article">Описание </label>
			 <textarea name="cat5" rows="10" cols="45" id="text-article"><?php echo $data['description'];?></textarea>
			</div>
			</fieldset>
			
			<div class="form-item" id="edit-profile-date-wrapper">
			 <label for="edit-profile-date">Тип </label>
			 <div class="container-inline"><div class="form-item" id="edit-profile-date-day-wrapper">
			 <select name="cat6" class="form-select" >
			    <option value="0" <?php if (0==$data['bonus']) echo 'selected'; ?>>Обычные товары</option>
				<option value="1" <?php if (1==$data['bonus']) echo 'selected'; ?>>Новые товары</option>
				<option value="2" <?php if (2==$data['bonus']) echo 'selected'; ?>>Хиты продаж</option>
				<option value="3" <?php if (3==$data['bonus']) echo 'selected'; ?>>Акции</option>
			 </select>
			</div>
			</div>
			</div>
			
			<fieldset>
			<div class="form-item" id="edit-mail-wrapper">
			 <label for="text-article">Каталог</label><input type="checkbox" name="cat7" <?php if (0==$data['visible']) echo 'checked'; ?>> не показывать
			</div>
			</fieldset>
			
			<input type="submit" name="op" id="edit-submit" value="Применить"  class="edit-submit2" />

			</div>
			</form>
		<?php
		}
	}
	
	// форма добавления статьи администратором
	public static function form_article($data)
	{
		?>
		<form action=""  accept-charset="UTF-8" method="post" id="user-register">
		    <input type="hidden" name="rd" id="edit-mail" value="rd"  />
			<div>
			<fieldset>
			<div class="form-item" id="edit-mail-wrapper">
			 <label for="edit-mail">Заголовок</label>
			 <input type="text" maxlength="64" name="cat1" id="edit-mail" size="60" value="<?php echo $data[1];?>" class="form-text required" />
			</div>
			</fieldset>

			<div class="form-item" id="edit-profile-date-wrapper">
			 <label for="edit-profile-date">Тип </label>
			 <div class="container-inline"><div class="form-item" id="edit-profile-date-day-wrapper">
			 <select name="cat2" class="form-select" >
				<option value="1">Новости</option>
				<option value="2">Обзоры</option>
				<option value="3">Скидки и акции</option>
			 </select>
			</div>
			</div>
			</div>

			<fieldset>
			<div class="form-item" id="edit-mail-wrapper">
			 <label for="edit-mail">Дата </label>
			 <input type="text" maxlength="64" name="cat3" id="edit-mail" size="60" value="<?php if (empty($data[3])) echo date('d.m.Y'); else echo $data[3];?>" class="form-text required" />
			</div>
			</fieldset>

			<fieldset>
			<div class="form-item" id="edit-mail-wrapper">
			 <label for="text-article">Текст </label>
			 <textarea name="cat4" rows="30" cols="60" id="text-article"><?php echo $data[4];?></textarea>
			</div>
			</fieldset>
			<input type="submit" name="op" id="edit-submit" value="Применить"  class="edit-submit2" />


			</div>
			</form>
		<?php
	}
	
	// форма добавления категории администратором
	public static function form_category($cats)
	{
		?>
		<form action=""  accept-charset="UTF-8" method="post" id="user-register">
		    <input type="hidden" name="rd" id="edit-mail" value="rd"  />
			<h2>Новая категория</h2>
			<div>
			<fieldset>
			<div class="form-item" id="edit-mail-wrapper">
			 <label for="edit-mail">Введите название: </label>
			 <input type="text" maxlength="64" name="cat1" id="edit-mail" size="60" value="" class="form-text required" />
			</div>
			</fieldset>

			<h2>Новая подкатегория</h2>

			<div class="form-item" id="edit-profile-date-wrapper">
			 <label for="edit-profile-date">Категория </label>
			 <div class="container-inline"><div class="form-item" id="edit-profile-date-day-wrapper">
			 <select name="cat2" class="form-select" >
			 <?php foreach ($cats as $cat) { ?>
				<option value="<?php echo $cat['id_category'];?>"><?php echo $cat['category'];?></option>
			<?php } ?>
			 </select>
			</div>
			</div>
			</div>

			<fieldset>
			<div class="form-item" id="edit-mail-wrapper">
			 <label for="edit-mail">Введите название: </label>
			 <input type="text" maxlength="64" name="cat3" id="edit-mail" size="60" value="" class="form-text required" />
			</div>
			</fieldset>

			<h2>Редактирование</h2>

			<div class="form-item" id="edit-profile-date-wrapper">
			 <label for="edit-profile-date"> </label>
			 <div class="container-inline"><div class="form-item" id="edit-profile-date-day-wrapper">
			 <select name="cat4" class="form-select" >
			 <?php foreach ($cats as $cat) { ?>
				<option value="<?php echo $cat['id_category'];?>"><?php echo $cat['category'];?></option>
				<?php if ($cat['id_parent']==0 && count($cat['childs'])>0) {
					foreach ($cat['childs'] as $scat) { ?>
				<option value="<?php echo $scat['id_category'];?>"><?php echo '&nbsp;&nbsp;&nbsp;'.$scat['category'];?></option>
				<?php } } ?>
			<?php } ?>
			 </select>
			</div>
			</div>
			</div>

			<fieldset>
			<div class="form-item" id="edit-mail-wrapper">
			 <label for="edit-mail">Новое название: </label>
			 <input type="text" maxlength="64" name="cat5" id="edit-mail" size="60" value="" class="form-text required" />
			</div>
			</fieldset>
			<input type="submit" name="op" id="edit-submit" value="Применить"  class="edit-submit2" />


			</div>
			</form>
		<?php
	}
	
	// слева блок с двумя новостями
	public static function sidebar_articles($arts)
	{
		?>
		<div id="block-views-news_block-block_1" class="clear-block block block-views"><div class="block-inner">
		  <h2>Новости</h2><div class="content"><div class="view view-news-block view-id-news_block view-display-id-block_1 view-dom-id-ab4cab9e01c496737c9506b935d2631c">
			  <div class="view-content">  
			  <?php foreach ($arts as $art) { ?>
				<div class="views-row views-row-1 views-row-odd views-row-first">
		  <div class="views-field views-field-created"><span class="field-content"><?php echo $art['date'];?></span>  </div>  
		  <div class="views-field views-field-title"><span class="field-content"><a href="articles.php?t=news&id=<?php echo $art['id_article'];?>" ><?php echo $art['title'];?></a></span></div>  
		  <div class="views-field views-field-teaser"><div class="field-content"><p>
		  <?php echo Helper::getFirstSentence($art['text']); ?>
		  </p></div></div></div>
		   <?php } ?>
			</div> <div class="view-footer">
			  <p><a href="articles.php?t=news">Все новости</a></p>
			</div></div></div></div></div>
		<?php
	}
	
	
	// меню слева - каталог товаров
	public static function sidebar_menu($main_cats, $index = -1, $sub_cats = null, $sindex = -1)
	{
		?>
		<div id="block-menu-secondary-links" class="clear-block block block-menu"><div class="block-inner">
		  <h2>Каталог</h2>
		  <div class="content">
		  <ul class="menu">
		  <?php if ($index==-1) {?>
			<?php foreach ($main_cats as $cat) { ?>
				 <li class="leaf"><a href="<?php echo 'goods.php?cat='.$cat['id_category'];?>"  title=""><?php echo $cat['category'];?></a></li>
			<?php } ?>
		  <?php } else if ($sub_cats == null) { ?>
		  <?php foreach ($main_cats as $cat) {
                 if ($cat['id_category']!=$index) {?>
				    <li class="leaf"><a href="<?php echo 'goods.php?cat='.$cat['id_category'];?>"  title=""><?php echo $cat['category'];?></a></li>
				 <?php } else { ?>
					<li class="leaf active-trail"><a href="<?php echo 'goods.php?cat='.$cat['id_category'];?>"  title=""><?php echo $cat['category'];?></a></li>
				 <?php } ?>
			<?php } ?>
		  <?php } else {?>
		  <?php foreach ($main_cats as $cat) {
                 if ($cat['id_category']!=$index) {?>
				    <li class="leaf"><a href="<?php echo 'goods.php?cat='.$cat['id_category'];?>"  title=""><?php echo $cat['category'];?></a></li>
				 <?php } else { ?>
					<li class="leaf active-trail"><a href="<?php echo 'goods.php?cat='.$cat['id_category'];?>"  title=""><?php echo $cat['category'];?></a>
					<ul class="menu">
					  <?php foreach ($sub_cats as $scat) {?>
						 <?php if ($scat['id_category']!=$sindex) { ?>
							<li class="leaf"><a href="<?php echo 'goods.php?cat='.$scat['id_category'];?>"><?php echo $scat['category'];?></a></li>
						<?php } else { ?>
							<li class="leaf active-trail"><a  class="active" href="<?php echo 'goods.php?cat='.$scat['id_category'];?>"><?php echo $scat['category'];?></a></li>
						<?php }?>
					  <?php } ?>
					</ul>
					</li>
				 <?php } ?>
			<?php } ?>
		  <?php } ?>  
		  </ul>
		  </div>
		</div></div>
		<?php
	}
	
	// главное меню основных страниц сайта сверху
	public static function main_menu($count_cart = 0, $user)
	{
		 $menu=array(
			'articles.php?t=discounts'=>'Скидки и акции',
			'articles.php?t=news'=>'Новости',
			'articles.php?t=reviews'=>'Обзоры',
			'stores.php'=>'Магазины',
			'periods.php'=>'Рассрочка',
		);
		?>
		<div id="main-menu">                
		<div id="block-menu-primary-links" class="clear-block block block-menu">
		<div class="block-inner">
		  <div class="content">
			  <ul class="menu">
			  <?php 
				if (strpos($_SERVER['PHP_SELF'],'index.php')!==false)
				{?><li class="leaf first active-trail"><a href="index.php"  title="" class="active">Магазин</a></li>
					<?php
				}
				else
				{?><li class="leaf first"><a href="index.php"  title="">Магазин</a></li>
					<?php
				}
				
				foreach ($menu as $url => $text)
				{
			  ?><li class="leaf<?php if (Helper::isSelfUrl($url,$_SERVER['PHP_SELF'],$_GET['t']))
                   { ?> active-trail <?php } ?>"><a href="<?php echo $url;?>" title="" <?php if (Helper::isSelfUrl($url,$_SERVER['PHP_SELF'],$_GET['t']))
                   { ?> class="active" <?php } ?>><?php echo $text;?></a></li>
			  <?php 
				}
				if (strpos($_SERVER['PHP_SELF'],'pays.php')!==false)
				{?><li class="leaf last active-trail"><a href="pays.php"  title="" class="active">Оплата и доставка</a></li>
					<?php
				}
				else
				{?><li class="leaf last"><a href="pays.php"  title="" >Оплата и доставка</a></li>
					<?php
				}
			  ?>
			  </ul>
		  </div>
		</div>
		</div>
		<div class="cart">                               
			<div id="block-uc_ajax_cart-0" class="clear-block block block-uc_ajax_cart cart-open">
			<div class="block-inner">
			  <h2><span class="title block-title" id="ajax-cart-headline">Корзина</span></h2>
			  <div class="content"><div id="ajaxCartUpdate" class="load-on-view ajax-cart-processed">
				<div id="cart-block-contents-ajax"><a href="cart.php" rel="nofollow"><span class="total"><?php echo $count_cart;?></span></a></div>
			  </div>
			  </div>
			</div>
			</div>
		</div>
		</div>
		<?php if ($user=='') { ?>
		<div id="user-menu" class="not-logged">
            <a href="entrance.php">Войти</a> &nbsp; | &nbsp; <a href="reg.php">Зарегистрироваться</a>                      
		</div>
		<?php } else if ($user['type']==2) { ?>
				<div id="user-menu" class="logged">
								<div class="profile-text">
					<b>Здравствуйте, <?php echo $user['name'];?>!</b> &nbsp;| <a href="index.php?e=1" class="logout">Выйти</a>            </div>
					<div class="profile-links">
					  <span class="title">Кабинет</span>
					  <div class="content">
						<div class="content-inner">
						  <a href="history.php">Покупки</a><br />
						  <a href="history.php?t">Личные данные</a>
						  </div>
					  </div>
					</div>
							  </div>
		<? } else if ($user['type']==1) { ?>
		<div id="user-menu" class="logged">
                        <div class="profile-text">
            <b>Здравствуйте, <?php echo $user['name'];?>!</b> &nbsp;| <a href="index.php?e=1" class="logout">Выйти</a>            </div>
            <div class="profile-links">
              <span class="title">Управление</span>
              <div class="content">
                <div class="content-inner">
                  <a href="admin.php?t=categories">Категории</a><br />
                  <a href="admin.php?t=goods">Товары</a><br />
				  <a href="admin.php?t=articles">Статьи</a><br />
                  <a href="history.php?t=0">Пользователи</a><br />
                  <a href="history.php">Заказы</a>
				  </div>
              </div>
            </div>
                      </div>
		<?php } ?>
		</div>
          <div id="container-outer">
              <div id="container-inner">
                <div id="container" class="clear-block">
                    <div id="center">
                        <div id="squeeze">
                            <div class="right-corner">		
		<?php
	}
	
	// показ слайдера на главной страницы
	public static function main_slider()
	{
		?>
		<div id="block-views-front_slider-block_1" class="clear-block block block-views"><div class="block-inner">
		<div class="content"><div class="view view-front-slider view-id-front_slider view-display-id-block_1 view-dom-id-829f0e5bfff91fdd19e273aa4dbbf7b2">
		<div class="view-content">
		<div id="views_slideshow_singleframe_main_front_slider-block_1" class="views_slideshow_singleframe_main views_slideshow_main"><div id="views_slideshow_singleframe_teaser_section_front_slider-block_1" class="views_slideshow_singleframe_teaser_section"><div class="views_slideshow_singleframe_slide views_slideshow_slide views-row-1 views-row-odd" id="views_slideshow_singleframe_div_front_slider-block_1_0"><div class="views-row views-row-0 views-row-first views-row-odd">
		<div>  
		<div class="views-field-field-slider-image-fid">
                <span class="field-content"><span class="field-content"><img  class="imagefield imagefield-field_slider_image" width="690" height="318" alt="" src="img/intro3.jpg" /></span></span>
		</div>
		<div class="views-field-title">
                <span class="field-content"><span class="field-content">Тестирование</span></span>
		</div>
		<div class="views-field-field-slider-features-value">
                <div class="field-content"><div class="field-content"><div class="field-item field-item-0">NVIDIA GeForce GTX 1060</div><div class="field-item field-item-1">NVIDIA GeForce GTX 1070</div><div class="field-item field-item-2">NVIDIA GeForce GTX 1080</div></div></div>
		</div>
		<div class="views-field-field-product-old-price-value">
                <span class="field-content"><span class="field-content"></span></span>
		</div>
		<div class="views-field-path">
                <span class="field-content"><span class="field-content"><a href="articles.php?t=reviews" >Подробнее</a></span></span>
		</div>
		<div class="views-field-sell-price">
                <span class="field-content"><span class="field-content"></span></span>
		</div>
		</div>
		</div>
		</div>
		<div class="views_slideshow_singleframe_slide views_slideshow_slide views-row-2 views_slideshow_singleframe_hidden views-row-even" id="views_slideshow_singleframe_div_front_slider-block_1_1"><div class="views-row views-row-0 views-row-first views-row-odd">
		<div class="mts-noprice">  
		<div class="views-field-field-slider-image-fid">
                <span class="field-content"><span class="field-content"><img  class="imagefield imagefield-field_slider_image" width="690" height="318" alt="" src="img/intr2.jpg"/></span></span>
		</div>
		<div class="views-field-title">
                <span class="field-content"><span class="field-content"> <font size="4" face="Comic Sans MS"> Обзор<br /> материнской платы<br /> ASUS X99-Deluxe II </font></span></span>
		</div>
		  <div class="views-field-field-slider-features-value">
						<div class="field-content"><div class="field-content"></div></div>
		  </div> 
		  <div class="views-field-field-product-old-price-value">
						<span class="field-content"><span class="field-content"></span></span>
		  </div> 
		  <div class="views-field-path">
						<span class="field-content"><span class="field-content"><a href="articles.php?t=reviews" >Подробнее</a></span></span>
		  </div>
  
  <div class="views-field-sell-price">
                <span class="field-content"><span class="field-content"><span class="currency-int"> </span> <span class="currency"></span>
</span></span>
  </div>
</div>
</div>
</div>
<div class="views_slideshow_singleframe_slide views_slideshow_slide views-row-3 views_slideshow_singleframe_hidden views-row-odd" id="views_slideshow_singleframe_div_front_slider-block_1_2"><div class="views-row views-row-0 views-row-first views-row-odd">
<div class="mts-noprice">  
  <div class="views-field-field-slider-image-fid">
                <span class="field-content"><span class="field-content"><img  class="imagefield imagefield-field_slider_image" width="690" height="318" alt="" src="img/intro4.jpg"/></span></span>
  </div>
  
  <div class="views-field-title">
                <span class="field-content"><span class="field-content">Два в одном. <br />Тестирование<br />шести APU от AMD</span></span>
  </div>
  
  <div class="views-field-field-slider-features-value">
                <div class="field-content"><div class="field-content"></div></div>
  </div>
  
  <div class="views-field-field-product-old-price-value">
                <span class="field-content"><span class="field-content"></span></span>
  </div>
  
  <div class="views-field-path">
                <span class="field-content"><span class="field-content"><a href="articles.php?t=reviews" >Подробнее</a></span></span>
  </div>
  
  <div class="views-field-sell-price">
                <span class="field-content"><span class="field-content"><span class="currency-int"> </span> <span class="currency"></span>
</span></span>
  </div>
</div>
</div>
</div>
<div class="views_slideshow_singleframe_slide views_slideshow_slide views-row-4 views_slideshow_singleframe_hidden views-row-even" id="views_slideshow_singleframe_div_front_slider-block_1_3"><div class="views-row views-row-0 views-row-first views-row-odd">
<div class="mts-noprice">  
  <div class="views-field-field-slider-image-fid">
                <span class="field-content"><span class="field-content"><img  class="imagefield imagefield-field_slider_image" width="690" height="318" alt="" src="img/intro5.jpg"/></span></span>
  </div>
  
  <div class="views-field-title">
                <span class="field-content"><span class="field-content">Почти вечный<br />проектор <br />LG PF1500G</span></span>
  </div>
  
  <div class="views-field-field-slider-features-value">
                <div class="field-content"><div class="field-content"></div></div>
  </div>
  
  <div class="views-field-field-product-old-price-value">
                <span class="field-content"><span class="field-content"></span></span>
  </div>
  
  <div class="views-field-path">
                <span class="field-content"><span class="field-content"><a href="articles.php?t=reviews">Подробнее</a></span></span>
  </div>
  
  <div class="views-field-sell-price">
                <span class="field-content"><span class="field-content"><span class="currency-int"></span> <span class="currency"></span>
</span></span>
  </div>
</div>
</div>
</div>
<div class="views_slideshow_singleframe_slide views_slideshow_slide views-row-5 views_slideshow_singleframe_hidden views-row-odd" id="views_slideshow_singleframe_div_front_slider-block_1_4"><div class="views-row views-row-0 views-row-first views-row-odd">
<div class="mts-noprice">  
  <div class="views-field-field-slider-image-fid">
                <span class="field-content"><span class="field-content"><img  class="imagefield imagefield-field_slider_image" width="690" height="318" alt="" src="img/intro1.jpg" /></span></span>
  </div>
  
  <div class="views-field-title">
                <span class="field-content"><span class="field-content">Гонка за<br /> терабайтами</span></span>
  </div>
  
  <div class="views-field-field-slider-features-value">
                <div class="field-content"><div class="field-content"></div></div>
  </div>
  
  <div class="views-field-field-product-old-price-value">
                <span class="field-content"><span class="field-content"></span></span>
  </div>
  
  <div class="views-field-path">
                <span class="field-content"><span class="field-content"><a href="articles.php?t=reviews" >Подробнее</a></span></span>
  </div>
  
  <div class="views-field-sell-price">
                <span class="field-content"><span class="field-content"><span class="currency-int"> </span> <span class="currency"></span>
</span></span>
  </div></div></div></div></div></div>
  <div class="views-slideshow-controls-bottom clear-block">
        <div class="views_slideshow_singleframe_pager views_slideshow_pagerNumbered" id="views_slideshow_singleframe_pager_front_slider-block_1"></div>      </div>
    </div>
</div> </div>
</div>
</div>
		<?php
	}
	
	
	// нижняя часть сайта 
	public static function footer()
	{
	    ?>
		    <div id="footer">
				<div class="footer_block footer_block_1">
				  <div class="block">
					<h2>+ 375-29-898-23-70</h2>
					<div class="content">
					  <p>(бесплатно)</p>
					  <p class="rfb"> Ежедневно, круглосуточно</p>
					</div>
				  </div>
				  <div class="share">
					  <a href="#"  rel="nofollow" class="vk"></a>
					  <a href="#" rel="nofollow" class="tw"></a>
					  <a href="#" rel="nofollow" class="fb"></a>
					  <a href="#" rel="nofollow" class="od"></a>
					  <a href="#" rel="nofollow" class="go"></a>
					  <a href="#" rel="nofollow" class="yt"></a>
					  <a href="#" rel="nofollow" class="fq"></a>
					  <a href="#" rel="nofollow" class="in"></a>
				  </div>
                </div>

        <div class="footer_block footer_block_2">
<div id="block-menu-menu-footer-2" class="clear-block block block-menu"><div class="block-inner">
  <h2>Информация</h2>

  <div class="content"><ul class="menu"><li class="leaf first"><a href="articles.php?t=reviews"  title="">Обзоры</a></li><li class="leaf"><a href="articles.php?t=news" title="">Новости</a></li><li class="leaf"><a href="articles.php?t=discounts"  title="">Скидки и акции</a></li><li class="leaf last"><a href="stores.php"  title="">Салоны</a></li></ul></div>
</div></div>
</div>
        <div class="footer_block footer_block_3">
<div id="block-menu-menu-footer-3" class="clear-block block block-menu"><div class="block-inner">
  <h2>Условия</h2>
  <div class="content"><ul class="menu"><li class="leaf first"><a href="pays.php" title="">Оплата и доставка</a></li><li class="leaf"><a href="periods.php"  title="">Рассрочка</a></li></ul></div>
</div></div>
</div>

        <div class="footer_block footer_block_last footer_block_4">
          <p class="indent">&copy; 2017<br />
          <b>СООО «Z Shop»</b></p>
          <p>Лицензия МС №978 от 11.07.2016, действительна до 30.01.2022</p>
            <p>Разработка<br /> и поддержка сайта<br> <img src="img/logo.png" width="120" height="30" alt=""/></p>
                  </div>
		     <div class="footer-pic">
					<div class="pic"> <img src="img/pic3.png"  alt="pay-pic"/> </div>
					<div class="pic"> <img src="img/pic2.png"  alt="pay-pic"/> </div>
					<div class="pic"> <img src="img/pic1.png"  alt="pay-pic"/> </div>
				</div>
			</div>	
					</div>	 <!-- /wrapper -->
			</body>
		</html>
		<?php
	}
	
	// верхняя часть сайта (логотип и др.)
	public static function header()
	{
	 ?>
	 <body class="front not-logged-in page-node one-sidebar sidebar-left breadcrumb-empty">
		<!-- Layout -->
		<div id="wrapper">
				<div id="header">
					<div id="logo-floater">
						<a href="index.php" title="Интернет-магазин"><img src="img/logo.png" alt="Интернет-магазин" id="logo"/></a>
					</div>
		<div class="search_cont">                           
			<div id="block-mts_search-0" class="clear-block block block-mts_search">
				<div class="block-inner">
				  <div class="content">
					<form action="search.php"  accept-charset="UTF-8" method="post" id="mts-search-ajax-search-form">
						<div>
						<div class="form-item" id="edit-ajax-text-wrapper">
							<input type="text" maxlength="128" name="search" id="edit-ajax-text" size="60" value="" class="form-text" />
							<?php if (isset($_GET['cat'])) { ?>
							<input type="hidden" name="cat" value="<?php echo $_GET['cat']; ?>">
							<?php }?>
						</div>
						<input type="submit" name="op" id="edit-submit" value="Найти"  class="form-submit" />
					   </div>
					</form>
					</div>
				</div>
			</div>
		</div>
               		
        <div id="header-menu">           
			<div id="block-block-10" class="clear-block block block-block">
				<div class="block-inner">
				  <div class="content"><p style="margin-top: 4px;"><strong>+8 (029) 8982370<br>(круглосуточно) </strong></p>
				  </div>
				</div>
			</div>
        </div>
	 <?php
	}
	
	// часть html-кода верстки с тегами <head></head>
	public static function head($title = "Интернет-магазин Z shop")
	{
		?>
		<!DOCTYPE html>
			<html lang="ru">
			<head>
			<meta charset="utf-8" />
			<meta name="robots" content="noindex" />
			<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
			<link rel="canonical" href="#"/>
			<title><?php echo $title; ?></title>
			<link type="text/css" rel="stylesheet" media="all" href="css/css1.css" />
			<link type="text/css" rel="stylesheet" media="all" href="css/css2.css" />
			<link type="text/css" rel="stylesheet" media="all" href="css/css3.css" />
			<link type="text/css" rel="stylesheet" media="all" href="css/css4.css" />

			<script type="text/javascript" src="js/js1.js"></script>
			<script type="text/javascript" src="js/js2.js"></script>
			<script type="text/javascript" src="js/js3.js" ></script>
			<script type="text/javascript" src="js/js4.js"></script>
			<script type="text/javascript" src="js/base2.js"></script>
			<!--[if lte IE 8]>
				<link type="text/css" rel="stylesheet" media="all" href="css/fix-ie.css" />		
			<![endif]-->
			<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
		</head>
		<?php
	}
}