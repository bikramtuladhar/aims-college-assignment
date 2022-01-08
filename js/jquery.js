const $ = (function () {

    'use strict';

    /**
     * Create the constructor
     * @param {String} selector The selector to use
     */
    const Constructor = function (selector) {
        if (!selector) return;
        if (selector === 'document') {
            this.elems = [document];
        } else if (selector === 'window') {
            this.elems = [window];
        } else {
            this.elems = document.querySelectorAll(selector);
        }
    };

    /**
     * Ajax function
     * @param url
     * @param method
     * @param callback
     */
    Constructor.prototype.ajax = function (url, method, callback, data = null) {
        let xhr = new XMLHttpRequest();
        xhr.open(method, url);
        xhr.onload = function () {
            if (xhr.status === 200) {
                callback(xhr.responseText);
            }
        };
        if (method === 'GET') {
            xhr.send();
        } else if (method === 'POST') {
            xhr.send(data);
        }
    };

    /**
     * Run a callback on each item
     * @param  {Function} callback The callback function to run
     */
    Constructor.prototype.each = function (callback) {
        if (!callback || typeof callback !== 'function') return;
        for (var i = 0; i < this.elems.length; i++) {
            callback(this.elems[i], i);
        }
        return this;
    };

    /**
     * Add a class to elements
     * @param {String} className The class name
     */
    Constructor.prototype.addClass = function (className) {
        this.each(function (item) {
            item.classList.add(className);
        });
        return this;
    };

    /**
     * Remove a class to elements
     * @param {String} className The class name
     */
    Constructor.prototype.removeClass = function (className) {
        this.each(function (item) {
            item.classList.remove(className);
        });
        return this;
    };


    /**
     * Change a class
     * @param {String} className existing class name
     * @param {String} replace replacing class name
     */
    Constructor.prototype.changeClass = function (className, replace) {
        this.each(function (item) {
            item.classList.replace(className, replace);
        });
        return this;
    };

    /**
     * Append a child to elements
     * @param element
     * @param innerHTML
     */
    Constructor.prototype.appendTo = function (element, innerHTML) {
        const target = this.elems[0];
        const div = document.createElement(element);
        div.innerHTML = innerHTML;
        target.parentNode.insertBefore(div, target.nextSibling);
    };

    /**
     * Prepend a child to elements
     * @param element
     * @param innerHTML
     */
    Constructor.prototype.prependTo = function (element, innerHTML) {
        const target = this.elems[0];
        const div = document.createElement(element);
        div.innerHTML = innerHTML;
        target.parentNode.insertBefore(div, target);
    };

    /**
     * Get datasets of dom elements
     * return {Object}
     */
    Constructor.prototype.data = function () {
        const data = {};
        this.each(function (item) {
            for (const key in item.dataset) {
                data[key] = item.dataset[key];
            }
        });
        return data;
    };
    /**
     * Get or set an attribute
     * @param value
     * @returns {*|Constructor}
     */
    Constructor.prototype.val = function (value) {
        if (value) {
            this.each(function (item) {
                item.value = value;
            });
            return this;
        } else {
            return this.elems[0].value;
        }
    };

    /**
     * jqeury style Get or set prop an attribute
     * @param prop
     * @param value
     * @returns {*|Constructor}
     */
    Constructor.prototype.prop = function (prop, value = undefined) {
        if (value !== undefined) {
            this.each(function (item) {
                item[prop] = value;
            });
            return this;
        } else {
            return this.elems[0][prop];
        }
    };

    /**
     * Get or set an innertext
     * @param innerText
     * @returns {*|Constructor}
     */
    Constructor.prototype.innerText = function (innerText) {
        if (innerText) {
            this.each(function (item) {
                item.innerText = innerText;
            });
            return this;
        } else {
            return this.elems[0].innerText;
        }
    };

    /**
     * Get or set an innerhtml
     */
    Constructor.prototype.copyToClipboard = function () {
        const el = document.createElement('textarea');
        el.value = this.elems[0].innerText;
        el.setAttribute('readonly', '');
        el.style.position = 'absolute';
        el.style.left = '-9999px';
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);
    };

    /**
     * Return the constructor instantiation
     */
    return function (selector) {
        return new Constructor(selector);
    };

})
();

window._$ = new $;
