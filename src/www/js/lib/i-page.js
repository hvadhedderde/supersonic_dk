
Util.Objects["page"] = new function() {
	this.init = function(page) {

		u.flash_video_player = "/media/flash/videoplayer.swf";
		// page is ready
		u.ac(page, "ready");

	}
}

u.e.addDOMReadyEvent(u.init);
