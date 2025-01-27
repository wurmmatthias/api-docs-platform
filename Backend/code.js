/**
 * Skipped minification because the original files appears to be already minified.
 * Original file: /npm/@editorjs/paragraph@2.11.7/dist/paragraph.umd.js
 *
 * Do NOT use SRI with dynamically generated files! More information: https://www.jsdelivr.com/using-sri-with-dynamic-files
 */
(function() {
    "use strict";
    try {
        if (typeof document < "u") {
            var e = document.createElement("style");
            e.appendChild(document.createTextNode(
                ".ce-paragraph{line-height:1.6em;outline:none}" +
                ".ce-block:only-of-type .ce-paragraph[data-placeholder-active]:empty:before," +
                ".ce-block:only-of-type .ce-paragraph[data-placeholder-active][data-empty=true]:before" +
                "{content:attr(data-placeholder-active)}" +
                ".ce-paragraph p:first-of-type{margin-top:0}" +
                ".ce-paragraph p:last-of-type{margin-bottom:0}"
            ));
            document.head.appendChild(e);
        }
    } catch (a) {
        console.error("vite-plugin-css-injected-by-js", a);
    }
})();

(function(i, n) {
    typeof exports == "object" && typeof module < "u" ? module.exports = n() :
    typeof define == "function" && define.amd ? define(n) :
    (i = typeof globalThis < "u" ? globalThis : i || self, i.code = n());
})(this, function() {
    "use strict";

    const i = "",
        n = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 8L5 12L9 16"/><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 8L19 12L15 16"/></svg>';

    function s(a) {
        const e = document.createElement("div");
        e.innerHTML = a.trim();
        const t = document.createDocumentFragment();
        return t.append(...Array.from(e.childNodes)), t;
    }

    /**
     * Base Paragraph Block for the Editor.js.
     * Represents a regular text block
     *
     * @author CodeX (team@codex.so)
     * @copyright CodeX 2018
     * @license The MIT License (MIT)
     */
    class r {
        static get DEFAULT_PLACEHOLDER() {
            return "";
        }

        constructor({ data: e, config: t, api: o, readOnly: l }) {
            this.api = o;
            this.readOnly = l;
            this._CSS = { block: this.api.styles.block, wrapper: "ce-paragraph" };
            this.readOnly || (this.onKeyUp = this.onKeyUp.bind(this));
            this._placeholder = t.placeholder ? t.placeholder : r.DEFAULT_PLACEHOLDER;
            this._data = e ?? {};
            this._element = null;
            this._preserveBlank = t.preserveBlank ?? !1;
        }

        onKeyUp(e) {
            if (e.code !== "Backspace" && e.code !== "Delete" || !this._element) return;
            const { textContent: t } = this._element;
            t === "" && (this._element.innerHTML = "");
        }

        drawView() {
            const e = document.createElement("DIV");
            e.classList.add(this._CSS.wrapper, this._CSS.block);
            e.contentEditable = "false";
            e.dataset.placeholderActive = this.api.i18n.t(this._placeholder);
            if (this._data.text) {
                e.innerHTML = this._data.text.replace(/@@/g, '');
            }
            if (!this.readOnly) {
                e.contentEditable = "true";
                e.addEventListener("keyup", this.onKeyUp);
            }
            return e;
        }

        render() {
            return this._element = this.drawView(), this._element;
        }

        merge(e) {
            if (!this._element) return;
            this._data.text += e.text;
            const t = s(e.text);
            this._element.appendChild(t);
            this._element.normalize();
        }

        validate(e) {
            return !(e.text.trim() === "" && !this._preserveBlank);
        }

        save(e) {
            return { text: `@@${e.innerHTML}@@` };
        }
        

        onPaste(e) {
            const t = { text: e.detail.data.innerHTML };
            this._data = t;
            window.requestAnimationFrame(() => {
                if (this._element) {
                    this._element.innerHTML = this._data.text || "";
                }
            });
        }

        static get conversionConfig() {
            return { export: "text", import: "text" };
        }

        static get sanitize() {
            return { text: { br: true } };
        }

        static get isReadOnlySupported() {
            return true;
        }

        static get pasteConfig() {
            return { tags: ["C"] };
        }

        static get toolbox() {
            return { icon: n, title: "Code" };
        }
    }

    return r;
});
