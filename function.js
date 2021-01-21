// JavaScript Document
let genPassword = {
	create_password: function(){
		jQuery(document).ready(function($) {
			let data = {
				action: 'md5_gen_pass',
				nonce_code : ajax.nonce,
				key: +thisFn.key_input_checked(),
				count_simbols: +jQuery('#count_simbols').val(),
			};
			
			if(!!thisFn.characterless_int(jQuery('#count_simbols').val())){
				jQuery.post( ajax.url, data, function(response) {
					let result = JSON.parse(response);
					if (thisFn.key_input_checked() === '') {
						jQuery('#div_result_passwords').addClass('d-none');
						jQuery('#div_worrning_passwords').removeClass('d-none');
						jQuery('#div_worrning_passwords').html('Отметьте хотя бы один параметр строки - Цифры, Прописные буквы, Заглавные буквы или Спецсимволы!');
						return false;
					}else{
						if(typeof(result[0]) === 'number'){
							jQuery('#div_result_passwords').addClass('d-none');
							jQuery('#div_worrning_passwords').removeClass('d-none');
							jQuery('#div_worrning_passwords').html('Допустимое количество символов, от 4 до 100 - вводите, только целые числа!');
							return false;	
						}
					}
					
					jQuery('#div_worrning_passwords').addClass('d-none');
					jQuery('#div_result_passwords').removeClass('d-none');
					jQuery('#div_result_passwords').html('');
					for (let key_res in result) {
						jQuery('#div_result_passwords').append('<li class="list-group-item mb-1">'+result[key_res]+'</li>');
					}
				});
			}else{
				jQuery('#div_result_passwords').addClass('d-none');
				jQuery('#div_worrning_passwords').removeClass('d-none');
				jQuery('#div_worrning_passwords').html('Допустимое количество символов, от 4 до 100 - вводите, только целые числа!');
				return false;
			}
		});
	}
}

let genMD5 = {
	create_hash: function(){
		jQuery(document).ready(function($) {
			let data = {
				action: 'md5_gen_hash',
				nonce_code : ajax.nonce,
				str_for_md5: jQuery.trim(jQuery('#str_for_md5').val()),
			};
	
			jQuery.post( ajax.url, data, function(response) {
				let result = JSON.parse(response);
				
				if(typeof(result[0]) === 'number'){
					jQuery('#div_result_hash').addClass('d-none');;
					jQuery('#div_worrning_hash').removeClass('d-none');
					jQuery('#div_worrning_hash').html('Пустая строка - для получения хеша, введите значение в форму!');
					
				}else{
					jQuery('#div_worrning_hash').addClass('d-none');
					jQuery('#div_result_hash').removeClass('d-none');
					jQuery('#div_result_hash').html(result[0]);
				}
				return false;
			});
		});
	}
	
}

let thisFn = {
	characterless_int: function(str){
		let result;
		result = str.replace(/\s+/g,"");
		result = result.match(/\b\d{1,}\b/);
		return result;
	},

	key_input_checked: function(){
		let res = '';
		for (let i = 1; i < 5; i++) {
			if (jQuery('#check_'+i).is(":checked")) {
       			res += jQuery('#check_'+i).val();
   			}
		}
		return res;
	}
}