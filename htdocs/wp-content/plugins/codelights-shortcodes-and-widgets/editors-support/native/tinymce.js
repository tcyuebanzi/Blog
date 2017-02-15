!function($){
	tinymce.create('tinymce.plugins.codelights', {
		init: function(ed, url){

			ed.addButton('codelights', {
				title: 'Insert / Edit CodeLights Shortcode',
				cmd: 'codelights',
				image: url + '/icon.png'
			});
			this.ed = ed;
			this.url = url;

			this._events = {
				disableUndo: function(e){
					return false
				}
			};

			var btnAction = function(){
				var textSelection = this.getTextSelection(),
					handler = $cl.fn.handleShortcodeCall.apply(window, textSelection);
				if (handler.selection !== undefined) {
					// Updating selection: seeking DOM elements for each selection part
					this.applySelection(handler.selection[0], handler.selection[1]);
				}
				if (handler.action == 'insert') {
					$cl.elist.unbind('select').bind('select', function(name){
						ed.insertContent($cl.fn.generateShortcode(name));
						range = ed.selection.getRng();
						ed.selection.setCursorLocation(range.endContainer, range.endOffset - 1);
						btnAction();
					});
					$cl.elist.show();
				} else if (handler.action == 'edit') {
					$cl.ebuilder.unbind('save').bind('save', function(values, defaults){
						var shortcode = $cl.fn.generateShortcode(handler.shortcode, values, defaults);
						shortcode = shortcode.replace(/\n/g, '<br> ');
						ed.insertContent(shortcode);
					});
					$cl.ebuilder.show(handler.shortcode, handler.values);
				}
			}.bind(this);

			ed.addCommand('codelights', btnAction);
		},

		/**
		 * Temporarily disable TinyMCE undo manager
		 */
		disableUndo: function(){
			this.ed.on('BeforeAddUndo', this._events.disableUndo);
		},

		/**
		 * Restore TinyMCE undo manager
		 */
		enableUndo: function(){
			this.ed.off('BeforeAddUndo', this._events.disableUndo);
		},

		/**
		 * Gets plain text representation of the current selection range and selection range positions within this
		 * plain text.
		 *
		 * @return {Array}
		 */
		getTextSelection: function(){
			var range = this.ed.selection.getRng(),
				startTrigger = '!cl-selection-start!',
				endTrigger = '!cl-selection-end!',
				content = this.ed.getContent({format: 'html'}),
				startOffset, endOffset;
			this.disableUndo();
			this.ed.selection.setContent(startTrigger + this.ed.selection.getContent() + endTrigger);
			startOffset = this.ed.getContent().indexOf(startTrigger);
			endOffset = this.ed.getContent().indexOf(endTrigger);
			if (startOffset != -1 && endOffset != -1 && endOffset > startOffset) endOffset -= startTrigger.length;
			this.ed.setContent(content);
			this.enableUndo();
			return [content, startOffset, endOffset];
		},

		/**
		 * Apply selection
		 *
		 * @param {Number} start Range start in the html representation
		 * @param {Number} end Range end in the html representation
		 */
		applySelection: function(start, end){
			var content = this.ed.getContent({format: 'html'}),
				startTrigger = '!cl-selection-start!',
				endTrigger = '!cl-selection-end!',
				newContent = content.substr(0, start) + startTrigger + content.substring(start, end) + endTrigger + content.substr(end);
			this.disableUndo();
			this.ed.setContent(newContent);
			// Looking for selection triggers
			var startContainer, startOffset,
				endContainer, endOffset,
				nodeWalker = document.createTreeWalker(this.ed.getBody(), NodeFilter.SHOW_TEXT, null, false),
				node;
			while (node = nodeWalker.nextNode()) {
				if (!startContainer) {
					if ((startOffset = node.nodeValue.indexOf(startTrigger)) != -1) {
						node.nodeValue = node.nodeValue.substr(0, startOffset) + node.nodeValue.substr(startOffset + startTrigger.length);
						startContainer = node;
					}
				}
				if (!endContainer) {
					if ((endOffset = node.nodeValue.indexOf(endTrigger)) != -1) {
						node.nodeValue = node.nodeValue.substr(0, endOffset) + node.nodeValue.substr(endOffset + endTrigger.length);
						endContainer = node;
					}
				}
			}
			if (startContainer) {
				if (endContainer) {
					var rng = this.ed.selection.getRng();
					rng.setStart(startContainer, startOffset);
					rng.setEnd(endContainer, endOffset);
					this.ed.selection.setRng(rng);
				} else {
					this.ed.selection.setCursorLocation(startContainer, startOffset);
				}
				// Restoring textarea default value
				this.ed.getElement().value = content;
			} else {
				this.ed.setContent(content);
			}
			this.enableUndo();
		},

		getInfo: function(){
			return {
				longname: 'CodeLighs Shortcodes and Widgets',
				author: 'CodeLights',
				authorurl: 'http://codelights.com/',
				infourl: 'http://codelights.com/',
				version: '1.0'
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('codelights', tinymce.plugins.codelights);
}(jQuery);
