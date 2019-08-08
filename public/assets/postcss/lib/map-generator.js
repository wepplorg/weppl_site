"use strict";

exports.__esModule = true;
exports.default = void 0;

var _sourceMap = _interopRequireDefault(require("source-map"));

var _path = _interopRequireDefault(require("path"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var MapGenerator =
/*#__PURE__*/
function () {
  function MapGenerator(stringify, root, opts) {
    this.stringify = stringify;
    this.mapOpts = opts.map || {};
    this.root = root;
    this.opts = opts;
  }

  var _proto = MapGenerator.prototype;

  _proto.isMap = function isMap() {
    if (typeof this.opts.map !== 'undefined') {
      return !!this.opts.map;
    }

    return this.previous().length > 0;
  };

  _proto.previous = function previous() {
    var _this = this;

    if (!this.previousMaps) {
      this.previousMaps = [];
      this.root.walk(function (node) {
        if (node.source && node.source.input.map) {
          var map = node.source.input.map;

          if (_this.previousMaps.indexOf(map) === -1) {
            _this.previousMaps.push(map);
          }
        }
      });
    }

    return this.previousMaps;
  };

  _proto.isInline = function isInline() {
    if (typeof this.mapOpts.inline !== 'undefined') {
      return this.mapOpts.inline;
    }

    var annotation = this.mapOpts.annotation;

    if (typeof annotation !== 'undefined' && annotation !== true) {
      return false;
    }

    if (this.previous().length) {
      return this.previous().some(function (i) {
        return i.inline;
      });
    }

    return true;
  };

  _proto.isSourcesContent = function isSourcesContent() {
    if (typeof this.mapOpts.sourcesContent !== 'undefined') {
      return this.mapOpts.sourcesContent;
    }

    if (this.previous().length) {
      return this.previous().some(function (i) {
        return i.withContent();
      });
    }

    return true;
  };

  _proto.clearAnnotation = function clearAnnotation() {
    if (this.mapOpts.annotation === false) return;
    var node;

    for (var i = this.root.nodes.length - 1; i >= 0; i--) {
      node = this.root.nodes[i];
      if (node.type !== 'comment') continue;

      if (node.text.indexOf('# sourceMappingURL=') === 0) {
        this.root.removeChild(i);
      }
    }
  };

  _proto.setSourcesContent = function setSourcesContent() {
    var _this2 = this;

    var already = {};
    this.root.walk(function (node) {
      if (node.source) {
        var from = node.source.input.from;

        if (from && !already[from]) {
          already[from] = true;

          var relative = _this2.relative(from);

          _this2.map.setSourceContent(relative, node.source.input.css);
        }
      }
    });
  };

  _proto.applyPrevMaps = function applyPrevMaps() {
    for (var _iterator = this.previous(), _isArray = Array.isArray(_iterator), _i = 0, _iterator = _isArray ? _iterator : _iterator[Symbol.iterator]();;) {
      var _ref;

      if (_isArray) {
        if (_i >= _iterator.length) break;
        _ref = _iterator[_i++];
      } else {
        _i = _iterator.next();
        if (_i.done) break;
        _ref = _i.value;
      }

      var prev = _ref;
      var from = this.relative(prev.file);

      var root = prev.root || _path.default.dirname(prev.file);

      var map = void 0;

      if (this.mapOpts.sourcesContent === false) {
        map = new _sourceMap.default.SourceMapConsumer(prev.text);

        if (map.sourcesContent) {
          map.sourcesContent = map.sourcesContent.map(function () {
            return null;
          });
        }
      } else {
        map = prev.consumer();
      }

      this.map.applySourceMap(map, from, this.relative(root));
    }
  };

  _proto.isAnnotation = function isAnnotation() {
    if (this.isInline()) {
      return true;
    }

    if (typeof this.mapOpts.annotation !== 'undefined') {
      return this.mapOpts.annotation;
    }

    if (this.previous().length) {
      return this.previous().some(function (i) {
        return i.annotation;
      });
    }

    return true;
  };

  _proto.toBase64 = function toBase64(str) {
    if (Buffer) {
      return Buffer.from(str).toString('base64');
    }

    return window.btoa(unescape(encodeURIComponent(str)));
  };

  _proto.addAnnotation = function addAnnotation() {
    var content;

    if (this.isInline()) {
      content = 'data:application/json;base64,' + this.toBase64(this.map.toString());
    } else if (typeof this.mapOpts.annotation === 'string') {
      content = this.mapOpts.annotation;
    } else {
      content = this.outputFile() + '.map';
    }

    var eol = '\n';
    if (this.css.indexOf('\r\n') !== -1) eol = '\r\n';
    this.css += eol + '/*# sourceMappingURL=' + content + ' */';
  };

  _proto.outputFile = function outputFile() {
    if (this.opts.to) {
      return this.relative(this.opts.to);
    }

    if (this.opts.from) {
      return this.relative(this.opts.from);
    }

    return 'to.css';
  };

  _proto.generateMap = function generateMap() {
    this.generateString();
    if (this.isSourcesContent()) this.setSourcesContent();
    if (this.previous().length > 0) this.applyPrevMaps();
    if (this.isAnnotation()) this.addAnnotation();

    if (this.isInline()) {
      return [this.css];
    }

    return [this.css, this.map];
  };

  _proto.relative = function relative(file) {
    if (file.indexOf('<') === 0) return file;
    if (/^\w+:\/\//.test(file)) return file;
    var from = this.opts.to ? _path.default.dirname(this.opts.to) : '.';

    if (typeof this.mapOpts.annotation === 'string') {
      from = _path.default.dirname(_path.default.resolve(from, this.mapOpts.annotation));
    }

    file = _path.default.relative(from, file);

    if (_path.default.sep === '\\') {
      return file.replace(/\\/g, '/');
    }

    return file;
  };

  _proto.sourcePath = function sourcePath(node) {
    if (this.mapOpts.from) {
      return this.mapOpts.from;
    }

    return this.relative(node.source.input.from);
  };

  _proto.generateString = function generateString() {
    var _this3 = this;

    this.css = '';
    this.map = new _sourceMap.default.SourceMapGenerator({
      file: this.outputFile()
    });
    var line = 1;
    var column = 1;
    var lines, last;
    this.stringify(this.root, function (str, node, type) {
      _this3.css += str;

      if (node && type !== 'end') {
        if (node.source && node.source.start) {
          _this3.map.addMapping({
            source: _this3.sourcePath(node),
            generated: {
              line: line,
              column: column - 1
            },
            original: {
              line: node.source.start.line,
              column: node.source.start.column - 1
            }
          });
        } else {
          _this3.map.addMapping({
            source: '<no source>',
            original: {
              line: 1,
              column: 0
            },
            generated: {
              line: line,
              column: column - 1
            }
          });
        }
      }

      lines = str.match(/\n/g);

      if (lines) {
        line += lines.length;
        last = str.lastIndexOf('\n');
        column = str.length - last;
      } else {
        column += str.length;
      }

      if (node && type !== 'start') {
        if (node.source && node.source.end) {
          _this3.map.addMapping({
            source: _this3.sourcePath(node),
            generated: {
              line: line,
              column: column - 1
            },
            original: {
              line: node.source.end.line,
              column: node.source.end.column
            }
          });
        } else {
          _this3.map.addMapping({
            source: '<no source>',
            original: {
              line: 1,
              column: 0
            },
            generated: {
              line: line,
              column: column - 1
            }
          });
        }
      }
    });
  };

  _proto.generate = function generate() {
    this.clearAnnotation();

    if (this.isMap()) {
      return this.generateMap();
    }

    var result = '';
    this.stringify(this.root, function (i) {
      result += i;
    });
    return [result];
  };

  return MapGenerator;
}();

var _default = MapGenerator;
exports.default = _default;
module.exports = exports.default;
//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm1hcC1nZW5lcmF0b3IuZXM2Il0sIm5hbWVzIjpbIk1hcEdlbmVyYXRvciIsInN0cmluZ2lmeSIsInJvb3QiLCJvcHRzIiwibWFwT3B0cyIsIm1hcCIsImlzTWFwIiwicHJldmlvdXMiLCJsZW5ndGgiLCJwcmV2aW91c01hcHMiLCJ3YWxrIiwibm9kZSIsInNvdXJjZSIsImlucHV0IiwiaW5kZXhPZiIsInB1c2giLCJpc0lubGluZSIsImlubGluZSIsImFubm90YXRpb24iLCJzb21lIiwiaSIsImlzU291cmNlc0NvbnRlbnQiLCJzb3VyY2VzQ29udGVudCIsIndpdGhDb250ZW50IiwiY2xlYXJBbm5vdGF0aW9uIiwibm9kZXMiLCJ0eXBlIiwidGV4dCIsInJlbW92ZUNoaWxkIiwic2V0U291cmNlc0NvbnRlbnQiLCJhbHJlYWR5IiwiZnJvbSIsInJlbGF0aXZlIiwic2V0U291cmNlQ29udGVudCIsImNzcyIsImFwcGx5UHJldk1hcHMiLCJwcmV2IiwiZmlsZSIsInBhdGgiLCJkaXJuYW1lIiwibW96aWxsYSIsIlNvdXJjZU1hcENvbnN1bWVyIiwiY29uc3VtZXIiLCJhcHBseVNvdXJjZU1hcCIsImlzQW5ub3RhdGlvbiIsInRvQmFzZTY0Iiwic3RyIiwiQnVmZmVyIiwidG9TdHJpbmciLCJ3aW5kb3ciLCJidG9hIiwidW5lc2NhcGUiLCJlbmNvZGVVUklDb21wb25lbnQiLCJhZGRBbm5vdGF0aW9uIiwiY29udGVudCIsIm91dHB1dEZpbGUiLCJlb2wiLCJ0byIsImdlbmVyYXRlTWFwIiwiZ2VuZXJhdGVTdHJpbmciLCJ0ZXN0IiwicmVzb2x2ZSIsInNlcCIsInJlcGxhY2UiLCJzb3VyY2VQYXRoIiwiU291cmNlTWFwR2VuZXJhdG9yIiwibGluZSIsImNvbHVtbiIsImxpbmVzIiwibGFzdCIsInN0YXJ0IiwiYWRkTWFwcGluZyIsImdlbmVyYXRlZCIsIm9yaWdpbmFsIiwibWF0Y2giLCJsYXN0SW5kZXhPZiIsImVuZCIsImdlbmVyYXRlIiwicmVzdWx0Il0s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LFVBQUFrQixDQUFDLEVBQUk7QUFDN0IwRCxNQUFBQSxNQUFNLElBQUkxRCxDQUFWO0FBQ0QsS0FGRDtBQUdBLFdBQU8sQ0FBQzBELE1BQUQsQ0FBUDtBQUNELEc7Ozs7O2VBR1k5RSxZIiwic291cmNlc0NvbnRlbnQiOlsiaW1wb3J0IG1vemlsbGEgZnJvbSAnc291cmNlLW1hcCdcbmltcG9ydCBwYXRoIGZyb20gJ3BhdGgnXG5cbmNsYXNzIE1hcEdlbmVyYXRvciB7XG4gIGNvbnN0cnVjdG9yIChzdHJpbmdpZnksIHJvb3QsIG9wdHMpIHtcbiAgICB0aGlzLnN0cmluZ2lmeSA9IHN0cmluZ2lmeVxuICAgIHRoaXMubWFwT3B0cyA9IG9wdHMubWFwIHx8IHsgfVxuICAgIHRoaXMucm9vdCA9IHJvb3RcbiAgICB0aGlzLm9wdHMgPSBvcHRzXG4gIH1cblxuICBpc01hcCAoKSB7XG4gICAgaWYgKHR5cGVvZiB0aGlzLm9wdHMubWFwICE9PSAndW5kZWZpbmVkJykge1xuICAgICAgcmV0dXJuICEhdGhpcy5vcHRzLm1hcFxuICAgIH1cbiAgICByZXR1cm4gdGhpcy5wcmV2aW91cygpLmxlbmd0aCA+IDBcbiAgfVxuXG4gIHByZXZpb3VzICgpIHtcbiAgICBpZiAoIXRoaXMucHJldmlvdXNNYXBzKSB7XG4gICAgICB0aGlzLnByZXZpb3VzTWFwcyA9IFtdXG4gICAgICB0aGlzLnJvb3Qud2Fsayhub2RlID0+IHtcbiAgICAgICAgaWYgKG5vZGUuc291cmNlICYmIG5vZGUuc291cmNlLmlucHV0Lm1hcCkge1xuICAgICAgICAgIGxldCBtYXAgPSBub2RlLnNvdXJjZS5pbnB1dC5tYXBcbiAgICAgICAgICBpZiAodGhpcy5wcmV2aW91c01hcHMuaW5kZXhPZihtYXApID09PSAtMSkge1xuICAgICAgICAgICAgdGhpcy5wcmV2aW91c01hcHMucHVzaChtYXApXG4gICAgICAgICAgfVxuICAgICAgICB9XG4gICAgICB9KVxuICAgIH1cblxuICAgIHJldHVybiB0aGlzLnByZXZpb3VzTWFwc1xuICB9XG5cbiAgaXNJbmxpbmUgKCkge1xuICAgIGlmICh0eXBlb2YgdGhpcy5tYXBPcHRzLmlubGluZSAhPT0gJ3VuZGVmaW5lZCcpIHtcbiAgICAgIHJldHVybiB0aGlzLm1hcE9wdHMuaW5saW5lXG4gICAgfVxuXG4gICAgbGV0IGFubm90YXRpb24gPSB0aGlzLm1hcE9wdHMuYW5ub3RhdGlvblxuICAgIGlmICh0eXBlb2YgYW5ub3RhdGlvbiAhPT0gJ3VuZGVmaW5lZCcgJiYgYW5ub3RhdGlvbiAhPT0gdHJ1ZSkge1xuICAgICAgcmV0dXJuIGZhbHNlXG4gICAgfVxuXG4gICAgaWYgKHRoaXMucHJldmlvdXMoKS5sZW5ndGgpIHtcbiAgICAgIHJldHVybiB0aGlzLnByZXZpb3VzKCkuc29tZShpID0+IGkuaW5saW5lKVxuICAgIH1cbiAgICByZXR1cm4gdHJ1ZVxuICB9XG5cbiAgaXNTb3VyY2VzQ29udGVudCAoKSB7XG4gICAgaWYgKHR5cGVvZiB0aGlzLm1hcE9wdHMuc291cmNlc0NvbnRlbnQgIT09ICd1bmRlZmluZWQnKSB7XG4gICAgICByZXR1cm4gdGhpcy5tYXBPcHRzLnNvdXJjZXNDb250ZW50XG4gICAgfVxuICAgIGlmICh0aGlzLnByZXZpb3VzKCkubGVuZ3RoKSB7XG4gICAgICByZXR1cm4gdGhpcy5wcmV2aW91cygpLnNvbWUoaSA9PiBpLndpdGhDb250ZW50KCkpXG4gICAgfVxuICAgIHJldHVybiB0cnVlXG4gIH1cblxuICBjbGVhckFubm90YXRpb24gKCkge1xuICAgIGlmICh0aGlzLm1hcE9wdHMuYW5ub3RhdGlvbiA9PT0gZmFsc2UpIHJldHVyblxuXG4gICAgbGV0IG5vZGVcbiAgICBmb3IgKGxldCBpID0gdGhpcy5yb290Lm5vZGVzLmxlbmd0aCAtIDE7IGkgPj0gMDsgaS0tKSB7XG4gICAgICBub2RlID0gdGhpcy5yb290Lm5vZGVzW2ldXG4gICAgICBpZiAobm9kZS50eXBlICE9PSAnY29tbWVudCcpIGNvbnRpbnVlXG4gICAgICBpZiAobm9kZS50ZXh0LmluZGV4T2YoJyMgc291cmNlTWFwcGluZ1VSTD0nKSA9PT0gMCkge1xuICAgICAgICB0aGlzLnJvb3QucmVtb3ZlQ2hpbGQoaSlcbiAgICAgIH1cbiAgICB9XG4gIH1cblxuICBzZXRTb3VyY2VzQ29udGVudCAoKSB7XG4gICAgbGV0IGFscmVhZHkgPSB7IH1cbiAgICB0aGlzLnJvb3Qud2Fsayhub2RlID0+IHtcbiAgICAgIGlmIChub2RlLnNvdXJjZSkge1xuICAgICAgICBsZXQgZnJvbSA9IG5vZGUuc291cmNlLmlucHV0LmZyb21cbiAgICAgICAgaWYgKGZyb20gJiYgIWFscmVhZHlbZnJvbV0pIHtcbiAgICAgICAgICBhbHJlYWR5W2Zyb21dID0gdHJ1ZVxuICAgICAgICAgIGxldCByZWxhdGl2ZSA9IHRoaXMucmVsYXRpdmUoZnJvbSlcbiAgICAgICAgICB0aGlzLm1hcC5zZXRTb3VyY2VDb250ZW50KHJlbGF0aXZlLCBub2RlLnNvdXJjZS5pbnB1dC5jc3MpXG4gICAgICAgIH1cbiAgICAgIH1cbiAgICB9KVxuICB9XG5cbiAgYXBwbHlQcmV2TWFwcyAoKSB7XG4gICAgZm9yIChsZXQgcHJldiBvZiB0aGlzLnByZXZpb3VzKCkpIHtcbiAgICAgIGxldCBmcm9tID0gdGhpcy5yZWxhdGl2ZShwcmV2LmZpbGUpXG4gICAgICBsZXQgcm9vdCA9IHByZXYucm9vdCB8fCBwYXRoLmRpcm5hbWUocHJldi5maWxlKVxuICAgICAgbGV0IG1hcFxuXG4gICAgICBpZiAodGhpcy5tYXBPcHRzLnNvdXJjZXNDb250ZW50ID09PSBmYWxzZSkge1xuICAgICAgICBtYXAgPSBuZXcgbW96aWxsYS5Tb3VyY2VNYXBDb25zdW1lcihwcmV2LnRleHQpXG4gICAgICAgIGlmIChtYXAuc291cmNlc0NvbnRlbnQpIHtcbiAgICAgICAgICBtYXAuc291cmNlc0NvbnRlbnQgPSBtYXAuc291cmNlc0NvbnRlbnQubWFwKCgpID0+IG51bGwpXG4gICAgICAgIH1cbiAgICAgIH0gZWxzZSB7XG4gICAgICAgIG1hcCA9IHByZXYuY29uc3VtZXIoKVxuICAgICAgfVxuXG4gICAgICB0aGlzLm1hcC5hcHBseVNvdXJjZU1hcChtYXAsIGZyb20sIHRoaXMucmVsYXRpdmUocm9vdCkpXG4gICAgfVxuICB9XG5cbiAgaXNBbm5vdGF0aW9uICgpIHtcbiAgICBpZiAodGhpcy5pc0lubGluZSgpKSB7XG4gICAgICByZXR1cm4gdHJ1ZVxuICAgIH1cbiAgICBpZiAodHlwZW9mIHRoaXMubWFwT3B0cy5hbm5vdGF0aW9uICE9PSAndW5kZWZpbmVkJykge1xuICAgICAgcmV0dXJuIHRoaXMubWFwT3B0cy5hbm5vdGF0aW9uXG4gICAgfVxuICAgIGlmICh0aGlzLnByZXZpb3VzKCkubGVuZ3RoKSB7XG4gICAgICByZXR1cm4gdGhpcy5wcmV2aW91cygpLnNvbWUoaSA9PiBpLmFubm90YXRpb24pXG4gICAgfVxuICAgIHJldHVybiB0cnVlXG4gIH1cblxuICB0b0Jhc2U2NCAoc3RyKSB7XG4gICAgaWYgKEJ1ZmZlcikge1xuICAgICAgcmV0dXJuIEJ1ZmZlci5mcm9tKHN0cikudG9TdHJpbmcoJ2Jhc2U2NCcpXG4gICAgfVxuICAgIHJldHVybiB3aW5kb3cuYnRvYSh1bmVzY2FwZShlbmNvZGVVUklDb21wb25lbnQoc3RyKSkpXG4gIH1cblxuICBhZGRBbm5vdGF0aW9uICgpIHtcbiAgICBsZXQgY29udGVudFxuXG4gICAgaWYgKHRoaXMuaXNJbmxpbmUoKSkge1xuICAgICAgY29udGVudCA9ICdkYXRhOmFwcGxpY2F0aW9uL2pzb247YmFzZTY0LCcgK1xuICAgICAgICAgICAgICAgIHRoaXMudG9CYXNlNjQodGhpcy5tYXAudG9TdHJpbmcoKSlcbiAgICB9IGVsc2UgaWYgKHR5cGVvZiB0aGlzLm1hcE9wdHMuYW5ub3RhdGlvbiA9PT0gJ3N0cmluZycpIHtcbiAgICAgIGNvbnRlbnQgPSB0aGlzLm1hcE9wdHMuYW5ub3RhdGlvblxuICAgIH0gZWxzZSB7XG4gICAgICBjb250ZW50ID0gdGhpcy5vdXRwdXRGaWxlKCkgKyAnLm1hcCdcbiAgICB9XG5cbiAgICBsZXQgZW9sID0gJ1xcbidcbiAgICBpZiAodGhpcy5jc3MuaW5kZXhPZignXFxyXFxuJykgIT09IC0xKSBlb2wgPSAnXFxyXFxuJ1xuXG4gICAgdGhpcy5jc3MgKz0gZW9sICsgJy8qIyBzb3VyY2VNYXBwaW5nVVJMPScgKyBjb250ZW50ICsgJyAqLydcbiAgfVxuXG4gIG91dHB1dEZpbGUgKCkge1xuICAgIGlmICh0aGlzLm9wdHMudG8pIHtcbiAgICAgIHJldHVybiB0aGlzLnJlbGF0aXZlKHRoaXMub3B0cy50bylcbiAgICB9XG4gICAgaWYgKHRoaXMub3B0cy5mcm9tKSB7XG4gICAgICByZXR1cm4gdGhpcy5yZWxhdGl2ZSh0aGlzLm9wdHMuZnJvbSlcbiAgICB9XG4gICAgcmV0dXJuICd0by5jc3MnXG4gIH1cblxuICBnZW5lcmF0ZU1hcCAoKSB7XG4gICAgdGhpcy5nZW5lcmF0ZVN0cmluZygpXG4gICAgaWYgKHRoaXMuaXNTb3VyY2VzQ29udGVudCgpKSB0aGlzLnNldFNvdXJjZXNDb250ZW50KClcbiAgICBpZiAodGhpcy5wcmV2aW91cygpLmxlbmd0aCA+IDApIHRoaXMuYXBwbHlQcmV2TWFwcygpXG4gICAgaWYgKHRoaXMuaXNBbm5vdGF0aW9uKCkpIHRoaXMuYWRkQW5ub3RhdGlvbigpXG5cbiAgICBpZiAodGhpcy5pc0lubGluZSgpKSB7XG4gICAgICByZXR1cm4gW3RoaXMuY3NzXVxuICAgIH1cbiAgICByZXR1cm4gW3RoaXMuY3NzLCB0aGlzLm1hcF1cbiAgfVxuXG4gIHJlbGF0aXZlIChmaWxlKSB7XG4gICAgaWYgKGZpbGUuaW5kZXhPZignPCcpID09PSAwKSByZXR1cm4gZmlsZVxuICAgIGlmICgvXlxcdys6XFwvXFwvLy50ZXN0KGZpbGUpKSByZXR1cm4gZmlsZVxuXG4gICAgbGV0IGZyb20gPSB0aGlzLm9wdHMudG8gPyBwYXRoLmRpcm5hbWUodGhpcy5vcHRzLnRvKSA6ICcuJ1xuXG4gICAgaWYgKHR5cGVvZiB0aGlzLm1hcE9wdHMuYW5ub3RhdGlvbiA9PT0gJ3N0cmluZycpIHtcbiAgICAgIGZyb20gPSBwYXRoLmRpcm5hbWUocGF0aC5yZXNvbHZlKGZyb20sIHRoaXMubWFwT3B0cy5hbm5vdGF0aW9uKSlcbiAgICB9XG5cbiAgICBmaWxlID0gcGF0aC5yZWxhdGl2ZShmcm9tLCBmaWxlKVxuICAgIGlmIChwYXRoLnNlcCA9PT0gJ1xcXFwnKSB7XG4gICAgICByZXR1cm4gZmlsZS5yZXBsYWNlKC9cXFxcL2csICcvJylcbiAgICB9XG4gICAgcmV0dXJuIGZpbGVcbiAgfVxuXG4gIHNvdXJjZVBhdGggKG5vZGUpIHtcbiAgICBpZiAodGhpcy5tYXBPcHRzLmZyb20pIHtcbiAgICAgIHJldHVybiB0aGlzLm1hcE9wdHMuZnJvbVxuICAgIH1cbiAgICByZXR1cm4gdGhpcy5yZWxhdGl2ZShub2RlLnNvdXJjZS5pbnB1dC5mcm9tKVxuICB9XG5cbiAgZ2VuZXJhdGVTdHJpbmcgKCkge1xuICAgIHRoaXMuY3NzID0gJydcbiAgICB0aGlzLm1hcCA9IG5ldyBtb3ppbGxhLlNvdXJjZU1hcEdlbmVyYXRvcih7IGZpbGU6IHRoaXMub3V0cHV0RmlsZSgpIH0pXG5cbiAgICBsZXQgbGluZSA9IDFcbiAgICBsZXQgY29sdW1uID0gMVxuXG4gICAgbGV0IGxpbmVzLCBsYXN0XG4gICAgdGhpcy5zdHJpbmdpZnkodGhpcy5yb290LCAoc3RyLCBub2RlLCB0eXBlKSA9PiB7XG4gICAgICB0aGlzLmNzcyArPSBzdHJcblxuICAgICAgaWYgKG5vZGUgJiYgdHlwZSAhPT0gJ2VuZCcpIHtcbiAgICAgICAgaWYgKG5vZGUuc291cmNlICYmIG5vZGUuc291cmNlLnN0YXJ0KSB7XG4gICAgICAgICAgdGhpcy5tYXAuYWRkTWFwcGluZyh7XG4gICAgICAgICAgICBzb3VyY2U6IHRoaXMuc291cmNlUGF0aChub2RlKSxcbiAgICAgICAgICAgIGdlbmVyYXRlZDogeyBsaW5lLCBjb2x1bW46IGNvbHVtbiAtIDEgfSxcbiAgICAgICAgICAgIG9yaWdpbmFsOiB7XG4gICAgICAgICAgICAgIGxpbmU6IG5vZGUuc291cmNlLnN0YXJ0LmxpbmUsXG4gICAgICAgICAgICAgIGNvbHVtbjogbm9kZS5zb3VyY2Uuc3RhcnQuY29sdW1uIC0gMVxuICAgICAgICAgICAgfVxuICAgICAgICAgIH0pXG4gICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgdGhpcy5tYXAuYWRkTWFwcGluZyh7XG4gICAgICAgICAgICBzb3VyY2U6ICc8bm8gc291cmNlPicsXG4gICAgICAgICAgICBvcmlnaW5hbDogeyBsaW5lOiAxLCBjb2x1bW46IDAgfSxcbiAgICAgICAgICAgIGdlbmVyYXRlZDogeyBsaW5lLCBjb2x1bW46IGNvbHVtbiAtIDEgfVxuICAgICAgICAgIH0pXG4gICAgICAgIH1cbiAgICAgIH1cblxuICAgICAgbGluZXMgPSBzdHIubWF0Y2goL1xcbi9nKVxuICAgICAgaWYgKGxpbmVzKSB7XG4gICAgICAgIGxpbmUgKz0gbGluZXMubGVuZ3RoXG4gICAgICAgIGxhc3QgPSBzdHIubGFzdEluZGV4T2YoJ1xcbicpXG4gICAgICAgIGNvbHVtbiA9IHN0ci5sZW5ndGggLSBsYXN0XG4gICAgICB9IGVsc2Uge1xuICAgICAgICBjb2x1bW4gKz0gc3RyLmxlbmd0aFxuICAgICAgfVxuXG4gICAgICBpZiAobm9kZSAmJiB0eXBlICE9PSAnc3RhcnQnKSB7XG4gICAgICAgIGlmIChub2RlLnNvdXJjZSAmJiBub2RlLnNvdXJjZS5lbmQpIHtcbiAgICAgICAgICB0aGlzLm1hcC5hZGRNYXBwaW5nKHtcbiAgICAgICAgICAgIHNvdXJjZTogdGhpcy5zb3VyY2VQYXRoKG5vZGUpLFxuICAgICAgICAgICAgZ2VuZXJhdGVkOiB7IGxpbmUsIGNvbHVtbjogY29sdW1uIC0gMSB9LFxuICAgICAgICAgICAgb3JpZ2luYWw6IHtcbiAgICAgICAgICAgICAgbGluZTogbm9kZS5zb3VyY2UuZW5kLmxpbmUsXG4gICAgICAgICAgICAgIGNvbHVtbjogbm9kZS5zb3VyY2UuZW5kLmNvbHVtblxuICAgICAgICAgICAgfVxuICAgICAgICAgIH0pXG4gICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgdGhpcy5tYXAuYWRkTWFwcGluZyh7XG4gICAgICAgICAgICBzb3VyY2U6ICc8bm8gc291cmNlPicsXG4gICAgICAgICAgICBvcmlnaW5hbDogeyBsaW5lOiAxLCBjb2x1bW46IDAgfSxcbiAgICAgICAgICAgIGdlbmVyYXRlZDogeyBsaW5lLCBjb2x1bW46IGNvbHVtbiAtIDEgfVxuICAgICAgICAgIH0pXG4gICAgICAgIH1cbiAgICAgIH1cbiAgICB9KVxuICB9XG5cbiAgZ2VuZXJhdGUgKCkge1xuICAgIHRoaXMuY2xlYXJBbm5vdGF0aW9uKClcblxuICAgIGlmICh0aGlzLmlzTWFwKCkpIHtcbiAgICAgIHJldHVybiB0aGlzLmdlbmVyYXRlTWFwKClcbiAgICB9XG5cbiAgICBsZXQgcmVzdWx0ID0gJydcbiAgICB0aGlzLnN0cmluZ2lmeSh0aGlzLnJvb3QsIGkgPT4ge1xuICAgICAgcmVzdWx0ICs9IGlcbiAgICB9KVxuICAgIHJldHVybiBbcmVzdWx0XVxuICB9XG59XG5cbmV4cG9ydCBkZWZhdWx0IE1hcEdlbmVyYXRvclxuIl0sImZpbGUiOiJtYXAtZ2VuZXJhdG9yLmpzIn0=
