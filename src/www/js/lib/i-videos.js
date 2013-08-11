Util.Objects["videos"] = new function() {
	this.init = function(scene) {

		var nodes = u.qsa("ul.videos li", scene);
		var node, i;
		for(i = 0; node = nodes[i]; i++) {

			u.ce(node);
			node.moved = function(event) {
				u.e.resetEvents(this);
			}
			node.clicked = function(event) {

				location.href = this.url;

			}
		}
	}
}