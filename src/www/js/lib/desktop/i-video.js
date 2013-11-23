Util.Objects["video"] = new function() {
	this.init = function(scene) {

		var video = u.qs(".video", scene);
		scene._item_id = u.cv(video, "item_id");
		scene._screendump = u.cv(video, "screendump");
		var page = u.qs("#page");
		// add global audio player for sound effects
		if(!page.videoplayer) {
			page.videoplayer = u.videoPlayer();
		}

		if(!page.videoplayer._controls) {
			page.videoplayer._controls = u.ae(page.videoplayer, "div", {"class":"controls"});

			u.e.click(page.videoplayer._controls);
			page.videoplayer._controls.clicked = function(event) {

				// video is active, toggle play/pause
				if(u.hc(this.parentNode, "active")) {

					if(u.hc(this.parentNode, "playing")) {
						this.parentNode.pause();
					}
					else {
						// specific play tracking
						u.stats.event(this.parentNode, "play video", location.href);

						this.parentNode.play();
					}

				}
				// video not active yet
				else {
					var src = u.qs(".watch a").href;
					this.parentNode.loadAndPlay(src);
					u.ac(this.parentNode, "active");

					if(u.e.event_pref == "touch") {
						page.videoplayer.video.controls = true;
					}
					// autohide controls when inactive
					if(u.e.event_pref == "mouse") {
						page.videoplayer._controls.onmousemove = function() {
							u.t.resetTimer(this.t_hide);
							u.a.transition(this, "all 0.3s ease-in");
							u.a.setOpacity(this, 1);
							this.t_hide = u.t.setTimer(this, this.onmouseout, 800);
						}
						page.videoplayer._controls.onmouseout = function() {
							u.a.transition(this, "all 0.3s ease-in");
							u.a.setOpacity(this, 0);
						}

						this.t_hide = u.t.setTimer(this, this.onmouseout, 500);
					}

					// video ended
					page.videoplayer.ended = function() {
						this.ended = null;
						this.stop();
						u.rc(this, "active");

						// show controls
						u.a.transition(this._controls, "all 0.3s ease-in");
						u.a.setOpacity(this._controls, 1);

						// close fullscreen on end
						if(u.qs("#page").fullscreen) {
							u.qs("#page").fullscreen.clicked();
						}

						// disable autohide
						if(u.e.event_pref == "mouse") {
							this._controls.onmouseover = null;
							this._controls.onmouseout = null;
						}
					}
				}

			}

			if(u.e.event_pref == "mouse") {
				// enable fullscreen audio
				page.videoplayer._controls._zoom = u.ae(page.videoplayer._controls, "div", {"class":"zoom"});
				page.videoplayer._controls._zoom.page = page;
				u.e.click(page.videoplayer._controls._zoom);
				page.videoplayer._controls._zoom.clicked = function(event) {

					// page ready for fullscreen
					this.page.transitioned = function(event) {

						// remember scroll position
						this._scrolled_to = u.scrollY();
						// hide page
						u.as(this, "display", "none");

						// inject fullscreen
						this.fullscreen = u.ae(document.body, "div", {"id":"fullscreen", "html":"<div><h1>Shhhh!</h1><p>Fullscreen audio</p></div>"});
						this.fullscreen.page = this;

						// enable closing of fullscreen
						u.e.click(this.fullscreen);
						this.fullscreen.clicked = function(event) {
							u.as(this, "display", "none");

							// page is shown - remove fullscreen
							this.page.transitioned = function() {
								if(this.fullscreen.parentNode) {
									this.fullscreen.parentNode.removeChild(this.fullscreen);
								}
								u.a.transition(this, "none");
								this.transitioned = null;
								this.fullscreen = null;
							}
							// show page
							u.as(this.page, "display", "block");
							window.scrollTo(0, this.page._scrolled_to);
							u.a.setOpacity(this.page, 1);
						}
					}

					// fade out page
					u.a.transition(this.page, "all 0.5s ease-in");
					u.a.setOpacity(this.page, 0);
				
				
				}
			}
		}

		// append video player
		u.ae(video, page.videoplayer);

		// add screendump if available
		if(scene._screendump) {
			u.as(page.videoplayer, "backgroundImage", "url(/images/"+scene._item_id+"/screendump/512x288."+scene._screendump+")");
		}
	}
}