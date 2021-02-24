//----------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------//
function createImageFromRGBdata(rgbData, width, height){
	var mCanvas = newEl('canvas');
	mCanvas.width = width;
	mCanvas.height = height;
	
	var mContext = mCanvas.getContext('2d');
	var mImgData = mContext.createImageData(width, height);
	
	var srcIndex=0, dstIndex=0, curPixelNum=0;
	
	for (curPixelNum=0; curPixelNum<width*height;  curPixelNum++){
		mImgData.data[dstIndex] = rgbData[srcIndex];		// r
		mImgData.data[dstIndex+1] = rgbData[srcIndex+1];	// g
		mImgData.data[dstIndex+2] = rgbData[srcIndex+2];	// b
		mImgData.data[dstIndex+3] = 255; // 255 = 0xFF - constant alpha, 100% opaque
		srcIndex += 3;
		dstIndex += 4;
	}
	mContext.putImageData(mImgData, 0, 0);
	return mCanvas;
}
//----------------------------------------------------------------------------------------------------------//
function rgb2arr(rgb) {
	rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
	return [rgb[1] , rgb[2] , rgb[3] , rgb[1] , rgb[2] , rgb[3]];
}
//----------------------------------------------------------------------------------------------------------//
function newEl(tag){return document.createElement(tag);}
//----------------------------------------------------------------------------------------------------------//
function getConvertArray2Img(rgbArray, width, height){
	// 1. - append data as a canvas element
	var mCanvas = createImageFromRGBdata(rgbArray, width, height);
	mCanvas.setAttribute('style', "width:64px; height:64px;"); // make it large enough to be visible
	
	// 2 - append data as a (saveable) image
	var mImg = newEl("img");
	var imgDataUrl = mCanvas.toDataURL();	// make a base64 string of the image data (the array above)
	mImg.src = imgDataUrl;
	mImg.setAttribute('style', "width:64px; height:64px;"); // make it large enough to be visible
	return mImg;
}
//----------------------------------------------------------------------------------------------------------//
function getConvertArray2Img_32(rgbArray, width, height){
    // 1. - append data as a canvas element
    var mCanvas = createImageFromRGBdata(rgbArray, width, height);
    mCanvas.setAttribute('style', "width:32px; height:32px;"); // make it large enough to be visible

    // 2 - append data as a (saveable) image
    var mImg = newEl("img");
    var imgDataUrl = mCanvas.toDataURL();	// make a base64 string of the image data (the array above)
    mImg.src = imgDataUrl;
    mImg.setAttribute('style', "width:32px; height:32px;"); // make it large enough to be visible
    return mImg;
}

