# Nomnoml Uml Diagrams Plugin

The **Nomnoml UML Diagrams** Plugin is for [Grav CMS](http://github.com/getgrav/grav). Renders [nomnoml UML Diagrams](https://github.com/skanaar/nomnoml) in Markdown through a `[nom]`-shortcode.

## Installation

Installing the Nomnoml Uml Diagrams plugin can be done in one of two ways. The GPM (Grav Package Manager) installation method enables you to quickly and easily install the plugin with a simple terminal command, while the manual method enables you to do so via a zip file.

### GPM Installation (Preferred)

The simplest way to install this plugin is via the [Grav Package Manager (GPM)](http://learn.getgrav.org/advanced/grav-gpm) through your system's terminal (also called the command line).  From the root of your Grav install type:

    bin/gpm install nomnoml-uml-diagrams

This will install the Nomnoml Uml Diagrams plugin into your `/user/plugins` directory within Grav. Its files can be found under `/your/site/grav/user/plugins/nomnoml-uml-diagrams`.

### Manual Installation

To install this plugin, just download the zip version of this repository and unzip it under `/your/site/grav/user/plugins`. Then, rename the folder to `nomnoml-uml-diagrams`. You can find these files on [GitHub](https://github.com/ole-vik/grav-plugin-nomnoml-uml-diagrams) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/nomnoml-uml-diagrams

## Configuration

Before configuring this plugin, you should copy the `user/plugins/nomnoml-uml-diagrams/nomnoml-uml-diagrams.yaml` to `user/config/plugins/nomnoml-uml-diagrams.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

```yaml
enabled: true
builtin_css: true
builtin_js: true
defaultoptions: 
```

Simply put, you can enable or disable the plugin, and enable or disable the plugin's built-in CSS and JS. The `defaultoptions` take an array of key-value pairs with [directives](https://github.com/skanaar/nomnoml#directives) and [styles](https://github.com/skanaar/nomnoml#custom-classifier-styles) for Nomnoml, eg.:

```
defaultoptions:
  arrowSize: '1'
  bendSize: '0.3'
  direction: down
  gutter: '5'
  edgeMargin: '3'
  edges: hard
  fill: 'rgb(255,255,255); rgb(251,251,251); rgb(247,247,247)'
  fillArrows: 'false'
  font: Calibri
  fontSize: '13'
  leading: '1.25'
  lineWidth: '2'
  padding: '10'
  spacing: '20'
  stroke: '#33322E'
  zoom: '1'
  .data: 'center dashed italic'
  .instance: 'center underline bold'
  .method: center
```

To disable the defaults on a specific diagram, add a `default=false` parameter, eg.: `[nom default=false]Grav->Awesome[/nom]`.

## Usage

In your page's Markdown, use the `[nom]`-shortcode to create a diagram. Full language-reference and docs available at [Nomnoml.com](http://www.nomnoml.com/). You can have multiple diagrams on the same page, each wrapped within `[nom]` and `[/nom]`.

### Examples

A very simple example:

```
[nom][Grav]->[Awesome][/nom]
```

A slightly more involved examples, using multiple lines to declare the diagram:

```
[nom]
[Pirate|eyeCount: Int|raid();pillage()|
  [beard]--[parrot]
  [beard]-:>[foul mouth]
]

[<abstract>Marauder]<:--[Pirate]
[Pirate]- 0..7[mischief]
[jollyness]->[Pirate]
[jollyness]->[rum]
[jollyness]->[singing]
[Pirate]-> *[rum|tastiness: Int|swig()]
[Pirate]->[singing]
[singing]<->[rum]

[<start>st]->[<state>plunder]
[plunder]->[<choice>more loot]
[more loot]->[st]
[more loot] no ->[<end>e]

[<actor>Sailor] - [<usecase>shiver me;timbers]
[/nom]
```

An example with custom styles and directives:

```
[nom]
#title: pgpm
#arrowSize: 1
#bendSize: 0.3
#direction: down
#gutter: 5
#edgeMargin: 3
#edges: hard
#fill: rgb(255,255,255); rgb(251,251,251); rgb(247,247,247)
#fillArrows: false
#font: Calibri
#fontSize: 13
#leading: 1.25
#lineWidth: 2
#padding: 10
#spacing: 20
#stroke: #33322E
#zoom: 1

#.data: center dashed italic
#.instance: center underline bold
#.method: center
[App]<:-:>[Controllers]
[Controllers]<:-:>[DataModel]
[Controllers]<:-:>[StorageModel]

[DataModel|
  [GitHub|
    [REST]<o-[JSON]
  ]
  [GPM|
    [HTTP]<o-[JSON]
  ]
]
[StorageModel|
  [Cache|
    [Driver]--[Temporary
    Storage]
  ]
  [Database|
    [Driver]--[Persistent
    Storage]
  ]
  [Filestorage|
    [Driver]--[Public
    Files]
  ]
]
[/nom]
```