// news list image 
Util.Objects["audio"] = new function() {
	this.init = function(li) {

		u.ce(li);
		li.clicked = function() {

			if(!this.audioplayer) {
				this.audioplayer = u.audioPlayer();
			}

			if(!u.hc(this, "playing")) {
				this.audioplayer.loadAndPlay(this.url);
				u.ac(this, "playing");
			}
			else {
				this.audioplayer.stop();
				u.rc(this, "playing");
			}

		}

	}
}

