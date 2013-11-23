Util.Objects["intro"] = new function() {
	this.init = function(node) {

		var page = u.qs("#page");
		// add global audio player for sound effects
		page.videoplayer = u.videoPlayer();
		u.ae(node, page.videoplayer);

		page.videoplayer.ended = function() {
			u.t.setTimer(this.parentNode, this.parentNode.clicked, 1500);
//			u.bug("move on")
		}
		page.videoplayer.loadAndPlay("/media/video/intro_1/960x480.mp4")

		u.e.click(node);
		node.clicked = function() {
			location.href = "/news";
		}

	}
}