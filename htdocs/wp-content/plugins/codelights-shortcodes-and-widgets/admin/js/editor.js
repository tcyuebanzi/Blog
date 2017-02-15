/**
 * Retrieve/set/erase dom modificator class <mod>_<value> for the CSS Framework
 * @param {String} mod Modificator namespace
 * @param {String} [value] Value
 * @returns {string|jQuery}
 */
jQuery.fn.clMod = function(mod, value){
	if (this.length == 0) return this;
	// Remove class modificator
	if (value === false) {
		return this.each(function(){
			this.className = this.className.replace(new RegExp('(^| )' + mod + '\_[a-zA-Z0-9\_\-]+( |$)'), '$2');
		});
	}
	var pcre = new RegExp('^.*?' + mod + '\_([a-zA-Z0-9\_\-]+).*?$'),
		arr;
	// Retrieve modificator
	if (value === undefined) {
		return (arr = pcre.exec(this.get(0).className)) ? arr[1] : false;
	}
	// Set modificator
	else {
		var regexp = new RegExp('(^| )' + mod + '\_[a-zA-Z0-9\_\-]+( |$)');
		return this.each(function(){
			if (this.className.match(regexp)) {
				this.className = this.className.replace(regexp, '$1' + mod + '_' + value + '$2');
			} else {
				this.className += ' ' + mod + '_' + value;
			}
		});
	}
};

if (window.$cl === undefined) window.$cl = {};
$cl.isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

!function($){
	if (window.$cl.mixins === undefined) window.$cl.mixins = {};

	/**
	 * Class mutator, allowing bind, unbind, and trigger class instance events
	 * @type {{}}
	 */
	$cl.mixins.Events = {
		/**
		 * Attach a handler to an event for the class instance
		 * @param {String} eventType A string containing event type, such as 'beforeShow' or 'change'
		 * @param {Function} handler A function to execute each time the event is triggered
		 */
		bind: function(eventType, handler){
			if (this.$$events === undefined) this.$$events = {};
			if (this.$$events[eventType] === undefined) this.$$events[eventType] = [];
			this.$$events[eventType].push(handler);
			return this;
		},
		/**
		 * Remove a previously-attached event handler from the class instance
		 * @param {String} eventType A string containing event type, such as 'beforeShow' or 'change'
		 * @param {Function} [handler] The function that is to be no longer executed.
		 * @chainable
		 */
		unbind: function(eventType, handler){
			if (this.$$events === undefined || this.$$events[eventType] === undefined) return this;
			if (handler !== undefined) {
				var handlerPos = $.inArray(handler, this.$$events[eventType]);
				if (handlerPos != -1) {
					this.$$events[eventType].splice(handlerPos, 1);
				}
			} else {
				this.$$events[eventType] = [];
			}
			return this;
		},
		/**
		 * Execute all handlers and behaviours attached to the class instance for the given event type
		 * @param {String} eventType A string containing event type, such as 'beforeShow' or 'change'
		 * @param {Array} extraParameters Additional parameters to pass along to the event handler
		 * @chainable
		 */
		trigger: function(eventType, extraParameters){
			if (this.$$events === undefined || this.$$events[eventType] === undefined || this.$$events[eventType].length == 0) return this;
			for (var index = 0; index < this.$$events[eventType].length; index++) {
				this.$$events[eventType][index].apply(this, extraParameters);
			}
			return this;
		}
	};

	/**
	 * $cl.Field class
	 * Boundable events: beforeShow, afterShow, change, beforeHide, afterHide
	 * @param row
	 * @constructor
	 */
	$cl.Field = function(row){
		this.$row = $(row);
		if (this.$row.data('clfield')) return this.$row.data('clfield');
		this.type = this.$row.clMod('type');
		this.name = this.$row.clMod('for');
		this.$input = this.$row.find('input[name], textarea[name], select[name]');
		this.inited = false;

		// Overloading by a certain type's declaration, moving parent functions to "parent" namespace: init => parentInit
		if ($cl.Field[this.type] !== undefined) {
			for (var fn in $cl.Field[this.type]) {
				if (!$cl.Field[this.type].hasOwnProperty(fn)) continue;
				if (this[fn] !== undefined) {
					var parentFn = 'parent' + fn.charAt(0).toUpperCase() + fn.slice(1);
					this[parentFn] = this[fn];
				}
				this[fn] = $cl.Field[this.type][fn];
			}
		}

		this.$row.data('clfield', this);

		// Init on the first show
		var initEvent = function(){
			this.init();
			this.inited = true;
			this.unbind('beforeShow', initEvent);
		}.bind(this);
		this.bind('beforeShow', initEvent);
	};
	$.extend($cl.Field.prototype, $cl.mixins.Events, {
		init: function(){
			this.$input.on('change', function(){
				this.trigger('change', [this.getValue()]);
			}.bind(this));
		},
		deinit: function(){
		},
		getValue: function(){
			return this.$input.val();
		},
		setValue: function(value){
			this.$input.val(value);
			this.render();
			this.trigger('change', [value]);
		},
		render: function(){
		}
	});

	/**
	 * $cl.Field type: checkboxes
	 */
	$cl.Field['checkboxes'] = {
		init: function(){
			this.parentInit();
			this.$checkboxes = this.$row.find('input[type="checkbox"]');
			this._events = {
				change: function(){
					var value = '';
					this.$checkboxes.each(function(index, checkbox){
						if (checkbox.checked) value += ((value != '') ? ',' : '') + checkbox.value;
					}.bind(this));
					this.$input.val(value).trigger('change');
				}.bind(this)
			};
			this.$checkboxes.on('change', this._events.change);
		},

		render: function(){
			var value = this.getValue().split(',');
			this.$checkboxes.each(function(index, checkbox){
				$(checkbox).attr('checked', ($.inArray(checkbox.value, value) != -1) ? 'checked' : false);
			}.bind(this));
		}
	};

	/**
	 * $cl.Field type: color
	 */
	$cl.Field['color'] = {
		init: function(){
			this.parentInit();
			this.changeTimer = null;
			this._events = {
				change: function(value){
					clearTimeout(this.changeTimer);
					this.changeTimer = setTimeout(function(){
						this.$input.trigger('change');
					}.bind(this), 100);
				}.bind(this)
			};
			this.$input.wpColorPicker({
				change: this._events.change
			});
		},
		render: function(){
			var value = this.getValue();
			this.$input.wpColorPicker('color', value);
		}
	};

	/**
	 * $cl.Field type: html
	 */
	$cl.Field['html'] = {
		init: function(){
			if (window.tinyMCEPreInit === undefined || !this.$row.is(':visible')) {
				setTimeout(this.init.bind(this), 100);
				return;
			}
			var id = this.$input.attr('id');
			if (id.indexOf('__i__') != -1) return;
			this.$container = this.$row.find('.cl-wysiwyg');
			var curEd = tinymce.get(id);
			var content;
			if (curEd != null) {
				content = curEd.getContent();
				curEd.remove();
			}
			this.mceSettings = this.$container[0].onclick() || {};
			tinyMCEPreInit.mceInit[id] = $.extend(tinyMCEPreInit.mceInit['codelights'] || {}, this.mceSettings, {
				selector: '#' + id,
				setup: function(editor){
					editor.on('change', function(){
						tinymce.get(id).save();
						this.$input.trigger('change');
						this.$input.val(window.switchEditors.pre_wpautop(editor.getContent()));
					}.bind(this));
					editor.on('init', function(){
						if (content) editor.setContent(content);
					});
					this.$input.on('keyup', function(){
						editor.setContent(window.switchEditors.wpautop(this.$input.val()));
					}.bind(this));
					this.editor = editor;
				}.bind(this)
			});
			// Removing CodeLights button from html field editor. Need to rework architecture to allow nested editors.
			tinyMCEPreInit.mceInit[id].toolbar1 = tinyMCEPreInit.mceInit[id].toolbar1.replace(',codelights', '');

			tinymce.init(tinyMCEPreInit.mceInit[id]);
			// Quick Tags
			tinyMCEPreInit.qtInit[id] = {id: id};
			this.$container.find('.quicktags-toolbar').remove();
			quicktags(tinyMCEPreInit.qtInit[id]);
			QTags._buttonsInit();
		},

		render: function(){
			if (this.editor === undefined) return;
			var value = this.getValue();
			this.editor.setContent(value);
		}
	};

	/**
	 * $cl.Field type: images
	 */
	$cl.Field['images'] = {

		init: function(){
			this.parentInit();

			this.$field = this.$row.find('.cl-imgattach');
			this.multiple = this.$field.data('multiple');
			this.$list = this.$field.find('.cl-imgattach-list');
			this.$btnAdd = this.$field.find('.cl-imgattach-add');

			this._events = {
				openMediaUploader: this.openMediaUploader.bind(this),
				deleteImg: function(event){
					$(event.target).closest('li').remove();
					this.updateInput();
				}.bind(this),
				updateInput: this.updateInput.bind(this)
			};

			if (this.multiple) {
				this.$list.sortable({stop: this._events.updateInput});
			}
			this.$btnAdd.on('click', this._events.openMediaUploader);
			this.$list.on('click', '.cl-imgattach-delete', this._events.deleteImg);
		},

		render: function(){
			var value = this.getValue(),
				items = {},
				currentIds = [],
				neededIds = value ? value.split(',').map(Number) : [];
			this.$list.children().toArray().forEach(function(item){
				var $item = $(item),
					id = parseInt($item.data('id'));
				items[id] = $item;
				currentIds.push(id);
			});
			var index = 0;
			for (index = 0; index < neededIds.length; index++) {
				var id = neededIds[index],
					currentIndex = currentIds.indexOf(id, index);
				if (currentIndex == index) continue;
				if (currentIndex == -1) {
					// Creating the new item
					var attachment = wp.media.attachment(id);
					items[id] = this.createItem(attachment);
				} else {
					// Moving existing item
					currentIds.splice(currentIndex, 1);
				}
				if (index == 0) {
					items[id].prependTo(this.$list);
				} else {
					items[id].insertAfter(items[neededIds[index - 1]]);
				}
				currentIds.splice(index, 0, id);
			}
			for (; index < currentIds.length; index++) {
				// Removing the excess items
				items[currentIds[index]].remove();
			}
		},
		updateInput: function(){
			var oldValue = this.getValue(),
				imgIds = this.$list.children().toArray().map(function(item){
					return parseInt(item.getAttribute('data-id'));
				}),
				newValue = imgIds.join(',');
			if (newValue != oldValue) {
				this.$input.val(newValue).trigger('change');
			}
		},
		openMediaUploader: function(){
			if (this.frame === undefined) {
				this.frame = wp.media({
					title: this.$btnAdd.attr('title'),
					multiple: this.multiple ? 'add' : false,
					library: {type: 'image'},
					button: {text: this.$btnAdd.attr('title')}
				});
				this.frame.on('open', function(){
					var value = this.getValue(),
						initialIds = value ? value.split(',').map(Number) : [],
						selection = this.frame.state().get('selection');
					initialIds.forEach(function(id){
						selection.add(wp.media.attachment(id));
					});
				}.bind(this));
				this.frame.on('select', function(){
					var value = this.getValue(),
						initialIds = value ? value.split(',').map(Number) : [],
						selection = this.frame.state().get('selection'),
						updatedIds = [];
					selection.forEach(function(attachment){
						if (attachment.id && initialIds.indexOf(attachment.id) == -1) {
							// Adding the new images
							this.$list.append(this.createItem(attachment));
						}
						updatedIds.push(attachment.id);
					}.bind(this));
					initialIds.forEach(function(id){
						if (updatedIds.indexOf(id) == -1) {
							// Deleting images that are not present in the recent selection
							this.$list.find('[data-id="' + id + '"]').remove();
						}
					}.bind(this));
					this.updateInput();
				}.bind(this));
			}
			this.frame.open();
		},
		/**
		 * Prepare item's dom from WP attachment object
		 * @param {Object} attachment
		 * @return {jQuery}
		 */
		createItem: function(attachment){
			if (!attachment || !attachment.attributes.id) return '';
			var html = '<li data-id="' + attachment.id + '">' +
				'<a class="cl-imgattach-delete" href="javascript:void(0)">&times;</a>' +
				'<img width="150" height="150" class="attachment-thumbnail" src="';
			if (attachment.attributes.sizes !== undefined) {
				var size = (attachment.attributes.sizes.thumbnail !== undefined) ? 'thumbnail' : 'full';
				html += attachment.attributes.sizes[size].url;
			}
			html += '"></li>';
			var $item = $(html);
			if (attachment.attributes.sizes === undefined) {
				// Loading missing image via ajax
				attachment.fetch({
					success: function(){
						var size = (attachment.attributes.sizes.thumbnail !== undefined) ? 'thumbnail' : 'full';
						$item.find('img').attr('src', attachment.attributes.sizes[size].url);
					}.bind(this)
				});
			}
			return $item;
		}

	};

	/**
	 * $cl.Field type: select
	 */
	$cl.Field['select'] = {
		init: function(){
			this.$input.on('change keyup', function(){
				this.trigger('change', [this.getValue()]);
			}.bind(this));
		}
	};

	/**
	 * $cl.Field type: link
	 */
	$cl.Field['link'] = {
		init: function(){
			this.$document = $(document);
			this.$btn = this.$row.find('.cl-linkdialog-btn');
			this.$linkUrl = this.$row.find('.cl-linkdialog-url');
			this.$linkTitle = this.$row.find('.cl-linkdialog-title');
			this.$linkTarget = this.$row.find('.cl-linkdialog-target');
			this._events = {
				open: function(event){
					wpLink.open(this.$input.attr('id'));
					wpLink.textarea = this.$input;
					var data = this.decodeLink(this.getValue());
					$('#wp-link-url').val(data.url);
					$('#wp-link-text').val(data.title);
					$('#wp-link-target').prop('checked', (data.target == '_blank'));
					$('#wp-link-submit').on('click', this._events.submit);
					this.$document.on('wplink-close', this._events.close);
				}.bind(this),
				submit: function(event){
					event.preventDefault();
					var wpLinkText = $('#wp-link-text').val(),
						linkAtts = wpLink.getAttrs();
					this.setValue(this.encodeLink(linkAtts.href, wpLinkText, linkAtts.target));
					this.$input.trigger('change');
					this._events.close();
				}.bind(this),
				close: function(){
					this.$document.off('wplink-close', this._events.close);
					$('#wp-link-submit').off('click', this._events.submit);
					if (typeof wpActiveEditor != 'undefined') wpActiveEditor = undefined;
					wpLink.close();
				}.bind(this)
			};

			this.$btn.on('click', this._events.open);
		},
		render: function(){
			var value = this.getValue(),
				parts = value.split('|'),
				data = {};
			for (var i = 0; i < parts.length; i++) {
				var part = parts[i].split(':', 2);
				if (part.length > 1) data[part[0]] = decodeURIComponent(part[1]);
			}
			this.$linkTitle.text(data.title || '');
			this.$linkUrl.text(this.shortenUrl(data.url || ''));
			this.$linkTarget.text(data.target || '');
		},
		/**
		 * Get shortened version of URL with url's beginning and end
		 * @param url
		 */
		shortenUrl: function(url){
			return (url.length <= 60) ? url : (url.substr(0, 28) + '...' + url.substr(url.length - 29));
		},
		encodeLink: function(url, title, target){
			var result = 'url:' + encodeURIComponent(url);
			if (title) result += '|title:' + encodeURIComponent(title);
			if (target) result += '|target:' + encodeURIComponent(target);
			return result;
		},
		decodeLink: function(link){
			var atts = link.split('|'),
				result = {url: '', title: '', target: ''};
			atts.forEach(function(value, index){
				var param = value.split(':', 2);
				result[param[0]] = decodeURIComponent(param[1]).trim();
			});
			return result;
		}
	};

	/**
	 * $cl.Tabs class
	 *
	 * Boundable events: beforeShow, afterShow, beforeHide, afterHide
	 *
	 * @param container
	 * @constructor
	 */
	$cl.Tabs = function(container){
		this.$container = $(container);
		this.$items = this.$container.find('.cl-tabs-item');
		this.$sections = this.$container.find('.cl-tabs-section');
		this.items = this.$items.toArray().map($);
		this.sections = this.$sections.toArray().map($);
		this.active = 0;
		this.items.forEach(function($elm, index){
			$elm.on('click', this.open.bind(this, index));
		}.bind(this));
	};
	$.extend($cl.Tabs.prototype, $cl.mixins.Events, {
		open: function(index){
			if (index == this.active || this.sections[index] == undefined) return;
			if (this.sections[this.active] !== undefined) {
				this.trigger('beforeHide', [this.active, this.sections[this.active], this.items[this.active]]);
				this.sections[this.active].hide();
				this.items[this.active].removeClass('active');
				this.trigger('afterHide', [this.active, this.sections[this.active], this.items[this.active]]);
			}
			this.trigger('beforeShow', [index, this.sections[index], this.items[index]]);
			this.sections[index].show();
			this.items[index].addClass('active');
			this.trigger('afterShow', [index, this.sections[index], this.items[index]]);
			this.active = index;
		}
	});

	/**
	 * $cl.EForm class
	 * @param container
	 * @constructor
	 */
	$cl.EForm = function(container){
		this.$container = $(container);
		this.$tabs = this.$container.find('.cl-tabs');
		if (this.$tabs.length) {
			this.tabs = new $cl.Tabs(this.$tabs);
		}

		// Dependencies rules and the list of dependent fields for all the affecting fields
		this.showIf = {};
		this.affects = {};

		this.$fields = this.$container.find('.cl-eform-row');
		this.fields = {};
		this.$fields.each(function(index, row){
			var $row = $(row),
				name = $row.clMod('for');
			this.fields[name] = new $cl.Field($row);
			this.fields[name].trigger('beforeShow');
			var $showIf = $row.find('.cl-eform-row-showif');
			if ($showIf.length) {
				this.showIf[name] = ($showIf[0].onclick() || {});
				if (this.affects[this.showIf[name][0]] === undefined) this.affects[this.showIf[name][0]] = [];
				this.affects[this.showIf[name][0]].push(name);
			}
		}.bind(this));

		$.each(this.affects, function(name, affectedList){
			var onChangeFn = function(){
				for (var index = 0; index < affectedList.length; index++) {
					if (this.shouldBeVisible(affectedList[index])) {
						this.fields[affectedList[index]].$row.show();
					} else {
						this.fields[affectedList[index]].$row.hide();
					}
				}
			}.bind(this);
			this.fields[name].bind('change', onChangeFn);
			onChangeFn();
		}.bind(this));
	};
	$.extend($cl.EForm.prototype, {
		/**
		 * Get a particular field value
		 * @param {String} name Field name
		 * @return {String}
		 */
		getValue: function(name){
			return (this.fields[name] === undefined) ? null : this.fields[name].getValue();
		},
		setValue: function(name, value){
			if (this.fields[name] !== undefined) this.field[name].setValue(value);
		},
		getValues: function(){
			var values = {};
			$.each(this.fields, function(name, field){
				values[name] = field.getValue();
			}.bind(this));
			return values;
		},
		setValues: function(values){
			$.each(values, function(name, value){
				if (this.fields[name] !== undefined) this.fields[name].setValue(value);
			}.bind(this));
		},
		/**
		 * Check if the field should be visible
		 * @param {String} name
		 * @return {Boolean}
		 */
		shouldBeVisible: function(name){
			if (this.showIf[name] === undefined) return true;
			var dep = this.showIf[name],
				value = this.fields[dep[0]].getValue();
			return (dep[2] instanceof Array) ? (dep[2].indexOf(value) != -1) : (value == dep[2]);
		}
	});

	/**
	 * $cl.Elist class: A popup with elements list to choose from. Behaves as a singleton.
	 * Boundable events: beforeShow, afterShow, beforeHide, afterHide, select
	 * @constructor
	 */
	$cl.EList = function(){
		if ($cl.elist !== undefined) return $cl.elist;
		this.$container = $('.cl-elist');
		if (this.$container.length > 0) this.init();
	};
	$.extend($cl.EList.prototype, $cl.mixins.Events, {
		init: function(){
			this.$closer = this.$container.find('.cl-elist-closer');
			this.$list = this.$container.find('.cl-elist-list');
			this._events = {
				select: function(event){
					var $item = $(event.target).closest('.cl-elist-item');
					this.hide();
					this.trigger('select', [$item.data('name')]);
				}.bind(this),
				hide: this.hide.bind(this)
			};
			this.$closer.on('click', this._events.hide);
			this.$list.on('click', '.cl-elist-item', this._events.select);
		},
		show: function(){
			if (this.$container.length == 0) {
				// Loading elements list html via ajax
				$.ajax({
					type: 'post',
					url: $cl.ajaxUrl,
					data: {
						action: 'cl_get_elist_html'
					},
					success: function(html){
						this.$container = $(html).css('display', 'none').appendTo($(document.body));
						this.init();
						this.show();
					}.bind(this)
				});
				return;
			}

			this.trigger('beforeShow');
			this.$container.css('display', 'block');
			this.trigger('afterShow');
		},
		hide: function(){
			this.trigger('beforeHide');
			this.$container.css('display', 'none');
			this.trigger('afterHide');
		}
	});
	// Singleton instance
	$cl.elist = new $cl.EList;

	/**
	 * $cl.EBuilder class: A popup with loadable elements forms
	 * Boundable events: beforeShow, afterShow, beforeHide, afterHide, save
	 * @constructor
	 */
	$cl.EBuilder = function(){
		this.$container = $('.cl-ebuilder');
		if (this.$container.length != 0) this.init();
	};
	$.extend($cl.EBuilder.prototype, $cl.mixins.Events, {
		init: function(){
			this.$title = this.$container.find('.cl-ebuilder-title');
			this.titles = this.$title[0].onclick() || {};
			this.$title.removeAttr('onclick');
			this.$closer = this.$container.find('.cl-ebuilder-closer, .cl-ebuilder-btn.for_close');
			// EForm containers and class instances
			this.$eforms = {};
			this.eforms = {};
			// Set of default values for each elements form
			this.defaults = {};
			this.$container.find('.cl-eform').each(function(index, eform){
				var $eform = $(eform).css('display', 'none'),
					name = $eform.clMod('for');
				this.$eforms[name] = $eform;
			}.bind(this));
			this.$btnSave = this.$container.find('.cl-ebuilder-btn.for_save');
			// Actve element
			this.active = false;
			this._events = {
				hide: this.hide.bind(this),
				save: this.save.bind(this)
			};
			this.$closer.on('click', this._events.hide);
			this.$btnSave.on('click', this._events.save);
		},
		/**
		 * Show element form for a specified element name and initial values
		 * @param {String} name
		 * @param {Object} values
		 */
		show: function(name, values){
			if (this.$container.length == 0) {
				// Loading ebuilder and initial form's html
				$.ajax({
					type: 'post',
					url: $cl.ajaxUrl,
					data: {
						action: 'cl_get_ebuilder_html'
					},
					success: function(html){
						if (html == '') return;
						html = $cl.fn.enqueueAssets(html);
						this.$container = $(html).css('display', 'none').appendTo($(document.body));
						this.init();
						this.show(name, values);
					}.bind(this)
				});
				return;
			}

			if (this.eforms[name] === undefined) {
				// Initializing EForm on the first show
				if (this.$eforms[name] === undefined) return;
				this.eforms[name] = new $cl.EForm(this.$eforms[name]);
				this.defaults[name] = this.eforms[name].getValues();
			}
			// Filling missing values with defaults
			values = $.extend({}, this.defaults[name], values);
			this.eforms[name].setValues(values);
			if (this.eforms[name].tabs !== undefined) this.eforms[name].tabs.open(0);
			this.$eforms[name].css('display', 'block');
			this.$title.html(this.titles[name] || '');
			this.active = name;
			this.trigger('beforeShow');
			this.$container.css('display', 'block');
			this.trigger('afterShow');
		},
		hide: function(){
			this.trigger('beforeHide');
			this.$container.css('display', 'none');
			if (this.$eforms[this.active] !== undefined) this.$eforms[this.active].css('display', 'none');
			this.trigger('afterHide');
		},
		/**
		 * Get values of the active form
		 * @return {Object}
		 */
		getValues: function(){
			return (this.eforms[this.active] !== undefined) ? this.eforms[this.active].getValues() : {};
		},
		/**
		 * Get default values of the active form
		 * @return {Object}
		 */
		getDefaults: function(){
			return (this.defaults[this.active] || {});
		},
		save: function(){
			this.hide();
			this.trigger('save', [this.getValues(), this.getDefaults()]);
		}
	});
	// Singletone instance
	$cl.ebuilder = new $cl.EBuilder;

}(jQuery);

// Helper functions
!function($){
	if ($cl.fn === undefined) $cl.fn = {};
	/**
	 * Retrieve all attributes from the shortcodes tag. (WordPress-function js analog).
	 * @param text
	 * @return {Array} List of attributes and their value
	 */
	$cl.fn.shortcodeParseAtts = function(text){
		// Fixing tinymce transformations
		text = text.replace(/\<br \/\> /g, "\n");
		var atts = {};
		text.replace(/([a-z0-9_\-]+)=\"([^\"\]]*)"/g, function(m, key, value){
			atts[key] = value;
		});
		return atts;
	};
	/**
	 * Generate shortcode string
	 * @param {String} name Shortcode name
	 * @param {{}} atts
	 * @param {{}} attsDefaults
	 * @return {String}
	 */
	$cl.fn.generateShortcode = function(name, atts, attsDefaults){
		var shortcode = '[' + name,
			htmlContent = ($cl.elements[name] && $cl.elements[name].params.content && $cl.elements[name].params.content.type == 'html');
		atts = atts || {};
		attsDefaults = attsDefaults || {};
		$.each(atts, function(att, value){
			if (htmlContent && att == 'content') return;
			if (attsDefaults[att] !== undefined && attsDefaults[att] !== value) shortcode += ' ' + att + '="' + value + '"';
		});
		shortcode += ']';
		if (htmlContent) shortcode += (atts.content || '') + '[/' + name + ']';
		return shortcode;
	};
	/**
	 * Handle "codelights" action within a plain text and determine what will be the new selection and the way it should
	 * be handled (insert / edit)
	 *
	 * @param {String} html Initial html text with shortcodes
	 * @param {Number} startOffset Selection start offset
	 * @param {Number} endOffset
	 * @return {{}} action, new selection, shortcode data (if found)
	 */
	$cl.fn.handleShortcodeCall = function(html, startOffset, endOffset){
		var handler = {};
		if (typeof html != 'string') html = '';
		if (startOffset == -1) startOffset = 0;
		if (endOffset == -1) endOffset = startOffset;
		if (endOffset < startOffset) {
			// Swapping start and end positions
			endOffset = startOffset + (startOffset = endOffset) - endOffset;
		}
		// If user selected a shortcode or its part
		if (startOffset < endOffset && html[endOffset - 1] == ']') {
			endOffset--;
		}
		var prevOpen = html.lastIndexOf('[', endOffset - 1),
			prevClose = html.lastIndexOf(']', endOffset - 1),
			nextOpen = html.indexOf('[', endOffset),
			nextClose = html.indexOf(']', endOffset),
		// We may fall back to insert at any time, so creating a separate variable for this
			insertHandler = {
				action: 'insert',
				selection: [startOffset, endOffset]
			};
		// Checking out if we're inside of some tag at all
		if (prevOpen == -1 || nextClose == -1 || prevOpen < prevClose || (nextOpen != -1 && nextOpen < nextClose)) {
			return insertHandler;
		}
		// If we're still here, the cursor is inside of some shorcode, so in case of insertion, we'll insert right after it
		insertHandler.selection = [nextClose + 1, nextClose + 1];
		var isOpener = (html.charAt(prevOpen + 1) != '/'),
			editHandler = {
				action: 'edit',
				shortcode: html.substring(prevOpen + (isOpener ? 1 : 2), nextClose + 1).replace(/^([a-zA-Z0-9\-\_]+)[^\[]+/, '$1')
			};
		// Handling only known shortcodes
		if ($cl.elements[editHandler.shortcode] === undefined) return insertHandler;
		var nestingLevel = 1,
			regexp = new RegExp('\\[(\\/?)' + editHandler.shortcode.replace(/\-/g, '\\$&') + '((?=\\])| [^\\]]+)', 'ig'),
			matches;
		if (isOpener) {
			// Opening shortcode: searching forward
			editHandler.values = $cl.fn.shortcodeParseAtts(html.substring(prevOpen, nextClose + 1));
			regexp.lastIndex = nextClose;
			while (matches = regexp.exec(html)) {
				nestingLevel += (matches[1] ? -1 : 1);
				if (nestingLevel == 0) {
					// Found the relevant closer
					editHandler.selection = [prevOpen, html.indexOf(']', regexp.lastIndex - matches[0].length + 1) + 1];
					editHandler.values.content = html.substring(nextClose + 1, regexp.lastIndex - matches[0].length);
					break;
				}
			}
			if (nestingLevel != 0) {
				// No shortcode closer
				editHandler.selection = [prevOpen, nextClose + 1];
			}
		} else {
			// Closing shortcode: searching backward
			var nestingChange = [],
				matchesPos = [];
			while (matches = regexp.exec(html)) {
				if (regexp.lastIndex >= prevOpen) break;
				nestingChange.push(matches[1] ? 1 : -1);
				matchesPos.push(regexp.lastIndex - matches[0].length);
			}
			for (var i = nestingChange.length - 1; i >= 0; i--) {
				nestingLevel += nestingChange[i];
				if (nestingLevel == 0) {
					var openerClose = html.indexOf(']', matchesPos[i]);
					editHandler.selection = [matchesPos[i], nextClose + 1];
					editHandler.values = $cl.fn.shortcodeParseAtts(html.substring(matchesPos[i], openerClose));
					editHandler.values.content = html.substring(openerClose + 1, prevOpen);
					break;
				}
			}
			if (nestingLevel != 0) {
				// Closing shortcode with no opening one: inserting right after it
				return insertHandler;
			}
		}

		return editHandler;
	};
	/**
	 * Parse ajax HTML, insert the needed assets and filter html from them
	 * @param {String} html
	 * @returns {String}
	 * TODO Rework this function to properly handle load-scripts.php
	 */
	$cl.fn.enqueueAssets = function(html){
		var regexp = /(\<link rel=\'stylesheet\' id=\'([^\']+)\'[^\>]+?\>)|(\<style type\=\"text\/css\"\>([^\<]*)\<\/style\>)|(\<script type=\'text\/javascript\' src=\'([^\']+)\'\><\/script\>)|(\<script type\=\'text\/javascript\'\>([^`]*?)\<\/script\>)/g;
		var $head = $(document.head),
			$internalStyles = $('style'),
			$externalScripts = $('script[src]'),
			$internalScripts = $('script:not([src])'),
			i;
		// Inserting only the assets that are not exist on a page yet
		return html.replace(regexp, function(m, m1, styleId, m2, styleContent, m3, scriptSrc, m4, scriptContent){
			if (m.indexOf('<link rel=\'stylesheet\'') == 0) {
				// External style
				if ($('link[rel="stylesheet"]#' + styleId).length != 0) return '';
			} else if (m.indexOf('<style') == 0) {
				// Internal style
				styleContent = styleContent.trim();
				for (i = 0; i < $internalStyles.length; i++) {
					if ($internalStyles[i].innerHTML.trim() == styleContent) return '';
				}
			} else if (m.indexOf('<script type=\'text/javascript\' src=\'') == 0) {
				// External script
				scriptSrc = scriptSrc.replace(/&_=[0-9]+/, '');
				for (i = 0; i < $externalScripts.length; i++) {
					if ($externalScripts[i].src.indexOf(scriptSrc) === 0) return '';
				}
			} else {
				// Internal script
				scriptContent = scriptContent.trim();
				for (i = 0; i < $internalScripts.length; i++) {
					if ($internalScripts[i].innerHTML.trim() == scriptContent) return '';
				}
			}
			$(m).appendTo($head);
			return '';
		});
	};
}(jQuery);

jQuery(function($){
	var clFixSortablesFields = function(selector){
		var $elm = $(selector);
		$elm.on('sortstart', function(event, ui){
			var $wysiwyg = $(ui.item).find('.cl-wysiwyg'),
				id = $wysiwyg.find('textarea:first').attr('id');
			if ($wysiwyg.length != 0) {
				tinymce.execCommand('mceRemoveEditor', true, id);
			}
		});
		$elm.on('sortstop', function(event, ui){
			var $wysiwyg = $(ui.item).find('.cl-wysiwyg'),
				id = $wysiwyg.find('textarea:first').attr('id');
			if ($wysiwyg.length != 0) {
				tinymce.init(tinyMCEPreInit.mceInit[id]);
			}
		});
	};

	// Admin widgets editor
	if (window.wpWidgets !== undefined) {
		// Widget ID => active tab, to keep the current active tab on widget save
		var formsTabs = {},
			initWidgetEForm = function($eform){
				var widgetId = $eform.closest('.widget').attr('id'),
					eform = new $cl.EForm($eform);
				if (eform.tabs) {
					if (formsTabs[widgetId] !== undefined) {
						eform.tabs.open(formsTabs[widgetId]);
					}
					eform.tabs.bind('afterShow', function(index){
						formsTabs[widgetId] = index;
					});
				}
			};
		$('#widgets-right').find('.cl-eform').each(function(){
			initWidgetEForm($(this));
		});
		$(document).bind('widget-added widget-updated', function(event, widget){
			initWidgetEForm($(widget).find('.cl-eform'));
		});
		// Widget reordering
		clFixSortablesFields('.widgets-sortables.ui-sortable');
		// Widget's fields may be shown
		$(document).bind('wp-pin-menu', function(){
			//console.log('toggled sidebar block');
		});
		// TODO Widget toggle
		// TODO Widget deletion
	}

	// Customizer widgets editor
	if (window._wpCustomizeWidgetsSettings !== undefined) {
		$('#widgets-right').find('.cl-eform').each(function(){
			new $cl.EForm(this);
		});
		$(document).bind('widget-added widget-updated', function(event, widget){
			new $cl.EForm($(widget).find('.cl-eform'));
		});
		// Widget reordering
		// TODO Rework it into proper fields-level actions calls
		clFixSortablesFields('.accordion-section-content.ui-sortable');

		// TODO Widget toggle
		// TODO Widget deletion
	}
	;
});



