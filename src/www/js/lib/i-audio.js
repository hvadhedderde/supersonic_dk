Util.Objects["audio"] = new function() {
	this.init = function(scene) {

		if(!scene.audioplayer) {
			scene.audioplayer = u.audioPlayer();

			scene.audioplayer.loadeddata = function(event) {}

			// video ended
			scene.audioplayer.ended = function() {
				this.stop();

				var nodes = u.qsa("ul.audio li");
				var node, i;
				for(i = 0; node = nodes[i]; i++) {
					u.rc(node, "playing");
				}
			}
		}

		var nodes = u.qsa("ul.audio li", scene);
		var node, i;
		for(i = 0; node = nodes[i]; i++) {

			node.scene = scene;
			u.ce(node);
			node.moved = function(event) {
				u.e.resetEvents(this);
			}
			node.clicked = function(event) {

				var page = u.qs("#page");

				if(!u.hc(this, "playing")) {
					// add global audio player for sound effects

					var nodes = u.qsa("ul.audio li");
					var node, i;
					for(i = 0; node = nodes[i]; i++) {
						u.rc(node, "playing");
					}

					this.scene.audioplayer.loadAndPlay(this.url);

					u.ac(this, "playing");


				}
				else {
					this.scene.audioplayer.stop();
					u.rc(this, "playing");
				}
			}
		}

	}
}