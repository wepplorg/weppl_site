"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.getUnsupportedTargets = getUnsupportedTargets;
exports.default = exports.targetMetadata = void 0;

var _data = _interopRequireDefault(require("caniuse-db/fulldata-json/data-2.0.json"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

// $FlowFixMe: Flow import error
// HACK: modern targets should be determined once at runtime
const targetMetadata = {
  targets: ['chrome', 'firefox', 'opera', 'safari', 'ie', 'edge', 'ios_saf', 'op_mini', 'android', 'bb', 'op_mob', 'and_chr', 'and_ff', 'ie_mob', 'and_uc', 'samsung', 'baidu']
};
exports.targetMetadata = targetMetadata;
const targetNameMappings = {
  chrome: 'Chrome',
  firefox: 'Firefox',
  opera: 'Opera',
  baidu: 'Baidu',
  and_qq: 'QQ Browser',
  safari: 'Safari',
  android: 'Android Browser',
  ie: 'IE',
  edge: 'Edge',
  ios_saf: 'iOS Safari',
  op_mini: 'Opera Mini',
  bb: 'Blackberry Browser',
  op_mob: 'Opera Mobile',
  and_chr: 'Android Chrome',
  and_ff: 'Android Firefox',
  ie_mob: 'IE Mobile',
  and_uc: 'Android UC Browser',
  samsung: 'Samsung Browser'
};
/**
 * Take a target's id and return it's full name by using `targetNameMappings`
 * ex. {target: and_ff, version: 40} => 'Android FireFox 40'
 */

function formatTargetNames(target) {
  return `${targetNameMappings[target.target]} ${target.version}`;
}
/**
 * Check version for the range format.
 * ex. 10.0-10.2
 */


function versionIsRange(version) {
  return version.includes('-');
}
/**
 * Parse version from caniuse and compare with parsed version from browserslist.
 */


function compareRanges(targetVersion, statsVersion) {
  return targetVersion === parseFloat(statsVersion);
}
/*
 * Check the CanIUse database to see if targets are supported
 */


function canIUseSupported(stats, {
  version,
  target,
  parsedVersion
}) {
  const targetStats = stats[target];
  return versionIsRange(version) ? Object.keys(targetStats).some(statsVersion => versionIsRange(statsVersion) && compareRanges(parsedVersion, statsVersion) ? !targetStats[statsVersion].includes('y') : false) : targetStats[version] && !targetStats[version].includes('y');
}
/**
 * Return an array of all unsupported targets
 */


function getUnsupportedTargets(node, targets) {
  const {
    stats
  } = _data.default.data[node.id];
  return targets.filter(target => canIUseSupported(stats, target)).map(formatTargetNames);
}
/**
 * Check if the node has matching object or properties
 */


function isValid(node, eslintNode, targets) {
  switch (eslintNode.type) {
    case 'CallExpression':
    case 'NewExpression':
      if (!eslintNode.callee) return true;
      if (eslintNode.callee.name !== node.object) return true;
      break;

    case 'MemberExpression':
      // Pass tests if non-matching object or property
      if (!eslintNode.object || !eslintNode.property) return true;
      if (eslintNode.object.name !== node.object) return true; // If the property is missing from the rule, it means that only the
      // object is required to determine compatibility

      if (!node.property) break;
      if (eslintNode.property.name !== node.property) return true;
      break;

    default:
      return true;
  }

  return getUnsupportedTargets(node, targets).length === 0;
} //
// TODO: Migrate to compat-db
// TODO: Refactor isValid(), remove from rules
//


const CanIUseProvider = [// new ServiceWorker()
{
  id: 'serviceworkers',
  ASTNodeType: 'NewExpression',
  object: 'ServiceWorker'
}, {
  id: 'serviceworkers',
  ASTNodeType: 'MemberExpression',
  object: 'navigator',
  property: 'serviceWorker'
}, // document.querySelector()
{
  id: 'queryselector',
  ASTNodeType: 'MemberExpression',
  object: 'document',
  property: 'querySelector'
}, // WebAssembly
{
  id: 'wasm',
  ASTNodeType: 'MemberExpression',
  object: 'WebAssembly'
}, // IntersectionObserver
{
  id: 'intersectionobserver',
  ASTNodeType: 'NewExpression',
  object: 'IntersectionObserver'
}, // PaymentRequest
{
  id: 'payment-request',
  ASTNodeType: 'NewExpression',
  object: 'PaymentRequest'
}, // Promises
{
  id: 'promises',
  ASTNodeType: 'NewExpression',
  object: 'Promise'
}, {
  id: 'promises',
  ASTNodeType: 'MemberExpression',
  object: 'Promise',
  property: 'resolve'
}, {
  id: 'promises',
  ASTNodeType: 'MemberExpression',
  object: 'Promise',
  property: 'all'
}, {
  id: 'promises',
  ASTNodeType: 'MemberExpression',
  object: 'Promise',
  property: 'race'
}, {
  id: 'promises',
  ASTNodeType: 'MemberExpression',
  object: 'Promise',
  property: 'reject'
}, // fetch
{
  id: 'fetch',
  ASTNodeType: 'CallExpression',
  object: 'fetch'
}, // document.currentScript()
{
  id: 'document-currentscript',
  ASTNodeType: 'MemberExpression',
  object: 'document',
  property: 'currentScript'
}, // URL
{
  id: 'url',
  ASTNodeType: 'NewExpression',
  object: 'URL'
}, // URLSearchParams
{
  id: 'urlsearchparams',
  ASTNodeType: 'NewExpression',
  object: 'URLSearchParams'
}, // performance.now()
{
  id: 'high-resolution-time',
  ASTNodeType: 'MemberExpression',
  object: 'performance',
  property: 'now'
}, {
  id: 'object-values',
  ASTNodeType: 'MemberExpression',
  object: 'Object',
  property: 'values'
}].map(rule => Object.assign({}, rule, {
  isValid,
  getUnsupportedTargets
}));
var _default = CanIUseProvider;
exports.default = _default;