

<link rel="stylesheet" type="text/css" href="{{url("fontawesome/css/font-awesome.min.css")}}">
<link rel="stylesheet" type="text/css" href="{{url('semantic/semantic.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('filepond/filepond.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{url('filepond/filepond-plugin-image-preview.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{url('toastr/toastr.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{url('spectrum/spectrum.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{url('spectrum/sp-dark.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{url('css/rangeSlider.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{url('css/pixel-picker.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{url('css/pixel-32.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{url('lity/lity.css')}}"/>

<style>
/****************************************************/
.ui.toggle.checkbox.red input:focus:checked~.box:before,
.ui.toggle.checkbox.red input:focus:checked~label:before {
    background-color: #FF695E !important
}

.ui.toggle.checkbox.red input:checked ~ .box:before,
.ui.toggle.checkbox.red input:checked ~ label:before {
  background-color: #FF695E !important;
}


.hollow-dots-spinner, .hollow-dots-spinner * {
    box-sizing: border-box;
}

.hollow-dots-spinner {
    height: 50px;
    width: 150px;
}

.hollow-dots-spinner .dot {
    width: 30px;
    height: 30px;
    margin: 0 calc(15px / 2);
    border: calc(30px / 5) solid #34b091;
    border-radius: 50%;
    float: left;
    transform: scale(0);
    animation: hollow-dots-spinner-animation 1000ms ease infinite 0ms;
}

.hollow-dots-spinner .dot:nth-child(1) {
    animation-delay: calc(300ms * 1);
}

.hollow-dots-spinner .dot:nth-child(2) {
    animation-delay: calc(300ms * 2);
}

.hollow-dots-spinner .dot:nth-child(3) {
    animation-delay: calc(300ms * 3);

}

@keyframes  hollow-dots-spinner-animation {
    50% {
        transform: scale(1);
        opacity: 1;
    }
    100% {
        opacity: 0;
    }
}

.gm-loader {
    position: fixed;
    top: 0;
    right: 0;
    width: 100%;
    height: 100%;
    z-index: 1000;
    background-color: #c5c5c591;
}
.preloader {
    position: absolute;
    top: 50%;
    left: 45%;
    z-index: 9999;
}
/****************************************************/


.levelGridIcons .icon{
    color:white;
}
.levelGridIcons .icon.selectedIcon{
    color:#032640;
}
#levelGrid .pixel-32-cell.hidden-pixel{
    background:transparent;
}
/* Reveal */
.hvr-reveal {
  /*display: inline-block;*/
  vertical-align: middle;
  -webkit-transform: perspective(1px) translateZ(0);
  /*transform: perspective(1px) translateZ(0);*/
  /*box-shadow: 0 0 1px transparent;*/
  position: relative;
  overflow: hidden;
}
.hvr-reveal:before {
  content: "";
  position: absolute;
  z-index: -1;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  border-color: #2098D1;
  border-style: solid;
  border-width: 0;
  -webkit-transition-property: border-width;
  transition-property: border-width;
  -webkit-transition-duration: 0.1s;
  transition-duration: 0.1s;
  -webkit-transition-timing-function: ease-out;
  transition-timing-function: ease-out;
}
.hvr-reveal:hover:before, .hvr-reveal:focus:before, .hvr-reveal:active:before {
  -webkit-transform: translateY(0);
  transform: translateY(0);
  border-width: 1px;
}
#footer .wrap {
    background: #0e6eb89e;
    border-top-left-radius: 75%;
    border-top-right-radius: 75%;
  }
.undo[disabled] , .redo[disabled]{
    color: #c1c1c1;
    cursor: no-drop;
}
input.popInput{
    color:  white !important;
    background-color: #202123 !important;
}
.screen .toolbar .title {
    font-size: 14px;
    color: #000;
    text-align: center;
    margin-right: 80px;
    padding-top: 5px;
}
.screen .frameWrapper {
    background: #fff;
    padding-top: 0px;
    position: relative;
}
.screen .toolbar .buttons {
    float: left;
    height: 13px;
    margin-top: 11px;
}
.screen .toolbar .left.red {
    background: #E74C3C;
}
.screen .toolbar .left.yellow {
    background: #F4A62A;
}
.screen .toolbar .left.green {
    background: #16A085;
}
.screen .toolbar .left {
    display: block;
    width: 13px;
    height: 13px;
    float: left;
    border-radius: 13px;
    margin-right: 6px;
}
.screen .toolbar {
    background: #E1E0E0;
    height: 35px;
    padding: 0px 0px 0px 11px;
}
.screen {
    margin: 0px auto 30px;
}	
.ui.corner.labeled .dropdown.selection .dropdown.icon{
	right:3em !important;
}
.ui.corner.labeled .dropdown.selection{
	width:100% !important;
}
label.error{
    float: left;
	color:#ff3b3b !important;
}
.hand{
	cursor: pointer;
}
.hide{
	display: none;
}
div.header span.closeModal{
	float: right;
}
.text-col-center{
	text-align: center !important;
}
div.bgimg{
	/*opacity: 0.8;*/
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow-y: auto;
    overflow-x: hidden;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
div.pixel-picker-row div.customHeight{
    height: 15px;
}
</style>