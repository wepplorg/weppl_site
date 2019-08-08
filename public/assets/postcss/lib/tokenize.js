"use strict";

exports.__esModule = true;
exports.default = tokenizer;
var SINGLE_QUOTE = '\''.charCodeAt(0);
var DOUBLE_QUOTE = '"'.charCodeAt(0);
var BACKSLASH = '\\'.charCodeAt(0);
var SLASH = '/'.charCodeAt(0);
var NEWLINE = '\n'.charCodeAt(0);
var SPACE = ' '.charCodeAt(0);
var FEED = '\f'.charCodeAt(0);
var TAB = '\t'.charCodeAt(0);
var CR = '\r'.charCodeAt(0);
var OPEN_SQUARE = '['.charCodeAt(0);
var CLOSE_SQUARE = ']'.charCodeAt(0);
var OPEN_PARENTHESES = '('.charCodeAt(0);
var CLOSE_PARENTHESES = ')'.charCodeAt(0);
var OPEN_CURLY = '{'.charCodeAt(0);
var CLOSE_CURLY = '}'.charCodeAt(0);
var SEMICOLON = ';'.charCodeAt(0);
var ASTERISK = '*'.charCodeAt(0);
var COLON = ':'.charCodeAt(0);
var AT = '@'.charCodeAt(0);
var RE_AT_END = /[ \n\t\r\f{}()'"\\;/[\]#]/g;
var RE_WORD_END = /[ \n\t\r\f(){}:;@!'"\\\][#]|\/(?=\*)/g;
var RE_BAD_BRACKET = /.[\\/("'\n]/;
var RE_HEX_ESCAPE = /[a-f0-9]/i;

function tokenizer(input, options) {
  if (options === void 0) {
    options = {};
  }

  var css = input.css.valueOf();
  var ignore = options.ignoreErrors;
  var code, next, quote, lines, last, content, escape;
  var nextLine, nextOffset, escaped, escapePos, prev, n, currentToken;
  var length = css.length;
  var offset = -1;
  var line = 1;
  var pos = 0;
  var buffer = [];
  var returned = [];

  function unclosed(what) {
    throw input.error('Unclosed ' + what, line, pos - offset);
  }

  function endOfFile() {
    return returned.length === 0 && pos >= length;
  }

  function nextToken(opts) {
    if (returned.length) return returned.pop();
    if (pos >= length) return;
    var ignoreUnclosed = opts ? opts.ignoreUnclosed : false;
    code = css.charCodeAt(pos);

    if (code === NEWLINE || code === FEED || code === CR && css.charCodeAt(pos + 1) !== NEWLINE) {
      offset = pos;
      line += 1;
    }

    switch (code) {
      case NEWLINE:
      case SPACE:
      case TAB:
      case CR:
      case FEED:
        next = pos;

        do {
          next += 1;
          code = css.charCodeAt(next);

          if (code === NEWLINE) {
            offset = next;
            line += 1;
          }
        } while (code === SPACE || code === NEWLINE || code === TAB || code === CR || code === FEED);

        currentToken = ['space', css.slice(pos, next)];
        pos = next - 1;
        break;

      case OPEN_SQUARE:
      case CLOSE_SQUARE:
      case OPEN_CURLY:
      case CLOSE_CURLY:
      case COLON:
      case SEMICOLON:
      case CLOSE_PARENTHESES:
        var controlChar = String.fromCharCode(code);
        currentToken = [controlChar, controlChar, line, pos - offset];
        break;

      case OPEN_PARENTHESES:
        prev = buffer.length ? buffer.pop()[1] : '';
        n = css.charCodeAt(pos + 1);

        if (prev === 'url' && n !== SINGLE_QUOTE && n !== DOUBLE_QUOTE && n !== SPACE && n !== NEWLINE && n !== TAB && n !== FEED && n !== CR) {
          next = pos;

          do {
            escaped = false;
            next = css.indexOf(')', next + 1);

            if (next === -1) {
              if (ignore || ignoreUnclosed) {
                next = pos;
                break;
              } else {
                unclosed('bracket');
              }
            }

            escapePos = next;

            while (css.charCodeAt(escapePos - 1) === BACKSLASH) {
              escapePos -= 1;
              escaped = !escaped;
            }
          } while (escaped);

          currentToken = ['brackets', css.slice(pos, next + 1), line, pos - offset, line, next - offset];
          pos = next;
        } else {
          next = css.indexOf(')', pos + 1);
          content = css.slice(pos, next + 1);

          if (next === -1 || RE_BAD_BRACKET.test(content)) {
            currentToken = ['(', '(', line, pos - offset];
          } else {
            currentToken = ['brackets', content, line, pos - offset, line, next - offset];
            pos = next;
          }
        }

        break;

      case SINGLE_QUOTE:
      case DOUBLE_QUOTE:
        quote = code === SINGLE_QUOTE ? '\'' : '"';
        next = pos;

        do {
          escaped = false;
          next = css.indexOf(quote, next + 1);

          if (next === -1) {
            if (ignore || ignoreUnclosed) {
              next = pos + 1;
              break;
            } else {
              unclosed('string');
            }
          }

          escapePos = next;

          while (css.charCodeAt(escapePos - 1) === BACKSLASH) {
            escapePos -= 1;
            escaped = !escaped;
          }
        } while (escaped);

        content = css.slice(pos, next + 1);
        lines = content.split('\n');
        last = lines.length - 1;

        if (last > 0) {
          nextLine = line + last;
          nextOffset = next - lines[last].length;
        } else {
          nextLine = line;
          nextOffset = offset;
        }

        currentToken = ['string', css.slice(pos, next + 1), line, pos - offset, nextLine, next - nextOffset];
        offset = nextOffset;
        line = nextLine;
        pos = next;
        break;

      case AT:
        RE_AT_END.lastIndex = pos + 1;
        RE_AT_END.test(css);

        if (RE_AT_END.lastIndex === 0) {
          next = css.length - 1;
        } else {
          next = RE_AT_END.lastIndex - 2;
        }

        currentToken = ['at-word', css.slice(pos, next + 1), line, pos - offset, line, next - offset];
        pos = next;
        break;

      case BACKSLASH:
        next = pos;
        escape = true;

        while (css.charCodeAt(next + 1) === BACKSLASH) {
          next += 1;
          escape = !escape;
        }

        code = css.charCodeAt(next + 1);

        if (escape && code !== SLASH && code !== SPACE && code !== NEWLINE && code !== TAB && code !== CR && code !== FEED) {
          next += 1;

          if (RE_HEX_ESCAPE.test(css.charAt(next))) {
            while (RE_HEX_ESCAPE.test(css.charAt(next + 1))) {
              next += 1;
            }

            if (css.charCodeAt(next + 1) === SPACE) {
              next += 1;
            }
          }
        }

        currentToken = ['word', css.slice(pos, next + 1), line, pos - offset, line, next - offset];
        pos = next;
        break;

      default:
        if (code === SLASH && css.charCodeAt(pos + 1) === ASTERISK) {
          next = css.indexOf('*/', pos + 2) + 1;

          if (next === 0) {
            if (ignore || ignoreUnclosed) {
              next = css.length;
            } else {
              unclosed('comment');
            }
          }

          content = css.slice(pos, next + 1);
          lines = content.split('\n');
          last = lines.length - 1;

          if (last > 0) {
            nextLine = line + last;
            nextOffset = next - lines[last].length;
          } else {
            nextLine = line;
            nextOffset = offset;
          }

          currentToken = ['comment', content, line, pos - offset, nextLine, next - nextOffset];
          offset = nextOffset;
          line = nextLine;
          pos = next;
        } else {
          RE_WORD_END.lastIndex = pos + 1;
          RE_WORD_END.test(css);

          if (RE_WORD_END.lastIndex === 0) {
            next = css.length - 1;
          } else {
            next = RE_WORD_END.lastIndex - 2;
          }

          currentToken = ['word', css.slice(pos, next + 1), line, pos - offset, line, next - offset];
          buffer.push(currentToken);
          pos = next;
        }

        break;
    }

    pos++;
    return currentToken;
  }

  function back(token) {
    returned.push(token);
  }

  return {
    back: back,
    nextToken: nextToken,
    endOfFile: endOfFile
  };
}

module.exports = exports.default;
//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInRva2VuaXplLmVzNiJdLCJuYW1lcyI6WyJTSU5HTEVfUVVPVEUiLCJjaGFyQ29kZUF0IiwiRE9VQkxFX1FVT1RFIiwiQkFDS1NMQVNIIiwiU0xBU0giLCJORVdMSU5FIiwiU1BBQ0UiLCJGRUVEIiwiVEFCIiwiQ1IiLCJPUEVOX1NRVUFSRSIsIkNMT1NFX1NRVUFSRSIsIk9QRU5fUEFSRU5USEVTRVMiLCJDTE9TRV9QQVJFTlRIRVNFUyIsIk9QRU5fQ1VSTFkiLCJDTE9TRV9DVVJMWSIsIlNFTUlDT0xPTiIsIkFTVEVSSVNLIiwiQ09MT04iLCJBVCIsIlJFX0FUX0VORCIsIlJFX1dPUkRfRU5EIiwiUkVfQkFEX0JSQUNLRVQiLCJSRV9IRVhfRVNDQVBFIiwidG9rZW5pemVyIiwiaW5wdXQiLCJvcHRpb25zIiwiY3NzIiwidmFsdWVPZiIsImlnbm9yZSIsImlnbm9yZUVycm9ycyIsImNvZGUiLCJuZXh0IiwicXVvdGUiLCJsaW5lcyIsImxhc3QiLCJjb250ZW50IiwiZXNjYXBlIiwibmV4dExpbmUiLCJuZXh0T2Zmc2V0IiwiZXNjYXBlZCIsImVzY2FwZVBvcyIsInByZXYiLCJuIiwiY3VycmVudFRva2VuIiwibGVuZ3RoIiwib2Zmc2V0IiwibGluZSIsInBvcyIsImJ1ZmZlciIsInJldHVybmVkIiwidW5jbG9zZWQiLCJ3aGF0IiwiZXJyb3IiLCJlbmRPZkZpbGUiLCJuZXh0VG9rZW4iLCJvcHRzIiwicG9wIiwiaWdub3JlVW5jbG9zZWQiLCJzbGljZSIsImNvbnRyb2xDaGFyIiwiU3RyaW5nIiwiZnJvbUNoYXJDb2RlIiwiaW5kZXhPZiIsInRlc3QiLCJzcGxpdCIsImxhc3RJbmRleCIsImNoYXJBdCIsInB1c2giLCJiYWNrIiwidG9rZW4iXSwibWFwcGluZ3MiOiI7Ozs7QUFBQSxJQUFNQSxZQUFZLEdBQUcsS0FBS0MsVUFBTCxDQUFnQixDQUFoQixDQUFyQjtBQUNBLElBQU1DLFlBQVksR0FBRyxJQUFJRCxVQUFKLENBQWUsQ0FBZixDQUFyQjtBQUNB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LEtBQWQ7QUFDRDs7QUFFRCxTQUFPO0FBQ0xELElBQUFBLElBQUksRUFBSkEsSUFESztBQUVMZCxJQUFBQSxTQUFTLEVBQVRBLFNBRks7QUFHTEQsSUFBQUEsU0FBUyxFQUFUQTtBQUhLLEdBQVA7QUFLRCIsInNvdXJjZXNDb250ZW50IjpbImNvbnN0IFNJTkdMRV9RVU9URSA9ICdcXCcnLmNoYXJDb2RlQXQoMClcbmNvbnN0IERPVUJMRV9RVU9URSA9ICdcIicuY2hhckNvZGVBdCgwKVxuY29uc3QgQkFDS1NMQVNIID0gJ1xcXFwnLmNoYXJDb2RlQXQoMClcbmNvbnN0IFNMQVNIID0gJy8nLmNoYXJDb2RlQXQoMClcbmNvbnN0IE5FV0xJTkUgPSAnXFxuJy5jaGFyQ29kZUF0KDApXG5jb25zdCBTUEFDRSA9ICcgJy5jaGFyQ29kZUF0KDApXG5jb25zdCBGRUVEID0gJ1xcZicuY2hhckNvZGVBdCgwKVxuY29uc3QgVEFCID0gJ1xcdCcuY2hhckNvZGVBdCgwKVxuY29uc3QgQ1IgPSAnXFxyJy5jaGFyQ29kZUF0KDApXG5jb25zdCBPUEVOX1NRVUFSRSA9ICdbJy5jaGFyQ29kZUF0KDApXG5jb25zdCBDTE9TRV9TUVVBUkUgPSAnXScuY2hhckNvZGVBdCgwKVxuY29uc3QgT1BFTl9QQVJFTlRIRVNFUyA9ICcoJy5jaGFyQ29kZUF0KDApXG5jb25zdCBDTE9TRV9QQVJFTlRIRVNFUyA9ICcpJy5jaGFyQ29kZUF0KDApXG5jb25zdCBPUEVOX0NVUkxZID0gJ3snLmNoYXJDb2RlQXQoMClcbmNvbnN0IENMT1NFX0NVUkxZID0gJ30nLmNoYXJDb2RlQXQoMClcbmNvbnN0IFNFTUlDT0xPTiA9ICc7Jy5jaGFyQ29kZUF0KDApXG5jb25zdCBBU1RFUklTSyA9ICcqJy5jaGFyQ29kZUF0KDApXG5jb25zdCBDT0xPTiA9ICc6Jy5jaGFyQ29kZUF0KDApXG5jb25zdCBBVCA9ICdAJy5jaGFyQ29kZUF0KDApXG5cbmNvbnN0IFJFX0FUX0VORCA9IC9bIFxcblxcdFxcclxcZnt9KCknXCJcXFxcOy9bXFxdI10vZ1xuY29uc3QgUkVfV09SRF9FTkQgPSAvWyBcXG5cXHRcXHJcXGYoKXt9OjtAISdcIlxcXFxcXF1bI118XFwvKD89XFwqKS9nXG5jb25zdCBSRV9CQURfQlJBQ0tFVCA9IC8uW1xcXFwvKFwiJ1xcbl0vXG5jb25zdCBSRV9IRVhfRVNDQVBFID0gL1thLWYwLTldL2lcblxuZXhwb3J0IGRlZmF1bHQgZnVuY3Rpb24gdG9rZW5pemVyIChpbnB1dCwgb3B0aW9ucyA9IHt9KSB7XG4gIGxldCBjc3MgPSBpbnB1dC5jc3MudmFsdWVPZigpXG4gIGxldCBpZ25vcmUgPSBvcHRpb25zLmlnbm9yZUVycm9yc1xuXG4gIGxldCBjb2RlLCBuZXh0LCBxdW90ZSwgbGluZXMsIGxhc3QsIGNvbnRlbnQsIGVzY2FwZVxuICBsZXQgbmV4dExpbmUsIG5leHRPZmZzZXQsIGVzY2FwZWQsIGVzY2FwZVBvcywgcHJldiwgbiwgY3VycmVudFRva2VuXG5cbiAgbGV0IGxlbmd0aCA9IGNzcy5sZW5ndGhcbiAgbGV0IG9mZnNldCA9IC0xXG4gIGxldCBsaW5lID0gMVxuICBsZXQgcG9zID0gMFxuICBsZXQgYnVmZmVyID0gW11cbiAgbGV0IHJldHVybmVkID0gW11cblxuICBmdW5jdGlvbiB1bmNsb3NlZCAod2hhdCkge1xuICAgIHRocm93IGlucHV0LmVycm9yKCdVbmNsb3NlZCAnICsgd2hhdCwgbGluZSwgcG9zIC0gb2Zmc2V0KVxuICB9XG5cbiAgZnVuY3Rpb24gZW5kT2ZGaWxlICgpIHtcbiAgICByZXR1cm4gcmV0dXJuZWQubGVuZ3RoID09PSAwICYmIHBvcyA+PSBsZW5ndGhcbiAgfVxuXG4gIGZ1bmN0aW9uIG5leHRUb2tlbiAob3B0cykge1xuICAgIGlmIChyZXR1cm5lZC5sZW5ndGgpIHJldHVybiByZXR1cm5lZC5wb3AoKVxuICAgIGlmIChwb3MgPj0gbGVuZ3RoKSByZXR1cm5cblxuICAgIGxldCBpZ25vcmVVbmNsb3NlZCA9IG9wdHMgPyBvcHRzLmlnbm9yZVVuY2xvc2VkIDogZmFsc2VcblxuICAgIGNvZGUgPSBjc3MuY2hhckNvZGVBdChwb3MpXG4gICAgaWYgKFxuICAgICAgY29kZSA9PT0gTkVXTElORSB8fCBjb2RlID09PSBGRUVEIHx8XG4gICAgICAoY29kZSA9PT0gQ1IgJiYgY3NzLmNoYXJDb2RlQXQocG9zICsgMSkgIT09IE5FV0xJTkUpXG4gICAgKSB7XG4gICAgICBvZmZzZXQgPSBwb3NcbiAgICAgIGxpbmUgKz0gMVxuICAgIH1cblxuICAgIHN3aXRjaCAoY29kZSkge1xuICAgICAgY2FzZSBORVdMSU5FOlxuICAgICAgY2FzZSBTUEFDRTpcbiAgICAgIGNhc2UgVEFCOlxuICAgICAgY2FzZSBDUjpcbiAgICAgIGNhc2UgRkVFRDpcbiAgICAgICAgbmV4dCA9IHBvc1xuICAgICAgICBkbyB7XG4gICAgICAgICAgbmV4dCArPSAxXG4gICAgICAgICAgY29kZSA9IGNzcy5jaGFyQ29kZUF0KG5leHQpXG4gICAgICAgICAgaWYgKGNvZGUgPT09IE5FV0xJTkUpIHtcbiAgICAgICAgICAgIG9mZnNldCA9IG5leHRcbiAgICAgICAgICAgIGxpbmUgKz0gMVxuICAgICAgICAgIH1cbiAgICAgICAgfSB3aGlsZSAoXG4gICAgICAgICAgY29kZSA9PT0gU1BBQ0UgfHxcbiAgICAgICAgICBjb2RlID09PSBORVdMSU5FIHx8XG4gICAgICAgICAgY29kZSA9PT0gVEFCIHx8XG4gICAgICAgICAgY29kZSA9PT0gQ1IgfHxcbiAgICAgICAgICBjb2RlID09PSBGRUVEXG4gICAgICAgIClcblxuICAgICAgICBjdXJyZW50VG9rZW4gPSBbJ3NwYWNlJywgY3NzLnNsaWNlKHBvcywgbmV4dCldXG4gICAgICAgIHBvcyA9IG5leHQgLSAxXG4gICAgICAgIGJyZWFrXG5cbiAgICAgIGNhc2UgT1BFTl9TUVVBUkU6XG4gICAgICBjYXNlIENMT1NFX1NRVUFSRTpcbiAgICAgIGNhc2UgT1BFTl9DVVJMWTpcbiAgICAgIGNhc2UgQ0xPU0VfQ1VSTFk6XG4gICAgICBjYXNlIENPTE9OOlxuICAgICAgY2FzZSBTRU1JQ09MT046XG4gICAgICBjYXNlIENMT1NFX1BBUkVOVEhFU0VTOlxuICAgICAgICBsZXQgY29udHJvbENoYXIgPSBTdHJpbmcuZnJvbUNoYXJDb2RlKGNvZGUpXG4gICAgICAgIGN1cnJlbnRUb2tlbiA9IFtjb250cm9sQ2hhciwgY29udHJvbENoYXIsIGxpbmUsIHBvcyAtIG9mZnNldF1cbiAgICAgICAgYnJlYWtcblxuICAgICAgY2FzZSBPUEVOX1BBUkVOVEhFU0VTOlxuICAgICAgICBwcmV2ID0gYnVmZmVyLmxlbmd0aCA/IGJ1ZmZlci5wb3AoKVsxXSA6ICcnXG4gICAgICAgIG4gPSBjc3MuY2hhckNvZGVBdChwb3MgKyAxKVxuICAgICAgICBpZiAoXG4gICAgICAgICAgcHJldiA9PT0gJ3VybCcgJiZcbiAgICAgICAgICBuICE9PSBTSU5HTEVfUVVPVEUgJiYgbiAhPT0gRE9VQkxFX1FVT1RFICYmXG4gICAgICAgICAgbiAhPT0gU1BBQ0UgJiYgbiAhPT0gTkVXTElORSAmJiBuICE9PSBUQUIgJiZcbiAgICAgICAgICBuICE9PSBGRUVEICYmIG4gIT09IENSXG4gICAgICAgICkge1xuICAgICAgICAgIG5leHQgPSBwb3NcbiAgICAgICAgICBkbyB7XG4gICAgICAgICAgICBlc2NhcGVkID0gZmFsc2VcbiAgICAgICAgICAgIG5leHQgPSBjc3MuaW5kZXhPZignKScsIG5leHQgKyAxKVxuICAgICAgICAgICAgaWYgKG5leHQgPT09IC0xKSB7XG4gICAgICAgICAgICAgIGlmIChpZ25vcmUgfHwgaWdub3JlVW5jbG9zZWQpIHtcbiAgICAgICAgICAgICAgICBuZXh0ID0gcG9zXG4gICAgICAgICAgICAgICAgYnJlYWtcbiAgICAgICAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgICAgICB1bmNsb3NlZCgnYnJhY2tldCcpXG4gICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIH1cbiAgICAgICAgICAgIGVzY2FwZVBvcyA9IG5leHRcbiAgICAgICAgICAgIHdoaWxlIChjc3MuY2hhckNvZGVBdChlc2NhcGVQb3MgLSAxKSA9PT0gQkFDS1NMQVNIKSB7XG4gICAgICAgICAgICAgIGVzY2FwZVBvcyAtPSAxXG4gICAgICAgICAgICAgIGVzY2FwZWQgPSAhZXNjYXBlZFxuICAgICAgICAgICAgfVxuICAgICAgICAgIH0gd2hpbGUgKGVzY2FwZWQpXG5cbiAgICAgICAgICBjdXJyZW50VG9rZW4gPSBbJ2JyYWNrZXRzJywgY3NzLnNsaWNlKHBvcywgbmV4dCArIDEpLFxuICAgICAgICAgICAgbGluZSwgcG9zIC0gb2Zmc2V0LFxuICAgICAgICAgICAgbGluZSwgbmV4dCAtIG9mZnNldFxuICAgICAgICAgIF1cblxuICAgICAgICAgIHBvcyA9IG5leHRcbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICBuZXh0ID0gY3NzLmluZGV4T2YoJyknLCBwb3MgKyAxKVxuICAgICAgICAgIGNvbnRlbnQgPSBjc3Muc2xpY2UocG9zLCBuZXh0ICsgMSlcblxuICAgICAgICAgIGlmIChuZXh0ID09PSAtMSB8fCBSRV9CQURfQlJBQ0tFVC50ZXN0KGNvbnRlbnQpKSB7XG4gICAgICAgICAgICBjdXJyZW50VG9rZW4gPSBbJygnLCAnKCcsIGxpbmUsIHBvcyAtIG9mZnNldF1cbiAgICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgY3VycmVudFRva2VuID0gWydicmFja2V0cycsIGNvbnRlbnQsXG4gICAgICAgICAgICAgIGxpbmUsIHBvcyAtIG9mZnNldCxcbiAgICAgICAgICAgICAgbGluZSwgbmV4dCAtIG9mZnNldFxuICAgICAgICAgICAgXVxuICAgICAgICAgICAgcG9zID0gbmV4dFxuICAgICAgICAgIH1cbiAgICAgICAgfVxuXG4gICAgICAgIGJyZWFrXG5cbiAgICAgIGNhc2UgU0lOR0xFX1FVT1RFOlxuICAgICAgY2FzZSBET1VCTEVfUVVPVEU6XG4gICAgICAgIHF1b3RlID0gY29kZSA9PT0gU0lOR0xFX1FVT1RFID8gJ1xcJycgOiAnXCInXG4gICAgICAgIG5leHQgPSBwb3NcbiAgICAgICAgZG8ge1xuICAgICAgICAgIGVzY2FwZWQgPSBmYWxzZVxuICAgICAgICAgIG5leHQgPSBjc3MuaW5kZXhPZihxdW90ZSwgbmV4dCArIDEpXG4gICAgICAgICAgaWYgKG5leHQgPT09IC0xKSB7XG4gICAgICAgICAgICBpZiAoaWdub3JlIHx8IGlnbm9yZVVuY2xvc2VkKSB7XG4gICAgICAgICAgICAgIG5leHQgPSBwb3MgKyAxXG4gICAgICAgICAgICAgIGJyZWFrXG4gICAgICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgICB1bmNsb3NlZCgnc3RyaW5nJylcbiAgICAgICAgICAgIH1cbiAgICAgICAgICB9XG4gICAgICAgICAgZXNjYXBlUG9zID0gbmV4dFxuICAgICAgICAgIHdoaWxlIChjc3MuY2hhckNvZGVBdChlc2NhcGVQb3MgLSAxKSA9PT0gQkFDS1NMQVNIKSB7XG4gICAgICAgICAgICBlc2NhcGVQb3MgLT0gMVxuICAgICAgICAgICAgZXNjYXBlZCA9ICFlc2NhcGVkXG4gICAgICAgICAgfVxuICAgICAgICB9IHdoaWxlIChlc2NhcGVkKVxuXG4gICAgICAgIGNvbnRlbnQgPSBjc3Muc2xpY2UocG9zLCBuZXh0ICsgMSlcbiAgICAgICAgbGluZXMgPSBjb250ZW50LnNwbGl0KCdcXG4nKVxuICAgICAgICBsYXN0ID0gbGluZXMubGVuZ3RoIC0gMVxuXG4gICAgICAgIGlmIChsYXN0ID4gMCkge1xuICAgICAgICAgIG5leHRMaW5lID0gbGluZSArIGxhc3RcbiAgICAgICAgICBuZXh0T2Zmc2V0ID0gbmV4dCAtIGxpbmVzW2xhc3RdLmxlbmd0aFxuICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgIG5leHRMaW5lID0gbGluZVxuICAgICAgICAgIG5leHRPZmZzZXQgPSBvZmZzZXRcbiAgICAgICAgfVxuXG4gICAgICAgIGN1cnJlbnRUb2tlbiA9IFsnc3RyaW5nJywgY3NzLnNsaWNlKHBvcywgbmV4dCArIDEpLFxuICAgICAgICAgIGxpbmUsIHBvcyAtIG9mZnNldCxcbiAgICAgICAgICBuZXh0TGluZSwgbmV4dCAtIG5leHRPZmZzZXRcbiAgICAgICAgXVxuXG4gICAgICAgIG9mZnNldCA9IG5leHRPZmZzZXRcbiAgICAgICAgbGluZSA9IG5leHRMaW5lXG4gICAgICAgIHBvcyA9IG5leHRcbiAgICAgICAgYnJlYWtcblxuICAgICAgY2FzZSBBVDpcbiAgICAgICAgUkVfQVRfRU5ELmxhc3RJbmRleCA9IHBvcyArIDFcbiAgICAgICAgUkVfQVRfRU5ELnRlc3QoY3NzKVxuICAgICAgICBpZiAoUkVfQVRfRU5ELmxhc3RJbmRleCA9PT0gMCkge1xuICAgICAgICAgIG5leHQgPSBjc3MubGVuZ3RoIC0gMVxuICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgIG5leHQgPSBSRV9BVF9FTkQubGFzdEluZGV4IC0gMlxuICAgICAgICB9XG5cbiAgICAgICAgY3VycmVudFRva2VuID0gWydhdC13b3JkJywgY3NzLnNsaWNlKHBvcywgbmV4dCArIDEpLFxuICAgICAgICAgIGxpbmUsIHBvcyAtIG9mZnNldCxcbiAgICAgICAgICBsaW5lLCBuZXh0IC0gb2Zmc2V0XG4gICAgICAgIF1cblxuICAgICAgICBwb3MgPSBuZXh0XG4gICAgICAgIGJyZWFrXG5cbiAgICAgIGNhc2UgQkFDS1NMQVNIOlxuICAgICAgICBuZXh0ID0gcG9zXG4gICAgICAgIGVzY2FwZSA9IHRydWVcbiAgICAgICAgd2hpbGUgKGNzcy5jaGFyQ29kZUF0KG5leHQgKyAxKSA9PT0gQkFDS1NMQVNIKSB7XG4gICAgICAgICAgbmV4dCArPSAxXG4gICAgICAgICAgZXNjYXBlID0gIWVzY2FwZVxuICAgICAgICB9XG4gICAgICAgIGNvZGUgPSBjc3MuY2hhckNvZGVBdChuZXh0ICsgMSlcbiAgICAgICAgaWYgKFxuICAgICAgICAgIGVzY2FwZSAmJlxuICAgICAgICAgIGNvZGUgIT09IFNMQVNIICYmXG4gICAgICAgICAgY29kZSAhPT0gU1BBQ0UgJiZcbiAgICAgICAgICBjb2RlICE9PSBORVdMSU5FICYmXG4gICAgICAgICAgY29kZSAhPT0gVEFCICYmXG4gICAgICAgICAgY29kZSAhPT0gQ1IgJiZcbiAgICAgICAgICBjb2RlICE9PSBGRUVEXG4gICAgICAgICkge1xuICAgICAgICAgIG5leHQgKz0gMVxuICAgICAgICAgIGlmIChSRV9IRVhfRVNDQVBFLnRlc3QoY3NzLmNoYXJBdChuZXh0KSkpIHtcbiAgICAgICAgICAgIHdoaWxlIChSRV9IRVhfRVNDQVBFLnRlc3QoY3NzLmNoYXJBdChuZXh0ICsgMSkpKSB7XG4gICAgICAgICAgICAgIG5leHQgKz0gMVxuICAgICAgICAgICAgfVxuICAgICAgICAgICAgaWYgKGNzcy5jaGFyQ29kZUF0KG5leHQgKyAxKSA9PT0gU1BBQ0UpIHtcbiAgICAgICAgICAgICAgbmV4dCArPSAxXG4gICAgICAgICAgICB9XG4gICAgICAgICAgfVxuICAgICAgICB9XG5cbiAgICAgICAgY3VycmVudFRva2VuID0gWyd3b3JkJywgY3NzLnNsaWNlKHBvcywgbmV4dCArIDEpLFxuICAgICAgICAgIGxpbmUsIHBvcyAtIG9mZnNldCxcbiAgICAgICAgICBsaW5lLCBuZXh0IC0gb2Zmc2V0XG4gICAgICAgIF1cblxuICAgICAgICBwb3MgPSBuZXh0XG4gICAgICAgIGJyZWFrXG5cbiAgICAgIGRlZmF1bHQ6XG4gICAgICAgIGlmIChjb2RlID09PSBTTEFTSCAmJiBjc3MuY2hhckNvZGVBdChwb3MgKyAxKSA9PT0gQVNURVJJU0spIHtcbiAgICAgICAgICBuZXh0ID0gY3NzLmluZGV4T2YoJyovJywgcG9zICsgMikgKyAxXG4gICAgICAgICAgaWYgKG5leHQgPT09IDApIHtcbiAgICAgICAgICAgIGlmIChpZ25vcmUgfHwgaWdub3JlVW5jbG9zZWQpIHtcbiAgICAgICAgICAgICAgbmV4dCA9IGNzcy5sZW5ndGhcbiAgICAgICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAgIHVuY2xvc2VkKCdjb21tZW50JylcbiAgICAgICAgICAgIH1cbiAgICAgICAgICB9XG5cbiAgICAgICAgICBjb250ZW50ID0gY3NzLnNsaWNlKHBvcywgbmV4dCArIDEpXG4gICAgICAgICAgbGluZXMgPSBjb250ZW50LnNwbGl0KCdcXG4nKVxuICAgICAgICAgIGxhc3QgPSBsaW5lcy5sZW5ndGggLSAxXG5cbiAgICAgICAgICBpZiAobGFzdCA+IDApIHtcbiAgICAgICAgICAgIG5leHRMaW5lID0gbGluZSArIGxhc3RcbiAgICAgICAgICAgIG5leHRPZmZzZXQgPSBuZXh0IC0gbGluZXNbbGFzdF0ubGVuZ3RoXG4gICAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgIG5leHRMaW5lID0gbGluZVxuICAgICAgICAgICAgbmV4dE9mZnNldCA9IG9mZnNldFxuICAgICAgICAgIH1cblxuICAgICAgICAgIGN1cnJlbnRUb2tlbiA9IFsnY29tbWVudCcsIGNvbnRlbnQsXG4gICAgICAgICAgICBsaW5lLCBwb3MgLSBvZmZzZXQsXG4gICAgICAgICAgICBuZXh0TGluZSwgbmV4dCAtIG5leHRPZmZzZXRcbiAgICAgICAgICBdXG5cbiAgICAgICAgICBvZmZzZXQgPSBuZXh0T2Zmc2V0XG4gICAgICAgICAgbGluZSA9IG5leHRMaW5lXG4gICAgICAgICAgcG9zID0gbmV4dFxuICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgIFJFX1dPUkRfRU5ELmxhc3RJbmRleCA9IHBvcyArIDFcbiAgICAgICAgICBSRV9XT1JEX0VORC50ZXN0KGNzcylcbiAgICAgICAgICBpZiAoUkVfV09SRF9FTkQubGFzdEluZGV4ID09PSAwKSB7XG4gICAgICAgICAgICBuZXh0ID0gY3NzLmxlbmd0aCAtIDFcbiAgICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgbmV4dCA9IFJFX1dPUkRfRU5ELmxhc3RJbmRleCAtIDJcbiAgICAgICAgICB9XG5cbiAgICAgICAgICBjdXJyZW50VG9rZW4gPSBbJ3dvcmQnLCBjc3Muc2xpY2UocG9zLCBuZXh0ICsgMSksXG4gICAgICAgICAgICBsaW5lLCBwb3MgLSBvZmZzZXQsXG4gICAgICAgICAgICBsaW5lLCBuZXh0IC0gb2Zmc2V0XG4gICAgICAgICAgXVxuXG4gICAgICAgICAgYnVmZmVyLnB1c2goY3VycmVudFRva2VuKVxuXG4gICAgICAgICAgcG9zID0gbmV4dFxuICAgICAgICB9XG5cbiAgICAgICAgYnJlYWtcbiAgICB9XG5cbiAgICBwb3MrK1xuICAgIHJldHVybiBjdXJyZW50VG9rZW5cbiAgfVxuXG4gIGZ1bmN0aW9uIGJhY2sgKHRva2VuKSB7XG4gICAgcmV0dXJuZWQucHVzaCh0b2tlbilcbiAgfVxuXG4gIHJldHVybiB7XG4gICAgYmFjayxcbiAgICBuZXh0VG9rZW4sXG4gICAgZW5kT2ZGaWxlXG4gIH1cbn1cbiJdLCJmaWxlIjoidG9rZW5pemUuanMifQ==
