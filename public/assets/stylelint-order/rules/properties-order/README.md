# properties-order

Specify the order of properties within declaration blocks.

```css
a {
	color: pink;
	top: 0;
}
/** ↑
 * These properties */
```

Prefixed properties *must always* precede the unprefixed version.

This rule ignores variables (`$sass`, `@less`, `--custom-property`).

* Options
* Optional secondary options
	* [`unspecified: "top"|"bottom"|"bottomAlphabetical"|"ignore"`](#unspecified-topbottombottomalphabeticalignore)
	* [`disableFix: true`](#disablefix-true)
* [Autofixing caveats](#autofixing-caveats)

## Options

```
["array", "of", "unprefixed", "property", "names", "or", "group", "objects"]
```

Within an order array, you can include

* unprefixed property names
* group objects with these properties:
	* `order: "flexible"`: If property isn't set (the default), the properties in this group must come in the order specified. If `"flexible"`, the properties can be in any order as long as they are grouped correctly.
	* `properties (array of strings)`: The properties in this group.
	* `emptyLineBefore ("always"|"never")`: If `always`, this group must be separated from other properties by an empty newline. If emptyLineBefore is `never`, the group must have no empty lines separating it from other properties. By default this property isn't set. Rule will check empty lines between properties _only_. However, shared-line comments ignored by rule. Shared-line comment is a comment on the same line as declaration before this comment.
	* `groupName`: An optional name for the group. This will be used in error messages.

There are some important details to keep in mind:

**By default, unlisted properties will be ignored.** So if you specify an array and do not include `display`, that means that the `display` property can be included before or after any other property. *This can be changed with the `unspecified` option* (see below).

Given:

```js
["transform", "top", "color"]
```

The following patterns are considered warnings:

```css
a {
	color: pink;
	top: 0;
}
```

```css
a {
	-moz-transform: scale(1);
	transform: scale(1);
	-webkit-transform: scale(1);
}
```

The following patterns are *not* considered warnings:

```css
a {
	top: 0;
	color: pink;
}
```

```css
a {
	-moz-transform: scale(1);
	-webkit-transform: scale(1);
	transform: scale(1);
}
```

```css
a {
	-webkit-transform: scale(1);
	-moz-transform: scale(1);
	transform: scale(1);
}
```

Given:

```js
["padding", "color", "padding-top"]
```

The following patterns are considered warnings:

```css
a {
	color: pink;
	padding: 1em;
}
```

```css
a {
	padding-top: 1em;
	color: pink;
}
```

The following patterns are *not* considered warnings:

```css
a {
	padding: 1em;
	color: pink;
}
```

```css
a {
	color: pink;
	padding-top: 1em;
}
```

Given:

```js
["font-smoothing", "color"]
```

Where `font-smoothing` is the unprefixed version of proprietary browser property `-webkit-font-smoothing`.

The following patterns are considered warnings:

```css
a {
	color: pink;
	-webkit-font-smoothing: antialiased;
}
```

```css
a {
	color: pink;
	font-smoothing: antialiased;
}
```

The following patterns are *not* considered warnings:

```css
a {
	-webkit-font-smoothing: antialiased;
	color: pink;
}
```

```css
a {
	font-smoothing: antialiased;
	color: pink;
}
```

Given:

```js
["padding", "padding-top", "padding-right", "padding-bottom", "padding-left", "color"]
```

The following patterns are considered warnings:

```css
a {
	padding-left: 2em;
	padding-top: 1em;
	padding: 1em;
	color: pink;
}
```

The following patterns are *not* considered warnings:

```css
a {
	padding-top: 1em;
	padding-right: 1em;
	padding-bottom: 0.5em;
	padding-left: 0.5em;
	color: pink;
}
```

```css
a {
	padding: 1em;
	padding-right: 2em;
	padding-left: 2.5em;
	color: pink;
}
```

Given:

```js
[
	{
		groupName: "dimensions",
		emptyLineBefore: "always",
		properties: [
			"height",
			"width",
		],
	},
	{
		groupName: "font",
		emptyLineBefore: "always",
		properties: [
			"font-size",
			"font-weight",
		],
	},
]
```

The following patterns are considered warnings:

```css
a {
	height: 1px;
	width: 2px;
	font-size: 2px;
	font-weight: bold;
}
```

```css
a {
	height: 1px;
	width: 2px;

	font-weight: bold;
	font-size: 2px;
}
```

```css
a {
	width: 2px;

	font-size: 2px;
	font-weight: bold;
	height: 1px;
}
```

The following patterns are *not* considered warnings:

```css
a {
	height: 1px;
	width: 2px;

	font-size: 2px;
	font-weight: bold;
}
```

Given:

```js
[
	{
		emptyLineBefore: "false",
		properties: [
			"height",
			"width",
		],
	},
	{
		emptyLineBefore: "false",
		properties: [
			"font-size",
			"font-weight",
		],
	},
]
```

The following patterns are considered warnings:

```css
a {
	height: 1px;
	width: 2px;

	font-size: 2px;
	font-weight: bold;
}
```

```css
a {
	height: 1px;
	width: 2px;

	font-weight: bold;
	font-size: 2px;
}
```

```css
a {
	width: 2px;

	font-size: 2px;
	font-weight: bold;
	height: 1px;
}
```

The following patterns are *not* considered warnings:

```css
a {
	height: 1px;
	width: 2px;
	font-size: 2px;
	font-weight: bold;
}
```

Given:

```js
[
	"height",
	"width",
	{
		order: "flexible",
		properties: [
			"color",
			"font-size",
			"font-weight",
		],
	},
]
```

The following patterns are considered warnings:

```css
a {
	height: 1px;
	font-weight: bold;
	width: 2px;
}
```

```css
a {
	width: 2px;
	height: 1px;
	font-weight: bold;
}
```

```css
a {
	height: 1px;
	color: pink;
	width: 2px;
	font-weight: bold;
}
```

The following patterns are *not* considered warnings:

```css
a {
	height: 1px;
	width: 2px;
	color: pink;
	font-size: 2px;
	font-weight: bold;
}
```

```css
a {
	height: 1px;
	width: 2px;
	font-size: 2px;
	color: pink;
	font-weight: bold;
}
```

## Optional secondary options

### `unspecified: "top"|"bottom"|"bottomAlphabetical"|"ignore"`

These options only apply if you've defined your own array of properties.

Default behavior is the same as `"ignore"`: an unspecified property can appear before or after any other property.

With `"top"`, unspecified properties are expected *before* any specified properties. With `"bottom"`, unspecified properties are expected *after* any specified properties. With `"bottomAlphabetical"`, unspecified properties are expected *after* any specified properties, and the unspecified properties are expected to be in alphabetical order.

Given:

```js
[["color", "background"], { unspecified: "ignore" }]
```

The following patterns are *not* considered warnings:

```css
a {
	color: pink;
	background: orange;
	left: 0;
}
```

```css
a {
	left: 0;
	color: pink;
	background: orange;
}
```

```css
a {
	color: pink;
	left: 0;
	background: orange;
}
```

Given:

```js
[["color", "background"], { unspecified: "top" }]
```

The following patterns are considered warnings:

```css
a {
	color: pink;
	background: orange;
	left: 0;
}
```

```css
a {
	color: pink;
	left: 0;
	background: orange;
}
```

The following patterns are *not* considered warnings:

```css
a {
	left: 0;
	color: pink;
	background: orange;
}
```

Given:

```js
[["color", "background"], { unspecified: "bottom" }]
```

The following patterns are considered warnings:

```css
a {
	left: 0;
	color: pink;
	background: orange;
}
```

```css
a {
	color: pink;
	left: 0;
	background: orange;
}
```

The following patterns are *not* considered warnings:

```css
a {
	color: pink;
	background: orange;
	left: 0;
}
```

Given:

```js
[["composes"], { unspecified: "bottomAlphabetical" }]
```

The following patterns are considered warnings:

```css
a {
	align-items: flex-end;
	composes: b;
	left: 0;
}
```

```css
a {
	composes: b;
	left: 0;
	align-items: flex-end;
}
```

The following patterns are *not* considered warnings:

```css
a {
	composes: b;
	align-items: flex-end;
	left: 0;
}
```

### `disableFix: true`

Disable autofixing. Autofixing is enabled by default if it's enabled in stylelint configuration.

## Autofixing caveats

Properties will be grouped together, if other node types between them (except comments). They will be groupped with the first found property. E. g.:

```css
/* Before: */
a {
	--custom-prop: 10px;
	top: 0;
	--another-custom-prop: 10px;
	bottom: 2px;
}

/* After: */
a {
	--custom-prop: 10px;
	top: 0;
	bottom: 2px;
	--another-custom-prop: 10px;
}
```

If `unspecified` secondary option was set to `ignore`, it will be re-set to `bottom`.
