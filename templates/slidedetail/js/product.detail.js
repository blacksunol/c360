$(document).ready(function($) 
{
	YUE.onContentReady('base', function () {
		var imageDetail_imageType = runParams.imageDetail_imageType,
			imageDetail_imageExist = runParams.imageDetail_imageExist,
			adminSeq = runParams.adminSeq,
			companyId = runParams.companyId,
			productId = runParams.productId,
			startValidDate = runParams.startValidDate,
			feedbackServer = runParams.feedbackServer,
			imageServer = runParams.imageServer,
			userCountry = runParams.userCountry,
			freightServer = runParams.freightServer,
			userType = runParams.userType,
			productTradeCount = runParams.productTradeCount;		
		if(shopDetail.isSub == 0){
			if (!get('run-params')) {		
				INF_IMAGE_SHOW = (new AE.run.infImageShow());
				INF_IMAGE_SHOW.init({
					sINFImageContainerId: 'img',
					sSICClassName: 'image-nav-item',
					sMICClassName: 'image-item',
					iMICWH: 300,
					iSICWH: 35,
					//sZoomHref: runParams.imageDetailPageURL,
					bEnableMagnifier: true,
					sSICSelectedClassName: 'current',
					oImageResource: [],
					aBISrc: runParams.imageURL
				});

				$('#img-gallerySlider').bxSlider({
					auto: false,
					infiniteLoop: false,
					speed: 500,
					pause: 4000,
					displaySlideQty: 4,
					moveSlideQty: 4
				});		
			}  
		}
	});
	
});
