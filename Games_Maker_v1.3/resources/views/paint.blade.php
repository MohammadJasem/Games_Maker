@extends('layouts.master_page')

@section('title','Paint')

@section('content')
{{----------------------------------------------------------------}}

    <input type="hidden" id="userId" value={{$_COOKIE['userId']}}>
    <input type="hidden" id="gameId" value={{$_COOKIE['gameId']}}>
    <input type="hidden" id="userName" value={{$_COOKIE['username']}}>
    <input type="hidden" id="gameName" value={{$gameName}}>
    <input type="hidden" id="gameFullName" value={{$gameFullName}}>

{{----------------------------------------------------------------}}



<div class="bgimg" style="background-image: url('{{url('img/login_reg.jpg')}}');height: 100%">

    @include('partials.paint_header')
    <div class="toc" style="top:0px;width: 200px !important;z-index: -1;bottom: 0px;">
        <div class="ui vertical inverted sticky menu top fixed" style="padding-top: 50px; margin-top: 45px;z-index: -1;overflow-y: auto;bottom: 0px;">
      <div class="ui equal width center aligned padded grid" style="color: #ffffff">
        <div class="row">
            <div class="column">
                <div id="previewImg"></div>
            </div>
        </div>
        <div class="row">
            <button class="eraseAll ui violet button mini" id="eraseAll">Erase All&nbsp;&nbsp;&nbsp;<i class="eraser icon"></i></button>
        </div>
        <div class="row">
          <div class="column">
            <i class="undo large icon hand" id="undo" disabled="disabled" data-content="Undo" data-position="top center" data-variation="mini"></i>
          </div>
          <div class="column">
            <i class="redo repeat large icon hand" id="redo" disabled="disabled" data-content="Redo" data-position="right center" data-variation="mini"></i>
          </div>
        </div>
        <div class="row">
          <div class="column">
            <i class="pencil large icon hand violet isClicked" id="pencil" data-content="Pencil" data-position="top center" data-variation="mini"></i>
          </div>
          <div class="column">
            <i class="eraser large icon hand" id="eraser" data-content="Eraser" data-position="right center" data-variation="mini"></i>
          </div>
        </div>
        <div class="row">
            <div class="column">
                <input type="text" id="colorPicker" style="width: 100px" data-content="Pencil Color" data-position="right center" data-variation="mini">
            </div>
          <div class="column">
            <i class="eye dropper large icon hand" id="eyeDropper" data-content="Eye Dropper" data-position="right center" data-variation="mini"></i>
          </div>
        </div>
          <div class="row">
              <div class="inline field">
                  <label for="game_width" style="color: white">Width</label>
                  <div class="ui slidecontainer right labeled">
                      <input type="range" min="0" max="3" value="0" class="slider" id="grid_width">
                      <span class="ui left violet circular label mini" id="gridWidthVal"></span>
                  </div>
              </div>
          </div>
        <div class="row">
            <div class="column">
                <form id="imageName">
                    <div class="field">
                        <label for="image_name" style="float: left;">Image Name</label>
                        <div class="ui corner labeled input mini" data-content="Image Name" data-position="left center" data-variation="mini">
                            <input type="text" id="image_name" name="image_name" class="gm_req popInput" value="{{$paint_name}}">
                            <div class="ui corner label">
                                <i class="asterisk icon" style="color:#f14141;"></i>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="column">
                <button class="ui violet button small" id="saveToImg">Save As Image</button>
            </div>
        </div>
      </div>
    </div>
</div>

    <input type="hidden" id="paintId" value="{{$paintId}}">
    <div class="ui container pixel-picker-container" id="paintGrid" style="background: transparent;position: absolute;top: 100px;left: 500px;width: 512px;">
        @for($i = 0;$i < 32;$i++)
            <div class="pixel-picker-row" data-row-num="{{$i}}">
                @for($j = 0;$j < 32;$j++)
                    <div class="pixel-picker-cell row-{{$i}}-cell-{{$j}}" data-row-num="{{$i}}" data-cell-num="{{$j}}" style="background-color: {{$pixelsColorArr[$i][$j]}}"></div>
                @endfor
            </div>
        @endfor
    </div>
</div>

@stop

@section('myScripts')
<script type="text/javascript" src="{{js('paint.js')}}"></script>
@stop