<?php

class Hint {

	private static $_loaded = FALSE;

	public static function scr () {
		
		return '<style type="text/css">

/* All form elements are within the definition list for this example */
dl {
    font:normal 12px/15px Arial;
    position: relative;
    width: 350px;
}
dt {
    clear: both;
    float:left;
    width: 130px;
    padding: 4px 0 2px 0;
    text-align: left;
}
dd {
    float: left;
    width: 200px;
    margin: 0 0 8px 0;
    padding-left: 6px;
}


/* The hint to Hide and Show */
.hint {
   	display: none;
    position: absolute;
    right: -250px;
    width: 185px;
    margin-top: -4px;
    border: 1px solid #c93;
    padding: 10px 12px;
    background: #ffc;
	font-size:10px;
	text-align: left;
}

.hint p {
	line-height: 130%;
	padding-bottom:5px;
}

/* The pointer image is hadded by using another span */
.hint .hint-pointer {
    position: absolute;
    left: -10px;
    top: 5px;
    width: 10px;
    height: 19px;
    background: url(pointer.gif) left top no-repeat;
}
</style>
<script type="text/javascript">
function addLoadEvent(func) {
  var oldonload = window.onload;
  if (typeof window.onload != \'function\') {
    window.onload = func;
  } else {
    window.onload = function() {
      oldonload();
      func();
    }
  }
}

function prepareInputsForHints() {
	var inputs = document.getElementsByTagName("input");
	for (var i=0; i<inputs.length; i++){
		// test to see if the hint span exists first
		if (inputs[i].parentNode.getElementsByTagName("span")[0]) {
			// the span exists!  on focus, show the hint
			inputs[i].onfocus = function () {
				this.parentNode.getElementsByTagName("span")[0].style.display = "inline";
			}
			// when the cursor moves away from the field, hide the hint
			inputs[i].onblur = function () {
				this.parentNode.getElementsByTagName("span")[0].style.display = "none";
			}
		}
	}
	// repeat the same tests as above for selects
	var selects = document.getElementsByTagName("select");
	for (var k=0; k<selects.length; k++){
		if (selects[k].parentNode.getElementsByTagName("span")[0]) {
			selects[k].onfocus = function () {
				this.parentNode.getElementsByTagName("span")[0].style.display = "inline";
			}
			selects[k].onblur = function () {
				this.parentNode.getElementsByTagName("span")[0].style.display = "none";
			}
		}
	}
}
addLoadEvent(prepareInputsForHints);
</script>';
		
	}
	
}
