@extends('layouts.master_page')

@section('title','Build Game')

@section('content')
{{----------------------------------------------------------------}}
<form id="pixelForm" class="hide">
    <input type="hidden" name="stateId" id="stateId">
    <input type="hidden" name="pixelId" id="pixelId">
    <input type="hidden" name="row" id="row">
    <input type="hidden" name="cell" id="cell">
    <input type="hidden" name="isDeleteContent" id="isDeleteContent" value="F">
    <div class="ui equal width form">
        <div class="fields">
          <div class="field deleteContentDiv hide">
            <div class="ui toggle checkbox red">
              <input name="deleteContent" id="deleteContent" type="checkbox">
              <label for="deleteContent">Delete Content</label>
            </div>
          </div>
        </div>
        <div class="fields">
            <div class="field">
                <label for="contentType">Content Type</label>
                <div class="ui corner labeled input">
                    <select id="contentType" name="contentType" class="ui dropdown gm_req">
                        <option value=""></option>
                        <option value="IMG">Image</option>
                        <option value="PNT">Paint</option>
                        <option value="LBL">Label</option>
                    </select>
                    @include('partials.req_star')
                </div>
            </div>
            <div class="field">
                <div class="imgContentDiv field hide">
                    <label for="imgContent">Content</label>
                    <div class="ui corner labeled input">
                        <select id="imgContent" name="imgContent" class="ui dropdown gm_req">
                        </select>
                        @include('partials.req_star')
                    </div>
                </div>
                <div class="pntContentDiv field hide">
                    <label for="pntContent">Content</label>
                    <div class="ui corner labeled input">
                        <select id="pntContent" name="pntContent" class="ui dropdown gm_req">
                        </select>
                        @include('partials.req_star')
                    </div>
                </div>
                <div class="lblContentDiv hide">
                  <div class="field">
                    <label for="lblContent">Content</label>
                    <div class="ui corner labeled input">
                        <input type="text" id="lblContent" name="lblContent" class="gm_req" maxlength="1">
                        @include('partials.req_star')
                    </div>
                  </div>
                  <div class="field">
                    <label for="textColor">Label Color</label>
                    <div class="ui corner labeled input">
                        <input type="text" id="textColor" style="width: 100px">
                    </div>
                  </div>
                  <div class="field">
                    <label for="fontFamily">Font Family</label>
                    <div class="ui corner labeled input">
                        <select id="fontFamily" name="fontFamily" class="ui dropdown">
                            <option value=""></option>
                            <option value="cursive">Cursive</option>
                            <option value="fantasy">Fantasy</option>
                            <option value="monospace">Monospace</option>
                            <option value="sans-serif">Sans-serif</option>
                            <option value="serif">Serif</option>
                        </select>
                    </div>
                  </div>
                </div>
            </div>
            <div class="field groupCodeDiv hide">
              <div class="field">
                <label for="groupCode">Group Code</label>
                <div class="ui corner labeled input">
                    <input type="text" class="gm_req" id="groupCode" name="groupCode">
                    @include('partials.req_star')
                </div>
              </div>
            </div>
        </div>
        <div class="fields">
            <div class="field" style="margin-top: 50px;text-align: center;">
                <img id="imagePreview" src="" width="20px">
            </div>
        </div>
        <div class="fields">
          <div class="field eventDiv hide">
            <label for="eventNameCode">Event</label>
            <div class="ui corner labeled input">
                <select id="eventNameCode" name="eventNameCode" class="ui dropdown">
                    <option value=""></option>
                    <option value="RNDM_PSN">Random Position</option>
                    <option value="FXD_PSN">Fixed Position</option>
                    <option value="FXD_PSN_DSTR">Fixed Position,Can Be Destroyed</option>
                    <option value="MOVING">Moving</option>
                    <option value="MOVING_COLLISION">Moving with Collision</option>
                    <option value="MOVING_COLLISION_VAR">Moving with Collision,Result</option>
                </select>
            </div>
            <br>
            <br>
            <br>
          </div>
        </div>
        <div class="fields">
          <div class="field collisiedPixelDiv hide">
            <label for="collisiedPixelCode">Collisied Pixel</label>
            <div class="ui corner labeled input">
                <select id="collisiedPixelCode" name="collisiedPixelCode" class="ui dropdown">
                </select>
            </div>
            <br>
            <br>
            <br>
          </div>
          <div class="field resultPixelDiv hide">
            <label for="resultPixelCode">Result Pixel</label>
            <div class="ui corner labeled input">
                <select id="resultPixelCode" name="resultPixelCode" class="ui dropdown">
                </select>
            </div>
            <br>
            <br>
            <br>
          </div>
        </div>
      </div>
    </div>
    <br>
    <br>
    <br>
</form>
{{----------------------------------------------------------------}}
<form id="gameSettingsForm" class="hide">
  <div class="ui equal width form">
      <div class="fields">
        <div class="inline field">
          <label for="game_width" style="color: white">Width</label>
          <div class="ui slidecontainer right labeled">
        <input type="range" min="4" max="48" value="4" class="slider" id="game_width" name="game_width">
        <span class="ui left blue circular label mini" id="gameWidthVal" style="margin-left:2px"></span>
      </div>
      </div>
    </div>
  </div>
<div class="ui equal width form">
      <div class="fields">
        <div class="inline field">
          <label for="game_height" style="color: white">Height</label>
          <div class="ui slidecontainer right labeled">
        <input type="range"  min="4" max="23" value="4" class="slider" id="game_height" name="game_height">
        <span class="ui left blue circular label mini" id="gameHeightVal" style="margin-left:2px"></span>
      </div>
      </div>
  </div>
  </div>
  <div class="ui equal width form">
      <div class="fields">
        <div class="field">
            <label for="local_storage_name" style="color: white">Local Storage Name</label>
            <div class="ui corner labeled input mini">
              <input type="text" id="local_storage_name" name="local_storage_name" class="gm_req popInput">
              @include('partials.req_star')
            </div>
        </div>
    </div>
  </div>
</form>
{{----------------------------------------------------------------}}
<form id="stateForm" class="hide">
    <div class="ui equal width form" style="height: 260px;min-width: 420px;">
      <div class="levelCont">
          <div class="fields stateRowInfoTemp" style="display: none">
            <input type="hidden" id="state_id" name="state_id[]">
            <input type="hidden" id="is_default" name="is_default[]" value="N">
            <div class="field">
                <div class="ui corner labeled input mini" data-content="Level Name" data-position="left center" data-variation="mini">
                  <input type="text" id="state_name" name="state_name[]" class="gm_req popInput">
                  @include('partials.req_star')
                </div>
            </div>
            <div class="field">
                <button type="button" id="backgroundStateId" class="backgroundState ui violet button icon mini" data-content="Background" data-variation="mini"><i class="icon image"></i></button>
            </div>
            <div class="field">
                <button type="button" id="audioStateId" class="audioState ui orange button icon mini" data-content="Audio" data-variation="mini"><i class="icon music"></i></button>
            </div>
            <div class="field">
              <button type="button" id="loadStateId" class="loadState ui blue button icon mini" data-content="Load" data-variation="mini"><i class="icon download"></i></button>
            </div>
            <div class="field">
                <div class="ui corner labeled input mini" data-content="Level Order" data-variation="mini">
                  <input type="text" id="state_order" name="state_order[]" maxlength="2" class="gm_req gm_number popInput" style="width: 80px;">
                  @include('partials.req_star')
                </div>
            </div>
            <div class="field">
              <button type="button" id="deleteStateId" class="deleteState ui red button icon mini" data-content="Delete" data-position="right center" data-variation="mini"><i class="icon trash"></i></button>
            </div>
          </div>
      </div>
      <div class="ui" style="width: 100%;position: absolute;bottom: 0;padding-bottom: 15px;">
        <div style="float: left"><span id="remainLevels">2</span>/5 free levels remaining</div>
        <div style="position: absolute;right: 0;">
          <button type="button" id="addStateId" class="addState ui icon button mini green" data-content="Add" data-position="right center" data-variation="mini"><i class="add icon"></i></button>
        </div>
      </div>
    </div>
</form>
{{----------------------------------------------------------------}}
<form id="gameFilesForm" class="hide">
    <div class="ui equal width form">
        <div class="fields">
          <div class="field">
              <label for="fileName">File Name</label>
              <div class="ui corner labeled input">
                <input type="text" id="fileName" name="fileName" class="gm_req">
                @include('partials.req_star')
              </div>
          </div>
          <div class="field">
              <label for="fileType">File Type</label>
              <div class="ui corner labeled input">
                <select id="fileType" name="fileType" class="ui dropdown gm_req">
                  <option value=""></option>
                  <option value="IMAGE">Image</option>
                  <option value="AUDIO">Audio</option>
                  <option value="FONT">Font</option>
                </select>
                @include('partials.req_star')
              </div>
          </div>
      </div>
      <div class="fields">
        <div class="field">
          <input type="file" name="gameFile" id="gameFile" class="filepond" data-max-file-size="10MB" accept="">
        </div>
      </div>
    </div>
</form>

{{----------------------------------------------------------------}}
{{----------------------------------------------------------------}}
<form id="setBackgroundForm" class="hide">
    <div class="ui equal width form">
        <input type="hidden" id="img_id">
        <input type="hidden" id="img_state_id">
        <div class="fields">
          <div class="field"></div>
          <div class="field">
              <label for="bkGrndType">Image Or Color</label>
              <div class="ui corner labeled input">
                  <select id="bkGrndType" name="bkGrndType" class="ui gm_req">
                      <option value="I">Image</option>
                      <option value="C">Color</option>
                  </select>
              </div>
          </div>
            <div class="field"></div>
        </div>
        <div class="bckGrndClr hide">
            <div class="fields hide">
                <div class="field"></div>
                <div class="field ">
                    <input type="text" id="colorPicker" style="width: 100px">
                </div>
                <div class="field"></div>
            </div>
        </div>
        <div class="bckGrndImg">
            <div class="fields">
              <div class="field">
                  <label for="imageName">Image</label>
                  <div class="ui corner labeled input">
                    <select id="imageName" name="imageName" class="ui gm_req">
                    </select>
                    @include('partials.req_star')
                  </div>
              </div>
              <div class="field">
                  <label for="setAsbtn">&nbsp;</label>
                  <div class="ui toggle checkbox">
                      <input type="checkbox" id="setAsbtn" name="setAsbtn">
                      <label>Set Image As Button</label>
                  </div>
              </div>
              <div class="field">
                  <div id="nxtBckGrnDiv" class="hide">
                      <input type="hidden" id="nextStateId">
                      <label for="nxtBckGrnTxt">&nbsp;</label>
                      <div class="ui" id="nxtBckGrnTxt">
                      </div>
                  </div>
              </div>
          </div>
          <div class="fields">
            <div class="field">
              <img id="imagePreview" src="" width="100%">
            </div>
          </div>
        </div>
    </div>
</form>
{{----------------------------------------------------------------}}
{{----------------------------------------------------------------}}
<form id="paintsForm" class="hide">
    <div class="ui equal width form" style="height: 300px;min-width: 560px;">
        <div class="fields paintRowInfoTemp" style="display: none;padding: 5px;margin: 5px;">
          <input type="hidden" id="paintId" name="paintId[]">
          <input type="hidden" id="paintColors" name="paintColors[]" class="paintColors">
          <div class="field" style="width: 350px;">
            <div class="ui image label teal " data-content="Paint Name" data-position="left center" data-variation="mini">
              <div class="imageThumbnail" style="display:inline-block;"></div>
              <span class="paintName"></span>
            </div>
          </div>
          <div class="field">
            <div id="deletePaintId" class="deletePaint ui red button icon mini" data-content="Delete" data-variation="mini" style="float: right"><i class="icon trash"></i></div>
            <div id="editPaintId" class="editPaint ui blue button icon mini" data-content="Edit" data-variation="mini" style="float: right"><i class="icon write square"></i></div>
          </div>
        </div>
        <input type="hidden" id="paintsCount" name="paintsCount" class="paintsCount">
        <div id="paintsContentSec1" style="min-width: 275px;display: inline-block;max-width: 275px;"></div>
        <div class="ui vertical divider"></div>
        <div id="paintsContentSec2" style="position: absolute;padding-left: 10px;min-width: 275px;display: inline-block;max-width: 275px;"></div>
        <div class="ui" style="width: 100%;position: absolute;bottom: 0;padding-bottom: 15px;">
          <div style="float: left"><span id="remainPaints">10</span>/10 free paints remaining</div>
          <div style="position: absolute;right: 0;">
            <button type="button" id="addPaintId" class="addPaint ui icon button mini green" data-content="Add" data-position="right center" data-variation="mini"><i class="add icon"></i></button>
          </div>
        </div>
    </div>
</form>
{{----------------------------------------------------------------}}
{{----------------------------------------------------------------}}

    <input type="hidden" id="userId" value={{$_COOKIE['userId']}}>
    <input type="hidden" id="gameId" value={{$_COOKIE['gameId']}}>
    <input type="hidden" id="userName" value={{$_COOKIE['username']}}>
    <input type="hidden" id="gameName" value={{$gameName}}>
    <input type="hidden" id="gameFullName" value={{$gameFullName}}>

{{----------------------------------------------------------------}}

@include('partials.keyboard')
@include('partials.events')

<div class="bgimg" style="background-image: url('{{url('img/login_reg.jpg')}}');padding-bottom: 200px;height: 100%">

@include('partials.build_game_sidebar')

  <div class="ui menu">
    @include('partials.build_game_header')
  </div>
  <div class="ui container" style="margin-left: 170px !important;margin-top: 40px;background-color: white">
      <input type="hidden" id="currentStateId" value="{{$firstStateId}}">
      <div class="ui container pixel-32-container" id="levelGrid" style="background-color: #80808059;position: absolute;top: 100px;left: 250px;width: 960px;">
      	@for($i = 1;$i <=23;$i++)
          	<div class="pixel-32-row" data-row-num="{{$i}}">
              	@for($j = 1;$j <=48;$j++)
              		@if($i>$gameHeight||$j>$gameWidth)
              			<div class="pixel-32-cell row-{{$i}}-cell-{{$j}} hidden-pixel" data-row-num="{{$i}}" data-cell-num="{{$j}}"></div>
              		@else
              			<div class="pixel-32-cell hvr-reveal row-{{$i}}-cell-{{$j}}" data-row-num="{{$i}}" data-cell-num="{{$j}}"></div>
              		@endif
              	@endfor
          	</div>
      	@endfor
      </div>
</div>

  @include('partials.footer')

</div>

@stop

@section('myScripts')
<script type="text/javascript" src="{{js('build_game.js')}}"></script>
<script type="text/javascript" src="{{js('keyboard.js')}}"></script>
<script type="text/javascript" src="{{js('events.js')}}"></script>
@stop