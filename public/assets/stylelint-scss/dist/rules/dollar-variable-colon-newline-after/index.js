"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.messages = exports.ruleName = undefined;

exports.default = function (expectation, options, context) {
  var checker = (0, _utils.whitespaceChecker)("newline", expectation, messages);

  return function (root, result) {
    var validOptions = _stylelint.utils.validateOptions(result, ruleName, {
      actual: expectation,
      possible: ["always", "always-multi-line"]
    }, {
      actual: options,
      possible: {
        disableFix: _lodash.isBoolean
      },
      optional: true
    });

    if (!validOptions) {
      return;
    }

    var shouldFix = context.fix && (!options || options.disableFix !== true);

    root.walkDecls(function (decl) {
      if (!decl.prop || decl.prop[0] !== "$") {
        return;
      }

      var value = decl.value.trim();
      var isMultilineVarWithParens = value[0] === "(" && value[value.length - 1] === ")" && !(0, _utils.isSingleLineString)(value);

      if (isMultilineVarWithParens) {
        return;
      }

      // Get the raw $var, and only that
      var endOfPropIndex = (0, _utils.declarationValueIndex)(decl) + decl.raw("between").length - 1;
      // `$var:`, `$var :`
      var propPlusColon = decl.toString().slice(0, endOfPropIndex);

      var _loop = function _loop(i, l) {
        if (propPlusColon[i] !== ":") {
          return "continue";
        }

        var indexToCheck = propPlusColon.substr(propPlusColon[i], 3) === "/*" ? propPlusColon.indexOf("*/", i) + 1 : i;

        checker.afterOneOnly({
          source: propPlusColon,
          index: indexToCheck,
          lineCheckStr: decl.value,
          err: function err(m) {
            if (shouldFix) {
              var nextLinePrefix = expectation === "always" ? decl.raws.before.replace(context.newline, "") : decl.value.split(context.newline)[1].replace(/^(\s+).*$/, function (_, whitespace) {
                return whitespace;
              });

              decl.raws.between = decl.raws.between.replace(/:(.*)$/, ":" + context.newline + nextLinePrefix);

              return;
            }

            _stylelint.utils.report({
              message: m,
              node: decl,
              index: indexToCheck,
              result: result,
              ruleName: ruleName
            });
          }
        });
        return "break";
      };

      _loop2: for (var i = 0, l = propPlusColon.length; i < l; i++) {
        var _ret = _loop(i, l);

        switch (_ret) {
          case "continue":
            continue;

          case "break":
            break _loop2;}
      }
    });
  };
};

var _utils = require("../../utils");

var _stylelint = require("stylelint");

var _lodash = require("lodash");

var ruleName = exports.ruleName = (0, _utils.namespace)("dollar-variable-colon-newline-after");

var messages = exports.messages = _stylelint.utils.ruleMessages(ruleName, {
  expectedAfter: function expectedAfter() {
    return 'Expected newline after ":"';
  },
  expectedAfterMultiLine: function expectedAfterMultiLine() {
    return 'Expected newline after ":" with a multi-line value';
  }
});