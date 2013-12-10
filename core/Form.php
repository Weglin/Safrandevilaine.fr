<?php
class Form{

	public static function input($name, $label, $value=null, $type='text', $options=null){
		$html = '<div class="clearfix">';
		if($type<>"hidden"){
			$html.='<label for="input'.$name.'">'.$label.'</label>';
		}
		switch ($type) {
			case 'password' :
				$html.='<input type="'.$type.'" id="input'.$name.'" name="'.$name.'" value="'.$value.'" autocomplete="off" >';
				break;
			case 'textarea':
				$html.='<textarea name="'.$name.'" id="input'.$name.'" '.$options.'>'.$value.'</textarea>';
				break;
			case 'checkbox':
				$html.='<input type="hidden" name="'.$name.'" value="0">';
				$html.='<input type="checkbox" name="'.$name.'" id="input'.$name.'" ';
				if (intval($value)==1){
					$html.='checked="checked" ';}
				$html.= 'value="1" />';
				break;
			case 'hidden':
				$html.='<input type="hidden" name="'.$name.'" value="'.$value.'">';
				break;
			case 'select' :
				$html.='<select name="'.$name.'" id="input'.$name.'">';
				if (!empty($value)){
					foreach ($value as $k => $v){
						$html.='<option value="'.$k.'" ';
						if ($k==$options){
							$html.= 'selected';
						}
						$html.='> '.$v.'</option>';
					}
					$html.='</select>';
				}else{
					$html.='<input type="hidden" name="'.$name.'">';
				}
				break;
			case 'dateTime' :
				$html.='<input type="datetime" id="input'.$name.'" name="'.$name.'" value="'.$value.'" '.$options.'>';
				if ($options=='disabled'){
					$html.='<input type="hidden" name="'.$name.'" value="'.$value.'">';
				}
				break;
			case 'file' :
				$html.='<input type="file" class="input-file" id="input'.$name.'" name="'.$name.'" value="'.$value.'">';
				break;
			default:
				$html.='<input type="'.$type.'" id="input'.$name.'" name="'.$name.'" value="'.$value.'">';
		}
		$html.='</div>';
		return $html; 
	}
}
?>