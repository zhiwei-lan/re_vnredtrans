//jquery validate custom style 
	function errorPlacementCustom( error, element ){
		error.addClass( "help-block" );
		element.parents( ".form-group" ).addClass( "has-feedback" );
		if ( element.prop( "type" ) === "checkbox" ) {
			error.insertAfter( element.parent( "label" ) );
		} else {
			error.insertAfter( element );
		}
		if ( !element.next( "span" )[ 0 ] ) {
			$( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
		}	
	}
	function successCustom(label, element){
		if ( !$( element ).next( "span" )[ 0 ] ) {
			$( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
		}
	}
	function highlightCustom( element, errorClass, validClass){
		$( element ).parents( ".form-group" ).addClass( "has-error" ).removeClass( "has-success" );
		$( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
	}
	function unhighlightCustom(element, errorClass, validClass){
		$( element ).parents( ".form-group" ).addClass( "has-success" ).removeClass( "has-error" );
		$( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
	}
	
$(function () {
	//custom validation for checkpassword
	jQuery.validator.addMethod("checkpassword", function(value, element) {   
		var reg = /^(?![0-9]+$)(?![a-zA-Z]+$)[0-9a-zA-Z]{6,}$|^[a-zA-Z]{6,}$/;
	  return this.optional( element ) || (reg.test( value ));
	}, '영문+숫자 조합으로 공백없이 설정하셔야 합니다.');
	
	//custom validation for checkid
	jQuery.validator.addMethod("checkid", function(value, element) {   
		var reg = /[/W]/g;
	  return this.optional( element ) || (reg.test( value ));
	}, '영문+숫자 조합으로 공백없이 설정하셔야 합니다.');
	
	// Limit the size of each individual file in a FileList.
	 $.validator.addMethod( "maxsize", function( value, element, param ) {
		if ( this.optional( element ) ) {
			return true;
		}
		if ( $( element ).attr( "type" ) === "file" ) {
			if ( element.files && element.files.length ) {
				for ( var i = 0; i < element.files.length; i++ ) {
					if ( element.files[ i ].size > param ) {
						return false;
					}
				}
			}
		}
		return true;
	 }, $.validator.format( "File size must not exceed {0} bytes each." ) );
	 

});
