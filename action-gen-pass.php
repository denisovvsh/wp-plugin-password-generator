<?php
add_filter('gen_pass_hook', 'gen_pass_js');
function gen_pass_js() {
	?>
	<div class="container text-dark">
		<div class="row">
			<div class="card col-lg-12 my-2">
				<div class="card-body">
					<div class="card-header my-2" id="card_header_connect_new_wifi">
					    <p class="card-text">Генератор хеша MD5 - PHP md5()</p>
					</div>
					<form id="id_create_hash_now">
						<div class="input-group">
						  <input type="text" class="form-control" id="str_for_md5" name="str_for_md5" placeholder="Вставьте строку" value="" style="font-size:0.9em !important;">
						  <div class="input-group-append">
						    <button class="btn btn-outline-success" type="submit" title="Получить хэш MD5" style="font-size:0.9em !important;">Пуск</button>
						  </div>
						</div>
					</form>
					<div class="alert alert-danger my-2 d-none" id="div_worrning_hash"></div>
					<div class="alert alert-success my-2 d-none" id="div_result_hash"></div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="card col-lg-12">
				<div class="card-body">
					<div class="card-header my-1" id="card_header_connect_new_wifi">
					    <p class="card-text">Укажите параметры и сгенерируйте пароль</p>
					</div>
				    	<form id="id_create_password_now">
							<div class="form-group form-check-inline col-sm-12">
								<input class="form-check-input" type="checkbox" id="check_1" name="check_1"  value="1" style="width: 1em !important; height: 1em !important;" checked="checked">
								<label class="form-check-label" for="check_1">
								  Цифры
								</label>
							</div>
							<div class="form-group form-check-inline col-sm-12">
								<input class="form-check-input" type="checkbox" id="check_2" name="check_2"  value="2" style="width: 1em !important; height: 1em !important;" checked="checked">
								<label class="form-check-label" for="check_2">
								  Прописные буквы
								</label>
							</div>
							<div class="form-group form-check-inline col-sm-12">
								<input class="form-check-input" type="checkbox" id="check_3" name="check_3"  value="3" style="width: 1em !important; height: 1em !important;" checked="checked">
								<label class="form-check-label" for="check_3">
								  Заглавные буквы
								</label>
							</div>
							<div class="form-group form-check-inline col-sm-12">
								<input class="form-check-input" type="checkbox" id="check_4" name="check_4" value="4" style="width: 1em !important; height: 1em !important;">
								<label class="form-check-label" for="check_4">
								  Спецсимволы
								</label>
							</div>
							<div class="form-group">
							    <label class="" for="count_simbols col-sm-12">Количество символов</label>
							    <input type="text" class="form-control col-sm-4" id="count_simbols" placeholder="Количество символов" name="count_simbols" value="8" style="font-size:1em !important;">
						    </div>
					          <button type="submit" class="btn btn-outline-success col-sm-12" title="Генерировать пароль" style="font-size:0.9em !important;">Пуск</button>
						</form>
					<div class="alert alert-danger my-2 d-none" id="div_worrning_passwords"></div>
					<ul class="list-group my-2 d-none" id="div_result_passwords">
					  
					</ul>
				</div>
			</div>
		</div>
	</div>
	
		<script type='module'> 
			jQuery('#id_create_password_now').submit( function(event){
				event.preventDefault(); 
				genPassword.create_password();
			});

			jQuery('#id_create_hash_now').submit( function(event){
				event.preventDefault(); 
				genMD5.create_hash();
			});
		</script>

	<?php
	
}

if( wp_doing_ajax() ){
	add_filter('wp_ajax_nopriv_md5_gen_pass', 'md5_gen_pass_callback', 10);
	add_filter('wp_ajax_nopriv_md5_gen_hash', 'md5_gen_hash_callback', 10);
	add_filter('wp_ajax_md5_gen_pass', 'md5_gen_pass_callback', 10);
	add_filter('wp_ajax_md5_gen_hash', 'md5_gen_hash_callback', 10);
}

?>